<?php
include 'main.php';

// The returned message.
$msg = '';

// Check if the email from the resend activation form was submitted, isset() will check if the email exists.
if (isset($_POST['email'])) {

    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code != "" AND activation_code != "activated"');
    $stmt->execute([ $_POST['email'] ]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check there is an email matched to an account. Regardless of the outcome, the $msg variable will displayed on the webpage and an
	// activation email will be sent if there is a matching email within the database.
    if ($account) {
        send_activation_email($_POST['email'], $account['activation_code']);
        $msg = 'The activaton link has been sent to your email!';
    } else {
        $msg = 'Sorry, we do not have an account with that email!';
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Resend Activation Email</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<div class="login">
			<h1>Resend Activation Email</h1>
			<form action="resendactivation.php" method="post">
                <label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Your Email" id="email" required>
				<div class="msg"><?=$msg?></div>
				<input type="submit" value="Submit">
			</form>
		</div>
	</body>
</html>
