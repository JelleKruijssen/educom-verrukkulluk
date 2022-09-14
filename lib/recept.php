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

    public function calcCalories($recipe_id) {
        $calories = $this->calc->selecteerArtikel($recipe_id);
        //calculate the total amount of calories
        $sql = "select * from ingrediënt where recipe_id = $recipe_id";
        $result = mysqli_query($this->connection, $sql);
        $calories = [];

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
       
            $artikel_id = $row['article_id'];
            $artikel = $this->selecteerArtikel($artikel_id);
            $calories [] = [
                "calories" =>$row ['calories'],
            ];
        
        }
        return ($calories);
        $totalcalories = array_sum($calories);
        echo "the total amount of calories are: $calories";
    }

    private function calcPrice($artikel_id) {
        $price = $this->calp->selecteerArtikel($artikel_id);
        // calculate the total price 
        return ($price);

    }

    private function selectRating($recipeinfo_id) {
        $rating = $this->selr->selectReceptinfo($recipeinfo_id);

        return ($rating);
    }

    private function selectSteps($recipeinfo_id) {
        $steps = $this->sels->selecteerReceptinfo($recipeinfo_id);

        return ($steps);
    }


    private function selectRemarks($recipeinfo_id) {
        $remarks = $this->selm->selecteerReceptinfo($recipeinfo_id);

        return ($remarks);
    }
}

?>