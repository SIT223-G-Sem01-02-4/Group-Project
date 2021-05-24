<?php
include 'main.php';
if($_POST) {

    $make = $_POST['search_make'];
    $model = $_POST['search_model'];
 
    $sql = "SELECT * FROM faultsandrecalls WHERE make = :make AND model = :model";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':make',$make,PDO::PARAM_STR);
    $stmt->bindParam(':model',$model,PDO::PARAM_STR);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $data = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Search Results - CheckYourCar</title>
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
            <div class="searchresults">
                <h1>Search Results</h1>
                <form action="index.php" method="">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                            <td class="responsive-hidden">Date</td>
                                <td class="responsive-hidden">Type</td>
                                <td class="responsive-hidden">Make</td>
                                <td class="responsive-hidden">Model</td>
                                <td class="responsive-hidden">Description</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data)): ?>
                            <tr>
                                <td colspan="8" style="text-align:center;">There are currently no faults or recalls for this vehicle!</td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($data as $faultrecall): ?>
                            <tr>
                                <td class="responsive-hidden"><?=$faultrecall['timestamp']?></td>
                                <td class="responsive-hidden"><?=$faultrecall['type']?></td>
                                <td class="responsive-hidden"><?=$faultrecall['make']?></td>
                                <td class="responsive-hidden"><?=$faultrecall['model']?></td>
                                <td class="responsive-hidden"><?=$faultrecall['description']?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <input type="submit" value="Search Again!" name="search_submit"></input>
                </form>
            </div>
		</main>
	</body>
</html>
