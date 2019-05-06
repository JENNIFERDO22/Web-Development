<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS UserDatabase";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
    
    $conn->close();

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

    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table Users created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $sql = "CREATE TABLE IF NOT EXISTS QuizResults (
        idQuiz INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        idUser INT(6) UNSIGNED NOT NULL,
        result VARCHAR(100) NOT NULL,
        FOREIGN KEY (idUser) REFERENCES Users(id)
        )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table Users created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();

?>