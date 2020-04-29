<html>
<head>
<title> Search </title>
<style type="text/css">
body {
    background-image: url("backgroundimg.jpg");
    background-size: cover;
}

h1, h2 {
  text-align: center;
}

a:link {
  color: yellow;
}

a:hover {
    color: green;
}

p {
  font-family: verdana;
  font-size: 20px;
  text-align: center;
  color: black;
}

form {
    text-align: center;
    padding-top: 30px;
}

</style>
</head>
<body>

<h1>Itt tudsz keresni</h1>
<hr style="width: 80%;height: 1px;background-color: black;border: none;">
<form action="" method="post" name="search">
    <input type="search" placeholder="Keresés név szerint" name="keresendo"/>
    <input type="submit" name="submit" value="Keresés"/>
    <br><br>
    <hr style="width: 80%;height: 1px;background-color: black;border: none;">
    <h2><a href="home.php">Vissza</a></h2>
</form>

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


</body>
</html>