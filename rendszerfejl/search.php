<?php

include_once 'class.user.php';
$user = new User();
session_start();

if (isset($_REQUEST['submit'])){
    if((isset($_POST['keresendo'])) && ($_POST['keresendo'] != ""))
    extract($_REQUEST);
    $search = $user->searchByName($keresendo);

}


?>

<h1>Itt tudsz keresni</h1>


<form action="" method="post" name="search">
    <input type="search" placeholder="Keresés név szerint" name="keresendo"/>
    <input type="submit" name="submit" value="Keresés"/>
    <br><br>
    <a href="home.php">Vissza</a>
</form>
