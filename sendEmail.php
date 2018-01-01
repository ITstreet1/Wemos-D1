<?php
$lm35 = $_GET["lm35"];
$text ="Temperatura: ".$lm35." C";
$email 	= "dekip@beotel.rs";
$from 	= "Arduino@no.limits";
$subject ="Očitavanje temperature van lokalne mreže";
//send email
mail($email,"$subject",$text,"From:" .$from);
echo $from;
?>
