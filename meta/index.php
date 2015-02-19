<?php
include_once '../includes/db_connect.php';
include_once '../includes/db_functions.php';
include '../vendor/autoload.php';
$parsedown = new ParsedownExtra();
error_reporting(0);

$timezoneDetector = new Dater\TimezoneDetector();
echo '<html><head>' . $timezoneDetector->getHtmlJsCode() .'</head></html>';
date_default_timezone_set($timezoneDetector->getClientTimezone());

sec_session_start();
 
if (login_check($db) == true) {
  $logged = 'in';
} else {
  $logged = 'out';
}
?>

<html lang="en">
	<head>
		<title>writely; meta</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/modules/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<link href="/css/footer.css" rel="stylesheet">
		<link href="/css/index.css" rel="stylesheet">
		<link href="/css/user.css" rel="stylesheet">
    <link href="/css/help.css" rel="stylesheet">
		<script src="/modules/jquery/jquery-2.1.3.min.js"></script> 
    <script src="/js/isotope.min.js"></script> 
    <script src="/js/helpsidebar.js"></script> 
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
            <li><a href="/index"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home</a></li>
            <li class="active"><a href="#"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;Meta</a></li>
            <li><a href="/meta/help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>&nbsp;Help</a></li>
          </ul>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="container">

      <h3 style="display:inline">writely</h3>&nbsp;<h1 style="display:inline">/meta/</h1>
      <br />
      <br />
      <div class="progress">
        <div class="progress-bar progress-bar-primary progress-bar-striped" style="width:25%">
        </div>
        <div class="progress-bar progress-bar-danger progress-bar-striped" style="width:75%">
        </div>
      </div>
      <hr />
      <h2 style="margin-top:-12px">Notices and Progression</h2><?php if (htmlentities($_SESSION['isAdmin']) == '1') {echo "<button type='button' value='New' class='btn btn-info' style='margin-top:-42px;float:right' onclick='location.href=\"/meta/newpost\"'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span>&nbsp&nbspNew</button>";} ?>
      <br />
      <?php
      $fetch = $db->query("SELECT author, title, content, lastedit, class FROM metaposts");
      while($row = $fetch->fetch(PDO::FETCH_ASSOC)) {

        echo "<div class='panel panel-". $row['class'] ."' style='width:50%'>";
        echo "<div class='panel-heading'>";
        echo "<h3 class='panel-title'>". $row['title'] ."</h3><small>". date('m/d/Y g:i a', $row['lastedit']) ."</small>";
        echo "</div>";
        echo "<div class='panel-body'>";
        echo $row['content'];
        echo "</div>";
        echo "</div>";
      }
    ?>

		</div>
		<footer class="footer">
			<div class="container">
				<div class="text-muted">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					2015 Jake Koenen | <script type="text/javascript" src="../modules/footquote/random.php?type=1"></script> <span style="float:right"><a href="http://github.com/NigelNoscopes/writely">github</a></span>
				</div>
			</div>
		</footer>
		<script src="/modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="/modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>