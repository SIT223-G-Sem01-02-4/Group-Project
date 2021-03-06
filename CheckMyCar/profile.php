<?php
include 'main.php';
check_loggedin($pdo);

// output message (errors, etc)
$msg = '';
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->execute([ $_SESSION['id'] ]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);
// Handle edit profile post data
if (isset($_POST['username'], $_POST['password'], $_POST['cpassword'], $_POST['email'], $_POST['make'], $_POST['model'])) {
	// Make sure the submitted registration values are not empty.
	if (empty($_POST['username']) || empty($_POST['email'])) {
		$msg = 'The input fields must not be empty!';
	} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$msg = 'Please provide a valid email address!';
	} else if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
	    $msg = 'Username must contain only letters and numbers!';
	} else if (!empty($_POST['password']) && (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5)) {
		$msg = 'Password must be between 5 and 20 characters long!';
	} else if ($_POST['cpassword'] != $_POST['password']) {
		$msg = 'Passwords do not match!';
	} else if (!empty($_POST['make']) && (strlen($_POST['make']) > 20)) {
		$msg = 'The make must be less then 20 characters';
	} else if (!empty($_POST['make']) && !preg_match('/^[a-zA-Z]+$/', $_POST['make'])) {
	    $msg = 'Make must contain only letters';
	} else if (!empty($_POST['model']) && (strlen($_POST['model']) > 30)) {
		$msg = 'Model must be less then 30 characters';
	} else if (!empty($_POST['model']) && !preg_match('/^[a-zA-Z0-9]+$/', $_POST['model'])) {
	    $msg = 'Model must contain only letters and numbers';
	}
	if (empty($msg)) {
		// Check if new username or email already exists in database
		$stmt = $pdo->prepare('SELECT COUNT(*) FROM accounts WHERE (username = ? OR email = ?) AND username != ? AND email != ?');
		$stmt->execute([ $_POST['username'], $_POST['email'], $_SESSION['name'], $account['email'] ]);
		if ($result = $stmt->fetchColumn()) {
			$msg = 'Account already exists with that username and/or email!';
		} else {
			// no errors occured, update the account...
			$uniqid = account_activation && $account['email'] != $_POST['email'] ? uniqid() : $account['activation_code'];
			$stmt = $pdo->prepare('UPDATE accounts SET username = ?, password = ?, email = ?, make = ?, model = ?, activation_code = ? WHERE id = ?');
			// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
			$password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $account['password'];
			$stmt->execute([ $_POST['username'], $password, $_POST['email'], $_POST['make'], $_POST['model'], $uniqid, $_SESSION['id'] ]);
			// Update the session variables
			$_SESSION['name'] = $_POST['username'];
			if (account_activation && $account['email'] != $_POST['email']) {
				// Account activation required, send the user the activation email with the "send_activation_email" function from the "main.php" file
				send_activation_email($_POST['email'], $uniqid);
				// Log the user out
				unset($_SESSION['loggedin']);
				$msg = 'You have changed your email address, you need to re-activate your account!';
			} else {
				// profile updated redirect the user back to the profile page and not the edit profile page
				header('Location: profile.php');
				exit;
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Member Profile - CheckYourCar</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>CheckYourCar</h1>
				<a href="index.php"><i class="fas fa-home"></i>Home</a>
				<a href="about-us.php"><i class="fas fa-users"></i> About Us</a>
				<a href="contact-us.php"><i class="fas fa-envelope"></i> Contact Us</a>
				<?php if ($_SESSION['role'] == 'Admin'): ?>
					<a href="admin/index.php" target="_blank"><i class="fas fa-user-cog"></i>Admin</a>
				<?php endif; ?>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<?php if (!isset($_GET['action'])): ?>
		<div class="content profile">
			<h2 class="hero_font">Welcome, <?=$_SESSION['name']?>!</h>
			<div class="block">

				<table>
					<tr>
						<td><strong><u>Personal Details:</u></strong></td>
					</tr>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$account['email']?></td>
					</tr>
					<tr>
						<td>Role:</td>
						<td><?=$account['role']?></td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td><strong><u>Personal Vehicle Details:</u></strong></td>
					</tr>
					<tr>
						<td>Make:</td>
						<td><?=$account['make']?></td>
					</tr>
					<tr>
						<td>Model:</td>
						<td><?=$account['model']?></td>
				</table>
				<a class="profile-btn" href="profile.php?action=edit">Edit Details</a>
			</div>
		</div>
		<?php elseif ($_GET['action'] == 'edit'): ?>
		<div class="content profile">
			<h2>Edit User Profile</h2>
			<div class="block">
				<form action="profile.php?action=edit" method="post">
					<label for="username">Username</label>
					<input type="text" value="<?=$_SESSION['name']?>" name="username" id="username" placeholder="Username">
					<label for="email">Email</label>
					<input type="email" value="<?=$account['email']?>" name="email" id="email" placeholder="Email">
					<label for="make">Make</label>
					<input type="text" value="<?=$account['make']?>" name="make" id="make" placeholder="Make">
					<label for="model">Model</label>
					<input type="text" value="<?=$account['model']?>" name="model" id="model" placeholder="Model">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" placeholder="Password">
					<label for="cpassword">Confirm Password</label>
					<input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
					<br>
					<input class="profile-btn" type="submit" value="Save">
					<p><?=$msg?></p>
				</form>
			</div>
		</div>
		<?php endif; ?>
	</body>
</html>
