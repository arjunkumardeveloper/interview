<?php
	include("connection.php");
	$id = $_GET['id'];
	
	$query = "DELETE FROM corearticle WHERE id = '$id'";
	if(mysqli_query($con, $query))
	{
		echo "<script>alert('Successfully Delete')</script>";
		header("LOCATION:welcome.php");
	}
	else
	{
		echo '<script>alert("Error..Try Again..")</script>';
		header("LOCATION:welcome.php");
	}
	
?>