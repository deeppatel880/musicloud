<?php 
include "../config/config.php";
session_start();
 ?>

 <?php 
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['susername'];
$email = $_POST['email'];
$password = $_POST['spassword'];
$rpassword = $_POST['rpassword'];


if(!empty($firstname) && !empty($lastname) && !empty($username) && !empty($email) && !empty($password) && !empty($rpassword)){
	if($password == $rpassword){

		$query = mysqli_query($con,"SELECT email FROM users WHERE email='$email' LIMIT 1");
		$query_n = mysqli_num_rows($query);

		if($query_n == 1){
			echo "<div id='fail'>Email is already taken</div>";
		}else{
			$query_user = mysqli_query($con,"SELECT username FROM users WHERE username='$username' LIMIT 1");
			$query_user_num = mysqli_num_rows($query_user);

			if($query_user_num == 1){
				echo "<div id='fail'>Username is already taken</div>";
			}else{
				
				if(strlen($password) > 8){
					$hash_pass =sha1(md5($password));
					$insert_user = mysqli_query($con,"INSERT INTO users(firstname,lastname,username,email,password) VALUES ('$firstname','$lastname','$username','$email','$hash_pass')");
					if($insert_user){
						echo "<div id='success'>Your account has been successfully created</div>";
						$_SESSION['username'] = $username;
						header("location: ./songs.php");
					}
				}else{
					echo "<div id='fail'>Passwords must be more than 8 characters</div>";
				}

			}
		}



	}else{
		echo "<div id='fail'>Passwords must match</div>";
	}



}else{
	echo "<div id='fail'>Please fill the form to Sign Up</div>";
}



  ?>