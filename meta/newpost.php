<?php
include_once '../includes/newmetapost.php';
include_once '../includes/db_functions.php';
 
sec_session_start();
 
if (login_check($db) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

if (!(htmlentities($_SESSION['isAdmin']) == 1)) {
	header('Location: /index');
}
?>

<!DOCTYPE html>
<?php if ($logged === 'out') {
        	header('Location: /index?msg=not_logged_in!');
        }
        ?>
<html lang="en">
	<head>
		<title>writely; new meta post</title>
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
            <li><a href="/index"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home</a></li>
            <li class="active"><a href="#"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;Meta</a></li>
            <li><a href="/meta/help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>&nbsp;Help</a></li>
          </ul>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="container">
			<div class="center text-centered">
				<div class="jumbotron">
					<form class="form-horizontal" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" name="new_meta_post">
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="title" name="title">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<textarea class="form-control" id="content" name="content" placeholder="Content" rows="5" value="content"></textarea>
							</div>
						</div>
						<div class="input-group" style="display:none">
							<input type="text" name="author" class="form-control" id="author" value="<?php echo htmlentities($_SESSION['username']) ?>" aria-label="Author">
						</div>
						<div class="form-group">
							<div class="col-sm-10">
								<div class="radio-inline">
									<label>
										<input type="radio" name="class" value="normal" checked> Normal
									</label>
								</div>
							</div>
							<div class="has-success">
								<div class="col-sm-10">
									<div class="radio-inline">
										<label>
											<input type="radio" name="class" value="success"> Good
										</label>
									</div>
								</div>
							</div>
							<div class="has-warning">
								<div class="col-sm-10">
									<div class="radio-inline">
										<label>
											<input type="radio" name="class" value="warning"> Warning
										</label>
									</div>
								</div>
							</div>
							<div class="has-error">
								<div class="col-sm-10">
									<div class="radio-inline">
										<label>
											<input type="radio" name="class" value="error"> Bad
										</label>
									</div>
								</div>
							</div>
						</div>
				<button type="submit" value="Save" class="btn btn-success" onclick="form.submit();">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp&nbspPost
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