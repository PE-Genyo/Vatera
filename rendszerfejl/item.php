<html>
<head>
<title> Item </title>
<style type="text/css">
body {
    background-image: url("backgroundimg.jpg");
    background-size: cover;
}

h1, h2 {
  text-align: center;
}

p {
  font-family: verdana;
  font-size: 20px;
  text-align: center;
  color: black;
}

.aa1:link {
    color: yellow;
}

.aa1:visited{
    color: yellowgreen;
}

.aa1:hover {
    color: green;
}

form {
    text-align: center;
    
}

div {
    text-align: center;
}

</style>
</head>
<body>

<h1><a href="home.php" class ="aa1">Főoldal</a></h1><br>
<hr style="width: 80%;height: 1px;background-color: black;border: none;">
<div>
<?php
include "class.item.php";

$item = new Item($_GET['itemID']); 

$item->printInfo();

if (isset($_REQUEST['submit'])){
    if((isset($_POST['osszeg'])) && ($_POST['osszeg'] != "")){
        extract($_REQUEST);
        $item->licit($osszeg);
    }
}

?>
</div>


<form action="" method="post" name="search">
    <input type="search" placeholder="Összeg" name="osszeg"/>
    <input type="submit" name="submit" value="Licitálás"/>
    <br><br>
    <a href="search.php" class ="aa1"><h2>Keresés</h2></a><br>
    <a href="myItemS.php" class ="aa1"><h2>Saját hírdetéseim</h2></a>
</form>