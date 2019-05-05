<?php 
    include_once "./ConnectionGenerator.php";
    include_once "./ReadingItemClass.php";
    
    $generator = new ConnectionGenerator();
    $connection = $generator->getConnection();

    $reading_item = new ReadingItem($connection);

    $input = json_decode(file_get_contents("php://input"));

    if (isset($input->id)) {
        $id = $input->id;

        if (isset($input->name)) {
            $name = $input->name;
            if ($reading_item->update($id, 'name', $name)) {
                echo json_encode(['message' => "Succeeded! Updated name = " . $name . " with ID = " . $id]);
            } else {
                echo json_encode(['message' => "Failed! Cannot update name = " . $name . " with ID = " . $id]);
            }
        }

        else if (isset($input->url)) {
            $url = $input->url;
            if ($reading_item->update($id, 'URL', $url)) {
                echo json_encode(['message' => "Succeeded! Updated URL = " . $url . " with ID = " . $id]);
            } else {
                echo json_encode(['message' => "Failed! Cannot update URL = " . $url . " with ID = " . $id]);
            }
        }

        else if (isset($input->desc)) {
            $desc = $input->desc;
            if ($reading_item->update($id, 'theDesc', $desc)) {
                echo json_encode(['message' => "Succeeded! Updated description = " . $desc . " with ID = " . $id]);
            } else {
                echo json_encode(['message' => "Failed! Cannot update description = " . $desc . " with ID = " . $id]);
            }
        }

    }
    

?>