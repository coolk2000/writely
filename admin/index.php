<?php
include_once '../includes/db_connect.php';
include_once '../includes/db_functions.php';
 
sec_session_start();

if (htmlentities($_SESSION['isAdmin']) == 1) {
	$adminStatus = true;
} else {
	header('Location: ../errors/401.html');
}
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<!DOCTYPE html>
<?php if ($logged === 'out') {
        	header('Location: ../index?msg=not_logged_in!');
        }
        ?>
<html lang="en">
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
		<?php echo htmlentities($_SESSION['isAdmin']) ?>
	</body>
</html>
