<?php
$host="localhost";
$username="root";
$password="";
$dbname="result";

$conn= new mysqli($host,$username,$password,$dbname);
if($conn->connect_error){
    die("connection failed".$conn->connect_error);
}
if(isset($_POST['R'],$_POST['branch'],$_POST['year'],$_POST['semester'],$_POST['month'],$_POST['years'])){
    $reg=$_POST['R'];
    $branch=$_POST['branch'];
    $year=$_POST['year'];
    $sem=$_POST['semester'];
    $month=$_POST['month'];
    $years=$_POST['years'];
}

        $table=$reg.$branch.$year.$sem.$month.$years;
        
$query="CREATE table if not EXISTS $table(
    id int auto_increment primary key
)";
if ($conn->query($query) === TRUE) {
    echo "<p align='bottom'>Table $table created successfully with 0 columns.</p>";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
