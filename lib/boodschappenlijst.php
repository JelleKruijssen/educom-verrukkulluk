<?php

class boodschappenlijst {

    private $connection;
    private $usr;
    private $ing;
    private $art;


    public function __construct($connection) {
        $this->connection = $connection;
    }

    // user
    private function selectUser() {
        $user = $this->usr->selecteerUser($user_id);

        return $user;
    }

    // ingredient
    private function selectIngredient() {
        $ingredient = $this->ing->selecteerIngredient($ingredient_id);

        return $ingredient;
    }

    //ingredient + artikel
    private function selectArtikel() {
        $artikel = $this->art->selecteerArikel($artikel_id);

        return $artikel;
    } 

    // calorieën berekenen
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

    // prijs bereken op basis van id
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


    
}
?>