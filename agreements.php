<?php
session_start();

if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
if(!$_POST){
	$_POST['unternehmen'] = '';
	$_POST['art'] = '';
	$_POST['gebuehr'] = '';
	$_POST['vertragsende'] = '';
	$_POST['anmerkung'] = '';
	$_POST['vertragsbeginn'] = '';
}

$mysqli = new mysqli( 'localhost', 'root', '', 'test2');
include("schriftart.php"); 	//$sa
include("bodycolor.php");	//$bc

//errrorhandler
$error = false;


//Deutsches datumsformat
setlocale(LC_TIME, "de_DE.utf8");
$kal_datum = time();

$kal_tage_gesamt = date("t", $kal_datum);
$kal_start_timestamp = mktime(0,0,0,date("n",$kal_datum),1,date("Y",$kal_datum));
$kal_start_tag = date("N", $kal_start_timestamp);
$kal_ende_tag = date("N", mktime(0,0,0,date("n",$kal_datum),$kal_tage_gesamt,date("Y",$kal_datum)));
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Verträge</title>
	
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
        <?php include ("sidebar_log1.php"); ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
								
                    <div class="page col-lg-12">
                        <div class="row">
                            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle" 
							<?php	echo '<style="background-color:#f5f4f4;font-family:'.$sa.'">';
									echo 'Toggle Menu</a>';

							echo '<h3><span style="font-family:'.$sa.'">Alle Verträge im Überblick</span></h3>';
							
							if(isset($_GET['send'])){
								$error = false;
								$fehler = 'Bitte Pflichtfelder* ausfüllen ';
								$unternehmen = $_POST['unternehmen'];
								$art = $_POST['art'];
								$gebuehr = $_POST['gebuehr'];
								$vertragsende = $_POST['vertragsende'];
								$anmerkung = $_POST['anmerkung'];
								$vertragsbeginn = $_POST['vertragsbeginn'];
								
								if($_POST['unternehmen'] == NULL){
									$error = true;
								}
								if($_POST['art'] == NULL){
									$error = true;
								}
								if($_POST['gebuehr'] == NULL){
									$error = true;
								}
								if($_POST['vertragsende'] == NULL){
									$error = true;
								}
								if($_POST['anmerkung'] == NULL){
									$anmerkung = 'k.A.';
								}
								else{
									$anmerkung = $_POST['anmerkung'];
								}
								if($_POST['vertragsbeginn'] == NULL){
									$error = true;
								}
								if($error == true){
									echo $fehler;
									return;
								}
							
								if( $mysqli -> connect_error){
									return false;
								} else{
									if( $stmt = $mysqli->prepare("INSERT INTO vertraege (userid, vertragsbeginn, unternehmen, art, gebuehr, vertragsende, anmerkung) VALUE (?, ?, ?, ?, ?, ?, ?)")){
										$stmt->bind_param('sssssss', $userid,  $vertragsbeginn, $unternehmen, $art, $gebuehr, $vertragsende, $anmerkung);
									
										$userid = $_SESSION['userid'];
										$unternehmen = $_POST['unternehmen'];
										$art = $_POST['art'];
										$gebuehr = $_POST['gebuehr'];
										$vertragsende = $_POST['vertragsende'];
										$vertragsbeginn = $_POST['vertragsbeginn'];
									
						
									if( !$stmt->execute()){
										return false;
									}
								} else {
									// for debugging purposes use: v
									var_dump($mysqli->error); exit;
									return false;
									}
								}
							}
							?>
							
                            <div class="box-grid col-lg-2" style="background-color:#f5f4f4;border:0px">
                                <div class="row">
                                    <div id="card">
                                        <figure class="front" style="background-color:#f5f4f4;">
                                   <?php echo '<div id="new" style="text-align:center"><h4>
												<span style="font-family:'.$sa.'">Neuen Vertrag hinzufügen</span>
													</h4></div>'; ?>
                                        </figure>
                                        <figure class="back" style="background-color:#f5f4f4">
                                            <form action="?send=1" method="post">
                                               
											<?php
											echo 'Unternehmen*<br>';
                                            echo '<input type="text" style="width:100%;font-family:'.$sa.'" maxlength="250" name="unternehmen"><br><br>';

                                            echo 'Was für ein Vertrag*<br>';
                                            echo '<input type="text" style="width:100%;font-family:'.$sa.'" maxlength="250" name="art"><br><br>';
												
											echo 'Monatliche Gebühr*<br>';
											echo '<input type="text" style="width:100%;font-family:'.$sa.'" maxlength="250" name="gebuehr"><br><br>';
												
											echo 'Vertragsbeginn*<br>';
											echo '<input type="text" style="width:100%;font-family:'.$sa.'" maxlength="250" name="vertragsbeginn"><br><br>';
												
											echo 'Vrs. Vertragsende*<br>';
											echo '<input type="text" style="width:100%;font-family:'.$sa.'" maxlength="250" name="vertragsende"><br><br>';
												
											echo 'Anmerkungen<br>';
											echo '<input type="text" style="width:100%;font-family:'.$sa.'" maxlength="250" name="anmerkung"><br><br>';

                                            echo '<input type="submit" value="Abschicken" style="font-family:'.$sa.'"><br><br>';
											?>
											
                                            </form> 
                                        </figure>
                                    </div>
                                </div>
                            </div>
							
							
                           
								<?php
                                $query = "SELECT * FROM vertraege";
								$result = mysqli_query($mysqli, $query);
					
								echo '<form method="post">';
								
								while($row = $result->fetch_assoc()){
									echo '<div style="border:0px;width:100px">';
									echo '<input type="submit" name="'.$row['unternehmen'].'" value="'.$row['unternehmen']
										.'" style="background-color:#dfdfdd;width:100%"><br>';
									echo $row['art'].'<br>';
									echo $row['gebuehr'].'<br>';
									echo $row['vertragsende'].'<br>';
									echo '</div>';
								}
								
								echo '</form>';
							
								
								?>
								
                           

                                <table class="kalender">
                                  <caption><?php echo '<br>'.strftime("%B %Y", $kal_datum); ?></caption>
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