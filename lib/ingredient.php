<?php
// Zorgt voor de connectie tussen de database en de keuze voor ingredient
class ingredient {
    private $connection;
    public function __construct($connection) {
        $this->connection = $connection;
    }

    // private artikel

    public function selecteerIngredient($ingredient_id) {
        $sql = "select * from ingrediënt where recipe_id = $ingredient_id";
        $result = mysqli_query($this->connection, $sql);
        $arr = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $artikel_id = $row['article_id'];
            $artikel = $this->art->selecteerArtikel($artikel_id);
            $arr [] = [
                "id" => $row['id'],
                "gerecht_id" => $row['recipe_id'],
                "artikel_id" => $row['article_id'],
                "Aantal" => $row['amount'],
                "Naam" => $artikel['NaamArtikel'],
                "Beschrijving" => $artikel['Beschrijving'],
                "Foto" => $artikel['photo'],
                "Prijs" => $artikel['prijs'],
                "Gewicht" => $artikel['Unit'],
                "Eenheid" => $artikel['packaging'],
                "Calorieën" => $artikel['calories'],
            ];
        } 
        return $arr;
    }
}

?>