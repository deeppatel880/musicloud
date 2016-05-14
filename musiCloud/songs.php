<?php 
include "config/config.php";
session_start();
$id = $_SESSION['id'];
$username = $_SESSION['username'];	
if(isset($_FILES['file'])){
	$name = $_FILES['file']['name'];
	$type = $_FILES['file']['type'];
	$size = $_FILES['file']['size'];
	$temp = $_FILES['file']['tmp_name'];
	$error = $_FILES['file']['error'];

        if($type == "audio/mp3" || $type == "audio/ogg" || $type == "audio/wma" || $type == "audio/wav"){
        	if(!file_exists("users_songs")){
        		mkdir("users_songs");
        	}else{
        		if(!file_exists("users_songs/".$username)){
        			mkdir("users_songs/" .$username);
        		}else{	
        			move_uploaded_file($temp, "users_songs/" .$username."/".$name);
        			mysqli_query($con,"INSERT INTO users(songs_array) VALUES() WHERE id='$id'");
        		}
        	}
        }
	}
	
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>My songs - <?php echo $username; ?></title>
 	<link rel="stylesheet" type="text/css" href="css/animate.css">
 	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
 	<link rel="stylesheet" type="text/css" href="css/songs.css">
 	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/cupertino/jquery-ui.css">
 	<script type="text/javascript" src="js/main.js"></script>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
 	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
 </head>
 <body>
 <div id="menu">
 	<div id="title">
 		<p>+</p>
	</div>
	<div id="links">
	<li><a href="profile.php">Profile</a></li>
	<br><br>
 	<li><a href="Settings.php">Settings</a></li>
 	<br><br>
 	<li><a href="logout.php">Logout</a></li>
 	</div>
 </div>
 <div id="entire-audio-player">
 <span id="info-icon"><a href="#" title="This player is draggable and could be placed anywhere"><img src="info.png"></a></span>
 	<div id="info">
 		<span id="song"></span>
 	</div><br>
 	<input type="range" id="vol" min="0" max="10" value="10" step="0.2"></input><br>
 	<div id="controls">
 		<button id="previous"><i class="fa fa-backward fa-3x" aria-hidden="true"></i></button>
 		<button id="play"><i class="fa fa-play fa-3x" aria-hidden="true"></i></button>
 		<button id="pause"><i class="fa fa-pause fa-3x" aria-hidden="true"></i></button>
 		<button id="next"><i class="fa fa-forward fa-3x" aria-hidden="true"></i></button><br><br><br><br><br>
 		<button id="forward"><img src="forward.png"></button>
 		<button id="backwards"><img src="backwards.png"></button>
 	</div><br>
 	<div id="tracker">
 		<div id="progress">
 		<div id="defaultbar">
 			<div id="progressbar"></div>
 		</div>
 		</div>
 		<div id="duration">0:00</div>
 	</div>
 </div>
 <br><br>
 <form action="" enctype="multipart/form-data" method="post">
 <input type="file" value="Upload music from computer" id="upload" name="file"></input>
 <input type="submit" id="submit" name="submit"></input>
 </form>
 <audio src="" id="audioPlayer"></audio>
 <ul id="playlist">
 </ul>
 </div>
 <script type="text/javascript" src="js/main.js"></script><script type="text/javascript">
 	$("#playlist").load("update/mysongs.php");
 	$("#playlist li a").attr("href","users_songs/" + "<?php echo $username; ?>" + "/" + $("#playlist li a").text());
 	audioPlayer();
 </script>
 </body>
 </html>