<?php 
include "../config/config.php"; 
session_start();
?>
<?php 
if(!empty($_POST['username']) && !empty($_POST['password'])){
	$username = $_POST['username'];
	$password =$_POST['password'];
	$hash_pass = sha1(md5($password));
	$query = mysqli_query($con,"SELECT * FROM users WHERE username='$username' && password='$hash_pass'");
	$query_num = mysqli_num_rows($query);
	$query_fetch = mysqli_fetch_assoc($query);
	if ($query_num == 1) {
		$_SESSION['username'] = $username;
		$_SESSION['id'] = $query_fetch['id'];
	} else {
		echo "<div id='fail'>Invalid username or password</div>";
		}
	
}else{
	echo "<div id='fail'>Please provide login information</div>";
}




 ?>