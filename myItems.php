<html>
<head>
<title> Login </title>
<style type="text/css">
body {
    background-image: url("backgroundimg.jpg");
    background-size: cover;
}

h1, h2 {
  text-align: center;
}

hr {
    width: 80%;
}

p {
  font-family: verdana;
  font-size: 20px;
  text-align: center;
  color: black;
}

</style>
</head>
<body>

<?php

include_once 'class.user.php';
$user = new User();
session_start();

include("footer.php");
?>

<h1>A hírdetéseid a következők: </h1>
<hr>
<br><br>
<p><?php $user->listMyItems($_SESSION['uid']); ?></p>
<br>
<a href="home.php"><h2>Vissza</h2></a>

</body>
</html>