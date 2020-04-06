<?php
    $error_string = '';
    include('config.php');

    if(isset($_POST['submitsignin'])){
        $username = $_POST['usernamesignin'];
        $password = $_POST['passwordsignin'];
        $password_hash = hash('sha512', strrev($password));

        

        $sql    = "SELECT Uname, Hash FROM USER WHERE Uname = '$username' AND Hash = '$password_hash'";
        $result = mysqli_query($db, $sql);
        $row    = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count  = mysqli_num_rows($result);

        if(!$count == 0){
            echo 'You have successfully logged in!';
        }
        else
        {
            $error_string= "This username/password pair is incorrect.";
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
			    		<h3 class="panel-title">Sign in <small> You should</small></h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" action='' method="POST">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="usernamesignin" id="username" class="form-control input-sm" placeholder="Username">
			    					</div>
			    				</div>
			    			</div>

			    			

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="passwordsignin" id="password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				
			    			</div>
			    			
							<button class="btn btn-success", type="submit", name="submitsignin">Sign in</button>
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

