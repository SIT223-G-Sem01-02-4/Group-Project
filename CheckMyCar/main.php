<?php
// This main file contains the database connection, session initializing, and functions, other PHP pages depend on this file.

// Include the configuration file
include_once 'config.php';

// We need to use sessions, so you should always start sessions using the below code.
session_start();

// DO NOT EDIT BELOW - THIS INFORMATION IS FIXED. ANY CHANGES WILL RESULT IN SEVERAL BROKEN WEBPAGES.
try {
	$pdo = new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset, db_user, db_pass);
} catch (PDOException $exception) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to database, please try again later.');
}

///////////////////////////////// F U N C T I O N S /////////////////////////////////
// A function to check if the user is logged in and if there is a valid session cookie.
function check_loggedin($pdo, $redirect_file = 'login.php') {
	// Check for the 'Remember me cookie' variable and 'Logged-in session' variable
    if (isset($_COOKIE['rememberme']) && !empty($_COOKIE['rememberme']) && !isset($_SESSION['loggedin'])) {
    	// Cross-check the 'Remember me cookie' with the database and update the 'Logged-in session' variables.
    	$stmt = $pdo->prepare('SELECT * FROM accounts WHERE rememberme = ?');
    	$stmt->execute([ $_COOKIE['rememberme'] ]);
    	$account = $stmt->fetch(PDO::FETCH_ASSOC);
    	if ($account) {
    		// Match Found! Update the 'Logged-in session' variables and keep the user logged-in.
    		session_regenerate_id();
    		$_SESSION['loggedin'] = TRUE;
    		$_SESSION['name'] = $account['username'];
    		$_SESSION['id'] = $account['id'];
			$_SESSION['role'] = $account['role'];
    	} else {
			// Match Not Found! Re-direct the user to the login page.
    		header('Location: ' . $redirect_file);
    		exit;
    	}
    } else if (!isset($_SESSION['loggedin'])) {
    	// Not Logged-in! Re-direct the user to the login page.
    	header('Location: ' . $redirect_file);
    	exit;
    }
}

// A function to perform a simple check and return if the user is logged in or not. (Used primarily via the nav bar)
function simple_check($pdo) {
	if ($_SESSION['loggedin'] = TRUE)
	{
		exit;
	}
	else $_SESSION['loggedin'] = FALSE;
}

// A function to send the activation email to un-activated users.
function send_activation_email($email, $code) {
	$subject = 'Account Activation Required';
	$headers = 'From: ' . mail_from . "\r\n" . 'Reply-To: ' . mail_from . "\r\n" . 'Return-Path: ' . mail_from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
	$activate_link = activation_link . '?email=' . $email . '&code=' . $code;
	$email_template = str_replace('%link%', $activate_link, file_get_contents('activation-email-template.html'));
	mail($email, $subject, $email_template, $headers);
}

// A function to send the email to registered users when a new fault/recall is added that matches there vehicle.
function send_newfaultorrecallmatch_email($email, $description) {
	$subject = 'Your at risk - A recently discovered fault/recall impacts you!';
	$headers = 'From: ' . mail_from . "\r\n" . 'Reply-To: ' . mail_from . "\r\n" . 'Return-Path: ' . mail_from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
	$email_template = str_replace('%description%', $description, file_get_contents('../admin/emailtemplates/matchedrecallfault-email-template.html'));
	mail($email, $subject, $email_template, $headers);
}

// Bruteforce Protection - This limits the users to X amount of login attempts per IP address
function loginAttempts($pdo, $update = TRUE) {
	$ip = $_SERVER['REMOTE_ADDR'];
	$now = date('Y-m-d H:i:s');
	if ($update) {
		$stmt = $pdo->prepare('INSERT INTO login_attempts (ip_address, `date`) VALUES (?,?) ON DUPLICATE KEY UPDATE attempts_left = attempts_left - 1, `date` = VALUES(`date`)');
		$stmt->execute([$ip,$now]);
	}
	$stmt = $pdo->prepare('SELECT * FROM login_attempts WHERE ip_address = ?');
	$stmt->execute([$ip]);
	$login_attempts = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($login_attempts) {
		// The user can try to login after 1 day
		$expire = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($login_attempts['date'])));
		if ($now > $expire) {
			$stmt = $pdo->prepare('DELETE FROM login_attempts WHERE ip_address = ?');
			$stmt->execute([$ip]);
			$login_attempts = array();
		}
	}
	return $login_attempts;
}
?>
