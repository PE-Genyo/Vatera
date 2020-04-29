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

form {
    text-align: center;
}

</style>
</head>
<body>

<p><?php

include_once 'class.user.php';
$user = new User();
session_start();

if (isset($_REQUEST['submit'])){
    if((isset($_POST['keresendo'])) && ($_POST['keresendo'] != ""))
    extract($_REQUEST);
    $search = $user->searchByName($keresendo);

}

?></p>

<h1>Itt tudsz keresni</h1>

<form action="" method="post" name="search">
    <input type="search" placeholder="Keresés név szerint" name="keresendo"/>
    <input type="submit" name="submit" value="Keresés"/>
    <br><br>
    <a href="home.php"><h2>Vissza</h2></a>
</form>
</body>
</html>