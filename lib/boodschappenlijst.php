<?php

session_start();

class boodschappenlijst {

    private $connection;
    private $art;
    private $usr;
    private $rct;
    private $ing;


    public function __construct($connection) {
        $this->connection = $connection;
        $this->art = new artikel($connection);
        $this->usr = new user($connection);
        $this->rct = new recept($connection);
        $this->ing = new ingredient($connection);
    }

    // user
    private function selectUser($user_id){
        $user = $this->usr->selecteerUser($user_id);

        return $user;
    }

    private function selectRecipe($recipe_id){
        $recipe = $this->rct->selectRecipe($recipe_id);

        return $recipe;
    }

    private function selectIngredient($ingredient_id){
        $ingredient = $this->ing->selecteerIngredient($ingredient_id);

        return $ingredient;
    }

    private function selectArtikel($artikel_id) {
        $artikel = $this->art->selecteerArtikel($artikel_id);

        return $artikel;
    }


    public function selectBoodschappenlijst($recipe_id, $user_id) {

        $sql = "SELECT * FROM shoppingcart WHERE recipe_id = $recipe_id AND user_id = $user_id";
        $result = mysqli_query($this->connection, $sql);

        $shoppingcart = [];
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if (mysqli_num_rows($result) > 0) {

                $recipe = $this->selectRecipe($row ['recipe_id']);  
                $user = $this->selectUser($row ['user_id']);

                // $toevoegen = $this->boodschappenToevoegen($recipe_id, $user_id);

                $ingredient = $this->selectIngredient($recipe_id);

                // artikel_id ophalen via $ingredient?!

                // $artikel = $this->selectArtikel($artikel_id);

                // $opLijst = $this->artikelOpLijst($artikel_id, $user_id);

                $shoppingcart [] = [
                    "id" => $row['id'],
                    "recipe" => $recipe,
                    "user" => $user,
                    "artikel" => $artikel_id,
                ];
            }
        }

        foreach ($shoppingcart as $boodschap) {
            array_push($shoppingcart, $boodschap);
        }
        
        return array_unique($shoppingcart, SORT_REGULAR);

    }

    // functie om boodschappen toe te voegen aan de lijst
    public function boodschappenToevoegen($recipe_id, $user_id) {

        $schappen = $this->selectBoodschappenlijst($recipe_id, $user_id);
        // ingredienten ophalen
        $recipe_id = $row['recipe_id'];
        $ingredienten = $this->selectIngredient($recipe_id);
        $lijst = $this->artikelOpLijst($artikel_id, $user_id);

        // zolang er ingredienten zijn moet dit doorgaan
        while (mysqli_num_rows($ingredienten) > 0) {
            if($lijst($ingredient->$artikel_id, $user_id)) {
                // berekening voor de nieuwe hoeveelheid zowel als het toegevoegd als weggehaald word!!!

                // artikel bijwerken
                // $update = "UPDATE boodschappen SET hoeveelheid = ";
                
                return $update;
            }else {
                // artikel toevoegen
                // $toevoegen =  "INSERT INTO boodschappen (id, user_id, recipe_id, hoeveelheid) Values ()";
                return $toevoegen;
            }

        }
    }


    // functie om te controleren of de artikelen die ingevoerd worden niet al op de lijst staan
    public function artikelOpLijst($artikel_id, $user_id) {

        // ophalen boodschappen
        $boodschappen = $this->selectBoodschappenlijst($user_id);

        foreach ($boodschappen as $boodschap) {
            // ingredienten ophalen
            if ($boodschap ['ingredient'][3] == $artikel_id) {
                // artikel_id hier ook ophalen of gebruik maken van de eerder opgeroepen artikel_id?!
                return $boodschap;
            } else {
                return false;
            }
        }
    }
}

?>