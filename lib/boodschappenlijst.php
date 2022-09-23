<?php

class boodschappenlijst {

    private $connection;
    private $usr;
    private $rct;
    private $ing;


    public function __construct($connection) {
        $this->connection = $connection;
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


    public function selectBoodschappenlijst($recipe_id, $user_id) {
        $sql = "SELECT * FROM boodschappen WHERE recipe_id = $recipe_id and user_id = $user_id";
        $result = mysqli_query($this->connection, $sql);

        $boodschappen = [];

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if(mysqli_num_rows($result) > 0) {

                $recipe = $this->selectRecipe($row['recipe_id']);
                $user = $this->selectUser($row['user_id']);
                $updaten = $this->boodschappenToevoegen($recipe_id, $user_id);
                $toevoegen = $this->boodschappenToevoegen($recipe_id, $user_id);

                $boodschappen [] = [

                    "id" =>$row['id'],
                    "user_id" =>$row['user_id'],
                    "recipe_id" =>$row['recipe_id'],
                    "hoeveelheid" =>$row['hoeveelheid'],

                ];
            }

        }
        return $boodschappen;

    }


// functie om boodschappen toe te voegen aan de lijst
    public function boodschappenToevoegen($recipe_id, $user_id) {

        $schappen = $this->selectBoodschappenlijst($recipe_id, $user_id);
        // ingredienten ophalen
        $recipe_id = $row['recipe_id'];
        $ingredienten = $this->selectIngredient($recipe_id);
        $lijst = $this->artikelOpLijst($artikel_id, $user_id);

        // zolang er ingredienten zijn moet dit doorgaan
        foreach ($ingredienten as $ingredient) {
            if($lijst($ingredient->$artikel_id, $user_id)) {
                // artikel bijwerken
                $update = "UPDATE boodschappen SET hoeveelheid = ";
                
                return $update;
            }else {
                // artikel toevoegen
                $toevoegen =  "INSERT INTO boodschappen (id, user_id, ";

                return $toevoegen;
            }

        }
    }


// functie om te controleren of de artikelen die ingevoerd worden niet al op de lijst staan
    public function artikelOpLijst($artikel_id, $user_id) {

        // ophalen boodschappen
        $schappen = $this->selectBoodschappenlijst($user_id);
        // ingredienten ophalen
        // artikel_id ophalen
        $ingredient = $this->selectIngredient($recipe_id);
        $artikel_id = $ingredient['article_id'];
        $artikel = $this->selectArtikel($artikel_id);


        while (($schappen) > 0) {
            if ($boodschap->$artikel_id == $artikel_id) {
                return $boodschap;
            }
        }
        return false;
    }
}

?>