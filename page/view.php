<?php
include_once '../includes/db_connect.php';
include_once '../includes/db_functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

$id = filter_input(INPUT_GET, 'id', $filter = FILTER_SANITIZE_STRING);
 
/*if (! $id) {
    header('Location: ../index');
}*/

$query = "SELECT id FROM pages WHERE id = ?";

$prep_stmt = "SELECT id FROM pages WHERE id = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 0) {
                        // A user with this username already exists
                        header('Location: ../index');
                        $stmt->close();
                }
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
        }

$stmt = $mysqli->prepare("SELECT title, owner, private FROM pages WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($title, $owner, $private);
$stmt->fetch();
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
		<title>writely; <?php echo htmlentities($_SESSION['username']) ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../modules/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link href="../css/footer.css" rel="stylesheet">
		<link href="../css/index.css" rel="stylesheet">
		<link href="../css/user.css" rel="stylesheet">
		<script src="../modules/jquery/jquery-2.1.3.min.js"></script> 
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
        <a class="navbar-brand" href="#">writely</a>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../index"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbspHome</a></li>
            <?php if (htmlentities($_SESSION['isAdmin']) == 1) {echo "<li><a href=\"../admin/\"><span class=\"glyphicon glyphicon-dashboard\" aria-hidden=\"true\"></span>&nbspAdmin</a></li>";} ?>
            <li><a href="../logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbspLogout</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<li><a href="../page/new"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
          	<p class="navbar-text navbar-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp<?php echo htmlentities($_SESSION['username']) ?><?php if (htmlentities($_SESSION['isAdmin']) == 1) {echo "&nbsp<span class=\"label label-info\">Admin</span>";} ?></p>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="container">
			<div class="centered text-center">
				<h1>TEST</h1>
				<h1>Page Title: <?php echo $title; ?></h1>
				<h1>Page Owner: <?php echo $owner; ?></h1>
				<h1>Page Privacy: <?php echo $private; ?></h1>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="text-muted">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					2015 Jake Koenen | <script type="text/javascript" src="../modules/footquote/random.php?type=1"></script>
				</div>
			</div>
		</footer>
		<script src="../modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="../modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>