<?php
include_once 'db_connect.php';
include_once 'db_config.php';

$error_msg = "";

if (isset($_POST['title'], $_POST['class'], $_POST['author'], $_POST['content'])) {
	$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
	$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
	$content = nl2br($_POST['content']);
	$lastedit = time();

	if ($_POST['class'] == 'normal') {
		$class = 'info';
	} elseif ($_POST['class'] == 'success') {
		$class = 'success';
	} elseif ($_POST['class'] == 'warning') {
		$class = 'warning';
	} elseif ($_POST['class'] == 'error') {
		$class = 'danger';
	} else {
		$class = 'info';
	}

	if (empty($error_msg)) {
		if ($stmt = $db->prepare("INSERT INTO metaposts (title, author, class, content, lastedit) VALUES (:title, :author, :class, :content, :lastedit)")) {
			if (! $stmt->execute(array(':title' => $title, ':author' => $author, ':class' => $class, ':content' => $content, ':lastedit' => $lastedit))) {
				header('Location: /error=creation failure: INSERT');
			}
		}
        $db = null;
		header('Location: /meta/');
	}
}