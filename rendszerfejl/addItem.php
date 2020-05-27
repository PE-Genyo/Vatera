<html>
<head>
<title> add item </title>
<style type="text/css">
body {
    background-image: url("backgroundimg.jpg");
    background-size: cover;
}

h1 {
  text-align: center;
}

p {
  font-family: verdana;
  font-size: 20px;
  text-align: center;
}

table {
    text-align: center;
    color:black;
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

.aa1:active{
    color: yellow;
}


#table1 {
    border-collapse: separate;
    border-spacing: 15px;
}
</style>
</head>
<body>

<?php
session_start();
include_once 'class.user.php'; 

$user = new User();

if (isset($_REQUEST['submit'])){
    extract($_REQUEST);
    $idopont=$idopont.' '.$time;
    $addItem = $user->addItem($nev, $mennyiseg,$ar, $idopont, $licitkulonbseg, $aktualislicit, $leiras, $_SESSION['uid'],$_FILES["fileToUpload"]);
    if ($addItem) {
        // Registration Success
        echo 'Sikeres felvitel!';
        header("location:home.php");
    } else {
        // Registration Failed
        echo 'Sikertelen felvitel';
    }
}
include("footer.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<script type="text/javascript" language="javascript">

    function checkDatas() {
        var form = document.addItem;
        console.log(form.ar.value);
        console.log(form.aktualislicit.value);

        if(parseInt(form.aktualislicit.value) > parseInt(form.ar.value)){
            alert( "A licit nem lehet nagyobb mint az ár" );
            return false;
        }

        if ( (Date.parse(form.idopont.value)) - (Date.parse(new Date().toDateString())) < 0){
            alert( "Az időtartam nem lehet kisebb mint a mostani dátum" );
            return false;
        }
    }

</script>

<div id="container">
    <h1 style="color: black;">Itt tudsz hirdetést feladni</h1>
    <hr style="width: 80%;height: 1px;background-color: black;border: none;">
    <form action="" method="post" name="addItem" enctype="multipart/form-data">>
        <table align = "center" id = "table1">
            <tbody>
            <tr>
                <th>Név:</th>
                <td><input type="text" name="nev" required="" /></td>
            </tr>
            <tr>
                <th>Mennyiség:</th>
                <td><input type="number" min="0" name="mennyiseg" required="" /></td>

            </tr>
            <tr>
                <th>Ár:</th>
                <td><input type="number" min="1" placeholder="Az ár Ft-ban értendő" name="ar" required="" /></td>

            </tr>
            <tr>
                <th>Időtartam:</th>
                <td><input type="date" name="idopont"  required="" /></td>
            </tr>
            <tr>
                <th> </th>
                <td><input type="time" id="time" name="time" required="" /></td>
            </tr>
            <tr>
                <th>Min. licit különbség:</th>
                <td><input type="number" name="licitkulonbseg" required="" /></td>
            </tr>
            <tr>
                <th>Licit kezdoertek:</th>
                <td><input type="number" min="0" name="aktualislicit" required="" /></td>
            </tr>
            <tr>
                <th>Kép feltöltése:</th>
                <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
            </tr>
            <tr>
                <th>Leiras:</th>
                <td><textarea name="leiras" required="" placeholder="Ide ird a termek leirast"></textarea></td>
            </tr>
            <tr>
                <td><a href="home.php" class = "aa1">Vissza</a></td>
                <td><input onclick="return(checkDatas()); " type="submit" name="submit" value="Felvitel" /></td>
            </tr>
            </tbody>
        </table>
    </form></div>
</body>
</html>