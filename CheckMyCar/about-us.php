<?php
include 'main.php'; // Include the main.php file to check for current sessions.
?>

<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>About Us</title>
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>

    <body>
        <header>
            <nav>
            <img class="logo" src="images/logo.svg" onclick="location.href='./home.php';" style="cursor: pointer;" />
                <div class="links">
                    <a href="home.php"><i class="fas fa-home"></i> Home</a>
                    <?php if ($_SESSION['role'] == 'Admin'): ?>
					    <a href="admin/index.php" target="_blank"><i class="fas fa-user-cog"></i> Admin</a>
					<?php endif; ?>
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
            <section class="aboutus_page">
                <h1 class="hero_font">About Us</h1>
                <div class="aboutus_content">
                    <p class="aboutus_pclass">For project A, our group is to take on the imaginary role of 
                        beginning a start-up company called ‘CheckYourCar’. The ‘CheckYourCar’ platform intends 
                        to connect its end users with information regarding any know issues and/or problems 
                        identified with their cars. (i.e. Takata airbag recalls or known manufacture faults.) 
                        The team consits of 5 members of whom take upon different roles and positions. <br><br>
                        Ajay Sutton<br>Backend / Securit Analyst <br><br>Luke Collins<br>Front End Development / UI/UX
                        <br><br>Mohammed Uddin<br>Database / Securit Analyst<br><br>Rhea Sutton <br>Scrum Master / Front End Development</p>
            </section>
        </main>
    </body>
</html>