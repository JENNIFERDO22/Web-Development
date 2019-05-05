<?php 
    include_once "./ConnectionGenerator.php";
    include_once "./ReadingItemClass.php";
    
    $generator = new ConnectionGenerator();
    $connection = $generator->getConnection();

    $reading_item = new ReadingItem($connection);

    $input = json_decode(file_get_contents("php://input"));

    if (isset($input)) {
        if (isset($input->date)) {
            $date = $input->date;
            echo $reading_item->retrieve('date', $date);
        } 
        
        else if (isset($input->id)) {
            $id = $input->id;
            echo $reading_item->retrieve('id', $id);
        }
    }
    
?>