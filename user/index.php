<?php
include_once '../includes/db_connect.php';
include_once '../includes/db_functions.php';
 
sec_session_start();
 
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

$prep_stmt = "SELECT id FROM pages WHERE owner = ?";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
    	$stmt->bind_param('s', htmlentities($_SESSION['username']));
        $stmt->execute();
        $stmt->store_result();
        
        $num_pages = $stmt->num_rows;
        
        $stmt->close();
        }
?>
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
    <script src="../js/isotope.min.js"></script> 
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
            <?php if (htmlentities($_SESSION['isAdmin']) == 1) {echo "<li><a href=\"../admin/\"><span class=\"glyphicon glyphicon-dashboard\" aria-hidden=\"true\"></span>&nbspAdmin</a></li>";} ?>
            <li><a href="../logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbspLogout</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<li><a href="../page/new"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
          	<li><a href="settings"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
          	<p class="navbar-text navbar-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp<?php echo htmlentities($_SESSION['username']) ?><?php if (htmlentities($_SESSION['isAdmin']) == 1) {echo "&nbsp<span class=\"label label-info\">Admin</span>";} ?></p>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="container">
			<div class="centered text-center">
				<h1>Hi, <?php echo htmlentities($_SESSION['username']) ?>!</h1><h2><?php if ($num_pages == 0) {echo "You haven't written any pages! Why not <a href='../page/new'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Make one?</a>";} else {echo "You've written <span class='label label-success'>".$num_pages." pages</span> so far.";} ?>
			</div>

<h2 style="display:inline-block">Filter</h2>
<div id="filters" class="button-group">  <button class="btn btn-info" data-filter="*">show all</button>
  <button class="btn btn-primary" data-filter="onlyPublic">only public</button>
  <button class="btn btn-primary" data-filter="onlyPrivate">only private</button>
</div>

<h2 style="display:inline-block">Sort</h2>
<div id="sorts" class="button-group">  <button class="btn btn-info" data-sort-by="original-order">original order</button>
  <button class="btn btn-primary" data-sort-by="title">title</button>
  <button class="btn btn-primary" data-sort-by="recent">recent</button>
  <button class="btn btn-primary" data-sort-by="id">ID</button>
  <button class="btn btn-primary" data-sort-by="privacy">privacy</button>
</div>
<br />

<?php
        $fetch = "SELECT id, title, owner, private, lastedit FROM pages";
        $result = $mysqli->query($fetch)or die(mysql_error());

        echo "<div class='isotope'>";

        while($row = mysqli_fetch_array($result))
          if ($row['owner'] == htmlentities($_SESSION['username'])) {
        {
          echo "<div class='page-info'>";
          echo "<div class='container' style='width:110%'>";
          echo "<div class='thumbnail'>";
          echo "<div class='caption'>";
          echo "<h3 class='title'>". $row['title'] ."</h3>";
          echo "<p class='recent' style='display:none'>". $row['lastedit'] ."</p>";
          echo "<div class='box-thing'><p><a style='a:link{color:#fff;}' href='/page/edit/". $row['id'] ."' class='btn btn-primary' role='button'>Edit</a> <a href='/page/view/". $row['id'] ."' class='btn btn-info' role='button'>View</a></p></div>";
          if ($row['private'] == 0) {echo "<p class='privacy' style='display:none'>0</p><small>last edit: ". date('m/d/Y', $row['lastedit']) ." &mdash; <span class='label label-primary'>Public</span></small>";} else {echo "<p class='privacy' style='display:none'>1</p><small>last edit: ". date('m/d/Y', $row['lastedit']) ." &mdash; <span class='label label-warning'>Private</span></small>";}
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
        }
      }

      echo "</div>";

      ?>
<script src="../js/isotope.min.js"></script> 
<script src="../js/page_sort_user.js"></script> 

		</div>
		<footer class="footer">
			<div class="container">
				<div class="text-muted">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					2015 Jake Koenen | <script type="text/javascript" src="../modules/footquote/random.php?type=1"></script>
				</div>
			</div>
		</footer>
		<script src="../modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="../modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>