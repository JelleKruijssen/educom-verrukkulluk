<?php
// Zorgt voor de connectie tussen de database en de keuze voor artikel
class artikel {
    private $connection;
    public function __construct($connection) {
        $this->connection = $connection;
    }
    public function selecteerArtikel($artikel_id) {
        $sql = "select * from article where id = $artikel_id";
        $result = mysqli_query($this->connection, $sql);
        $artikel = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return($artikel);
    }

}

?>
