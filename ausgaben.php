<?php
session_start();
$mysqli = new mysqli( 'localhost', 'root', '', 'test2');
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}

if(!$_POST){
	$_POST['price']='';
	$_POST['object']='';
	$_POST['date']='';
}

include("schriftart.php");	//$sa
include("bodycolor.php");	//$bc

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ausgaben</title>
	
	<!-- Style CSS -->
	 <link href="style.css" rel="stylesheet">
	
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

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
        <!-- /sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div clavss="row">
					<div class="col-md-12">
					<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
						<h1>Shopped</h1>
					</div>
                    <div class="col-md-12 ">
					
					<?php
						$showFormular = true; //Variable ob das Shopped-Menü anezeigt werden soll
						 
						if(isset($_GET['send'])) {
							$error = false;
							$userid = $_SESSION['userid'];
							$date = $_POST['date'];
							$object = $_POST['object'];
							$price = $_POST['price'];
							$fehler = 'Bitte alle Felder füllen.';
							
							if($userid == NULL){
								$error = true;
							}
							if($date == NULL){
								$error = true;
							}
							else{
								
							}
							if($object == NULL){
								$error = true;
							}
							if($price == NULL){
								$error = true;
							}
							if($error == true){
								echo $fehler;
								return;
							}
							
							//Keine Fehler, wir können den Nutzer registrieren
							//Check database connection
							if( $mysqli -> connect_error){
								return false;
							} else{
								if( $stmt = $mysqli->prepare("INSERT INTO ausgaben (userid, price, object, date) VALUE (?, ?, ?, ?)")){
									$stmt->bind_param('ssss', $userid, $price, $object, $date);
									
									$userid = $_SESSION['userid'];
									$object = $_POST['object'];
									$price = $_POST['price'];
									$date = $_POST['date'];
												
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
						 
						if($showFormular) {
						?>
						 
						<form action="?send=1" method="post">
						Preis:<br>
						<input type="text" size="40" maxlength="250" name="price"><br><br>
						
						Objekt:<br>
						<input type="text" size="40" maxlength="250" name="object"><br><br>
						
						Datum:<br>
						<input type="text" size="40"  maxlength="250" name="date" id="datepicker"><br><br>
						 
						<input type="submit" value="Abschicken" style="background-color:#dfdfdd">
						</form>
						 
						<?php
						} //Ende von if($showFormular)
						?>			
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
	
	
	
	<script src="jquery-ui-1.12.0.custom/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="jquery-ui-1.12.0.custom/jquery-ui.min.css">
	
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
	$(document).ready(function(){
		$("#datepicker").datepicker({
			dateFormat: "yy.mm.dd"
		});
		
	});
    </script>

</body>

</html>