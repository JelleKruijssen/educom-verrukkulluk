<?php

class recept {

    private $connection;
    private $usr;
    private $ing;
    private $calc;
    private $calp;
    private $selr;
    private $sels;
    private $selm;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->usr = new User($connection);
        $this->ing = new Ingredient($connection);
        $this->calc = new Artikel($connection);
        $this->calp = new Artikel($connection);
        $this->selr = new receptinfo($connection);
        $this->sels = new receptinfo($connection);
        $this->selm = new receptinfo($connection);
    }

    private function selectUser($user_id) {
        $user = $this->usr->selecteerUser($user_id);

        return ($user);
    }

    private function selectIngredient($recipe_id) {
        $ingredient= $this->ing->selecteerIngredient($recipe_id);

        return ($ingredient);
    }

        //calculate the total amount of calories
    public function calcCalories($recipe_id) {
        $calories = $this->calc->selecteerArtikel($recipe_id);
        $sql = "select * from ingrediënt where recipe_id = $recipe_id";
        $result = mysqli_query($this->connection, $sql);
        $cal = [];
        $totalcal = 0;

        while ($row = mysqli_fetch_array($result)) {
            $artikel_id = $row['article_id'];
            $artikel = $this->calc->selecteerArtikel($artikel_id);
            
            $totalcal = $totalcal + $artikel ['calories'] * $row ['amount'];
        };
        return $totalcal;

    }

        //calculate the total price
    public function calcPrice($recipe_id) {
        $price = $this->calp->selecteerArtikel($recipe_id);
        $sql = "select * from ingrediënt where recipe_id = $recipe_id";
        $result = mysqli_query($this->connection, $sql);
        $totalpri = 0;
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
       
            $artikel_id = $row['article_id'];
            $artikel = $this->calp->selecteerArtikel($artikel_id);
            $totalpri = $totalpri + $artikel ['price'] * $row ['amount'];
        }
        return $totalpri;

    }

        // Een gemiddelde geven van de waarderingen
    public function selectRating($recipe_id, $record_type) {
        $rating = $this->selr->selecteerReceptinfo($recipe_id, $record_type);
        $sql = "select * from recipe_info where recipe_id = $recipe_id AND record_type = 'W'";
        $result = mysqli_query($this->connection, $sql);
        $totalrating = 0;
        $averageRating = 0;

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $totalrating += $row ['numeric_field'];
            $count = mysqli_num_rows ($result);
            $averageRating = $totalrating / $count;
        }
        return round($averageRating);

    }

    //stappen van het kookprocess weergeven met de nummers van de stappen
    public function selectSteps($recipe_id, $record_type) {
        $steps = $this->sels->selecteerReceptinfo($recipe_id, $record_type);
        $sql = "select * from recipe_info where recipe_id = $recipe_id AND record_type = 'B'";
        $result = mysqli_query($this->connection, $sql);
        $arr= [];

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $arr[] = [
                "numeric_field" =>$row['numeric_field'],
                "text_field" =>$row['text_field'],
            ];
        }
        return $arr;
    }


    public function selectRemarks($recipe_id, $record_type) {
        $remarks = $this->selm->selecteerReceptinfo($recipe_id, $record_type);
        $sql = "select * from recipe_info where recipe_id = $recipe_id AND record_type = 'O'";
        $result = mysqli_query($this->connection, $sql);
        $arr= [];

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $user_id = $row['user_id'];
            $user = $this->selectUser($user_id);
            $arr[] = [
                "user_id" => $row['user_id'],
                "username" => $user['username'],
                "photo" =>$user['photo'],
                "text_field" =>$row['text_field'],
            ];
        }
        return $arr;
    }
}

?>