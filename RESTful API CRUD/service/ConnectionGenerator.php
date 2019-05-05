<?php
    class ConnectionGenerator {
        
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "ReadingList";

        private $connection;

        function getConnection() {
            $this->connection = null;

            // Create connection
            $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
            // Check connection
            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }

            return $this->connection;
        }
    }
?>