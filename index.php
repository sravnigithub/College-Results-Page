<!DOCTYPE html>
<html>
<head>
    <title>Student Results</title>
    <style>
        img {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh;
            margin: 0;
        }
        img {
            max-width: 50%;
            max-height: 50%;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333; 
            margin: 0;
            padding: 0;
        }
        .container {
            width: 95%;
            height: 95vh;
            length:100%;
            margin: auto;
            padding: 10px;
            background-color: #fff; 
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .center {
            text-align: left;
        }
        .student-info {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            align-items: left;
            margin: 20px 0;
        }
        .student-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .student-info th, .student-info td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .student-info th {
            background-color: #f2f2f2;
        }
        }
        }
        table {
            border-collapse: collapse;
            width: 80%;
            text-align: left;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .student-info {
        flex: 1;
    }

    .student-image {
        flex: 1;
        text-align: right;
    }
    .grades {
            margin-top: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center; 
        }

        .grades p {
            margin: 0 10px;
            align-items: center;
        }
        </style>
</head>
<body>
    <div class="container"><center>
        <center>
        <center><img src="https://dhondi.ai/logos/jntugvcev.png" alt="Centered Image"></center>
        <center>
            <font color="light-blue"><h2>JNTU-GV College of Engineering,Vizianagaram</h2></font>
            <h3>Examination Results</h3>
            <h3>III B.Tech I Semester Regular R20 December 2023</h3>

<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "result1";

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['rollnumber'])) {
    $name = $_POST['rollnumber'];
}
// Query to select data from the 'dummy' table
$query = "SELECT  *FROM dummy where Rollno= '$name' ";
#$x ="SELECT (`P&S I`+`P&S E`) as total from dummy where Rollno=$name";
$result = $conn->query($query);
#$y=$conn->query($x);
#$row=$y->fetch_assoc();


if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='student-container'>";

            echo "<table class='student-info'>";
               echo "<table>";
               echo "<tr>";
               $x=$row["P&S TOTAL"]+$row["PSE TOTAL"]+$row["CN TOTAL"]+$row["OS TOTAL"]+$row["MEFA TOTAL"]+$row["PSELAB TOTAL"]+$row["CNLAB TOTAL"]+$row["OSLAB TOTAL"]+$row["DELAB TOTAL"];
               echo "<tr><td>Hallticket NO</td><td>Student name</td><td>Total</td><td>Status</td></tr>";
               echo "<tr><td>".$row["Rollno"]."</td><td>".$row["Student Name"]."</td><td>".$x."</td></tr>";
               echo "</tr>";
               echo "</table>";

                echo "<table>";
               
                echo "<div class=''>";
                echo "<tr>";
                echo "<tr><td>subcode</td> <td>subname</td> <td>Internal marks</td> <td>External marks</td> <td>Total</td></tr>";
                echo "<tr><td>R202212BS01</td> <td>Probability and Statistics</td> <td>" . $row["P&SI"] . "</td> <td>" . $row["P&SE"] . "</td> <td>" . $row["P&S TOTAL"] . "</td></tr>";
                echo "<tr><td>R202212ES01 </td><td>Principles of Software Engineering</td><td>".$row["PSE I"]."</td><td>".$row["PSE E"]."</td><td>".$row["PSE TOTAL"]."</td></tr>";
                echo "<tr><td>R202212PC01 </td> <td>Computer Networks</td><td>".$row["CN I"]."</td><td>".$row["CN E"]."</td><td>".$row["CN TOTAL"]."</td></tr>";
                echo "<tr><td>R202212PC02</td> <td>Operating Systems</td><td>".$row["OS I"]."</td><td>".$row["OS E"]."</td><td>".$row["OS TOTAL"]."</td></tr>";
                echo "<tr><td>R2022HS01</td> <td>Managerial economics and financial analysis</td><td>".$row["MEFA I"]."</td><td>".$row["MEFA E"]."</td><td>".$row["MEFA TOTAL"]."</td></tr>";
                echo "<tr><td>R202212ES01A</td> <td>Software Engineering Lab </td><td>".$row["PSELAB I"]."</td><td>".$row["PSELAB E"]."</td><td>".$row["PSELAB TOTAL"]."</td></tr>";
                echo "<tr><td>R202212PC01A</td> <td>Computer Networks LAB </td><td>".$row["CNLAB I"]."</td><td>".$row["CNLAB  E"]."</td><td>".$row["CNLAB TOTAL"]."</td></tr>";
                echo "<tr><td>R202212PC02A</td><td>Operating Systems Lab</td><td>".$row["OSLAB I"]."</td><td>".$row["OSLAB E"]."</td><td>".$row["OSLAB TOTAL"]."</td></tr>";
                echo "<tr><td>R202212SC01</td><td>Data Exploration</td><td>".$row["DLAB I"]."</td><td>".$row["DELAB E"]."</td><td>".$row["DELAB TOTAL"]."</td></tr>";
                echo "</tr>";
    } echo "</table>";
} else {
    echo "No results found.";
}

// Close the connection
$conn->close();
?>
