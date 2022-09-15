<?php

/*
    In deze file moet er een code worden geschreven waardoor er meerdere recepten geselecteerd kunnen worden ipv maar een
*/

class select {

    private $connection;

    public function __construct($connection) {
        $connection = $this->connection;
        $recept = new recept($connection);
    }
}

?>