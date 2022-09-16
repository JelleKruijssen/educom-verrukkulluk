<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukentype.php");
require_once("lib/ingredient.php");
require_once("lib/receptinfo.php");
require_once("lib/recept.php");
require_once("lib/selecting.php"); 

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$usr = new user($db->getConnection());
$kt = new keukentype($db->getConnection());
$ing = new ingredient($db->getConnection());
$rpi = new receptinfo($db->getConnection());
$rct = new recept($db->getConnection());
$sel = new select($db->getConnection());


/// VERWERK 
// Selecteer een artikel dat word weergegeven op de site
$artikel = $art->selecteerArtikel(2);
// selecteerUser moet nog aangepast worden zodat het juiste account word gekozen na inloggen
$user = $usr->selecteerUser(4);
// keukentype
$keukentype = $kt->selecteerKeukenType(1);
// ingredienten
$ingredient = $ing->selecteerIngredient(1);
// receptinfo
$receptinfo = $rpi->selecteerReceptinfo(1,"W");
// recept
$calories = $rct->calcCalories(1);
$prijs = $rct->calcPrice(1);
$rating = $rct->selectRating(1, "W");
$steps = $rct->selectSteps(1, "B");
$remarks = $rct->selectRemarks(1, "O");
// selecting multiple recepise
$select = $sel->selecteerSelect(1, 2);



/// RETURN
// var_dump($artikel); 
// echo "<br>";
// var_dump($user);
// echo "<br>";
// var_dump($keukentype);
// echo "<br>";
// echo "<pre>";
// var_dump($ingredient);
// echo "<br>";
// echo "<pre>";
// // var_dump($receptinfo);
// echo "<br>";
// var_dump($calories);
// echo "<br>";
// var_dump($prijs);
// echo "<br>";
// var_dump($rating);
// echo "<br>";
// var_dump($steps);
// echo "<br>";
// var_dump($remarks);
echo "<br>";
var_dump($select);

?>
