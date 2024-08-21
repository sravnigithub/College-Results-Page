<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "result";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$selectedTable = '';
if (isset($_POST['table_names'])) {
    $selectedTable = $_POST['table_names'];
    $query = "SHOW COLUMNS FROM $selectedTable";
    $result = $conn->query($query);

    if ($result === false) {
        die("Error: " . $conn->error);
    }

    
}

$query = "SHOW TABLES FROM $database";
$result = $conn->query($query);

if ($result === false) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Input Columns</title>
    <style>
        .input-container {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Dynamic Input Columns</h1>

    <form action="" method="post">
        <center>
            <p>Select table:</p>
            <select name="table_names" onchange="this.form.submit()">
                <option value="">--Select a table--</option>
                <?php
                while ($row = $result->fetch_row()) {
                    $tableName = $row[0];
                    $selected = ($tableName === $selectedTable) ? 'selected' : '';
                    echo "<option value='$tableName' $selected>$tableName</option>";
                }
                ?>
            </select>
        </center>

        <?php if ($selectedTable) { ?>
            <h2>Columns in table <?php echo $selectedTable; ?>:</h2>
            <ul>
                <?php
                $query = "SHOW COLUMNS FROM $selectedTable";
                $result = $conn->query($query);

                if ($result === false) {
                    die("Error: " . $conn->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . $row['Field'] . "</li>";
                }
                ?>
            </ul>
        <?php } ?>

        <div id="input-container">
            <div class="input-container">
                <input type="text" name="column1" placeholder="Column 1">
            </div>
        </div>

        <button type="button" id="addColumnBtn" onclick="addColumn()">Add Column</button><br><br>
        <input type="submit" value="Update" id="updateBtn">
    </form>

    <script>
        // Function to add a new input column
        function addColumn() {
            const inputContainer = document.getElementById("input-container");
            const newInput = document.createElement("div");
            newInput.className = "input-container";
            newInput.innerHTML = `<input type="text" name="column${inputContainer.children.length + 1}" placeholder="Column ${inputContainer.children.length + 1}">`;
            inputContainer.appendChild(newInput);
        }
    </script>

    <form action="markupdate1.html"> 
        <input type="submit" name="addmark" value="Addmarks"> 
    </form>
</body>
</html>
