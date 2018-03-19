<?php
session_start();
$pdo = NEW PDO ('mysql:host0localhost, dbname=test2', 'root');
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
// Nutzerdaten aus profile ziehen
$sql = $pdo->prepare("SELECT * FROM profile WHERE id ='" . $_SESSION['userid'] . "' ");

 ?>
 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Einstellungen</title>
	
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

<body>

    <div id="wrapper">

        <!-- Sidebar -->
		<?php include("sidebar_log1.php"); ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
						<?php
						if(isset($_GET['konto'])) {
								$kontoname = $_POST['kname'];
								$kontonummer = $_POST['knummer'];
								$kontostand = $_POST['wert'];
								$userid = $_SESSION['userid'];
								
								
								
								
								$statement = $pdo->prepare("INSERT INTO konten WHERE id ='" . $_SESSION['userid'] . "' (kontoname, kontonummer, kontostand) VALUES (:kontoname, :kontonummer, :kontostand)");
								$result = $statement->execute(array('kontoname' => $kontoname, 'kontonummer' => $kontonummer, 'kontostand' => $kontostand));
								
							
							}
						?>
                        <h1>Einstellungen</h1>
                        <p>Dieses Programm soll dir dabei helfen deine Ausgaben und Einnahmen im Blick zubehalten.</p>
                        <form action="?konto=1" method="post">
							Kontoname:<br>
							<input type="text" size="40" maxlength="250" name="kname"><br><br>
		 
							Kontonummer:<br>
							<input type="text" size="40"  maxlength="250" name="knummer"><br>
							
							Kontostand:<br>
							<input type="text" size="40"  maxlength="250" name="wert"><br>
							 
							<input type="submit" value="Abschicken">
						</form> 
                        
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