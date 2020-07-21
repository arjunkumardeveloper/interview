<?php
	session_start();
	include("connection.php");
	include("header.php");
	$id = $_GET['id'];
	
	$query = "SELECT * FROM corearticle WHERE id = '$id'";
	$res = mysqli_query($con, $query);
	$data = mysqli_fetch_array($res);
?>

<div class="container mt-5">
<h3 class="text-center" style="font-family:algerian; background-image:linear-gradient(#D0D4D4, #D0D1D4, #030C25); color:#0C090A;">Update Article</h3>
	<div class="row justify-content-center">
    
    	<div class="col-lg-6 border mb-5 rounded" style="background:white;">
        	<form action="#" method="post" enctype="multipart/form-data">
            	<div class="form-group">
                	<div class="label">Article Title</div>
                	<textarea value="" name="articletitle" rows="10" cols="60"><?php echo $data['articletitle'] ?></textarea>
                </div>
                <div class="form-group">
                	<div class="label">Article Image</div>
                    <image src="upload/<?php echo $data['path'] ?>" height="200px" width="150px" />
                	<input type="file" name="photo" />
                </div>
                <div class="form-group text-center">
                	<input type="submit" value="Update" class="btn btn-primary" name="articleupdate" />
                    <a href="welcome.php" class="btn btn-info">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
	if(isset($_POST['articleupdate']))
	{
		$articletitle = $_POST['articletitle'];
		$abc = "";
		$arjunfn = arjun($abc);
		$break = explode('@', $arjunfn);
		$path = $break[0];
		$filename = $break[2];
		
		if($filename == "")
		{
			$sql = "UPDATE corearticle SET articletitle = '$articletitle' WHERE id = '$id'";
			if(mysqli_query($con, $sql))
			{
				echo "<script>alert('Successfully Update');</script>";
				header("LOCATION:welcome.php");
			}
			else
			{
				echo "<script>alert('Updation Faild...');</script>";
			}
		}
		else
		{
			$sql = "UPDATE corearticle SET articletitle = '$articletitle', filename = '$filename', path = '$path' WHERE id= '$id'";
			if(mysqli_query($con, $sql))
			{
				echo "<script>alert('Successfully Update');</script>";
				header("LOCATION:welcome.php");
			}
			else
			{
				echo "<script>alert('Updation Faild...');</script>";
			}
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



<?php
	include("footer.php");
?>