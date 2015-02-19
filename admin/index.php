<?php
include_once '../includes/db_connect.php';
include_once '../includes/db_functions.php';
 
sec_session_start();

if (login_check($db) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

if (htmlentities($_SESSION['isAdmin']) == 1) {
	$adminStatus = true;
} else {
	header('Location: ../errors/401.html');
}

    if ($stmt = $db->prepare("SELECT id FROM users")) {
        $stmt->execute();
        $num_users = $stmt->rowCount();
        }

$stmt = "SELECT id FROM pages";
 
    if ($stmt = $db->prepare("SELECT id FROM pages")) {
        $stmt->execute();
        $num_pages = $stmt->rowCount();
        }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>writely; admin</title>
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
            <li><a href="../user/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbspHome</a></li>
            <?php if (htmlentities($_SESSION['isAdmin']) == 1) {echo "<li class=\"active\"><a href=\"#\"><span class=\"glyphicon glyphicon-dashboard\" aria-hidden=\"true\"></span>&nbspAdmin</a></li>";} ?>
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
  				<ul class="nav nav-tabs">
  					<li role="presentation" class="active"><a href="#">Dashboard</a></li>
  					<li role="presentation"><a href="users.php">User List</a></li>
  					<li role="presentation"><a href="pages.php">Page List</a></li>
				</ul>
		</div>
    <div class="container">
      <h1>Hi, <?php echo htmlentities($_SESSION['username']) ?>!</h1>
      <h3>There are <span class="label label-info"><?php echo $num_users; ?> users</span> and <span class="label label-warning"><?php echo $num_pages; ?> pages</span> registered in the database.</h3>
    </div>
		<script src="../modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="../modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
