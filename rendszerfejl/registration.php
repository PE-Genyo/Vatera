<?php

include_once 'class.user.php';  $user = new User(); // Checking for user logged in or not

if (isset($_REQUEST['submit'])){
    extract($_REQUEST);
    $register = $user->reg_user($fullname, $uname,$upass, $uemail);
    if ($register) {
        // Registration Success
        echo 'Registration successful <a href="login.php">Click here</a> to login';
    } else {
        // Registration Failed
        echo 'Registration failed. Email or Username already exits please try again';
    }
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<style><!--
    #container{width:400px; margin: 0 auto;}
    --></style>


<div id="container">
    <h1>Registration Here</h1>
    <form action="" method="post" name="reg">
        <table>
            <tbody>
            <tr>
                <th>Full Name:</th>
                <td><input type="text" name="fullname" required="" /></td>
            </tr>
            <tr>
                <th>User Name:</th>
                <td><input type="text" name="uname" required="" /></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><input type="text" name="uemail" required="" /></td>
            </tr>
            <tr>
                <th>Password:</th>
                <td><input type="password" name="upass" required="" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input  type="submit" name="submit" value="Register" /></td>
            </tr>
            <tr>
                <td></td>
                <td><a href="login.php">Already registered? Click Here!</a></td>
            </tr>
            </tbody>
        </table>
    </form></div>



