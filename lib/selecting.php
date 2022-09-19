<?php

/*
    In deze file moet er een code worden geschreven waardoor er meerdere recepten geselecteerd kunnen worden ipv maar een
*/

class select {

    private $connection;
    private $recipe;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->rct = new recept($connection);
    }

    private function selectRecipe($recipe_id){
        $recipe = $this->rct->selecteerRecipe($recipe_id);

        return $recipe;
    }

    public function selecteerSelect ($recipe_id) {
        $sql = "select * from recipe where id = '$recipe_id'";
        $result = mysqli_query($this->connection, $sql);
        $recepten = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                array_push($recepten, $row);
            }
        }
        

        foreach ($recepten[0] as $data) {

            return $recepten;
        }
    }
}

?>