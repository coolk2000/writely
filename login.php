<?php
include_once 'includes/db_connect.php';
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
	</head>
	<body>

		<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index">Home</a></li>
            <li><a href="register">Register</a></li>
            <li class="active"><a href="#">Login</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

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
					or <a href="register">register</a>.
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="text-muted">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					2015 Jake Koenen | <a href="index">home</a> | <script type="text/javascript" src="modules/footquote/random.php?type=1"></script>
				</div>
			</div>
		</footer>
	</body>
</html>