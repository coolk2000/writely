<?php
include_once 'db_connect.php';
include_once 'db_config.php';
include 'id_gen.php';

$error_msg = "";

if (isset($_POST['title'], $_POST['id'])) {
	$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
	$id = $_POST['id'];
	$lastedit = time();
	
	if (isset($_POST['private'])) {
		if ($_POST['private'] == "1") {
		$private = '1';
		}
	} else {
		$private = '0';
	}

	if (isset($_POST['contents'])) {
		$contents = filter_input(INPUT_POST, 'contents', FILTER_SANITIZE_STRING);
	} else {
		$contents = "";
	}

	if (empty($error_msg)) {

		if ($stmt = $db->prepare("UPDATE pages SET title = ?, private = ?, lastedit = ? WHERE id = ?")) {
			if (! $stmt->execute(array($title, $private, $lastedit, $id))) {
				header('Location: ../errors/error.php?err=creation failure: INSERT');
			}
		}
		// Create the blank page file
		$pagefile = fopen("../page_files/".$id.".txt", "w");
		fwrite($pagefile, $contents);
		fclose($pagefile);
		$db = null;
		header('Location: /page/view/'.$id.'');
	}
}