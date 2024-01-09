<?php

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }

    $stmt = $conn->prepare("SELECT * FROM user WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $user_type = $row['user_type'];
        session_start();
        $_SESSION["username"] = $username;

        if ($user_type == 'staff') {
            header("Location: dashboard.php");
        } elseif ($user_type == 'admin') {
            header("Location: admin-dashboard.php");
        } else {
            echo "Invalid user type";
        }
    } else {
        echo "Login Failed";
    }

    $stmt->close();
    $conn->close();
}



?>