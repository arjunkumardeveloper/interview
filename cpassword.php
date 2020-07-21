<?php
	session_start();
	include("header.php");
	include("connection.php");
//	echo $id = $_SESSION['id'];
?>

<div class="container mt-5">
<h3 class="text-center" style="font-family:algerian; background-image:linear-gradient(#D0D4D4, #D0D1D4, #030C25); color:#0C090A;">Change Password</h3>
	<div class="row justify-content-center">
    	<div class="col-lg-6 border rounded mb-5 bg-light">
        	<form action="#" method="post" name="changepassword">
            	<label>Old Password</label>
                <div class="form-group">
                	<input type="password" name="oldpassword" placeholder="Enter Your Old password" class="form-control" />
                </div>
                <label>New Password</label>
                <div class="form-group">
                	<input type="password" name="newpassword" placeholder="Enter Your New password" class="form-control" />
                </div>
                <label>Confirm Password</label>
                <div class="form-group">
                	<input type="password" name="conpassword" placeholder="Enter Your Confirm password" class="form-control" />
                </div>
                <div class="form-group text-center">
                	<input type="submit" class="btn btn-primary" name="cpassword" value="Submit" onclick="return validate();" />
                    <a href="profile.php" class="btn btn-info">Back</a>
                </div>	
            </form>
        </div>
    </div>
</div>
<?php
	if(isset($_POST['cpassword']))
	{
		$oldpassword = $_POST['oldpassword'];
		$newpassword = $_POST['newpassword'];
		$id = $_SESSION['id'];
		
		$query = "SELECT * FROM coreregistration WHERE id = '$id'";
		$res = mysqli_query($con, $query);
		$data = mysqli_fetch_array($res);
		
		if($data['password'] == $oldpassword)
		{
			$query = "UPDATE coreregistration SET password = '$newpassword' WHERE id = '$id'";
			if(mysqli_query($con, $query))
			{
				echo "<script>alert('Successfully Update Your Password')</script>";
				header("LOCATION:profile.php");
			}
			else
			{
				echo "<script>alert('Error..! Try Again..')</script>";
			}
		}
		else
		{
			echo "<script>alert('Old password does not match')</script>";
		}
		
	}
?>
<script>
	function validate()
	{
		if(document.changepassword.oldpassword.value == "")
		{
			alert("Old Password Must Be Required");
			return false;
		}
		else if(document.changepassword.newpassword.value == "")
		{
			alert("New password Must Be Required");
			return false;
		}
		else if(document.changepassword.conpassword.value == "")
		{
			alert("Confirm Password Must Be Required");
			return false;
		}
		else if(document.changepassword.newpassword.value.length <= 8)
		{
			alert("Password Must Be Eight Character");
			return false;
		}
		else if(document.changepassword.newpassword.value != document.changepassword.conpassword.value)
		{
			alert("New Password And Confirm Password Not Match");
			return false;
		}
		else
		{
			return true;
		}
	}
</script>

<?php
	include("footer.php");
?>