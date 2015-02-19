<?php
include_once '../includes/delpage.php';
include_once '../includes/db_functions.php';
include '../modules/inspiration.php';
 
sec_session_start();
 
if (login_check($db) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

$id = filter_input(INPUT_GET, 'id', $filter = FILTER_SANITIZE_STRING);
 
if (! $id) {
    header('Location: /index');
}
    if ($stmt = $db->prepare("SELECT id FROM pages WHERE id = ? LIMIT 1")) {
        $stmt->execute(array($id));
        $row_count = $stmt->rowCount();
 
                if ($row_count == 0) {
                        // A user with this username already exists
                        header('Location: /index');
                }
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
        }

$stmt = $db->prepare("SELECT title, owner, private FROM pages WHERE id = ?");
$stmt->execute(array($id));
$pageinfo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!(htmlentities($_SESSION['username']) == $pageinfo['owner'] || htmlentities($_SESSION['isAdmin']) == 1)) {
	header('Location: /index');
}

$file = '../page_files/'.$id.'.txt';
$open = fopen($file, 'r');
if (filesize($file) == 0) {
	$data = null;
} else {
	$data = fread($open,filesize($file));
}
fclose($open);
?>

<!DOCTYPE html>
<?php if ($logged === 'out') {
        	header('Location: /index?msg=not_logged_in!');
        }
        ?>
<html lang="en">
	<head>
		<title>writely; delete page</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/modules/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<link href="/css/footer.css" rel="stylesheet">
		<link href="/css/index.css" rel="stylesheet">
		<link href="/css/user.css" rel="stylesheet">
		<script src="/modules/jquery/jquery-2.1.3.min.js"></script> 
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
            <li><a href="/index"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbspHome</a></li>
            <?php if (htmlentities($_SESSION['isAdmin']) == 1) {echo "<li><a href=\"/admin/\"><span class=\"glyphicon glyphicon-dashboard\" aria-hidden=\"true\"></span>&nbspAdmin</a></li>";} ?>
            <li><a href="/logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbspLogout</a></li>
            <li class="active"><a href="#"><span style="color:red"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete</a></span></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<li><a href="/page/new"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
          	<li><a href="/user/settings"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
          	<p class="navbar-text navbar-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp<?php echo htmlentities($_SESSION['username']) ?><?php if (htmlentities($_SESSION['isAdmin']) == 1) {echo "&nbsp<span class=\"label label-info\">Admin</span>";} ?></p>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="container">
			<div class="center text-centered">
				<div class="jumbotron">
			<form class="form-register" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" name="delete_page">
			<div class="input-group" style="display:none">
					<input type="text" name="id" class="form-control" id="id" value="<?php echo $id; ?>" aria-label="Page ID">
				</div>
				<button type="submit" value="Save" class="btn btn-danger" onclick="form.submit();">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp&nbspDelete
				</button>
			</form>
		</div>
	</div>
</div>
		<footer class="footer">
			<div class="container">
				<div class="text-muted">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					2015 Jake Koenen | <script type="text/javascript" src="/modules/footquote/random.php?type=1"></script> | <a href="/meta/">meta</a> <span style="float:right"><a href="/meta/help#markdown"><span class="glyphicon glyphicon-question-sign"></span> What's Markdown?</a></span>
				</div>
			</div>
		</footer>
		<script src="/modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="/modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>