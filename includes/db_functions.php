<?php
include_once 'db_connect.php';
include_once 'db_config.php';
 
function sec_session_start() {
	$session_name = 'sec_session_id';
	$secure = SECURE;

	$httponly = true;

	if (ini_set('session.use_only_cookies', 1) === FALSE) {
		header("Location: /error.php?err=could not initiate a safe session (ini_set)");
		exit();
	}

	$cookieParams = session_get_cookie_params();
	session_set_cookie_params($cookieParams["lifetime"],
		$cookieParams["path"], 
		$cookieParams["domain"], 
		$secure,
		$httponly);

	session_name($session_name);
	session_start();
	session_regenerate_id(true);
}

function login($username, $password, $db) {
	if ($stmt = $db->prepare("SELECT id, username, password, salt, admin FROM users WHERE username = ? LIMIT 1")) {
		$stmt->execute(array($username));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$row_count = $stmt->rowCount();

		$password = hash('sha512', $password . $row['salt']);
		if ($row_count == 1) {
			if (checkbrute($row['id'], $db) == true) {
				// TODO: handle bruteforce attack / account lock
				return false;
				$db = null;
			} else {
				if ($row['password'] == $password) {
					$user_browser = $_SERVER['HTTP_USER_AGENT'];
					$user_id = preg_replace("/[^0-9]+/", "", $row['id']);
					$_SESSION['user_id'] = $user_id;
					$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $row['username']);
					$_SESSION['username'] = $row['username'];
					$_SESSION['isAdmin'] = $row['admin'];
					$_SESSION['login_string'] = hash('sha512', $password . $user_browser);
					return true;
				} else {
					// TODO: put in a place in /admin/ to see attempts
					// TODO: get attempter's IP and put it in there too
					$now = time();
					$stmt = $db->prepare("INSERT INTO login_attempts (user_id, time) VALUES (?, ?)");
					$stmt->execute(array($row['id'], $now));
					$db = null;
					return false;
				}
			}
		} else {
			return false;
		}
	}
	$db = null;
}

function checkbrute($user_id, $db) {
	$now = time();
	$valid_attempts = $now - (2 * 60 * 60);

	if ($stmt = $db->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > ?")) {
		$stmt->execute(array($user_id, $valid_attempts));
		$row_count = $stmt->rowCount();

		if ($row_count >= 15) {
			return true;
		} else {
			return false;
		}
		$db = null;
	}
}

function login_check($db) {
	if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['isAdmin'], $_SESSION['login_string'])) {

		$user_id = $_SESSION['user_id'];
		$login_string = $_SESSION['login_string'];
		$username = $_SESSION['username'];
		$admin = $_SESSION['isAdmin'];
		$user_browser = $_SERVER['HTTP_USER_AGENT'];

		if ($stmt = $db->prepare("SELECT password FROM users WHERE id = ? LIMIT 1")) {
			$stmt->execute(array($user_id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$row_count = $stmt->rowCount();

			if ($row_count == 1) {
				$password = $row['password'];
				$login_check = hash('sha512', $password . $user_browser);

				if ($login_check == $login_string) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function esc_url($url) {
	if ('' == $url) {
		return $url;
	}

	$url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

	$strip = array('%0d', '%0a', '%0D', '%0A');
	$url = (string) $url;

	$count = 1;
	while ($count) {
		$url = str_replace($strip, '', $url, $count);
	}

	$url = str_replace(';//', '://', $url);

	$url = htmlentities($url);

	$url = str_replace('&amp;', '&#038;', $url);
	$url = str_replace("'", '&#039;', $url);

	if ($url[0] !== '/') {
		// We're only interested in relative links from $_SERVER['PHP_SELF']
		return '';
	} else {
		return $url;
	}
}