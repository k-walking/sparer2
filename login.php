<?php 
session_start();
$mysqli = new mysqli( 'localhost', 'root', '', 'test2');

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

    <title>Login</title>
	
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
<!--TODO: content, stylen-->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("sidebar_log0.php"); ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<?php 
							if(isset($_GET['login'])) {
								$email = $_POST['email'];
								$password = $_POST['passwort'];
								
                                $query = "SELECT * FROM users WHERE email = '$email' ";
                                
								$result = mysqli_query($mysqli, $query);
                                
                                if ($result){
                                    $user_array = mysqli_fetch_row($result);
                                    $user_email = $user_array[2];
                                    $user_passwordhash = $user_array[3];
                                    $user_name = $user_array[1];
                                    $user_id = $user_array[0]; 
                                    
                                    //Überprüfung des Passworts
                                    if ($result !== false && password_verify($password, $user_passwordhash)) {
                                    

                                        $_SESSION['userid'] = $user_id;
                                        die('Login erfolgreich. Weiter zu <a href="profile.php">internen Bereich</a>');
                                    } else {
                                        $errorMessage = '<style="font-family:'.$sa.'">E-Mail oder Passwort war ungültig<br>';
                                    }
                                } 
								else {
                                    $errorMessage = '<style="font-family:'.$sa.'">Kein Ergebnis aus der Datenbankabfrage';
                                }	
								
							}
							if(isset($errorMessage)) {
								echo $errorMessage;
							}
							
							 
							echo '<form action="?login=1" method="post">';
							echo '<style="font-family:'.$sa.'">E-Mail:<br>';
							echo '<input type="email" size="40" maxlength="250" name="email"><br><br>';
							
							 
							echo '<style="font-family:'.$sa.'">Dein Passwort:<br>';
							echo '<input type="password" size="40"  maxlength="250" name="passwort"><br>';
							 
							echo '<input type="submit" value="Abschicken" style="font-family:'.$sa.'>';
							echo '</form>';
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

