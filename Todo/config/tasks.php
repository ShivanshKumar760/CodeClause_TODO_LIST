<?php
    class Tasks extends Database {
        
       
        public function executeQuery($sql) {
            $res = $this->connect()->query($sql);
            if($res)
                return true;
            else
                return false;
        }

       
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



