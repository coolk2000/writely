<?php
$msg = filter_input(INPUT_GET, 'msg', $filter = FILTER_SANITIZE_STRING);
 
if (! $msg) {
    $msg = 'writely';
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>writely; home</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="modules/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="css/footer.css" rel="stylesheet">
		<link href="css/index.css" rel="stylesheet">
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
          <a class="navbar-brand" href="#">writely</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="register">Register</a></li>
            <li><a href="login">Login</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="container">
			<div class="centered text-center">
				<div class="jumbotron">
					<h1><?php echo str_replace("_", " ", $msg); ?></h1>
					<form action="login">
						<button type="submit" class="btn btn-primary">
							Login
						</button>
					</form>
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