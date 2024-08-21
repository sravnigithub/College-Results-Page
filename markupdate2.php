<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "result";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
    <title>Update Table</title>
</head>
<body>
    <h1>Update Table</h1>

    <form action="markupdate3.php" target='frame2' method="post">
        <p>Select table:</p>
        <select name="table_names">
            <?php
            while ($row = $result->fetch_row()) {
                echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
            }
            ?>
        </select>
        <br><br>

        <input type="submit" value="OK">
    </form>
</body>
</html>

