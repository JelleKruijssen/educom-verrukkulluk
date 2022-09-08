<?php

require_once("lib/database.php");
require_once("lib/artikel.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());


/// VERWERK 
// Selecteer een artikel dat word weergegeven op de site
$data = $art->selecteerArtikel(2);

/// RETURN
var_dump($data);