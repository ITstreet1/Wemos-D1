<?php
/*
 * PHP fajl za potrebe članka u Svetu Kompjutera
 * Author: Petrović Dejan
 * Date: 31/12/2017
 * Wemos D1, LM35
 */
$lm35 = $_GET["lm35"];
$text ="Temperatura: ".$lm35." C";
$email 	= "neko@negde.rs"; // mejl na koji će nam stizati temperaturna očitavanja
$from 	= "Arduino@no.limits";
$subject ="Očitavanje temperature van lokalne mreže";
//send email
mail($email,"$subject",$text,"From:" .$from);
echo $from;
?>
