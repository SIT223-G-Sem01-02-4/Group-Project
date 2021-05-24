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
                    For project A, our group is to take on the imaginary role of beginning a start-up 
                    company called ‘CheckYourCar’. The ‘CheckYourCar’ platform intends to connect its 
                    end users with information regarding any know issues and/or problems identified 
                    with their cars. (i.e. Takata airbag recalls or other known manufacture faults.) 
                    The team consits of 5 members of whom take upon different roles and positions.<br></p> 
                    
                    <h2><br>Ajay Sutton<br>Backend / Security Analyst<br></h2>
                    <h2><br>Luke Collins<br>Full Stack Development<br><h2>
                    <h2><br>Mohammed Uddin<br>Database / Securit Analyst<br></h2>
                    <h2><br>Rhea Sutton <br>Scrum Master / Front End Development<br></h2>
            </div>
        </main>
	</body>
</html>