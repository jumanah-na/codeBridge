<?php
// Start the session to hold information about the user
session_start();

// When the user submits the login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve from the form
    $ID = $_POST['ID'];
    $password = $_POST['password'];

    // Connect to the DB
    $servername = "localhost:3308";
    $username = "root";
    $dbPassword = "";
    $dbname = "codeBridge";

    // Create connection
    $conn = new mysqli($servername, $username, $dbPassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL for authentication from student and instructor tables
    //-------------student
    $sql = "SELECT * FROM student WHERE stuID = '$ID' AND stuPassword = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Direct the user to the student page
        header("Location: student.html");
        exit();
    }

    //--------------instructor
    $sql = "SELECT * FROM instructor WHERE insID = '$ID' AND insPassword = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Direct the user to the instructor page
        header("Location: instructor.html");
        exit();
    }

    // Invalid credentials
    echo "Invalid ID or password. Please try again.";
    exit();

    $conn->close();
}
?>