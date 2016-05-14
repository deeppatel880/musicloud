<?php 
include "../config/config.php";
session_start();
$id = $_SESSION['id'];
$username = $_SESSION['username'];

$query = mysqli_query($con, "SELECT songs_array FROM users WHERE id='$id'");
while($row = mysqli_fetch_assoc($query)){
	$song = $row['songs_array'];
	echo"<li><a href='users_songs/$username/$song'>$song</a></li>";
}


 ?>