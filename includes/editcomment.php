<?php
include_once 'db_connect.php';
include_once 'db_config.php';
include 'id_gen.php';

$error_msg = "";

if (isset($_POST['content'], $_POST['id'])) {
	$content = nl2br($_POST['content']);
	$lastedit = time();
	$id = $_POST['id'];

	if (empty($error_msg)) {
	   if ($stmt = $db->prepare("UPDATE comments SET content = ?, lastedit = ? WHERE id = ?")) {
			if (! $stmt->execute(array($content, $lastedit, $id))) {
				header('Location: /errors/error.php?err=creation failure: INSERT');
			}
		}
		$stmt->close();
	}
}