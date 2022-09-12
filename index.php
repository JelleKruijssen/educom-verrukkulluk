<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukentype.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$usr = new user($db->getConnection());
$kt = new keukentype($db->getConnection());


/// VERWERK 
// Selecteer een artikel dat word weergegeven op de site
// selecteerArtikel moet nog aangepast worden zodat er met een variabele gezocht kan worden
$artikel = $art->selecteerArtikel(2);

// selecteerUser moet nog aangepast worden zodat het juiste account word gekozen na inloggen
$user = $usr->selecteerUser(2);

// keukentype
$keukentype = $kt->selecteerKeukenType(1);

/// RETURN
var_dump($artikel); 
echo "<br>";
var_dump($user);
echo "<br>";
var_dump($keukentype);

?>
