<?php
    include_once "ConnectionGenerator.php";

    $generator = new connectionGenerator();
    $connection = $generator->getConnection();

    $query = "CREATE TABLE IF NOT EXISTS ReadingList(
            ID INT(6) AUTO_INCREMENT PRIMARY KEY,
            Date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            Name VARCHAR(100) NOT NULL,
            URL VARCHAR(200) NOT NULL,
            Description VARCHAR(400)
        )";

    if ($connection->query($query) === TRUE) {
        echo "Table ReadingList created successfully";
    } else {
        echo "Error creating table: " . $connection->error;
    }

    $connection->close();

?>