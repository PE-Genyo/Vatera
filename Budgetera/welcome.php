<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include("footer.php");
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center;
		} 
		
		nav {
		  -webkit-flex: 1;
		  -ms-flex: 1;
		  flex: 1;
		  background: #ccc;
		  padding: 20px;
		}
		
		nav ul {
		  list-style-type: none;
		  text-align: center;
		  padding: 0;
		}
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a><br>
    </p>
	
	<hr>
	
	<section>
		<form>
			<label for="search-item">Search for item:</label>
			<input type="text" id="search" name="search"><br>
			<label for="search-cat">Search for category:</label>
			<input type="text" id="search-cat" name="search-cat"><br>
		</form>
	
		<nav>
			<ul>
			    <li><a href="#">Your shopping cart</a></li>
			    <li><a href="#">Browse categories</a></li>
			    <li><a href="#">Profile</a></li>
			</ul>
		</nav>
	</section>
	<h2>Newest items listed on Budgetera:</h2>
	<div class="newI-iems">
		<img src="alma.jpg" width="300" height="300">
		<img src="kocsi.jpg" width="300" height="300">
		<img src="cipo.jpg" width="300" height="300">
		<img src="asztal.jpg" width="300" height="300">
	</div>
	
	<!-- Todo: 5 newest listed items -->
</body>
</html>