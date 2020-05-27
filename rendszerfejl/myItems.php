<html>
<head>
<title> My Items </title>
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
    height: 1px;
    background-color: black;
    border: none;
}

.aa1:link{
    color:yellow;
}

.aa1:visited{
    color: yellow;
}

.aa1:hover {
  color: yellowgreen;
}

.aa1:visited {
  color: yellow;
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
<hr style="width: 80%;height: 1px;background-color: black;border: none;">
<br><br>
<p><?php $user->listMyItems($_SESSION['uid']); ?></p>
<br>
<hr style="width: 80%;height: 1px;background-color: black;border: none;">
<a href="home.php" class = "aa1"><h2>Vissza</h2></a>

<br><br>

</body>
</html>