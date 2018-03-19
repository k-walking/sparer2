<?php
session_start();
$mysqli = new mysqli( 'localhost', 'root', '', 'test2');
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
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

    <title>Pfand</title>
	
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
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
					<div class="col-md-12">
					<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
						<h1>pfandflaschen rechner</h1>
					</div>
                    <div class="col-md-12 pfandbox">
						
                        
						<div class="col-md-3 banner">
                        <form action="?pfand=1" method="post">
							00,08€ Flaschen:<br>
							<input type="text" size="30" maxlength="250" name="kpfand"><br><br>
							
							 
							00,25€ Flaschen:<br>
							<input type="text" size="30"  maxlength="250" name="gpfand"><br>
							 
							<input type="submit" value="Pfand gesamt">
							</form> 
							<?php
							if(isset($_GET['pfand'])) {
								$anzahlkPfand = $_POST['kpfand'];
								$anzahlgPfand = $_POST['gpfand'];
							
								$pfand1 = 00.08;
								$pfand2 = 00.25;
								
								$money = ($anzahlkPfand * $pfand1) + ($anzahlgPfand * $pfand2);
								
								print_r($anzahlgPfand);
								if($anzahlkPfand and $anzahlgPfand === 0) {
									echo 'Bitte eine Menge an Flaschen angeben!<br>';
									$error = true;
								}
															
								
							}
							?>
							
							</div>
							
							<div class="ergebnis col-md-9">
								<p> 
								<?php 
								if(isset($_GET['pfand'])) {
									
									print_r('<h2 id="message">Message</h2>Dein Pfand aus '.$anzahlkPfand.' Flaschen für 00,08€ und '.$anzahlgPfand.' Flaschen für 00,25€ beträgt '.$money.'€');?></p>
										<h3><?php 
										if($money <= 3){
											 print_r('Das reicht uns nicht!!');
										}
										 else if($money <= 5){
											print_r('Das reicht uns noch nicht!!');
										} else {
											print_r('Das reicht uns!!');
										}
								}
										?><h3>
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
    </script>

</body>

</html>