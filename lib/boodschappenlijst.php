<?php

class boodschappenlijst {

    private $connection;
    private $usr;
    private $rct;


    public function __construct($connection) {
        $this->connection = $connection;
        $this->usr = new User($connection);
        $this->rct = new Recept($connection);
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


    public function selecteerBoodschappenlijst($recipe_id, $user_id) {
        $sql = "select * from boodschappenlijst where recipe_id = $recipe_id and user_id = $user_id";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $boodschapToevoegen = $this->boodschappenToevoegen(); 
        $artikelOpLijst = $this->artikelOpLijst();

    }


// functie om boodschappen toe te voegen aan de lijst
    public function boodschappenToevoegen($recipe_id, $user_id) {
       
        // zolang er ingredienten zijn en deze ingredienten op de lijst staan
        while ($ingredienten) {
            if($this->artikelOpLijst()) {
                // ja bijwerken
                "UPDATE boodschappenlijst SET ";
                // de waaardes nog toevoegen
            }
            // nee toevoegen
            "INSERT INTO boodschappenlijst";
            // waardes toevoegen

        }
    }
// functie om te controleren of de artikelen die ingevoerd worden niet al op de lijst staan
    public function artikelOpLijst($artikel_id, $user_id) {
        // boodschappen ophalen die toegevoegd zijn aan de boodschappenlijst
        $boodschappen = ophalenBoodschappen($user_id);
        // als er boodschappen zijn
        while (($boodschappen) ) {
            if($boodschap->$artikel_id == $artikel_id) {
                // ja return
                return $boodschap;
            }
            // nee false
        }
        return false;
    }
}

?>