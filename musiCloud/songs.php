<?php 
include "config/config.php";
session_start();
$id = $_SESSION['id'];
$username = $_SESSION['username'];		
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
 		<p><i class="fa fa-bars" aria-hidden="true" style="transform:rotate(90deg);margin-top:10px;"></i></p>
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
 <span id="info-icon"><a href="#" title="This player is draggable and could be placed anywhere. Use initial letters for having control anywhere on page(e.g press 'n' for next track in your list) with the exception of pause and play."><img src="info.png"></a></span>
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
 <button id="cloud-upload"><i class="fa fa-cloud-upload fa-4x" aria-hidden="true"></i></button>
 <br><br>
 <div id="upload-body">
 </div>
 <div id="upload-panel">
 <img src="close.png" class="fa-times" height="17.5px;">
 <form action="" method="post" enctype="multipart/form-data">
 <br><br>
 <div id="drop_box"><br><br><br><img src="file.png" height="100px"><br>Drag and drop songs of<br> your choice</div><br>
 <div id="status"></div>
 <input type="file" value="Upload music from computer" id="file" name="file"></input>
 <input type="submit" id="submit" name="submit" ></input>
 </form>
 </div>
 <div id="data"></div>
 <audio src="" id="audioPlayer"></audio>
 <ul id="playlist">
 </ul>
 </div>
 <script type="text/javascript" src="js/main.js"></script><script type="text/javascript">
    $("#playlist").load("update/mysongs.php");
        audioPlayer();
 </script>
 <?php
 if(isset($_POST['submit'])){
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];
        $temp = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];
        if (strpos($name, ',') == true) {
            echo "Please change the name of the song it shouldn't contain any special characters like comma(,), pipes(|),.....";
        }else{
        if($type == "audio/mp3" || $type == "audio/wav" || $type == "audio/wmv" || $type == "audio/avi" || $type == "audio/ogg"){
                
                $query =  mysqli_query($con,"SELECT songs_array FROM users WHERE id='$id'");
                $fetch_row = mysqli_fetch_assoc($query);
                if($fetch_row['songs_array'] == ""){
                         mysqli_query($con,"UPDATE users SET songs_array=CONCAT(songs_array,'$name') WHERE id='$id'");

                }else{
                         mysqli_query($con,"UPDATE users SET songs_array=CONCAT(songs_array,',$name') WHERE id='$id'");
                }
                if(!file_exists('users_songs')){
                        mkdir('users_songs');
                }else{
                        if(!file_exists('users_songs/' . $username)){
                                mkdir('users_songs/'.$username);
                        }
                }
                move_uploaded_file($temp, 'users_songs/'.$username.'/'.$name);



        }else{
                echo "The file you are trying to upload is not supported";
        }
    }
  }
  ?>
 </body>
 </html>