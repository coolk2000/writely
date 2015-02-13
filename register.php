<?php
include_once 'includes/register.inc.php';
include_once 'includes/db_functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <title>writely; register</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" type="text/css" href="modules/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="css/footer.css" rel="stylesheet">
        <link href="css/register.css" rel="stylesheet">
        <script src="modules/jquery/jquery-2.1.3.min.js"></script>
        <script> 
            $(function(){
                $("#nav").load("navbar/register.html"); 
            });
        </script>
    </head>
	<body>
		<?php if ($logged === 'in') {
        	header('Location: ./index?msg=already_logged_in!');
        }
        ?>

        <div id="nav"></div>

		<!-- Registration form to be output if the POST variables are not
		set or if the registration script caused an error. -->
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
		<div class="container">
			<div class="centered text-center">
				<div class="jumbotron">
					<h1>register</h1>
					<form class="form-register" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
						<div class="form-group">
							<label class="sr-only" for="username">Username</label>
							<input type="username" name="username" class="form-control" id="username" placeholder="Username">
							<label class="sr-only" for="inputPassword">Password</label>
							<input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            <label class="sr-only" for="inputPassword">Confirm Password</label>
                            <input type="password" name="confirmpwd" class="form-control" id="confirmpwd" placeholder="Password Again">
                        </div>
						<!-- <div class="checkbox">
							<label>
								<input type="checkbox"> Remember me
							</label>
						</div> -->
						<button type="button" value="Register" class="btn btn-primary" onclick="return regformhash(this.form, this.form.username, this.form.password, this.form.confirmpwd);">
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						</button>
					</form>
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="text-muted">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					2015 Jake Koenen | <a href="index">home</a> | <a href="login">login</a> | <script type="text/javascript" src="modules/footquote/random.php?type=1"></script>
				</div>
			</div>
		</footer>
		<script src="modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>