<?php
include_once '../includes/newpage.php';
include_once '../includes/db_functions.php';
include '../modules/inspiration.php';
 
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
<?php if ($logged === 'out') {
        	header('Location: ../index?msg=not_logged_in!');
        }
        ?>
<html lang="en">
	<head>
		<title>writely; new page</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../modules/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link href="../css/footer.css" rel="stylesheet">
		<link href="../css/index.css" rel="stylesheet">
		<link href="../css/user.css" rel="stylesheet">
		<script src="../modules/jquery/jquery-2.1.3.min.js"></script> 
		<script src='https://www.google.com/recaptcha/api.js'></script>
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
            <?php if (htmlentities($_SESSION['isAdmin']) == 1) {echo "<li><a href=\"../admin/\"><span class=\"glyphicon glyphicon-dashboard\" aria-hidden=\"true\"></span>&nbspAdmin</a></li>";} ?>
            <li><a href="../logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbspLogout</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<li class="active"><a href="../page/new"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
          	<li><a href="/user/settings"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
          	<p class="navbar-text navbar-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp<?php echo htmlentities($_SESSION['username']) ?><?php if (htmlentities($_SESSION['isAdmin']) == 1) {echo "&nbsp<span class=\"label label-info\">Admin</span>";} ?></p>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="container">
			<div>
				<h3 style="display:inline"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> New Page</h3><h4 style="display:inline;float:right;margin-left:-100px"><span class="label label-primary">Configure</span></h4>
			</div>
			<hr style="margin-top:8px"/>
			<form class="form-register" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="new_page_configuration">
				<div class="input-group">
					<span class="input-group-addon">Page Title</span>
					<input type="text" name="title" class="form-control" id="title" placeholder="<?php echo $sentence ?>" aria-label="Page Title">
					<span class="input-group-addon">(Max 140 Characters)</span>
				</div>
				<br />
				<div class="input-group" style="display:none">
					<input type="text" name="owner" class="form-control" id="owner" value="<?php echo htmlentities($_SESSION['username']) ?>" aria-label="Page Owner">
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="private" value="1">Make Private <span title="Making a page private means only you can view it."><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></span>
					</label>
				</div>
				<br />
				<div class="g-recaptcha" data-sitekey="6LePBwITAAAAALUD9aBgm2UnPghov9wXQqCU4Ycq"></div>
				<br />
				<button type="button" value="Create" class="btn btn-primary" onclick="form.submit();">
					<span class="glyphicon glyphicon-save" aria-hidden="true"></span>&nbsp&nbspCreate
				</button>
			</form>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="text-muted">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					2015 Jake Koenen | <script type="text/javascript" src="../modules/footquote/random.php?type=1"></script> <span style="float:right"><a href="/help#markdown"><span class="glyphicon glyphicon-question-sign"></span> What's Markdown?</a></span>
				</div>
			</div>
		</footer>
		<script src="../modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="../modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>