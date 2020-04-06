<?php 
include("config.php");

$error_string = '';

if(isset($_POST['submit'])){

  //username check
    if(preg_match('/^[A-Za-z0-9][A-Za-z0-9]{5,15}$/',$_POST['username']) == false)
        $error_string = 'Invalid Username';
  
  //password check
    else if($_POST['password'] != $_POST['password2'])
        $error_string = 'passwords dont match';
    

  //email check
    else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
        $error_string = 'Invalid e-mail';

    else{

        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        
        $password_hash = hash('sha512', strrev($password));

        $sql    = "SELECT Uname FROM USER WHERE Uname = '$username'";
        $result = mysqli_query($db, $sql);
        $row    = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count  = mysqli_num_rows($result);

        if($count == 0){

            $sql    = "INSERT INTO USER" . "(Uname,Hash,Email)" . "VALUES('$username','$password_hash','$email')";
			$retval = mysqli_query($db, $sql);
			echo "Registration successful.";

        }
        else{
            $error_string='username already taken';
        }

    }
}

?>

<html>

<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>

<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Create your account <small>It's free!</small></h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" action='' method="POST">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="username" id="username" class="form-control input-sm" placeholder="Username">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password2" id="password2" class="form-control input-sm" placeholder="Confirm Password">
			    					</div>
			    				</div>
			    			</div>
			    			
							<button class="btn btn-success", type="submit", name="submit">Register</button>
							<a href="index.php" value="Vissza", style="font-size: 14pt; font-weight:bold; text-align: right;">Vissza</a>
							
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

<?php

if($error_string != ''){
    print("<label class=\"control-label\">$error_string</label>");
}

?>

</body>
</html>

