<?php
include_once 'db_connect.php';
include_once 'db_config.php';
include 'id_gen.php';

$error_msg = "";

if (isset($_POST['id'])) {
	$id = $_POST['id'];

	if (empty($error_msg)) {

		if ($stmt = $db->prepare("DELETE FROM pages WHERE id = ?")) {
			if (! $stmt->execute(array($id))) {
				header('Location: /error=deletion failure: DELETE');
			}
		}
		// Create the blank page file
		unlink('/page_files/'.$id.'.txt');
		$db = null;
		header('Location: /index');
	}
}