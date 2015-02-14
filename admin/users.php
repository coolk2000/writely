<?php
include_once '../includes/db_connect.php';
include_once '../includes/db_functions.php';
 
sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

if (htmlentities($_SESSION['isAdmin']) == 1) {
	$adminStatus = true;
} else {
	header('Location: ../errors/401.html');
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
            <li class="active"><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbspHome</a></li>
            <li><a href="../logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbspLogout</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<p class="navbar-text navbar-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp<?php echo htmlentities($_SESSION['username']) ?></p>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="container">
			<h4>User Database</h4>
				<?php
					if (!isset($_GET['page']) or !is_numeric($_GET['page'])) {
						$page = 0;
					} else {
						$page = (int)$_GET['page'];
					}
				$rows = $page * 10;
				$prev = $page - 1;
				$fetch = "SELECT id, username, admin FROM users LIMIT $rows, 10";
				$result = $mysqli->query($fetch)or die(mysql_error());

				echo "<table class=\"table\">
				<tr>
				<th>ID</th><th>Username</th><th>isAdmin</th>
				<tr>";

				while($row = mysqli_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['username'] . "</td>";
					echo "<td>" . $row['admin'] . "</td>";
				}
				echo "</table>";
				echo "<ul class=\"pager\">";
				if ($prev >= 0)
				echo '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'">Previous</a></li>';
				echo '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.($page+1).'">Next</a></li></ul>';
			?>
		</div>
		<script src="../modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="../modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
