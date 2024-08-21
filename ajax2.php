<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exam Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            text-align: center;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300vh;
        }

        img.centered {
            max-width: 100px;
            display: block;
            margin: 0 auto;
        }

        h2 {
            color: #0074e4;
        }

        h3 {
            color: #333;
        }

        .hallticket {
            width: 20%;
            padding: 10px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            text-align: left;
        }

        th, td {
            padding: 8px;
        }
    </style>
</head>
<body>
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "dummy";

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['rollnumber'])) {
    $name = $_POST['rollnumber'];

    // Query to select data from the 'dummy' table
    $query = "SELECT * FROM dummy WHERE Rollno= '$name'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<div class='container'>";
        echo "<img class='centered' src='https://dhondi.ai/logos/jntugvcev.png' alt='Centered Image'>";
        echo "<h2>JNTU-GV College of Engineering, Vizianagaram</h2>";
        echo "<h3>Examination Results</h3>";
        echo "<h3>III B.Tech I Semester Regular R20 December 2023</h3>";

        while ($row = $result->fetch_assoc()) {
            echo "<table>";
            echo "<tr><td>Hallticket NO</td><td>Student name</td></tr>";
            echo "<tr><td>" . $row["Rollno"] . "</td><td>" . $row["Student Name"] . "</td></tr>";
            echo "<tr><td>Total Marks</td><td>" . calculateTotalMarks($row) . "</td></tr>";
            echo "<tr><td>Total Credits</td><td>" . calculateTotalCredits($row) . "</td></tr>"; // Add Total Credits
            echo "<tr><td>Status of the Student</td><td>" . calculateStatus($row) . "</td></tr>"; // Add Student Status
            echo "</table>";

            echo "<table>";
            echo "<tr><td>SubjectCode</td><td>SubjectName</td><td>Internal Marks</td><td>External Marks</td><td>Total Marks</td><td>Grade</td><td>Credits</td><td>Status</td></tr>";
            echo "<tr><td>R202212BS01</td><td>Probability and Statistics</td><td>" . $row["P&S I"] . "</td><td>" . $row["P&S E"] . "</td><td>" . $row["P&S TOTAL"] . "</td><td>" . calculateGrade($row["P&S TOTAL"]) . "</td><td>" . calculateCredits($row["P&S TOTAL"]) . "</td><td>" . calculateStatus($row["P&S TOTAL"]) . "</td></tr>";
            echo "<tr><td>R202212ES01</td><td>Principles of Software Engineering</td><td>" . $row["PSE I"] . "</td><td>" . $row["PSE E"] . "</td><td>" . $row["PSE TOTAL"] . "</td><td>" . calculateGrade($row["PSE TOTAL"]) . "</td><td>" . calculateCredits($row["PSE TOTAL"]) . "</td><td>" . calculateStatus($row["PSE TOTAL"]) . "</td></tr>";
            echo "<tr><td>R202212PC01</td><td>Computer Networks</td><td>" . $row["CN I"] . "</td><td>" . $row["CN E"] . "</td><td>" . $row["CN TOTAL"] . "</td><td>" . calculateGrade($row["CN TOTAL"]) . "</td><td>" . calculateCredits($row["CN TOTAL"]) . "</td><td>" . calculateStatus($row["CN TOTAL"]) . "</td></tr>";
            echo "<tr><td>R202212PC02</td><td>Operating Systems</td><td>" . $row["OS I"] . "</td><td>" . $row["OS E"] . "</td><td>" . $row["OS TOTAL"] . "</td><td>" . calculateGrade($row["OS TOTAL"]) . "</td><td>" . calculateCredits($row["OS TOTAL"]) . "</td><td>" . calculateStatus($row["OS TOTAL"]) . "</td></tr>";
            echo "<tr><td>R2022HS01</td><td>Managerial economics and financial analysis</td><td>" . $row["MEFA I"] . "</td><td>" . $row["MEFA E"] . "</td><td>" . $row["MEFA TOTAL"] . "</td><td>" . calculateGrade($row["MEFA TOTAL"]) . "</td><td>" . calculateCredits($row["MEFA TOTAL"]) . "</td><td>" . calculateStatus($row["MEFA TOTAL"]) . "</td></tr>";
            echo "<tr><td>R202212ES01A</td><td>Software Engineering Lab</td><td>" . $row["PSELAB I"] . "</td><td>" . $row["PSELAB E"] . "</td><td>" . $row["PSELAB TOTAL"] . "</td><td>" . calculateGrade($row["PSELAB TOTAL"]) . "</td><td>" . calculateCredits($row["PSELAB TOTAL"], true) . "</td><td>" . calculateStatus($row["PSELAB TOTAL"]) . "</td></tr>";
            echo "<tr><td>R202212PC01A</td><td>Computer Networks LAB</td><td>" . $row["CNLAB I"] . "</td><td>" . $row["CNLAB  E"] . "</td><td>" . $row["CNLAB TOTAL"] . "</td><td>" . calculateGrade($row["CNLAB TOTAL"]) . "</td><td>" . calculateCredits($row["CNLAB TOTAL"], true) . "</td><td>" . calculateStatus($row["CNLAB TOTAL"]) . "</td></tr>";
            echo "<tr><td>R202212PC02A</td><td>Operating Systems Lab</td><td>" . $row["OSLAB I"] . "</td><td>" . $row["OSLAB E"] . "</td><td>" . $row["OSLAB TOTAL"] . "</td><td>" . calculateGrade($row["OSLAB TOTAL"]) . "</td><td>" . calculateCredits($row["OSLAB TOTAL"], true) . "</td><td>" . calculateStatus($row["OSLAB TOTAL"]) . "</td></tr>";
            echo "<tr><td>R202212SC01</td><td>Data Exploration</td><td>" . $row["DLAB I"] . "</td><td>" . $row["DELAB E"] . "</td><td>" . $row["DELAB TOTAL"] . "</td><td>" . calculateGrade($row["DELAB TOTAL"]) . "</td><td>" . calculateCredits("Data Exploration", $row["DELAB TOTAL"]) . "</td><td>" . calculateStatus($row["DELAB TOTAL"]) . "</td></tr>";

            echo "</table>";
        }
        echo "</div>";
    } else {
        echo "<div class='container'>";
        echo "<img class='centered' src='https://dhondi.ai/logos/jntugvcev.png' alt='Centered Image'>";
        echo "<h2>JNTU-GV College of Engineering, Vizianagaram</h2>";
        echo "<h3>Examination Results</h3>";
        echo "<h3>III B.Tech I Semester Regular R20 December 2023</h3>";
        echo "<form method='post'>";
        echo "<input type='text' autocomplete='new-password' name='rollnumber' class='hallticket' placeholder='HallTicket Number' maxlength='10'>";
        echo "<br>";
        echo "<button type='submit'>Get Result</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    // If $_POST['rollnumber'] is not set, display an initial form
    echo "<div class='container'>";
    echo "<img class='centered' src='https://dhondi.ai/logos/jntugvcev.png' alt='Centered Image'>";
    echo "<h2>JNTU-GV College of Engineering, Vizianagaram</h2>";
    echo "<h3>Examination Results</h3>";
    echo "<h3>III B.Tech I Semester Regular R20 December 2023</h3>";
    echo "<form method='post'>";
    echo "<input type='text' autocomplete='new-password' name='rollnumber' class='hallticket' placeholder='HallTicket Number' maxlength='10'>";
    echo "<br>";
    echo "<button type='submit'>Get Result</button>";
    echo "</form>";
    echo "</div>";
}

