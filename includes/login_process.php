<?php
include_once 'db_connect.php';
include_once 'db_functions.php';

sec_session_start();

if (isset($_POST['username'], $_POST['p'])) {
	$username = $_POST['username'];
	$password = $_POST['p'];

	if (login($username, $password, $db) == true) {
		header('Location: ../index');
	} else {
		header('Location: ../login?msg=Sorry,_what_you_typed_below_was_wrong.');
	}
} else {
	header('Location: /error=creation failure: INSERT');
}