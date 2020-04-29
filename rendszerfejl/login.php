<html>
<head>
<title> Login </title>
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
  font-size: 16px;
  text-align: center;
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
session_start();
include_once 'class.user.php';
$user = new User();

if (isset($_REQUEST['submit'])) {
    extract($_REQUEST);
    $login = $user->check_login($emailusername, $password);
    if ($login) {
        // Registration Success
        header("location:home.php");
    } else {
        // Registration Failed
        echo '<p style="background-color:red">Wrong username or password</p>';
    }
}
include("footer.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" language="javascript">

    function submitlogin() {
        var form = document.login;
        if(form.emailusername.value == ""){
            alert( "Enter email or username." );
            return false;
        }
        else if(form.password.value == ""){
            alert( "Enter password." );
            return false;
        }
    }

</script>


<h1 style="color: yellow;"><b>Login Here</b></h1>
<form action="" method="post" name="login">
    <table align = "center" id="table1">
        <tbody>
        <tr>
            <th><p>UserName or Email:</p></th>
            <td><input type="text" name="emailusername" required="" /></td>
        </tr>
        <tr>
            <th><p>Password:</p></th>
            <td><input type="password" name="password" required="" /></td>
        </tr>
        <tr>
            <td><p><a href="registration.php" class="aa1">Register new user</a></p></td>
            <td><input onclick="return(submitlogin());" type="submit" name="submit" value="Login" /></td>
        </tr>
        </tbody>
    </table>

</form></div>

</body>
</html>