// Function to calculate the credits based on total marks
function calculateCredits($totalMarks, $isLab = false) {
    return $totalMarks >= 35 ? ($isLab ? 1.5 : 3) : ''; // Give 3 credits for subjects, and 1.5 credits for labs if pass, else blank for fail
}

// Function to calculate the grade based on total marks
function calculateGrade($totalMarks) {
    if ($totalMarks >= 90) {
        return 'A+';
    } elseif ($totalMarks >= 80) {
        return 'A';
    } elseif ($totalMarks >= 70) {
        return 'B';
    } elseif ($totalMarks >= 60) {
        return 'C';
    } elseif ($totalMarks >= 40) {
        return 'D';
    } else {
        return 'F';
    }
}

// Function to calculate the pass/fail status
function calculateStatus($totalMarks) {
    return $totalMarks >= 35 ? 'Pass' : 'Fail';
}

// Function to calculate the total marks
function calculateTotalMarks($row) {
    $totalMarks = 0;
    // Calculate the total marks by summing up marks from all subjects
    $totalMarks += $row["P&S TOTAL"] + $row["PSE TOTAL"] + $row["CN TOTAL"] + $row["OS TOTAL"] + $row["MEFA TOTAL"] + $row["PSELAB TOTAL"] + $row["CNLAB TOTAL"] + $row["OSLAB TOTAL"] + $row["DELAB TOTAL"];
    return $totalMarks;
}

// Function to calculate the total credits based on all subjects
function calculateTotalCredits($row) {
    $totalCredits = 0;

    // Calculate the total credits by summing up credits from all subjects
    $totalCredits += calculateCredits($row["P&S TOTAL"]) +
                     calculateCredits($row["PSE TOTAL"]) +
                     calculateCredits($row["CN TOTAL"]) +
                     calculateCredits($row["OS TOTAL"]) +
                     calculateCredits($row["MEFA TOTAL"]) +
                     calculateCredits($row["PSELAB TOTAL"], true) +
                     calculateCredits($row["CNLAB TOTAL"], true) +
                     calculateCredits($row["OSLAB TOTAL"], true) +
                     calculateCredits("Data Exploration", $row["DELAB TOTAL"]);

    return $totalCredits;
}

// Close the connection
$conn->close();
?>
</body>
</html>
