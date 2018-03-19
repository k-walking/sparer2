

<?php 
session_start();
$mysqli = new mysqli( 'localhost', 'root', '', 'test2');

$statement = $mysqli->prepare("SELECT * FROM users WHERE email = :email");
/*die(var_dump($statement));*/
include("bodycolor.php");
	


?>
<!DOCTYPE html>
<html lang="en">
<!--TODO: stylen-->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registrierung</title>
	
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
						

						 
						<?php
						$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
						 
						if(isset($_GET['register'])) {
							$error = false;
							$email = $_POST['email'];
							$vorname = $_POST['vorname'];
							$passwort = $_POST['passwort'];
							$passwort2 = $_POST['passwort2'];
						  
							if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
								echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
								$error = true;
							} 	
							if(strlen($passwort) == 0) {
								echo 'Bitte ein Passwort angeben<br>';
								$error = true;
							}
							if($passwort != $passwort2) {
								echo 'Die Passwörter müssen übereinstimmen<br>';
								$error = true;
							}
							
							//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
							if(!$error) { 
                                $query = "SELECT * FROM users WHERE email = '$email' ";
								$result = mysqli_query($mysqli, $query);
                                
                                $user_array = mysqli_fetch_row($result);
                                $user_email = $user_array[0];
                               								
								if($user_email !== NULL) {
									echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
									$error = true;
								}	
							}
							
							//Keine Fehler, wir können den Nutzer registrieren
							if(!$error) {	
								$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
								
								// Neuer Nutzer
                                $query = "INSERT INTO users (email, passwort, vorname) VALUES (?, ?, ?)";
                                $result = $mysqli->prepare($query);
                                $result->bind_param("sss", $email, $passwort_hash, $vorname);
								$result->execute();
								
								//Konto anlegen
                                /*$result = $mysqli->prepare($query);
                                $result->bind_param("sss", $email, $passwort_hash, $vorname);
								$result->execute();
                                $query = "INSERT INTO user (email, password, name) VALUES (?, ?, ?)";
								$ = $mysqli->prepare("INSERT INTO konten (email) VALUES (:email)");
								$result_1 = $create->execute(array('email' => $email));*/
								
								//persönliches Profil
                                $query = "INSERT INTO profile (email, vorname) VALUES (?, ?)";
                                $result = $mysqli->prepare($query);
                                $result->bind_param("ss", $email, $vorname);
								$result->execute();
								
								if($result) {		
									echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
									$showFormular = false;
								} else {
									echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
								}
							} 
						}
						 
						if($showFormular) {
						?>
						 
						<form action="?register=1" method="post">
						E-Mail:<br>
						<input type="email" size="40" maxlength="250" name="email"><br><br>
						
						Vorname:<br>
						<input type="text" size="40" maxlength="250" name="vorname"><br><br>
						
						Dein Passwort:<br>
						<input type="password" size="40"  maxlength="250" name="passwort"><br>
						 
						Passwort wiederholen:<br>
						<input type="password" size="40" maxlength="250" name="passwort2"><br><br>
						 
						<input type="submit" value="Abschicken">
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
 
<?php 

?>
 
