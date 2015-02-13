<?php
include_once 'includes/db_connect.php';
include_once 'includes/db_functions.php';

sec_session_start();

$msg = filter_input(INPUT_GET, 'msg', $filter = FILTER_SANITIZE_STRING);
 
if (! $msg) {
    $msg = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
if (login_check($mysqli) == true) {
    ?>
    	<style type="text/css">#nav{display:none;}</style>
    <?php
	} else {
	?>
		<style type="text/css">#nav_2{display:none;}</style>
	<?php
	}
?>
	<head>
		<title>writely; home</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="modules/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="css/footer.css" rel="stylesheet">
		<link href="css/index.css" rel="stylesheet">
		<script src="modules/jquery/jquery-2.1.3.min.js"></script> 
    	<script> 
    		$(function(){
      			$("#nav").load("navbar/index.html"); 
      			$("#nav_2").load("navbar/index2.html"); 
    		});
    	</script>
	</head>
	<body>

		<div id="nav"></div>
		<div id="nav_2"></div>

		<div class="container">
			<div class="centered text-center">
				<div class="jumbotron">
					<div class="headertext"><h1>writely</h1></div>
					<h3 class="errortext"><?php echo str_replace("_", " ", $msg); ?></h3>
					<hr />
					<div id="loginButton">
					<form action="login">
						<button type="submit" class="btn btn-primary">
							Login
						</button>
					</form>
					</div>
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