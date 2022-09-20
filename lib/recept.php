<?php

class recept {

    private $connection;
    private $usr;
    private $art;
    private $kt;
    private $ing;
    private $selr;
    private $sels;
    private $selm;
    private $rpi;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->usr = new user($connection);
        $this->art = new artikel($connection);
        $this->kt = new keukentype($connection);
        $this->ing = new ingredient($connection);
        $this->selr = new receptinfo($connection);
        $this->sels = new receptinfo($connection);
        $this->selm = new receptinfo($connection);
        $this->rpi = new receptinfo($connection);
    }

    private function selectUser($user_id) {
        $user = $this->usr->selecteerUser($user_id);

        return ($user);
    }

    private function selectIngredient($recipe_id) {
        $ingredient= $this->ing->selecteerIngredient($recipe_id);

        return ($ingredient);
    }

    private function selectKeukenType($recipe_id) {
        $keukentype = $this->kt->selecteerKeukenType($recipe_id);

        return ($keukentype);
    }

    private function selectReceptinfo($recipe_id, $record_type) {
        $receptinfo = $this->rpi->selecteerReceptinfo($recipe_id, $record_type);

        return ($receptinfo);
    }

    // gerechten selecteren
    public function selecteerRecipe($recipe_id) {
        $sql = "SELECT * FROM recipe WHERE id = $recipe_id";
        $result = mysqli_query($this->connection, $sql);

        $recepten =[];
        // hier moet een loop zodat de array aanzichzelf toevoegd als er meerdere recepten worden geselecteerd
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if(mysqli_num_rows($result) > 0) {
                /* hier  staan de stappen in 1 stuk code
                $keukentype_id = $row['kitchen_id'];
                $keukentype = $this->selectKeukenType($keukentype_id);
                */
                $kitchen = $this->selectKeukenType($row['kitchen_id'], "K");
                $type = $this->selectKeukenType($row['type_id'], "T");
                $ingredients = $this->selectIngredient($recipe_id);

                $calories = $this->calcCalories($ingredients);
                $price = $this->calcPrice($ingredients);

                $remarks = $this->selectReceptinfo($recipe_id, "O");
                $valuation = $this->selectReceptinfo($recipe_id, "W");
                $favorite = $this->selectReceptinfo($recipe_id, "F");
                $steps = $this->selectReceptinfo($recipe_id, "B");

                $recepten [] = [
                    "recipe_id" => $row['id'],
                    "Kitchen" => $kitchen,
                    "type" => $type,
                    "user_id" => $row['user_id'],
                    "date" =>$row['date_added'],
                    "titel" => $row['titel'],
                    "short_description" => $row['short_description'],
                    "long_description" => $row['long_description'],
                    "photo" => $row['photo'],
                    "ingredient" => $ingredients,
                    "comments" => $remarks,
                    "valuation" => $valuation,
                    "favorite" => $favorite,
                    "steps" => $steps,
                    "totalcalories" => $calories,
                    "totalprice" => $price,
                ];
            }
        }
        foreach ($recepten as $recept) {
            array_push($recepten, $recept);
        }
    return array_unique($recepten, SORT_REGULAR);
    }

        //calculate the total amount of calories
    public function calcCalories($ingredients) {
            $calories = 0;
            foreach ($ingredients as $ingredient) {
                $calo = $ingredient['calories'];
                $amount = $ingredient['amount'];
                $calories += $calo * $amount;
            } 
            return $calories;
            
        }

        //calculate the total price
    public function calcPrice($ingredients) {
            $price = 0;
            foreach ($ingredients as $ingredient) {
                $pric = $ingredient['price'];
                $amount = $ingredient['amount'];
                $price += $pric * $amount;
        }
        return $price;
    }
}

?>