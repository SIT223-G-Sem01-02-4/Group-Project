<?php
include 'main.php';
?>

<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Contact Us - CheckYourCar</title>
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
        <main>    
            <div class="contactus">
                <h1>Contact Us!</h1>
                <form action="sendmessage.php" method="post">
                    <label for="name">
                        <i class="fas fa-user-circle"></i>
                    </label>
                    <input type="text" name="visitor_name" placeholder="John Doe" id="name" pattern=[A-Z\sa-z]{3,20} required>

                    <label for="email">
                        <i class="fas fa-envelope"></i>
                    </label>
                    <input type="email" id="email" name="visitor_email" placeholder="john.doe@email.com" required> 

                    <label for="email_title">
                        <i class="fas fa-pen"></i>
                    </label>
                    <input type="text" id="title" name="email_title" required placeholder="Email Subject" pattern=[A-Za-z0-9\s]{8,60}>
                    
                    <textarea id="message" name="visitor_message" placeholder="Say whatever you want." required="" style="margin: 0px; width: 370px; height: 191px;"></textarea>
                    <div class="msg"></div>
                    <input type="submit" value="Send!">
                </form>
            </div>
        </main>
	</body>
</html>