<?php
    header("Content-Type: application/json", true);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "UserDatabase";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $uname = $_POST["uname"];
    $pass = $_POST["pass"];

    $sql = 'SELECT `id`, `password` FROM Users WHERE `username`="' . $uname. '" ';
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($pass == $row["password"]) {
            echo "login";
        } else {
            echo "wrong password";
        }
    } else {
        echo "username does not exists";
    }

    $conn->close();
?>


