<a href="home.php">Főoldal</a><br>

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


<form action="" method="post" name="search">
    <input type="search" placeholder="Összeg" name="osszeg"/>
    <input type="submit" name="submit" value="Licitálás"/>
    <br><br>
    <a href="search.php">Keresés</a><br>
    <a href="myItemS.php">Saját hírdetéseim</a>
</form>

