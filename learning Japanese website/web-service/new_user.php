<?php
    include_once "../web-service/getConnection.php";

    header("Content-Type: application/json", true);

    echo "Audo";

    $input = json_decode(file_get_contents("php://input"));
    echo $input;

    if (isset($input)) {
        $conn = new Connection().getConnection();
        
        $uname = $input->uname;
        $pass = $input->pass;

        $sql = "SELECT `id` FROM Users WHERE `username`='$uname'";
        $result = $conn->query($sql);

        if (!$result || $result->num_rows == 0) {
            $sql = "INSERT INTO Users (username, password)
            VALUES ('$uname', '$pass')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error";
            }
        } else {
            echo 'User already exists';
        }

        $conn->close();
    }
    
?>