<?php 
    include_once "./ConnectionGenerator.php";
    include_once "./ReadingItemClass.php";
    
    $input = json_decode(file_get_contents("php://input"));

    if (isset($input->name)) {
        $name = $input->name;
        $url = $input->url;
        $desc = $input->desc;

        $generator = new ConnectionGenerator();
        $connection = $generator->getConnection();

        $reading_item = new ReadingItem($connection);

        echo $reading_item->create($name, $url, $desc);
    }

    /*
    $file_path = "../data/listCreating.json";

    $reading_file_json = file_get_contents($file_path);
    $json_decode_list = json_decode($reading_file_json, true);
    $json_reading_list = $json_decode_list['listCreating'];

    foreach($json_reading_list as $item) {

        $reading_item->name = $item['name'];
        $reading_item->URL = $item['URL'];
        $reading_item->description = $item['description'];

        if ($reading_item->create()) {
            echo '{"message": "New items in file ' . $file_path . ' were created"}';
        } else {
            echo '{"message": "Cannot create new items in file ' . $file_path . '}';
        } 
    }
    */

?>


