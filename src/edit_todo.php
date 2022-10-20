<form action="edit.php?edit=todo" method="post">
    <style>
        input {
            width: 100%;
            background: #474747 !important;
            color: #fff;
        }
    </style>
    <?php
    if (isset($_GET['id'])) {
        $_SESSION['id'] = $_GET['id'];
        $_SESSION['todo_id'] = $_GET['todo_id'];
        $_SESSION['project_id'] = $_GET['project_id'];
        $_SESSION['todo_name'] = $_GET['todo_name'];
        $_SESSION['todo_progress'] = $_GET['todo_progress'];
        $yuri = htmlspecialchars($_GET['todo']); // HAH YURI!!! 🤣
        echo "<p>ToDo Name:<br>";
        echo '<input type="text" name="todo_name" id="todo_name" placeholder="Aufgaben Name" required><br>';
        echo "Project ID<br>";
        echo '<input type="text" name="project_id" id="project_id" placeholder="' . $_SESSION['project_id'] . '" value="' . $_SESSION['project_id'] . '" content="' . $_SESSION['project_id'] . '" required><br>';
        echo "ToDo ID<br>";
        echo '<input type="text" name="todo_id" id="todo_id" value="' . $_SESSION['id'] . '" placeholder="' . $_SESSION['id'] . '" content="' . $_SESSION['id'] . '" required><br>';
        echo "ToDo Progress:<br>";
        echo '<input type="number" value="' . $_SESSION['todo_progress'] . '" name="todo_progress" id="todo_progress" required placeholder="Aufgaben Status (NUR PROZENTUALE VERWENDEN)"><br>';
    }
    ?>
    <input type="submit" value="Aufgabe Bearbeiten"><br>
</form>