<html>
<head>
<title> Home </title>
<style type="text/css">
body {
    background-image: url("backgroundimg.jpg");
    background-size: cover;

}

div {
    color: black;
}

hr {
    width: 80%;
    background-color: #666;
}

h1, h2 {
  text-align: center;
  font-family:'Georgia', Times New Roman, Times, serif;
  color: black;
}

p {
  font-family: verdana;
  font-size: 20px;
  text-align: center;
}

table, th, td {
    text-align: center;
    color:black;
}
</style>
</head>
<body>

<?php
session_start();
include_once 'class.user.php';
$user = new User(); $uid = $_SESSION['uid'];
if (!$user->get_session()){
    header("location:login.php");
}

if (isset($_GET['q'])){
    $user->user_logout();
    header("location:login.php");
}
include("footer.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<div id="container">
    <div id="header" style="background-color: white; width: 65px;"><a href="home.php?q=logout">LOGOUT</a></div>

    <div id="main-body">
        <h1>Hello <?php $user->get_fullname($uid); ?></h1>
        <hr>
        <a href="addItem.php"><h2>Hirdetes felvitel</h2></a>
        <br><br>
        <a href="myItems.php"><h2>Saját hirdetéseim</h2></a>
        <br><br>
        <a href="search.php"><h2>Keresés</h2></a>

    </div>

    <div id="footer"></div>
</div>

</body>
</html>
