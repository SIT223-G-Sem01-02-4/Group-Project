<?php
include 'main.php';
//Brute Fore Protection - Each failed login attempt triggers a counter, once the counter = 100 the user cant login for 24 hours.
$login_attempts = loginAttempts($pdo, FALSE);
if ($login_attempts && $login_attempts['attempts_left'] <= 0) {
	exit('You cannot login right now please try again later!');
}

//CSRF Protection - when the user logs in, each login will require a token that will be checked with PHP.
if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['token']) {
	exit('Incorrect token provided!');
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['username'], $_POST['password'])) {
	$login_attempts = loginAttempts($pdo);
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password field!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
$stmt = $pdo->prepare('SELECT * FROM accounts WHERE username = ?');
// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
$stmt->execute([ $_POST['username'] ]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);
// Check if the account exists:
if ($account) {
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $account['password'])) {
		// Check if the account is activated
		if (account_activation && $account['activation_code'] != 'activated') {
			// User has not activated their account, output the message
			echo 'Please activate your account to login, click <a href="resendactivation.php">here</a> to resend the activation email!';
		} 	// Crosscheck users IP address with whats recorded on the system
		else if ($_SERVER['REMOTE_ADDR'] != $account['ip']) {
			// Two-factor authentication required
			$_SESSION['2FA'] = uniqid();
			echo '2FA: twofactor.php?id=' . $account['id'] . '&email=' . $account['email'] . '&code=' . $_SESSION['2FA'];
		} else {
			// Verification success! User has loggedin!
			// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $account['username'];
			$_SESSION['id'] = $account['id'];
			$_SESSION['role'] = $account['role'];
			// IF the user checked the remember me check box:
			if (isset($_POST['rememberme'])) {
				// Create a hash that will be stored as a cookie and in the database, this will be used to identify the user, change "yoursecretkey" to anything you want.
				$cookiehash = !empty($account['rememberme']) ? $account['rememberme'] : password_hash($account['id'] . $account['username'] . 'yoursecretkey', PASSWORD_DEFAULT);
				// The amount of days a user will be remembered:
				$days = 30;
				setcookie('rememberme', $cookiehash, (int)(time()+60*60*24*$days));
				/// Update the "rememberme" field in the accounts table
				$stmt = $pdo->prepare('UPDATE accounts SET rememberme = ? WHERE id = ?');
				$stmt->execute([ $cookiehash, $account['id'] ]);
			}
			echo 'Success'; // Do not change this line as it will be used to check with the AJAX code
		}
	} else {
		// Incorrect password
		$login_attempts = loginAttempts($pdo, TRUE);
		echo 'Incorrect username and/or password, you have ' . $login_attempts['attempts_left'] . ' attempts remaining!';
	}
} else {
	// Incorrect username
	$login_attempts = loginAttempts($pdo, TRUE);
	echo 'Incorrect username and/or password, you have ' . $login_attempts['attempts_left'] . ' attempts remaining!';
}
?>
