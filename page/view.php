<?php
include_once '../includes/db_connect.php';
include_once '../includes/db_functions.php';
include '../includes/id_gen.php';
include '../modules/parsedown/Parsedown.php';
$parsedown = new Parsedown();
 
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
		<link rel="stylesheet" type="text/css" href="/modules/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<link href="/css/footer.css" rel="stylesheet">
		<link href="/css/index.css" rel="stylesheet">
		<link href="/css/user.css" rel="stylesheet">
		<script src="/modules/jquery/jquery-2.1.3.min.js"></script> 
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
            <?php if (htmlentities($_SESSION['isAdmin']) == 1 || htmlentities($_SESSION['username']) == $owner) {echo "<li><a href='/page/edit/".$id."'><span class='glyphicon glyphicon-wrench' aria-hidden='true'></span> Edit</a></li>";} ?>
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
				<h3 style="display:inline"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span> <?php echo $title; ?></h3> <span class="page-title">&nbspBy <?php echo $owner; ?></span><h4 style="display:inline;float:right;margin-left:-100px"><span class="label label-info">View</span><?php if ($private == 1) {echo "&nbsp<span class=\"label label-warning\" title=\"Only you can view this page\">Private <span class=\"glyphicon glyphicon-question-sign\" aria-hidden=\"true\"></span>";} ?></h4>
			<hr style="margin-top:8px"/>
			<div style="display:inline;">
			<!-- <h4 style="margin-top:-14px;float:right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> By <?php echo $owner; ?></h4> -->
				<?php
				$file = '../page_files/'.$id.'.txt';
				$open = fopen($file, 'r');
				if (filesize($file) == 0) {
					echo '<div class="centered text-center"><div class="jumbotron"><h2 style="color:#e5e5e5"><script type="text/javascript" src="/modules/emptypage/random.php?type=1"></script></h2></div></div>';
				} else {
					$data = fread($open,filesize($file));
					echo $parsedown->text($data);
				}
				fclose($open);
				?>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="text-muted">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					2015 Jake Koenen | <script type="text/javascript" src="/modules/footquote/random.php?type=1"></script>
				</div>
			</div>
		</footer>
		<script src="/modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="/modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>