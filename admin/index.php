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
            <li><a href="../index"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbspHome</a></li>
            <li><a href="register"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbspRegister</a></li>
            <li><a href="login"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbspLogin</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="container">
			<div class="panel panel-default">
  				<div class="panel-heading"><h4>User Database</h4></div>
  				<?php
  					$usertable = "SELECT id, username, admin FROM users";
					$result = $mysqli->query($usertable);

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
				?>
			</div>
		</div>
		<script src="../modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="../modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
