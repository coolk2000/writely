<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
 
if (! $error) {
    $error = 'unknown error';
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>writely; 404</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="modules/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="container">
			<div class="jumbotron vertical-center">
				<h2>Error: <?php echo str_replace("_", " ", $error); ?></h2>
			</div>
		</div>
	</body>
</html>