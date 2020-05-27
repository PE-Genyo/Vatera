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
    color: yellow;
}

.aa1:hover {
    color: yellowgreen;
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

.button {
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 0px 0px;
  cursor: pointer;
  border-radius: 12px;
}
.buttonDel {background-color: rgb(79, 29, 245);height:20px; width: 60px;}
.buttonLicit {background-color: rgb(63, 221, 15); height:30px; width: 70px;}
.buttonSend{background-color: rgb(122, 214, 57);height:30px; width: 70px;}

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

if ($_SESSION['uid'] != $item->getUserId() && $item->getIdopont() > date("Y-m-d H:i:s",time())){
    print " <form action=\"\" method=\"post\" name=\"search\">
                <input type=\"number\" placeholder=\"Összeg\" name=\"osszeg\"/>
                <input class=\"button buttonLicit\"type=\"submit\" name=\"licit\" value=\"Licitálás\"/>
                <br><br>
            </form>";
}

if (isset($_REQUEST['send'])){
    
    $item->addComment($_POST['mycomment']);    
    
}

//if($item->getIdopont() > date("Y-m-d H:i:s",time())){
print 
"<div>
<form action=\"\" method=\"post\" name=\"mycomment\">
    <br><br>
    <textarea placeholder=\"Hozzászólok... (max 500 karakter)\" name=\"mycomment\" id=\"mycomment\" cols=\"90\" rows=\"5\"></textarea><br><br>
    <input class=\"button buttonSend\"type=submit name=send value=Küldés>
</form>
</div>";
//}

$item->printComments();

include("footer.php");


if(isset($_REQUEST['del'])){
    $item->deleteMyComment($_POST['del']);
}


?>
</div>
<hr style="width: 80%;height: 1px;background-color: black;border: none;">
</body>
</html>