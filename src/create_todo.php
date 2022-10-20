<form action="add.php?add=todo" method="post">
    <input type="text" name="todo_name" id="todo_name" placeholder="Aufgaben Name" required><br>
    <input type="text" name="todo_description" id="todo_description" placeholder="Aufgaben Beschreibung" required><br>
    <?php
    $yuri = htmlspecialchars($_GET['todo']);
    if (isset($_GET['todo'])) {
        if (isset($_GET['id'])) {
            echo '<input type="text" name="project_id" id="project_id" placeholder="Projekt ID" value="' . $_GET['id'] . '" content="' . $yuri . '" required><br>';
        } else {
            echo '<input type="text" name="project_id" id="project_id" placeholder="Projekt ID" required><br>';
        }
    } else {
        echo '<input type="text" name="project_id" id="project_id" placeholder="Projekt ID" required><br>';
    }
    ?>
    <input type="number" name="todo_progress" id="todo_progress" required
           placeholder="Aufgaben Status (NUR PROZENTUALE VERWENDEN)"><br>
    <input type="submit" value="Aufgabe Bearbeiten"><br>
</form>