<?php
include 'main.php';
?>

<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>About Us - CheckYourCar</title>
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
            <div class="aboutus">
                <h1>About Us!</h1>
                <p class="aboutus_pclass">
                    <br>
                    For project A, our group is to take on the imaginary role of beginning a start-up 
                    company called ‘CheckYourCar’. 
                    <br><br>
                    The ‘CheckYourCar’ platform intends to connect its 
                    end users with information regarding any know issues and/or problems identified 
                    with their cars. (i.e. Takata airbag recalls or other known manufacture faults.)
                    <hr class="solid">
                    <div class="row">
                        <div class="column">
                            The functionality of this website includes:
                            <br>
                            User Login/Registration
                            <br>
                            User Forgot Password
                            <br>
                            Backend Add Faults/Issues
                            <br>
                            Backend Add/Manage users
                            <br>
                            Backend Edit Email Templates
                            <br>
                            Frontend User Profiles 
                            <br>
                            Contact Us Form
                            <br>
                            Search Engine (Make and Model)
                        </div>
                        <div class="column">
                            Security:
                            <br>
                            2fa
                            <br>
                            Brute Force Protection
                            <br>
                            CSRF Protection
                        </div>
                    </div>
                    <hr class="solid">
                    The team consists of 5 members of whom take upon different roles and positions.</p> 
                    <h2>Ajay Solanki<br>Backend / Security Analyst</h2>
                    <hr class="invisible">
                    <h2>Luke Collins<br>Full Stack Development / UI Design<h2>
                    <hr class="invisible">
                    <h2>Mohammed Uddin<br>Database / Security Analyst</h2>
                    <hr class="invisible">
                    <h2>Rhea Sutton <br>Scrum Master / Front End Development<br></h2>
            </div>
        </main>
	</body>
</html>