<?php

include("schriftart.php");
include("schriftgroeße.php");

echo '<div id="sidebar-wrapper" style="background-color:#dfdfdd">';
	echo '<ul class="sidebar-nav">';
		echo '<li class="sidebar-brand">';
			echo '<a href="#">';
				echo '<span style="font-family:'.$sa.';font-size:22px">Haushaltsrechner</span>';
			echo '</a>';
		echo '</li>';             
		echo '<li>';
			echo '<a href="overview.php"><span style="font-family:'.$sa.';font-size:'.$sg.'">Kontoübersicht</span></a>';	
		echo '</li>';            
		echo '<li>';
			echo '<a href="einnahmen.php"><span style="font-family:'.$sa.';font-size:'.$sg.'">Einnahmen</span></a>';
		echo '</li>';
		echo '<li>';
			echo '<a href="ausgaben.php"><span style="font-family:'.$sa.';font-size:'.$sg.'">Ausgaben</span></a>';
		echo '</li>';
		echo '<li>';
			echo '<a href="agreements.php"><span style="font-family:'.$sa.';font-size:'.$sg.'">Verträge</span></a>';
		echo '</li>';  
		echo '<li>';
			echo '<a href="setting.php"><span style="font-family:'.$sa.';font-size:'.$sg.'">Einstellungen</span></a>';
		echo '</li>';
		echo '<li>';
			echo '<a href="logout.php"><span style="font-family:'.$sa.';font-size:'.$sg.'">Logout</span></a>';
		echo '</li>';
	echo '</ul>';
echo '</div>';

?>