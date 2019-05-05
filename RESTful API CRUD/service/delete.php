<?php 
    include_once "./ConnectionGenerator.php";
    include_once "./ReadingItemClass.php";
    
    $generator = new ConnectionGenerator();
    $connection = $generator->getConnection();

    $reading_item = new ReadingItem($connection);

    $input = json_decode(file_get_contents("php://input"));

    if (isset($input->id)) { 
        $id = $input->id;
        
        if ($reading_item->delete($id)) {
            echo json_encode(['message' => "Succeeded! Deleted item with ID = " . $id]);
        } else {
            echo json_encode(['message' => "Failed! Delete item with ID = " . $id]);
        }
    }
?>