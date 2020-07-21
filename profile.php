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
<h3 class="text-center" style="font-family:algerian; background-image:linear-gradient(#D0D4D4, #D0D1D4, #030C25); color:#0C090A;">Our Profile</h3>
	<div class="row justify-content-center">
    	<div class="col-lg-6 border text-light text-center mb-5" style="background:#0066FF">
        	<div class="text-center">
            	<image src="uploadregis/<?php echo $data['path']; ?>" height="350px" width="350px" style="border-radius:50%;" /><br />
                <a class="btn btn-secondary" href="editprofile.php"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile Picture</a>
            </div>
            <p><strong>Name: </strong><?php echo $data['fname'] . "&nbsp;" . $data['lname']; ?></p>
            <p><strong>Father Name: </strong><?php echo $data['fathername']; ?> <strong>Mother Name: </strong><?php echo $data['mothername']; ?></p>
            <p><strong>Username Or Mobile No.: </strong><?php echo $data['mobile'] ?></p>
            <p><strong>Password: </strong><?php echo $data['password'] ?> <a href="cpassword.php" style="color:white;">Change_Password</a></p>
            <p><strong>Date Of Birth: </strong><?php echo date('d-M-Y', strtotime($data['dob'])) ?></p>
        </div>
    </div>
</div>




<?php
	include("footer.php");
?>