<?php
include 'main.php';
?>

<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Contact Us</title>
		<link href="styles-contactus.css" rel="stylesheet" type="text/css">
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
                    
            <section class="aboutus_page">
                <h1 class="hero_font">Contact Us</h1>
                <div class="aboutus_content">
                <form action="contact.php" method="post">
                    <div class="elem-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="visitor_name" placeholder="John Doe" pattern=[A-Z\sa-z]{3,20} required>
                    </div>
                    <div class="elem-group">
                        <label for="email">Your E-mail</label>
                        <input type="email" id="email" name="visitor_email" placeholder="john.doe@email.com" required>
                    </div>
                    <div class="elem-group">
                        <label for="department-selection">Choose Concerned Department</label>
                        <select id="department-selection" name="concerned_department" required>
                            <option value="">Select a Department</option>
                            <option value="recalls">Recalls</option>
                            <option value="manufacturer faults">Manufacturer Faults</option>
                            <option value="technical support">Technical Support</option>
                        </select>
                    </div>
                    <div class="elem-group">
                        <label for="title">Reason For Contacting Us</label>
                        <input type="text" id="title" name="email_title" required placeholder="Unable to Reset my Password" pattern=[A-Za-z0-9\s]{8,60}>
                    </div>
                    <div class="elem-group">
                        <label for="message">Write your message</label>
                        <textarea id="message" name="visitor_message" placeholder="Say whatever you want." required></textarea>
                    </div>
                    <button class = "button_contactform" type="submit">Send Message</button>
                </form>
            </section>
        </main>
    </body>
</html>