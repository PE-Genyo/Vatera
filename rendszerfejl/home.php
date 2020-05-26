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

.center {
  margin: auto;
  width: 25%;
  border: 3px solid lightblue;
  padding: 5px;
}

h1 {
    text-align: center;
    color: black;
}

.serif {
  font-family: "Times New Roman", Times, serif;
  font-size: 50;
}

h2 {
    text-align: center;
    font-family:'Georgia', Times New Roman, Times, serif;
    color: black;
}


.aa1:link, .aa1:visited {
    background-color: #ccffff;
    color: black;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;

    margin: auto;
    width: 20%;
    border: 5px solid #33cc33;
    padding: 2px;
}

.aa1:hover, .aa1:active {
    background-color: lightgreen;
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
    <div id="header" style="color: blue; background-color: white; width: 65px;"><a href="home.php?q=logout">LOGOUT</a></div>

    <div id="main-body">
        <h1 class="serif">Hello <?php $user->get_fullname($uid); ?></h1>
        <hr style="width: 80%;height: 1px;background-color: black;border: none;">
        <h2><a href="addItem.php" class ="aa1">Hirdetes felvitel</a></h2>
        <br><br>
        <h2><a href="myItems.php" class ="aa1">Saját hirdetéseim</a></h2>
        <br><br>
        <h2><a href="search.php" class="aa1">Keresés</a></h2>

    </div>

    <div id="footer"></div>
</div>

</body>
</html>