<?php

class receptinfo {


    private $connection;
    private $usr;
    private $favoriet;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->usr = new User($connection);
    }

    private function selectUser($user_id){
        $user = $this->usr->selecteerUser($user_id);

        return ($user);
    }

    private function addFavorite($recipe_id, $record_type, $user_id){
        $sql = "INSERT INTO recipe_info (recipe_id, record_type, user_id) Values ('$recipe_id','F','$user_id')";
        if (mysqli_query($connection, $sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function deleteFavorite($recipe_id, $record_type, $user_id){
        $sql = "DELETE FROM recipe_info WHERE recipe_id = $recipe_id AND record_type = 'F' AND user_id = $user_id ";
        if (mysqli_query($connection, $sql)) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function selecteerReceptinfo($recipe_id, $record_type) {
        $sql = "select * from recipe_info where recipe_id = '$recipe_id' AND record_type = '$record_type'";
        $result = mysqli_query($this->connection, $sql);
        $arr = [];

        if ($record_type == "O") {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $user_id = $row['user_id'];
                $user = $this->selectUser($user_id);
                $arr[] = [ 
                    "id"=>$row['id'],
                    "recipe_id"=>$row['recipe_id'],
                    "record_type" =>$row['record_type'],
                    "user_id" =>$row['user_id'],
                    "date" =>$row['date'],
                    "numeric_field" =>$row['numeric_field'],
                    "text_field" =>$row['text_field'],
                ];
            
            return $arr;
            }
        }elseif ($record_type == "F") {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $user_id = $row['user_id'];
                $user = $this->selectUser($user_id);
                $arr[] = [
                    "id" => $row['id'],
                    "recipe_id" =>$row['recipe_id'],
                    "record_type" =>$row['record_type'],
                    "user_id" =>$row['user_id'],                  
                ];
            }

            return $arr;

        }elseif ($record_type == "W") {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $arr[] = [
                    "id" => $row['id'],
                    "recipe_id" => $row['recipe_id'],
                    "record_type" =>$row['record_type'],
                    "date" =>$row['date'],
                    "numeric_field" =>$row['numeric_field'],
                ];
            }
            return $arr;
        }else {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $arr[] = [
                    "id" => $row['id'],
                    "recipe_id" => $row['recipe_id'],
                    "record_type" =>$row['record_type'],
                    "date" =>$row['date'],
                    "numeric_field" =>$row['numeric_field'],
                    "text_field" =>$row['text_field'],
                ];
            }
        return $arr;
        }
    }
}

?>

