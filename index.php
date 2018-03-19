<?php

include("schriftart.php"); 	//$sa
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

    <title>Startseite</title>
	
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
		<?php include("sidebar_log0.php"); ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
					<?php 	echo '<a href="#menu-toggle" class="btn btn-default" 
								id="menu-toggle" style="font-family:'.$sa.'">Toggle Menu</a>';
							echo '<h1 style="font-family:'.$sa.'">Simpler Haushaltsrechner</h1>';
							echo '<p style="font-family:'.$sa.'">Dieses Programm soll dir dabei helfen 
								deine Ausgaben und Einnahmen im Blick zubehalten.</p>';
							echo '<p style="font-family:'.$sa.'">Um ein neues Haushaltskonto zu Erstellen wähle Registrieren.</p>';
							echo '<p style="font-family:'.$sa.'">Eine Schnelle Rechnung kannst du mit dem Rechner durchführen.</p>';
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