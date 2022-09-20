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
        $this->usr = new user($connection);
        $this->art = new artikel($connection);
        $this->kt = new keukentype($connection);
        $this->ing = new ingredient($connection);
        $this->calc = new artikel($connection);
        $this->calp = new artikel($connection);
        $this->selr = new receptinfo($connection);
        $this->sels = new receptinfo($connection);
        $this->selm = new receptinfo($connection);
        $this->rpi = new receptinfo($connection);
    }

    private function selectUser($user_id) {
        $user = $this->usr->selecteerUser($user_id);

        return ($user);
    }

    private function selectIngredient($recipe_id) {
        $ingredient= $this->ing->selecteerIngredient($recipe_id);

        return ($ingredient);
    }

    private function selectKeukenType($keukentype_id) {
        $keukentype = $this->kt->selecteerKeukenType($keukentype_id);

        return ($keukentype);
    }

    private function selectReceptinfo($recipe_id, $record_type) {
        $receptinfo = $this->rpi->selecteerReceptinfo($recipe_id, $record_type);

        return ($receptinfo);
    }

    public function selecteerRecipe($recipe_id) {
        $sql = "SELECT * FROM recipe WHERE id = $recipe_id";
        $result = mysqli_query($this->connection, $sql);

        $return =[];
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            /* hier  staan de stappen in 1 stuk code
            $keukentype_id = $row['kitchen_id'];
            $keukentype = $this->selectKeukenType($keukentype_id);
            */

            $keukentype = $this->selectKeukenType($row['kitchen_id']);
            $ingredients = $this->selectIngredient($recipe_id);

            $calories = $this->calcCalories($ingredients);
            $price = $this->calcPrice($ingredients);

            $remarks = $this->selectReceptinfo($recipe_id, "O");
            $valuation = $this->selectReceptinfo($recipe_id, "W");
            $favorite = $this->selectReceptinfo($recipe_id, "F");
            $steps = $this->selectReceptinfo($recipe_id, "B");

                $return [] = [
                    "recipe_id" => $row['id'],
                    "kitchen_id" => $row['kitchen_id'],
                    "type_id" => $row['type_id'],
                    "user_id" => $row['user_id'],
                    "date" =>$row['date_added'],
                    "titel" => $row['titel'],
                    "short_description" => $row['short_description'],
                    "long_description" => $row['long_description'],
                    "photo" => $row['photo'],
                    "ingredient" => $ingredients,
                    "comments" => $remarks,
                    "waardering" => $valuation,
                    "favoriet" => $favorite,
                    "stappen" => $steps,
                    "totalcalories" => $calories,
                    "totalprice" => $price,
                ];
                return $return;
        }
    }

        //calculate the total amount of calories
    public function calcCalories($ingredients) {
            $calories = 0;
            foreach ($ingredients as $ingredient) {
                $calo = $ingredient['calories'];
                $amount = $ingredient['amount'];
                $calories += $calo * $amount;
            } 
            return $calories;
            
        }

        //calculate the total price
    public function calcPrice($ingredients) {
            $price = 0;
            foreach ($ingredients as $ingredient) {
                $pric = $ingredient['price'];
                $amount = $ingredient['amount'];
                $price += $pric * $amount;
        }
        return $price;
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