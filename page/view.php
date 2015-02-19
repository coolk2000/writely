<?php
include_once '../includes/db_connect.php';
include_once '../includes/db_functions.php';
include '../includes/id_gen.php';
include '../vendor/autoload.php';
$parsedown = new ParsedownExtra();

$timezoneDetector = new Dater\TimezoneDetector();
echo '<html><head>' . $timezoneDetector->getHtmlJsCode() .'</head></html>';
date_default_timezone_set($timezoneDetector->getClientTimezone());

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

$stmt = $db->prepare("SELECT title, owner, private, lastedit FROM pages WHERE id = ?");
$stmt->execute(array($id));
$pageinfo = $stmt->fetch(PDO::FETCH_ASSOC);

if ($pageinfo['private'] == '1') {
	if (! (htmlentities($_SESSION['username']) == $owner || htmlentities($_SESSION['isAdmin']) == '1')) {
		header('Location: /index');
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
if ($logged == 'in') {
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
		<title>writely; view page</title>
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
			<div class="panel panel-default">
				<div class="panel-heading">
				<h3 style="display:inline"><?php echo $pageinfo['title']; ?></h3> <span class="page-title">&nbspBy <?php echo $pageinfo['owner']; ?> | Last edit: <?php echo date('m/d/Y g:i a', $pageinfo['lastedit']); ?></span><h4 style="display:inline;float:right;margin-left:-100px"><span class="label label-info">View</span><?php if ($pageinfo['private'] == 1) {echo "&nbsp<span class=\"label label-warning\" title=\"Only you can view this page\">Private <span class=\"glyphicon glyphicon-question-sign\" aria-hidden=\"true\"></span>";} ?></h4>
			</div>
			<!-- <div style="display:inline;"> -->
			<div class="panel-body">
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

		<?php
		$fetch = $db->query("SELECT submitter, content, lastedit, pageid FROM comments");

		echo "<hr />";
		echo "<h3>Comments</h3>";


		while($row = $fetch->fetch(PDO::FETCH_ASSOC)) {
		  if ($row['pageid'] == $id) {

		  echo "<div class='panel panel-default' style='width:40%'>";
		  echo "<div class='panel-body'>";
		  echo $parsedown->text($row['content']);
		  echo "</div>";
		  echo "<div class='panel-footer'>";
		 echo "". $row['submitter'] ." | ". date('m/d/Y g:i a', $row['lastedit']) ."";
		  echo "</div>";
		  echo "</div>";
	  }
	  }
	  ?>

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