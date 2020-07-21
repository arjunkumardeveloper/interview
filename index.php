<?php
	session_start();
	include('connection.php');
	
?>

<html>
	<head>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/style.css" >
    	<title>
        	Interview Project
        </title>
    </head>
    <body>
    	<div class="container mt-5">
        	<div class="row justify-content-center">
                
            	<div class="col-lg-6 border login">
                	<p class="text-center pb-5" style="font-size:30px;"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Login Form</p>
                    <!--<p class="text-center text-primary">(If Already Registerd)</p>-->
                	<form method="post" action="#" name="loginform">
                    	<div class="form-group">
                        	<div class="label">Username</div>
                        	<input type="text" name="username" placeholder="Enter Your Username or Mobile No." class="form-control" />
                        </div>
                        <div class="form-group">
                        <div class="label">Password</div>
                        	<input type="password" name="password" placeholder="Enter Your Password" class="form-control" />
                        </div>
                        <a href="register.php">New User's ?</a>
                        <div class="form-group text-center">
                        	<input type="submit" value="SUBMIT" class="btn btn-primary w-50" name="login" onClick="return checkVal()" />  
                        </div>
                    </form>
                    
                </div>
                
            </div>
        </div>
        
 <?php
 	if(isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM coreregistration WHERE mobile = '$username' AND password = '$password'";
		$res = mysqli_query($con, $sql);
		$data = mysqli_fetch_array($res);
		
		if($data['mobile'] == $username && $data['password'] == $password)
		{
			$_SESSION['userid'] = $data['fname'];
			$_SESSION['image'] = $data['path'];
			$_SESSION['id'] = $data['id'];
			header("LOCATION:welcome.php");
		}
		else
		{
			echo "<div class='alert alert-danger'>Login Faild! Try Again...</div>";
		}
	}
 ?>

 
        
        
        
<script>
	function checkVal()
	{
		//alert("Hello");
		if(document.loginform.username.value == "")
		{
			alert("Username Filled Must Be Required");
			return false;
		}
		else if(document.loginform.password.value == "")
		{
			alert("Password Filled Must Be Required");
			return false;
		}
		else if(document.loginform.password.value.length <= 8)
		{
			alert("Password Shoud Be 8 Character");
			return false;
		}
	}

	
</script>        
  
        
        
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>