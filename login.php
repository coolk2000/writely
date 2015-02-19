<?php
include_once 'includes/db_connect.php';
include_once 'includes/db_functions.php';

sec_session_start();

if (login_check($db) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

$msg = filter_input(INPUT_GET, 'msg', $filter = FILTER_SANITIZE_STRING);
 
if (! $msg) {
    $msg = '';
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>writely; login</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="modules/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="css/footer.css" rel="stylesheet">
		<link href="css/login.css" rel="stylesheet">
		<script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
        <script src="modules/jquery/jquery-2.1.3.min.js"></script>
        <script> 
    		$(function(){
      			$("#nav").load("navbar/login.html"); 
    		});
    	</script>
	</head>
	<body>

		<div id="nav"></div>

		<?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?>
        <?php if ($logged === 'in') {
        	header('Location: ./index?msg=already_logged_in!');
        }
        ?>
        <div class="container">
			<div class="centered text-center">
				<div class="jumbotron">
					<h1>login</h1>
					<h3 class="errortext"><?php echo str_replace("_", " ", $msg); ?></h3>
					<hr />
					<form class="form-inline" action="includes/login_process.php" method="post" name="login_form">
						<div class="form-group">
							<label class="sr-only" for="inputUsername">Username</label>
							<input type="username" class="form-control" id="inputUsername" name="username" placeholder="Username">
						</div>
						<div class="form-group">
							<label class="sr-only" for="inputPassword">Password</label>
							<input type="password" name="password" class="form-control" id="password" placeholder="Password">
						</div>
						<!-- <div class="checkbox">
							<label>
								<input type="checkbox"> Remember me
							</label>
						</div> -->
						<button type="submit" class="btn btn-primary" value="Login" onclick="formhash(this.form, this.form.password);">
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						</button>
					</form>
					<hr />
					or <a href="register">register</a>.
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="text-muted">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					2015 Jake Koenen | <script type="text/javascript" src="modules/footquote/random.php?type=1"></script>
				</div>
			</div>
		</footer>
		<script src="modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>