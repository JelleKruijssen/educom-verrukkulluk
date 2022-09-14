<?php
// Maakt verbinding met de database om in andere omgevingen te gebruiken
    // Aanpassen naar je eigen omgeving
    define("USER", "root");
    define("PASSWORD", "msis6BG[1m6z*Fx1");
    define("DATABASE", "ver1");
    define("HOST", "127.0.0.1");

    class database {
        private $connection;
        public function __construct() {
        $this->connection = mysqli_connect(HOST,
                                            USER,
                                            PASSWORD, 
                                            DATABASE);
        }
        public function getConnection() {
            return($this->connection);
        }
    }


?>