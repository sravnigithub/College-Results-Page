<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "result";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['table_names'])) {
        $selectedTable = $_POST['table_names'];
        $columnNames = array();

        $query = "SHOW COLUMNS FROM $selectedTable";
        $result = $conn->query($query);

        if ($result === false) {
            die("Error: " . $conn->error);
        }

        echo '<form action="" method="post">';
        echo "<h2>Table: $selectedTable</h2>";

        while ($row = $result->fetch_assoc()) {
            $columnName = $row['Field'];
            $columnNames[] = $columnName;

            echo "<label for='$columnName'>$columnName:</label><br>";
            echo "<input type='text' id='$columnName' name='$columnName'><br><br>";
        }

        echo '<input type="hidden" name="selected_table" value="' . $selectedTable . '">';
        echo '<input type="submit" value="Submit">';
        echo '</form>';

        if (isset($_POST['selected_table'])) {
            $selectedTable = $_POST['selected_table'];
            $query = "INSERT INTO $selectedTable (";

            foreach ($columnNames as $index => $columnName) {
                $query .= $columnName;
                if ($index !== count($columnNames) - 1) {
                    $query .= ", ";
                }
            }

            $query .= ") VALUES (";

            foreach ($columnNames as $index => $columnName) {
                $value = $_POST[$columnName];
                $query .= "'$value'";
                if ($index !== count($columnNames) - 1) {
                    $query .= ", ";
                }
            }

            $query .= ")";

            if ($conn->query($query) !== true) {
                echo "Error updating table: " . $conn->error;
            } else {
                echo "Data updated successfully.";
            }
        }
    }
}
?>