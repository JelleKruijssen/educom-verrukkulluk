<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$usr = new user($db->getConnection());


/// VERWERK 
// Selecteer een artikel dat word weergegeven op de site
// selecteerArtikel moet nog aangepast worden zodat er met een variabele gezocht kan worden
$artikel = $art->selecteerArtikel(2);

// selecteerUser moet nog aangepast worden zodat het juiste account word gekozen na inloggen
$user = $usr->selecteerUser(2);

// select * from ingredient
//  where gerecht_id = $id
// $return = []
// ingredient while ($row = mysqli_fetch_array()

// while() {
// 
// $artikel_id = $row["artikel_id"]
// $artikel = $this->art->selectArtikel($artikel_id);
// $return[] = [
// "id" => $row["id],
// "gerecht_id" => $row["gerecht_id],
// "naam" => $artikel["naam"]
// ];  
// }
// 
// priv db
// priv art

// return($return)

/// RETURN
var_dump($artikel); 
echo "<br>";
var_dump($user);

?>
