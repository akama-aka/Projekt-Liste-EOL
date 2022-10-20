<?php
use project_list\Config\Config;
require "./vendor/autoload.php";
\Sentry\init(['dsn' => 'https://4216cc1fb47a4e44964960e2d77407eb@o1236763.ingest.sentry.io/6412928']);

error_reporting(E_ERROR);

$titleb = "Projekte";
/*$prozent_query = "SELECT todo_progress FROM projects.project_todo WHERE project_id = :project_id";

$prozent_stmt = $conn->prepare($prozent_query);
$prozent_stmt->execute();
$prozent_result = $prozent_stmt->fetchAll();
var_dump($prozent_result);
$count = 0;
foreach ($prozent_result as $prozent_wert) {
    $count++;
    $sum += $prozent_wert['todo_progress'];
}

echo $sum;*/
#############################
## PROZENTUALE BERECHNUNG  ##
#############################
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
    try {
        $conn = new pdo("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME, Config::DB_USER, Config::DB_PASSW);
    } catch (PDOException $e) {
        echo "<h1 class='errorbar'>" . $e->getMessage() . "</h1>";
        #die();
    }
    ?>
</head>
<body>
<div id="warning">
    <h1>!!ACHTUNG!! Support endet am 1.12.2022</h1>
    <small>Mehr Informationen auf GitHub (Klicke <a href="">hier</a>)<br></small>
    <small onclick="closeButton()" style=" cursor: pointer">Close</small>
</div>
<script>
    function closeButton() {
        let x = document.getElementById("warning");
        console.log("closed");
        x.style.display = "none";
        x.style.visibility = "hidden";
    }

    function reload() {
        location.reload();
    }

    setTimeout(reload, 300000);
</script>
<?php
require(__DIR__ . '/assets/php/body.phtml');
try {
    $query_projects = $conn->query("SELECT * FROM project_list");
    $fetch_projects = $query_projects->fetchAll();
} catch (Exception $e) {
    echo "<h1 class='errorbar'>" . $e->getMessage() . "</h1>";
}
if (isset($_GET['project'])) {
    try {
        $get_todos = "SELECT * FROM project_todo WHERE project_id=:project_id";
        $query_todos = $conn->prepare($get_todos);
        $query_todos->bindParam(":project_id", $_GET['project']);
        $get_data = $query_todos->execute();
        $fetch_todos = $query_todos->fetchAll();
    } catch (Exception $e) {
        echo "<h1 class='errorbar'>" . $e->getMessage() . "</h1>";
    }
}
?>
<div class="container">
    <h1></h1>
    <?php
    if ($_GET['status'] == "todo_success") {
        echo "<h1 class='success'>Die Aufgabe wurde erfolgreich erstellt / bearbeitet!</h1>";
    } elseif ($_GET['status'] == 'project_success') {
        echo "<h1 class='success'>Das Projekt wurde erfolgreich erstellt / bearbeitet!</h1>";
    } else {
        $_GET['status'] = NULL;
    }
    ?>
    <table>
        <thead>
        <tr>
            <th>Projekte</th>
            <?php
            if (!empty($_GET['project'])) {
                #echo '<th>Beschreibung</th>';
            }
            ?>
            <th>Status</th>
            <?php
            if (!empty($_GET['project'])) {
                echo '<th>Bearbeiten</th>';
            }
            ?>
        </thead>
        <tbody>
        <?php
        if (empty($_GET['project'])) {
            include './src/get_projects.phtml';
        } else {
            include './src/get_todos.phtml';
        }
        ?>
        </tbody>
    </table>
    <style>
        .btn-back {
            background-color: #00bcd4;
            color: white;
            border-radius: 5px;
            padding: 5px;
            margin: 5px;
            border-width: 0;
            font-size: 20px;
            font-weight: bolder;
        }
    </style>
    <button class="btn-back" onclick="history.back()" style="margin-right: 82.2%; margin-left: 0"><a>Back</a></button>
    <button class="btn-back" onclick="history.forward()" style="margin-right: 0; "><a>Forward</a>
    </button>
    <div class="footer row">
    </div>
</div>
<?php
include(__DIR__ . '/assets/php/footer.phtml');
?>
</body>
</html>