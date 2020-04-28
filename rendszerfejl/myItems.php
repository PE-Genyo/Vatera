<?php

include_once 'class.user.php';
$user = new User();
session_start();




?>

<h1>A hírdetéseid a következők: </h1><br><br>
<?php $user->listMyItems($_SESSION['uid']); ?>
<br>
<a href="home.php">Vissza</a>