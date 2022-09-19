<?php

class boodschappenlijst {

    private $connection;
    private $usr;
    private $ing;
    private $art;
    private $calp;


    public function __construct($connection) {
        $this->connection = $connection;
        $this->usr = new User($connection);
        $this->ing = new Ingredient($connection);
        $this->art = new Artikel($connection);
        $this->rct = new Recept($connection);
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

    private function selectRecipe(){
        $recipe = $this->rct->selecteerRecipe($recipe_id);

        return $recipe;
    }
// functie om boodschappen toe te voegen aan de lijst
    public function boodschappenToevoegen($recipe_id, $user_id) {
        // boodschappen toevoegen aan booschappenlijst
        // ingredienten = ophalenIngredienten(gerecht_id);
        $sql = "select * from booschappenlijst where recipe_id = $recipe_id";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        // zolang ingredienten
        while (mysqli_num_rows($result) > 0) {
            if (artikelOpLijst($ingredient->$artikel_id, $user_id)) {
                $user_id = $row ['user_id'];
                $user = $this->usr->selectUsers($user_id);
                $artikel_id = $row['article_id'];
                $artikel = $this->usr->selectArtikel($artikel_id);
                $sqlu = "update booschappenlijst set hoeveelheid = $berekening where user_id = $user_id and article_id = $artikel_id";
            } else {
                array_push($bsl);
            }
        }
    }
// functie om te controleren of de artikelen die ingevoerd worden niet al op de lijst staan
    public function artikelOpLijst($artikel_id, $user_id) {
        // boodschappen ophalen die toegevoegd zijn aan de boodschappenlijst
        $boodschappen = ophalenBoodschappen($user_id);
        while (($boodschappen) > 0) {
            if($boodschap->$artikel_id == $artikel_id) {
                return $boodschap;
            }
        }
        return false;
    }
}

?>