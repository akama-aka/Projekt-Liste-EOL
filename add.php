<?php
use project_list\Config\Config;
require "./vendor/autoload.php";
\Sentry\init(['dsn' => 'https://4216cc1fb47a4e44964960e2d77407eb@o1236763.ingest.sentry.io/6412928']);
error_reporting(E_ERROR);


$titleb = "Projekte";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = htmlspecialchars($_POST["project_id"]);
    $project_name = htmlspecialchars($_POST["project_name"]);
    $project_progress = htmlspecialchars($_POST["project_progress"]);
    $todo_name = htmlspecialchars($_POST["todo_name"]);
    $todo_description = htmlspecialchars($_POST["todo_description"]);
    $todo_progress = htmlspecialchars($_POST["todo_progress"]);
};
?>
<!doctype html>
<html lang="de">
<head>

    <?php
    try {
        require(__DIR__ . '/assets/php/head.phtml');
        try {
            $conn = new pdo("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME, Config::DB_USER, Config::DB_PASSW);
        } catch (PDOException $e) {
            echo "<h1 class='errorbar'>" . $e->getMessage() . "</h1>";
            die();
        }
    } catch (Exception $e) {
        echo "<h1 class='errorbar'>" . $e->getMessage() . "</h1>";
    }
    ?>
</head>
<body>
<!-- PHP SCRIPT -->
<?php
try {
    if (empty($_GET['add'])) {
        echo "<h1>Was willst du erstellen?</h1>";
        echo "<a href='add.php?add=project'>Ein Projekt</a>";
        echo "<br>";
        echo "<a href='add.php?add=todo'>Eine Aufgabe (ToDo)</a>";
    } elseif ($_GET['add'] == 'todo') {
        if (isset($todo_name)) {
            if (empty($todo_name || $todo_description || $todo_progress || $project_id)) {
                echo "<h1 class='errorbar'>Bitte gebe einen Namen für die Aufgabe ein!</h1>";
            } elseif ($_POST['todo_progress'] > 100 || $_POST['todo_progress'] < 0) {
                echo "<h1 class='errorbar'>Bitte gebe einen gültigen Prozentsatz ein!</h1>";
            } else {
                $get_project_todo_id = "SELECT * FROM projects.project_todo WHERE id = :project_id";
                $get_project_todo_id_stmt = $conn->prepare($get_project_todo_id);
                $get_project_todo_id_stmt->bindParam(':project_id', $project_id);
                $execute_your_dad = $get_project_todo_id_stmt->execute();
                if (!empty($execute_your_dad)) {
                    $sql = "INSERT INTO projects.project_todo (todo_name, todo_description, todo_progress, project_id) VALUES (:todo_name, :todo_description, :todo_progress, :project_id)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':todo_name', $todo_name);
                    $stmt->bindParam(':todo_description', $todo_description);
                    $stmt->bindParam(':todo_progress', $todo_progress);
                    $stmt->bindParam(':project_id', $project_id);
                    $stmt->execute();
                    header("Location: index.php?status=todo_success");
                } else {
                    echo "<h1 class='errorbar'>Das Projekt existiert nicht!</h1>";
                }
            }
        } else {
            include './src/create_todo.php';
        }

    } elseif ($_GET['add'] == 'project') {
        if (isset($project_name)) {

            if (empty($project_name || $project_progress)) {
                echo "<h1 class='errorbar'>Bitte fülle alle felder aus!</h1>";
            } else {
                $sql = "INSERT INTO projects.project_list (project_name, project_progress) VALUES (:project_name, :project_progress)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':project_name', $project_name);
                $stmt->bindParam(':project_progress', $project_progress);
                try {
                    $stmt->execute();
                    header("Location: index.php?status=project_success");
                } catch (Exception $e) {
                    echo "<h1 class='errorbar'>FEHLER: " . $e->getMessage() . "</h1>";
                }

            }
        } else {
            include './src/create_project.php';
        }
    } else {
        echo "<h1 class='errorbar'>FEHLER: Ungültige Variable!</h1>";
    }
} catch (Exception $e) {
    echo "<h1 class='errorbar'>FEHLER: " . $e->getMessage() . "</h1>";
}
?>
<?php
include(__DIR__ . '/assets/php/footer.phtml');
?>
</body>
</html>