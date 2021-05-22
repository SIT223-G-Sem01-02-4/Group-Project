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
                    <a href="about-us.php"><i class="fas fa-users"></i> About Us</a>
                    <a href="contact-us.php"><i class="fas fa-envelope"></i> Contact Us</a>
                    <a href="check-my-car.php"><i class="fas fa-car"></i> CheckMyCar</a>
					<a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                </div>
            </nav>
        </header>

        <main>    
                    
            <section class="info">
                <h1 class="hero_font">Is your car as safe<br> as you think it is?</h1>
                <div class="icons">
                    
                    <div class="icon" onclick="location.href='./register.html';" style="cursor: pointer;">
                        <img src="./images/RegisterIcon.svg">
                        <div class="icon_info">
                            <p class="icon_top">Want to receive live updates?</p>
                            <p class="icon_bottom">Register Now</p>
                        </div>
                    </div>
                    
                    <div class="icon" onclick="location.href='#';" style="cursor: pointer;">
                        <img src="./images/CheckNowIcon.svg">
                        <div class="icon_info">
                            <p class="icon_top">Are you Curious about your familys safety?</p>
                            <p class="icon_bottom">Check Now</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="features">

                <div class="feature">
                    <img src="images/feature_image1.jpg" />
                    <div class="feature_info">
                        <p class="feature_top">Feature Spot#1</p>
                        <p class="feature_bottom">Feature text body.</p>
                    </div>

                </div>
                <div class="feature">
                    <img src="images/feature_image2.jpg" />
                    <div class="feature_info">
                        <p class="feature_top">Feature Spot#2</p>
                        <p class="feature_bottom">Feature text body.</p>
                    </div>

                </div>
                <div class="feature">
                    <div class="feature_info">
                        <p class="feature_cta">Learn More</p>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>