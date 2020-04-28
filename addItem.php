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

hr {
    width: 80%;
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

#table1 {
    border-collapse: separate;
    border-spacing: 15px;
}
</style>
</head>
<body>

<?php
session_start();
include_once 'class.user.php'; $user = new User();


if (isset($_REQUEST['submit'])){
    extract($_REQUEST);
    $addItem = $user->addItem($nev, $mennyiseg,$ar, $idopont, $licitkulonbseg, $aktualislicit, $leiras, $_SESSION['uid']);
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
        //var $elso = Date.parse(form.idopont.value);
        //var $masodik = Date.parse(new Date().toDateString());
        //console.log($elso - $masodik);
        if(form.aktualislicit.value > form.ar.value){
            alert( "A licit nem lehet nagyobb mint az ár" );
            return false;
        }
        //else if(form.idopont.value > new Date()){
        else if ( (Date.parse(form.idopont.value)) - (Date.parse(new Date().toDateString())) < 0){
            alert( "Az időtartam nem lehet kisebb mint a mostani dátum" );
            return false;
        }
    }

</script>

<div id="container">
    <h1 style="color: black;">Itt tudsz hirdetést feladni</h1>
    <hr>
    <form action="" method="post" name="addItem">
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
                <th>Min. licit különbség:</th>
                <td><input type="number" name="licitkulonbseg" required="" /></td>
            </tr>
            <tr>
                <th>Licit kezdoertek:</th>
                <td><input type="number" min="0" name="aktualislicit" required="" /></td>
            </tr>
            <tr>
                <th>Leiras:</th>
                <td><textarea name="leiras" required="" placeholder="Ide ird a termek leirast"></textarea></td>
            </tr>
            <tr>
                <td><a href="home.php">Vissza</a></td>
                <td><input onclick="return(checkDatas()); " type="submit" name="submit" value="Felvitel" /></td>
            </tr>
            </tbody>
        </table>
    </form></div>
</body>
</html>