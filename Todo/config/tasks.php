<?php
    class Tasks extends Database {
        
        //Function to insert data
        public function executeQuery($sql) {
            $res = $this->connect()->query($sql);
            if($res)
                return true;
            else
                return false;
        }

        // Function to get all tasks
        public function getAllTasks() {
            $sql = "select * from todolists order by id desc";
            $result = $this->connect()->query($sql);

            $data = array();
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            return $data;
        }

        // Function to get all tasks
        public function getTask($id) {
            $sql = "select * from todolists where id = ".$id;
            $result = $this->connect()->query($sql);

            $data = array();
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data = $row;
                }
            }
            return $data;
        }


    }
?>



