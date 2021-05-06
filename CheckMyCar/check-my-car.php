<?php
include 'main.php'; // Include the main.php file to check for current sessions.
?>

<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Check My Car!</title>
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>

    <body>
        <header>
            <nav>
            <img class="logo" src="images/logo.svg" onclick="location.href='./home.php';" style="cursor: pointer;" />
                <div class="links">
                    <a href="home.php"><i class="fas fa-home"></i> Home</a>
                    <a href="about-us.php"><i class="fas fa-users"></i> About Us</a>
                    <a href="contact-us.php"><i class="fas fa-envelope"></i> Contact Us</a>
                    <a href="check-my-car.php"><i class="fas fa-car"></i> CheckMyCar</a>

                    <!-- Check if there is a current session, if TRUE display logout & profile -->
    			    <?php if (isset($_SESSION['loggedin'])): ?>
                        <a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a>
					    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a> 
					<?php endif; ?>

                    <!-- Check if there is a current session, if FALSE display login -->
    			    <?php if (!isset($_SESSION['loggedin'])): ?>
                        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a> 
					<?php endif; ?>
                </div>
            </nav>
        </header>

        <main>    
        </main>
    </body>
</html>