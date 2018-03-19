<?php

session_start();
	
if(!isset($_SESSION['userid'])){
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}

include("schriftart.php");
include("bodycolor.php");

//Deutsches datumsformat
setlocale(LC_TIME, "de_DE.utf8");
$kal_datum = time();

    $kal_tage_gesamt = date("t", $kal_datum);
    $kal_start_timestamp = mktime(0,0,0,date("n",$kal_datum),1,date("Y",$kal_datum));
    $kal_start_tag = date("N", $kal_start_timestamp);
    $kal_ende_tag = date("N", mktime(0,0,0,date("n",$kal_datum),$kal_tage_gesamt,date("Y",$kal_datum)));
	
if(!$_POST){
	$_POST['kontoname'] = '';
	$_POST['kontostand'] = '';
}

$mysqli = new mysqli('localhost', 'root', '', 'test2');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Startseite</title>
	
	<!-- Style CSS -->
	 <link href="style.css" rel="stylesheet">
	
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<?php echo '<body style="background-color:'.$bc.'">'; ?>
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("sidebar_log1.php"); ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="page col-lg-12">
                        <div class="row">
						
						<?php
                            echo '<a href="#menu-toggle" class="btn btn-default" id="menu-toggle" style="font-family:'.$sa.'">
								Toggle Menu</a>';
                            echo '<h1 style="font-family:'.$sa.'">Alle deine Konten im Überblick </h1>';
														
							if (isset($_GET['send'])){
								$error = false;
								$userid = $_SESSION['userid'];
								$kontoname = $_POST['kontoname'];
								$kontostand = $_POST['kontostand'];
								$fehler = 'Bitte die Pflichtfelder* ausfüllen';
								
								if($kontoname == NULL){
									$error = true;
								}
								if($kontostand == NULL){
									$error = true;
								}
								if($error == true){
									echo $fehler;
									return;
								}
								if($mysqli->connect_error){
									return false;
								}else{
									if($query = "INSERT INTO overview (userid, kontoname, kontostand)VALUES(?,?,?)"){
										$result = $mysqli->prepare($query);
										$result ->bind_param("sss", $userid, $kontoname, $kontostand);
										$result ->execute();
										
										$userid = $_SESSION['userid'];
										$kontoname = $_POST['kontoname'];
										$kontostand = $_POST['kontostand'];
										
									}		
								}
							}
													
                            echo '<div class="box-grid col-lg-4">';
								echo '<div class="row">';
									echo '<div id="card">';
										echo '<figure class="front" style="background-color:#2fbada">';
											echo '<div id="new" style="text-align:center"><h4>Neues Konto</h4></div>';
										echo '</figure>';
										echo '<figure class="back" style="background-color:#2fbada">';
											echo '<form action="?send=1" method="post">';
											echo '<style="font-family:'.$sa.'">Kontoname*<br>';
											echo '<input type="text" size="40" name="kontoname"><br>';
											echo '<style="font-family:'.$sa.'">Kontostand*<br>';
											echo '<input type="text" size="40" name="kontostand"><br>';
												
											echo '<input type="submit" size="40" value="Abschicken" 
												style="font-family:'.$sa.'"><br>';
										echo '</figure>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
							
							echo '<div class="box-grid col-lg-4">';
					
								$query = "SELECT * FROM overview";
								$result = mysqli_query($mysqli, $query);
								
								echo '<form method="post">';
								while($row = $result->fetch_assoc()){
									echo '<div style="border:2px solid black;width:150px">';
									echo '<style="font-family:'.$sa.'">Kontoname: '.$row['kontoname'].'<br>';
									echo '<style="font-family:'.$sa.'">Kontostand: '.$row['kontostand'].'<br>';
									echo '</div><br>';
								}
								echo '</form>';
								?>
							
                                <table class="kalender">
                                  <caption><?php echo strftime("%B %Y", $kal_datum); ?></caption>
                                  <thead>
                                    <tr>
                                      <th>Mo&nbsp&nbsp</th>
                                      <th>Di&nbsp&nbsp</th>
                                      <th>Mi&nbsp&nbsp</th>
                                      <th>Do&nbsp&nbsp</th>
                                      <th>Fr&nbsp&nbsp</th>
                                      <th>Sa&nbsp&nbsp</th>
                                      <th style="color:#f53235">So&nbsp&nbsp</th>
                                    </tr>
                                  </thead>
                                  <tbody>
									<?php
                                        for($i = 1; $i <= $kal_tage_gesamt+($kal_start_tag-1)+(7-$kal_ende_tag); $i++)
                                        {
                                            $kal_anzeige_akt_tag = $i - $kal_start_tag;
                                            $kal_anzeige_heute_timestamp = strtotime($kal_anzeige_akt_tag." day", $kal_start_timestamp);
                                            $kal_anzeige_heute_tag = date("j", $kal_anzeige_heute_timestamp);
                                            if(date("N", $kal_anzeige_heute_timestamp) == 1)
                                              echo "<tr>\n";
                                            if(date("dmY", $kal_datum) == date("dmY", $kal_anzeige_heute_timestamp))
                                              echo "      <td class=\"kal_aktueller_tag\">", $kal_anzeige_heute_tag,"</td>\n";
                                            elseif($kal_anzeige_akt_tag >= 0 AND $kal_anzeige_akt_tag < $kal_tage_gesamt)
                                              echo "      <td class=\"kal_standard_tag\">", $kal_anzeige_heute_tag,"</td>\n";
                                            else
                                              echo "      <td class=\"kal_vormonat_tag\">", $kal_anzeige_heute_tag,"</td>\n";
                                            if(date("N", $kal_anzeige_heute_timestamp) == 7)
                                              echo "    </tr>\n";
                                        }
									?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
	$("#new").click(function(e) {
    e.preventDefault();
    $("#card").toggleClass("flipped");
    });
    </script>

</body>

</html>