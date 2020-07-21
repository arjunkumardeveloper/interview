 <?php
 include('connection.php');
 
 
 	if(isset($_POST['registration']))
	{
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$fathername = $_POST['fathername'];
		$mothername = $_POST['mothername'];
		$dob = $_POST['dob'];
		$gender = $_POST['gender'];
		$mobile = $_POST['mobile'];
		$tdate = date('d-m-y');
		$password = $_POST['password'];
		
		$abc = "";
		$arjunfn = arjun($abc);
		$break = explode('@', $arjunfn);
		$path = $break[0];
		$filename = $break[2];
		
		$sql = "INSERT INTO coreregistration (fname, lname, fathername, mothername, dob, gender, mobile, tdate, password, filename, path) VALUES ('$fname', '$lname', '$fathername', '$mothername', '$dob', '$gender', '$mobile', '$tdate', '$password', '$filename', '$path')";
		if(mysqli_query($con, $sql))
		{
			
			echo "<div class='alert alert-success'>Registration Success</div>";
			header("LOCATION:index.php");
		}
	}
	
	function arjun($arj){
		$words = explode('.', $_FILES["photo"]["name"]);
		$pfile = array_pop($words);
		$pfile1 = implode('', $words);
		
		if($_FILES["photo"]["error"] > 0){
				$arj = $_FILES["photo"]["error"]."<br />";
		}else{
			if(file_exists("uploadregis/" . $_FILES['photo']['name'])){
				$arj = $_FILES['photo']['name'] . "Already Exists. Change the name of the  image";		
			}
			else{
				$char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQURSTUVWXYZ";
				$res = "";
				for($i=0; $i<15; $i++){
					$res .= $char[mt_rand(0, strlen($char)-1)];
				}
				$filenamesave = $_FILES['photo']['name'];
				$filename = $res . "." . $pfile;
				$path = $filename ;
				$fullpath = $path . "@" . $pfile . "@" . $pfile1;
				move_uploaded_file($_FILES["photo"]["tmp_name"], "uploadregis/" . $filename);
				$far = "Upload Successfully";
				return $fullpath;
			}
		}
	}
 ?>
<html>
	<head>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/style.css" >
    
    
    	<title>Interview Project</title>
    </head>
    <body>
    	<div class="continer mt-5">
        	<div class="row justify-content-center">
            	<div class="col-lg-6 border " style="background:white;">
                	<h3 class="text-center p-4"><i class="fa fa-user-circle" aria-hidden="true"></i> Registraion Form</h3>
                    <form action="#" method="post" name="myform" enctype="multipart/form-data">
                    	<div class="form-group">
                        	<input type="text" name="fname" placeholder="Enter Your First Name" class="form-control" />
                        </div>
                        <div class="form-group">
                        	<input type="text" name="lname" placeholder="Enter Your Last Name" class="form-control" />
                        </div>
                        <div class="form-group">
                        	<input type="text" name="fathername" placeholder="Enter Your Father Name" class="form-control" />
                        </div>
                        <div class="form-group">
                        	<input type="text" name="mothername" placeholder="Enter Your Mother Name" class="form-control" />
                        </div>
                        <div class="form-group">
                        	<input type="date" name="dob" class="form-control"  />
                        </div>
                        <div class="form-group">
                        	Male: <input type="radio" name="gender" value="Male" />
                            Female: <input type="radio" name="gender" value="Female" />
                        </div>
                        <div class="form-group">
                        	<input type="text" name="mobile" placeholder="Enter Your Mobile Number" class="form-control" onKeyPress="return checkdegi()" />
                        </div>
                        <div class="form-group">
                        	<input type="text" name="password" placeholder="Enter Your Password" class="form-control" />
                        </div>
                        <div class="form-group">
                        	<input type="file" name="photo" />
                        </div>
                        <div class="form-group text-center">
                        	<input type="submit" value="Submit" name="registration" class="btn btn-primary" onClick="return validate()" />
                            <a href="index.php" class="btn btn-info">Back</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        
        
        
        <script>
        	function validate()
	{
		//alert("hii");
		var a = document.myform.fname.value;
		
		if(a == "")
		{
			alert("FirstName Must Be Filled");
			return false;
		}
		else if(document.myform.lname.value == "")
		{
			alert("LastName Must Be Filled");
			return false;
		}
		else if(document.myform.fathername.value == "")
		{
			alert("FatherName Must Be Filled");
			return false;
		}
		else if(document.myform.mothername.value == "")
		{
			alert("MotherName Must Be Filled");
			return false;
		}
		else if(document.myform.dob.value == "")
		{
			alert("Date Of Birth Field Required");
			return false;
		}
		else if(document.myform.gender.value == "")
		{
			alert("Gender Must Be Required");
			return false;
		}
		else if(document.myform.mobile.value == "")
		{
			alert("Mobile Number Must Be Required");
			return false;
		}
		else if(document.myform.password.value == "")
		{
			alert("Password Must Be Required");
			return false;
		}
		else if(document.myform.password.value.length <= 8)
		{
			alert("Password Shoud Be 8 Character");
			return false;
		}
	}
	
	function checkdegi()
	{
		if((event.keyCode > 47) && (event.keyCode < 58))
		{
			return true;
		}
		else
		{
			alert("Only Numeric Value Allowed");
			return false;
		}
	}
        </script>
        
        
        
        
        
        
        
        
        
        
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>