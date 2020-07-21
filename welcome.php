<?php
session_start();
	if($_SESSION['userid'] == "")
	{
		header("LOCATION:index.php");
	}
	//echo $_SESSION['image'];
?>

<?php
	include('header.php');
	include('connection.php');
?>

<div class="container mt-5 mb-5">
	<?php
    	$sql = "SELECT * FROM corearticle ORDER BY ID DESC";
		$res = mysqli_query($con, $sql);
		if(mysqli_num_rows($res)){
		while($data = mysqli_fetch_array($res)){
		
	?>
    <div class="row justify-content-center">
    	<div class="col-lg-6 border mb-2">
        	<p style="font-family:cursive;color:#FFFF99"><image src="uploadregis/<?php echo $data['pimage'] ?>" height="50px" width="50px" style="border-radius:50%;"><?php echo $data['articletitle']; ?></p>
            <div class="text-center">
            	<image src="upload/<?php echo $data['path'] ?>" height="300px" width="400px">
        	</div>
            <?php
            if($_SESSION['id'] == $data['pid'])
            {
            ?>
            	<p class="float-left"><a href="delete.php?id=<?php echo $data['id']; ?>" onclick="return delcon();">Delete</a>||<a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a></p>
            <?php
            }
			?>
            <p class="float-right"><em>Published On:</em> <?php echo date('d-M-Y', strtotime($data['tdate'])); ?> </p>
        </div>
    </div>
    
	<?php
		}
		}
		else
		{
			echo "No Record Found.";
		}
	?>
</div>

<script>
	function delcon()
	{
		var a = confirm("Are You Sure You Want To Delete");
		if(a == true)
		{
			return true;
		}
		else
		{
			return false;
		} 
	}
</script>


<?php
	include('footer.php');
?>



