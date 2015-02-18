<?php
include_once '../includes/editpage.php';
include_once '../includes/db_functions.php';
include '../modules/inspiration.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

$id = filter_input(INPUT_GET, 'id', $filter = FILTER_SANITIZE_STRING);
 
if (! $id) {
    header('Location: /index');
}

$prep_stmt = "SELECT id FROM pages WHERE id = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 0) {
                        // A user with this username already exists
                        header('Location: /index');
                        $stmt->close();
                }
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
        }

$stmt = $mysqli->prepare("SELECT title, owner, private FROM pages WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->bind_result($title, $owner, $private);
$stmt->fetch();
$stmt->close();

if (!(htmlentities($_SESSION['username']) == $owner || htmlentities($_SESSION['isAdmin']) == 1)) {
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
		<title>writely; edit page</title>
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
            <li class="active"><a href="#"><span class='glyphicon glyphicon-wrench' aria-hidden='true'></span> Edit</a></li>
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
			<div>
				<h3 style="display:inline"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editing <span class="page-title">"<?php echo $title; ?>"</span></h3><h4 style="display:inline;float:right;margin-left:-100px"><span class="label label-danger">Edit</span>
			</div>
			<hr style="margin-top:8px"/>
			<form class="form-register" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" name="edit_page">
				<div class="input-group">
				<span class="input-group-addon">Page Title</span>
				<input type="text" name="title" class="form-control" id="title" placeholder="<?php echo $sentence ?>" value="<?php echo $title; ?>" aria-label="Page Title">
				<span class="input-group-addon">(Max 140 Characters)</span>
			</div>
			<div class="input-group" style="display:none">
					<input type="text" name="id" class="form-control" id="id" value="<?php echo $id; ?>" aria-label="Page ID">
				</div>
			<br />
				<textarea type="text" rows="15" name="contents" class="form-control" id="contents" placeholder="<?php echo $sentence ?>" aria-label="Page Contents"></textarea>
				<script type="text/javascript">var textdata = <?php echo json_encode($data); ?>; document.getElementById("contents").value = textdata;</script>
				<br />
				<div class="checkbox">
					<label>
						<input type="checkbox" name="private" value="1" id="private">Make Private <span title="Making a page private means only you can view it."><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></span>
					</label>
					<?php
					if ($private == 1) {
						echo '<script type="text/javascript">document.getElementById("private").checked = true;</script>';
					} else {
						echo '<script type="text/javascript">document.getElementById("private").checked = false;</script>';
					}
					?>
				</div>
				<br />
				<button type="submit" value="Save" class="btn btn-success" onclick="form.submit();">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp&nbspSave
				</button>
				<button type="button" value="Cancel" class="btn btn-danger" onclick="location.href='/page/view/<?php echo $id; ?>'">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp&nbspCancel
				</button>
			</form>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="text-muted">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					2015 Jake Koenen | <script type="text/javascript" src="/modules/footquote/random.php?type=1"></script> <span style="float:right"><a href="/help#markdown"><span class="glyphicon glyphicon-question-sign"></span> What's Markdown?</a></span>
				</div>
			</div>
		</footer>
		<script src="/modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="/modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>