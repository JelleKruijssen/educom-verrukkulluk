<?php

// Zorgt voor de connectie tussen de database en de keuze voor ingredient
class ingredient {
    
    private $connection;
    private $art;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->art = new artikel($connection);
    }

    
    
    private function selectArtikel($artikel_id) {
        $artikel = $this->art->selecteerArtikel($artikel_id);

        return ($artikel);
    }

    
    public function selecteerIngredient($recipe_id) { 
        $sql = "select * from ingrediënt where recipe_id = $recipe_id";
        $result = mysqli_query($this->connection, $sql);
        $arr = [];

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
       
            $artikel_id = $row['article_id'];
            $artikel = $this->selectArtikel($artikel_id);
            
            $arr [] = [
                "id" => $row['id'],
                "recipe_id" => $row['recipe_id'],
                "article_id" => $row['article_id'],
                "amount" => $row['amount'],
                "name" => $artikel['naam'],
                "description" => $artikel['beschrijving'],
                "photo" => $artikel['photo'],
                "price" => $artikel['price'],
                "weight" => $artikel['packaging'],
                "unit" => $artikel['units'],
                "calories" => $artikel['calories'],
            ];
        } 
        return $arr;
    }
}

?>