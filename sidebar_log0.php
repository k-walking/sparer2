<?php

include("schriftart.php");
include("schriftgroeße");

echo '<div id="sidebar-wrapper" style="background-color:#dfdfdd">';
	echo '<ul class="sidebar-nav">';
		echo '<li class="sidebar-brand">';
			echo '<a href="#">';
				echo '<span style="font-family:'.$sa.';font-size:22px">Haushaltsrechner</span>';
			echo '</a>';
		echo '</li>';             
		echo '<li>';
			echo '<a href="registrierung.php"><span style="'.$sa.';font-size:'.$sg.'">Registrieren</span></a>';
		echo '</li>';
		echo '<li>';
			echo '<a href="login.php"><span style="'.$sa.';font-size:'.$sg.'">Anmelden</span></a>';
		echo '</li>';
		echo '<li>';
			echo '<a href="calculation.php"><span style="'.$sa.';font-size:'.$sg.'">Rechner</span></a>';
		echo '</li>';
	echo '</ul>';
echo '</div>';

?>