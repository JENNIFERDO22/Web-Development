<?php
    class ReadingItem {
        private $table_name = "ReadingList";

        private $connection;

        public function __construct($conn) {
            $this->connection = $conn;
        }

        public function create($name, $url, $desc) {
            $count_stmt = $this->connection->prepare("SELECT ID FROM " . $this->table_name . 
                " WHERE NAME = ? AND URL = ? AND DESCRIPTION= ?");
            $count_stmt->bind_param("sss", $name, $url, $desc);
            $count_stmt->execute();
            $result = $count_stmt->get_result();
            $numrows = $result->num_rows;

            if ($numrows > 0) {
                return json_encode(['message' => 'Failed! Item is already added before']);
            } else {
                $statement = $this->connection->prepare("INSERT IGNORE INTO " . $this->table_name . 
                "(Name, URL, Description) VALUES (?, ?, ?)");
                $statement->bind_param("sss", $name, $url, $desc);

                if ($statement->execute()) {
                    return json_encode(['message' => 'Successfully create new item']);
                } else {
                    return json_encode(['message' => 'Failed! Cannot create new item']);
                }
            }
        }

        public function retrieve($entry_point, $value_retrieve) {
            $query = "SELECT ID, DATE, NAME, URL, DESCRIPTION FROM " . $this->table_name;

            if ($entry_point == 'id') {
                $query .= " WHERE ID = ?";
                $statement = $this->connection->prepare($query);
                $statement->bind_param("i", $value_retrieve);
            } 
            
            else if ($entry_point == 'date'){
                $query .= " WHERE DATE BETWEEN ? AND ?";
                $statement = $this->connection->prepare($query);
                $end_time = $value_retrieve . " 23:59:59";
                $statement->bind_param("ss", $value_retrieve, $end_time);
            } 
            
            else {
                return 'Please enter an ID or a date';
            }

            $statement->execute();
            $result = $statement->get_result();

            $array_reading_list = [];

            while ($row = $result->fetch_assoc()) {
                
                $item_Id = $row['ID'];
                $item_Date = $row['DATE'];
                $item_Name = $row['NAME'];
                $item_URL = $row['URL'];
                $item_Description = $row['DESCRIPTION'];

                $array_reading_list[] = ['ID' => $item_Id, 'Date' => $item_Date, 'Name' => $item_Name, 'URL' => $item_URL, 'Desc' => $item_Description];
            }

            return json_encode($array_reading_list); 
        }

        public function update($id_item, $field_updating, $value_update) {
            $query = "UPDATE " . $this->table_name;
                
            if ($field_updating == 'name') {
                $query .= " SET NAME = ? ";
            } else if ($field_updating == 'URL'){
                $query .= " SET URL = ? ";
            } else if ($field_updating == 'theDesc'){
                $query .= " SET DESCRIPTION = ? ";
            } else {
                return false;
            }

            $query .= " WHERE ID = ?";
            $statement = $this->connection->prepare($query);
            $statement->bind_param("si", $value_update, $id_item);

            return $statement->execute();
        }

        public function delete($id) {
            $statement = $this->connection->prepare("DELETE FROM " . $this->table_name . " WHERE ID = ?");
            $statement->bind_param("i", $id);

            return $statement->execute();
        }

    }
?>