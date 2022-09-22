<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukentype.php");
require_once("lib/ingredient.php");
require_once("lib/receptinfo.php");
require_once("lib/recept.php");
require_once("lib/boodschappenlijst.php");

/// INIT
$db = new database();
// $art = new artikel($db->getConnection());
// $usr = new user($db->getConnection());
// $kt = new keukentype($db->getConnection());
// $ing = new ingredient($db->getConnection());
// $rpi = new receptinfo($db->getConnection());
// $rct = new recept($db->getConnection());
$bsl = new boodschappenlijst($db->getConnection());


/// VERWERK Hierbij moet nog een variabelen worden gecreeërd die de waardes vastlegd die er daadwerkelijk gebruikt gaan worden
// Selecteer een artikel dat word weergegeven op de site
// $artikel = $art->selecteerArtikel(2);
// // selecteerUser moet nog aangepast worden zodat het juiste account word gekozen na inloggen
// $user = $usr->selecteerUser(4);
// // keukentype
// $keukentype = $kt->selecteerKeukenType(1);
// // ingredienten
// $ingredient = $ing->selecteerIngredient(1);
// // receptinfo
// $receptinfo = $rpi->selecteerReceptinfo(1,"W");
// recept
// $recept = $rct->selectRecipe(1, 2);
// $recept = $rct->selecteerRecipe(2);
// selecting multiple recepise

$lijst = $bsl->selectBoodschappenlijst(1,2);




// /// RETURN
echo "<pre>";
// var_dump($recept);
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
var_dump($lijst);

?>
