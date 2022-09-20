<?php
// Zorgt voor de connectie tussen de database en de keuze voor artikel
class keukentype {
    private $connection;
    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function selecteerKeukenType($keukentype_id) {
        $sql = "select * from kitchentype where id = $keukentype_id";
        $result = mysqli_query($this->connection, $sql);
        $keukentype = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return($keukentype);
    }

}

?>