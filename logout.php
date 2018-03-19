<?php
session_start();

include("schriftart.php");
include("bodycolor.php");

echo '<body style="background-color:'.$bc.'">';

If (session_start()){
	session_destroy();
    echo '<style="font-family:'.$sa.'">Logout erfolgreich';
     die('<style="font-family:'.$sa.'">Logout erfolgreich. Weiter zu <a href="profile.php">internen Bereich</a>');
}
echo '<style="font-family:'.$sa.'">Logout erfolgreich';
echo '</body';

?>