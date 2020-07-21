<?php
session_start();
if($_SESSION['userid'] == "")
{
	header("LOCATION:index.php");
}

include("header.php");
include("connection.php");
$id = $_SESSION['id'];

$query = "SELECT * FROM coreregistration WHERE id = '$id'";
$res = mysqli_query($con, $query);
$data = mysqli_fetch_array($res);
?>

<div class="container mt-5">
<h3 class="text-center" style="font-family:algerian; background-image:linear-gradient(#D0D4D4, #D0D1D4, #030C25); color:#0C090A;"> Edit Profile Picture</h3>
	<div class="row justify-content-center">
    	<div class="col-lg-6 border text-light text-center mb-5" style="background:#0066FF">
        	<div class="text-center">
            	<image src="uploadregis/<?php echo $data['path']; ?>" height="350px" width="350px" style="border-radius:50%;" /><br />
                
            </div>
            <form name="myform" method="post" action="#" enctype="multipart/form-data">
            	<div class="form-group">
                	<label>Select Profile Picture</label>
                    <input type="file" name="photo" class="form-control" />
                </div>
                <div class="form-group">
                	<input type="submit" name="submit" class="btn btn-primary" onclick="return validation()" />
                    <a href="profile.php" class="btn btn-info">Back</a>
                </div>
            </form>
            
        </div>
    </div>
</div>

<script>
	function validation()
	{
		if(document.myform.photo.value == "")
		{
			alert("Please Select Your Profile Picture");
			return false;
		}
	}
</script>
<?php
	if(isset($_POST['submit']))
	{
		$abc = "";
		$arjunfn = arjun($abc);
		$break = explode('@', $arjunfn);
		$path = $break[0];
		$filename = $break[2];
		
		$sql = "UPDATE coreregistration SET filename = '$filename', path = '$path' WHERE id = '$id'";
		if(mysqli_query($con, $sql))
		{
			echo "<script>alert('Successfully Update Your Profile Picture')</script>";
		}
		else
		{
			echo "<script>alert('Updation Faild..Try Again')</script>";
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

<?php
	include("footer.php");
?>