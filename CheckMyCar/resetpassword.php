<?php
include 'main.php';
// Output message
$msg = '';
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (isset($_GET['email'], $_GET['code']) && !empty($_GET['code'])) {
    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE email = ? AND reset = ?');
    $stmt->execute([$_GET['email'], $_GET['code']]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    // If the account exists with the email and code
    if ($account) {
        if (isset($_POST['npassword'], $_POST['cpassword'])) {
            if (strlen($_POST['npassword']) > 20 || strlen($_POST['npassword']) < 5) {
            	$msg = 'Password must be between 5 and 20 characters long!';
            } else if ($_POST['npassword'] != $_POST['cpassword']) {
                $msg = 'Passwords must match!';
            } else {
                $stmt = $pdo->prepare('UPDATE accounts SET password = ?, reset = "" WHERE email = ?');
            	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            	$password = password_hash($_POST['npassword'], PASSWORD_DEFAULT);
            	$stmt->execute([$password, $_GET['email']]);
                $msg = 'Password has been reset! You can now <a href="index.php">login</a>!';
            }
        }
    } else {
        exit('Incorrect email and/or code!');
    }
} else {
    exit('Please provide the email and code!');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Reset Password - CheckYourCar</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
	<nav class="navtop">
			<div>
				<h1>CheckYourCar</h1>
                    <a href="index.php"><i class="fas fa-home"></i> Home</a>
                    <a href="about-us.php"><i class="fas fa-users"></i> About Us</a>
                    <a href="contact-us.php"><i class="fas fa-envelope"></i> Contact Us</a>

                    <!-- Check if there is a current session, if TRUE display logout & profile -->
                    <?php if (isset($_SESSION['loggedin'])): ?>
                        <?php if ($_SESSION['role'] == 'Admin'): ?>
                        <a href="admin/index.php" target="_blank"><i class="fas fa-user-cog"></i> Admin</a>
					<?php endif; ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['loggedin'])): ?>
                        <a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a>
                        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a> 
					<?php endif; ?>

                    <!-- Check if there is a current session, if FALSE display login -->
    			    <?php if (!isset($_SESSION['loggedin'])): ?>
                        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login/Register</a> 
					<?php endif; ?>
			</div>
		</nav>
		<div class="login">
			<h1>Reset Password</h1>
			<form action="resetpassword.php?email=<?=$_GET['email']?>&code=<?=$_GET['code']?>" method="post">
                <label for="npassword">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="npassword" placeholder="New Password" id="npassword" required>
                <label for="cpassword">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="cpassword" placeholder="Confirm Password" id="cpassword" required>
				<div class="msg"><?=$msg?></div>
				<input type="submit" value="Submit">
			</form>
		</div>
	</body>
</html>
