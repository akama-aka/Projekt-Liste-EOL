<?php
use project_list\Config\Config;
require "./vendor/autoload.php";
\Sentry\init(['dsn' => 'https://4216cc1fb47a4e44964960e2d77407eb@o1236763.ingest.sentry.io/6412928']);
error_reporting(E_ERROR);
try {
    $conn = new pdo("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME, Config::DB_USER, Config::DB_PASSW);
} catch (PDOException $e) {
    echo "<h1 class='errorbar'>" . $e->getMessage() . "</h1>";
    die();
}
$titleb = "Projekte";
?>
<!doctype html>
<html lang="de">
<head>
    <?php
    try {
        require(__DIR__ . '/assets/php/head.phtml');
    } catch (Exception $e) {
        echo "<h1 class='errorbar'>" . $e->getMessage() . "</h1>";
    }
    ?>

</head>
<body>
<?php
if (empty($_GET['edit'])) {
    echo "<h1>Was willst du bearbeiten?</h1>";
    echo "<a href='edit.php?edit=project'>Ein Projekt</a>";
    echo "<br>";
    echo "<a href='edit.php?edit=todo'>Eine Aufgabe (ToDo)</a>";
} elseif ($_GET['edit'] == 'todo') {
    if (isset($_POST['todo_name'])) {
        if (empty($_POST['todo_name'] || $_POST['todo_progress'] || $_POST['project_id'])) {
            echo "<h1 class='errorbar'>Bitte gebe einen Namen für die Aufgabe ein!</h1>";
        } elseif ($_POST['todo_progress'] > 100 || $_POST['todo_progress'] < 0) {
            echo "<h1 class='errorbar'>Bitte gebe einen gültigen prozentualen wert ein!</h1>";
        } else {
            $get_project_todos = "SELECT * FROM projects.project_todo WHERE project_id=:project_id AND id=:id";
            $get_project_todos = $conn->prepare($get_project_todos);
            $get_project_todos->bindParam(':project_id', $_POST['project_id']);
            $get_project_todos->bindParam(':id', $_POST['id']);
            $execute_your_mom = $get_project_todos->execute();
            if (!empty($execute_your_mom)) {
                if (empty($_POST['todo_name'])) {
                    $update = "UPDATE projects.project_todo SET todo_progress=:todo_progress WHERE project_id=:project_id AND id=:id";
                    $stmt = $conn->prepare($update);
                    $stmt->bindParam(':todo_progress', $_POST['todo_progress']);
                    $stmt->bindParam(':project_id', $_POST['project_id']);
                    $stmt->bindParam(':id', $_POST['id']);
                } else {
                    $update = "UPDATE projects.project_todo SET todo_progress=:todo_progress, todo_name=:todo_name WHERE project_id=:project_id AND id=:id";
                    $stmt = $conn->prepare($update);
                    $stmt->bindParam(':todo_name', $_POST['todo_name']);
                    $stmt->bindParam(':todo_progress', $_POST['todo_progress']);
                    $stmt->bindParam(':project_id', $_POST['project_id']);
                    $stmt->bindParam(':id', $_POST['todo_id']);
                }
                $stmt->execute();
                header("Location: index.php?status=todo_success");
            } else {
                echo "<h1 class='errorbar'>Das Projekt existiert nicht!</h1>";
            }
        }
    } else {
        include './src/edit_todo.php';
    }
} elseif ($_GET['edit'] == 'project') {
    if (isset($_POST['project_name'])) {
        if (empty($_POST['project_name'])) {
            echo "<h1 class='errorbar'>Bitte gebe den neuen Namen von dem Projekt an!</h1>";
        } else {
            $check_your_mom = "SELECT * FROM projects.project_list WHERE id = :id";
            $check_your_mom = $conn->prepare($check_your_mom);
            $check_your_mom->bindParam(':id', $_POST['id']);
            $execute_your_mom = $check_your_mom->execute();
            if (!empty($execute_your_mom)) {
                $update = "UPDATE projects.project_list SET project_name=:project_name WHERE project_id=:project_id";
                $stmt = $conn->prepare($update);
                $stmt->bindParam(':project_name', $_POST['project_name']);
                $stmt->bindParam(':project_id', $_POST['project_id']);
                try {
                    $stmt->execute();
                } catch (Exception $e) {
                    echo "<h1 class='errorbar'>Fehler beim Bearbeiten des Projekts!</h1>";
                }
                header("Location: index.php?status=project_success");
            } else {
                echo "<h1 class='errorbar'>Das Projekt existiert nicht!</h1>";
            }
        }
    } else {
        include './src/edit_project.php';
    }
}
?>
<?php
include(__DIR__ . '/assets/php/footer.phtml');
?>
</body>
</html>