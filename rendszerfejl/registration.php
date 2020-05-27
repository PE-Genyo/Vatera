<html>
<head>
<title> Registration </title>
<style type="text/css">
body {
    background-image: url("backgroundimg.jpg");
    background-size: cover;
}

h1 {
  text-align: center;
}

h2 {
    background-color: yellow;
    color: black;
    text-align: center;
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

.aa2:link {
    color: blue;
}

.aa2:visited{
    color: blue;
}

.aa2:hover {
    color: lightblue;
}

p {
  font-family: verdana;
  font-size: 20px;
  text-align: center;
}

table, th, td {
    text-align: right;
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

include_once 'class.user.php';  $user = new User(); // Checking for user logged in or not

if (isset($_REQUEST['submit'])){
    extract($_REQUEST);
    $register = $user->reg_user($fullname, $uname,$upass, $uemail);
    if ($register) {
        // Registration Success
        echo '<h2>Registration successful <a href="login.php" class="aa2">Click here</a> to login</h2>';
    } else {
        // Registration Failed
        echo '<h2>Registration failed. Email or Username already exits please try again</h2>';
    }
}
include("footer.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />


<div id="container">
    <h1>Registration Here</h1>
    <hr style="width: 80%;height: 1px;background-color: black;border: none;">
    <form action="" method="post" name="reg">
        <table align ="center" id="table1">
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
            </tbody>
        </table>
    <p><a href="login.php" class = "aa1">Already registered? Click Here!</a></p>
    </form>
</div>

</body>
</html>