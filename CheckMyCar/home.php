<?php
include 'main.php';
check_loggedin($pdo, $redirect_file = 'index.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Home Page</title>
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <nav>
                <img class="logo" src="images/logo.svg" onclick="location.href='./home.php';" style="cursor: pointer;" />
                <div class="links">
					<?php if ($_SESSION['role'] == 'Admin'): ?>
					<a href="admin/index.php" target="_blank"><i class="fas fa-user-cog"></i> Admin</a>
					<?php endif; ?>
                    <a href="about-us.php"><i class="fas fa-users"></i> About Us</a>
                    <a href="contact-us.php"><i class="fas fa-envelope"></i> Contact Us</a>
                    <a href="check-my-car.php"><i class="fas fa-car"></i> CheckMyCar</a>
					<a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a>
					<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </div>
            </nav>
        </header>

        <main>    
                    
            <section class="info">
                <h1 class="hero_font">Welcome, <?=$_SESSION['name']?>!</h1>
                <div class="icons">
                    
                    <div class="icon" onclick="location.href='./register.html';" style="cursor: pointer;">
                        <img src="./images/RegisterIcon.svg">
                        <div class="icon_info">
                            <p class="icon_bottom">Register Car Now</p>
                        </div>
                    </div>
                    
                    <div class="icon" onclick="location.href='#';" style="cursor: pointer;">
                        <img src="./images/CheckNowIcon.svg">
                        <div class="icon_info">
                            <p class="icon_bottom">Check Now</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
