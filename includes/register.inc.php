<?php
include_once 'db_connect.php';
include_once 'db_config.php';
require_once 'recaptchalib.php';

$secret = "6LePBwITAAAAAP8-Zvg3fOODI217MLcWaHs7mZEt";
$response = null;
$reCaptcha = new ReCaptcha($secret);

$error_msg = "";

if (isset($_POST['username'], $_POST['p'], $_POST['g-recaptcha-response'])) {
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
	if (strlen($password) != 128) {
		// TODO: properly handle errors by displaying them nicely to the user
		$error_msg .= 'Invalid password configuration.';
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
	$stmt = "SELECT id FROM users WHERE username = ? LIMIT 1";
	$stmt_ready = true;

	if ($stmt_ready == true) {
		$stmt->execute(array($username));
				if (($stmt->fetchColumn() > 0)) {
						// TODO: properly handle errors by displaying them nicely to the user
						$error_msg .= 'A user with this username already exists';
						$stmt->close();
				}
		} else {
				// TODO: properly handle errors by displaying them nicely to the user
				$error_msg .= 'Database error';
				$stmt->close();
		}

	if (empty($error_msg)) {
		$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		$password = hash('sha512', $password . $random_salt);

		if ($stmt = $db->prepare("INSERT INTO users (username, password, salt) VALUES (:username, :password, :salt)")) {
			if (! $stmt->execute(array(':username' => $username, ':password' => $password, ':salt' => $random_salt))) {
				header('Location: /error=registration failure: INSERT');
			}
		}
		header('Location: ./index?msg=registered!_log_in_below.');
	}
}