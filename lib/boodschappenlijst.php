<?php

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


    public function selectBoodschappenlijst($recipe_id, $user_id) {
        $sql = "SELECT * FROM boodschappen WHERE recipe_id = $recipe_id";
        $result = mysqli_query($this->connection, $sql);

        


        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $recipe = $this->selectRecipe($row['recipe_id']);
            $user = $this->selectUser($row['user_id']);
            $toevoegen = $this->boodschappenToevoegen($recipe_id, $user_id);


        }
        return $row;

    }


// functie om boodschappen toe te voegen aan de lijst
    public function boodschappenToevoegen($recipe_id, $user_id) {

        $schappen = $this->selectBoodschappenlijst($recipe_id, $user_id);
        $recipe = $this->selectRecipe($row['recipe_id']);


        // ingredienten ophalen
        $ingredienten = $this->selectIngredient($recipe_id);
        $lijst = $this->artikelOpLijst($artikel_id, $user_id);

        // zolang er ingredienten zijn moet dit doorgaan
        while (($ingredienten) > 0) {
            if($artikelOpLijst) {
                // artikel bijwerken
                return "UPDATE boodschappen SET hoeveelheid = ";
            }else {
                // artikel toevoegen
                return "INSERT INTO boodschappen (id, user_id, ";
            }

        }
    }


// functie om te controleren of de artikelen die ingevoerd worden niet al op de lijst staan
    public function artikelOpLijst($artikel_id, $user_id) {

        // ophalen boodschappen
        $boodschappen = [];
        $schappen = $this->selectBoodschappenlijst($user_id);
        // ingredienten ophalen
        // artikel_id ophalen
        $artikel_id = $this->selectIngredient($recipe_id);
        $artikel = $this->selectArtikel($artikel_id);


        while (($booschappen) > 0) {
            if ($boodschap->$artikel_id == $artikel_id) {
                return $boodschap;
            }
        }
        return false;
    }
}

?>