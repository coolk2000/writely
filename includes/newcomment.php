<?php
include_once 'db_connect.php';
include_once 'db_config.php';
include 'id_gen.php';

$error_msg = "";

if (isset($_POST['pageid'], $_POST['submitter'], $_POST['content'])) {
	$submitter = filter_input(INPUT_POST, 'submitter', FILTER_SANITIZE_STRING);
	$pageid = filter_input(INPUT_POST, 'pageid', FILTER_SANITIZE_STRING);
	$content = nl2br($_POST['content']);
	$lastedit = time();

	if (empty($error_msg)) {
		if ($stmt = $db->prepare("INSERT INTO comments (submitter, pageid, content, lastedit) VALUES (:submitter, :pageid, :content, :lastedit)")) {
			if (! $stmt->execute(array(':submitter' => $submitter, ':pageid' => $pageid, ':content' => $content, ':lastedit' => $lastedit))) {
				header('Location: /error=creation failure: INSERT');
			}
		}
		header('Location: /page/view/'.$pageid.'');
	}
}