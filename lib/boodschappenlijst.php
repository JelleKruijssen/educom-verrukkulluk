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

    public function artikelOpLijst($artikel_id, $user_id) {

        // ophalen boodschappen
        $sql = "select * from shoppingcart where user_id = $user_id";
        $result = mysqli_query($this->connection, $sql);
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if (mysqli_num_rows($result) > 0) {

                if($row['article_id'] == $artikel_id) {
                    return $row;
                }else {
                    return false;
                }
            }
        } 
    }

    // functie om boodschappen toe te voegen aan de lijst
    public function boodschappenToevoegen($recipe_id, $user_id) {

        // ingredienten ophalen
        $ingredienten = $this->selectIngredient($recipe_id);

        // zolang er ingredienten zijn moet dit doorgaan
        foreach ($ingredienten as $ingredient) {
            if ($this->artikelOpLijst($ingredient['article_id'], $user_id) !== false) {

                // oplijst moet ing-id of art-id en user bevatten
                $artikel_id = $ingredient['article_id'];
                
                // berekening
                $amount = $ingredient['amount'];
                $current = $this->artikelOpLijst(['amount']);
                $total = $amount + $current;
                
                // ceil voor afronding naar boven
                
                // artikel bijwerken
                $sql = "UPDATE shoppingcart SET amount = $total where article_id = $artikel_id";

                echo "update";

                return $sql;
                
            }else {
                // artikel toevoegen
                $artikel_id = $ingredient['article_id'];	
                $amount = $ingredient['amount'];
                
                $sql =  "INSERT INTO shoppingcart (user_id, article_id, amount) Values ($user_id, $artikel_id, $amount)";
                echo "new";

                return $sql;
            }

        }
    }

    // functie om te controleren of de artikelen die ingevoerd worden niet al op de lijst staan
    
}

?>