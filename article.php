<?php
	session_start();
	if($_SESSION['userid'] == "")
	{
		header("LOCATION:index.php");
	}
	
	include('header.php');
	include('connection.php');
	
	
	
	if(isset($_POST['article']))
	{
		$articletitle = $_POST['articletitle'];
		$tdate = date('y-m-d');
		$pimage = $_SESSION['image'];
		$pid = $_SESSION['id'];
		$abc = "";
		$arjunfn = arjun($abc);
		$break = explode('@', $arjunfn);
		$path = $break[0];
		$filename = $break[2];
		
		
		$sql = "INSERT INTO corearticle (articletitle, tdate, filename, path, pimage, pid) VALUES ('$articletitle', '$tdate', '$filename', '$path', '$pimage', '$pid')";
		if(mysqli_query($con, $sql))
		{
			echo "<div class='alert alert-success'>Article Upload Successfull</div>";
			header("LOCATION:welcome.php");
		}
		else
		{
			echo "<divc class='alert alert-danger'>Article Upload Faild.. Try Again</div>";
			header("LOCATION:article.php");
		}
		
	}
	
	
	
	
	
	function arjun($arj){
		$words = explode('.', $_FILES["photo"]["name"]);
		$pfile = array_pop($words);
		$pfile1 = implode('', $words);
		
		if($_FILES["photo"]["error"] > 0){
				$arj = $_FILES["photo"]["error"]."<br />";
		}else{
			if(file_exists("upload/" . $_FILES['photo']['name'])){
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
				move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $filename);
				$far = "Upload Successfully";
				return $fullpath;
			}
		}
	}
?>

<div class="container mt-5">
<h3 class="text-center" style="font-family:algerian; background-image:linear-gradient(#D0D4D4, #D0D1D4, #030C25); color:#0C090A;">Add Article</h3>
	<div class="row justify-content-center">
    	<div class="col-lg-6 border mb-5" style="background:white;">
        	<form action="#" method="post" enctype="multipart/form-data" name="addform">
            	<div class="form-group">
                	<div class="label">Article Title</div>
                	<textarea placeholder="Enter Article Title" name="articletitle" rows="10" cols="60"></textarea>
                </div>
                <div class="form-group">
                	<div class="label">Article Image</div>
                	<input type="file" name="photo" />
                </div>
                <div class="form-group text-center">
                	<input type="submit" value="Submit" onclick="return articleadd()" class="btn btn-primary w-50" name="article" />
                </div>
            </form>
        </div>
    </div>
</div>

<script>
	function articleadd()
	{
		if(document.addform.articletitle.value == "")
		{
			alert("Article Title Must Be Field");
			return false;
		}
		else if(document.addform.photo.value == "")
		{
			alert("Article Image Must");
			return false;
		}
	}
</script>



<?php
	include("footer.php");
?>