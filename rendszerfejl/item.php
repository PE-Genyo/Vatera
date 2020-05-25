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

textarea {
  resize: none;
}

</style>
</head>
<body>

<h1><a href="home.php" class ="aa1">Főoldal</a></h1><br>
<hr style="width: 80%;height: 1px;background-color: black;border: none;">
<div>
<?php
include "class.item.php";

session_start();

$item = new Item($_GET['itemID']); 

$item->printInfo();

if (isset($_REQUEST['licit'])){
    if((isset($_POST['osszeg'])) && ($_POST['osszeg'] != "")){
        $item->licit($_POST['osszeg']);
    }
}

if ($_SESSION['uid'] != $item->getUserId()){
    print " <form action=\"\" method=\"post\" name=\"search\">
                <input type=\"number\" placeholder=\"Összeg\" name=\"osszeg\"/>
                <input type=\"submit\" name=\"licit\" value=\"Licitálás\"/>
                <br><br>
            </form>";
}

if (isset($_REQUEST['send'])){
    
    $item->addComment($_POST['mycomment']);    
    
}

print 
"<div>
<form action=\"\" method=\"post\" name=\"mycomment\">
    <br><br>
    <textarea placeholder=\"Hozzászólok... (max 500 karakter)\" name=\"mycomment\" id=\"mycomment\" cols=\"90\" rows=\"5\"></textarea><br><br>
    <input type=submit name=send value=Küldés>
</form>
</div>";

$item->printComments();

?>
</div>





 
