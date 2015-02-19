<?php
include_once 'db_connect.php';
include_once 'db_config.php';
require_once 'recaptchalib.php';
include 'id_gen.php';

$secret = "6LePBwITAAAAAP8-Zvg3fOODI217MLcWaHs7mZEt";
$response = null;
$reCaptcha = new ReCaptcha($secret);

$error_msg = "";

if (isset($_POST['title'], $_POST['owner'], $_POST['g-recaptcha-response'])) {
	$owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING);
	$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
	$lastedit = time();
	$randNumber = randomNumber(16);
	$id = alphaID($randNumber);
	
	if (isset($_POST['private'])) {
	  if ($_POST['private'] == "1") {
		$private = '1';
		}
	} else {
		$private = '0';
	}

	if ($_POST["g-recaptcha-response"]) {
		$response = $reCaptcha->verifyResponse(
			$_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]
		);
	}

	if (!($response != null && $response->success)) {
		// TODO: warn user (properly) that captcha was failed
        $error_msg .= 'Incorrect captcha';
	}

	if (empty($error_msg)) {
		if ($stmt = $db->prepare("INSERT INTO pages (id, title, owner, private, lastedit) VALUES (:id, :title, :owner, :private, :lastedit)")) {
			if (! $stmt->execute(array(':id' => $id, ':title' => $title, ':owner' => $owner, ':private' => $private, ':lastedit' => $lastedit))) {
				header('Location: /error=creation failure: INSERT');
			}
		}
		$newpage = fopen("../page_files/".$id.".txt", "w");
		fclose($newpage);
        $db = null;
		header('Location: ../page/edit/'.$id.'');
	}
}