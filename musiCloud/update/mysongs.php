<?php 
include "../config/config.php";
session_start();
$id = $_SESSION['id'];
$username = $_SESSION['username'];

$query = mysqli_query($con, "SELECT songs_array FROM users WHERE id='$id'");
while($row = mysqli_fetch_assoc($query)){
	$song_array = $row['songs_array'];
	if ($song_array != "") {
			
	$song_explode = explode(',', $song_array);
	foreach ($song_explode as $key => $song){ 
	echo"<li><a href='users_songs/$username/$song'>$song</a><i class='fa fa-trash fa-lg' aria-hidden='true' style='float:right; top:10px;''></i></li>";
		}
	}	
}

 ?>
 <style type="text/css">
 #white-background{
 	display: none;
	transition-duration: 0.5s;
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0px;
    left: 0px;
    background-color: #fefefe;
    opacity: 0.7;
    z-index: 9999;
    transition-duration: 0.5s;
 }
 #dialog_box{
 	display: none;
    position: fixed;
    height: 150px;
    margin: 0 auto;
    width: 480px;
    z-index: 9999;
    border-radius: 10px;
    background-color: #eee;
 }

 #box{
 	margin-left: 30%;
 }

 #dialog_header{
 	margin: 0px;
    width: 96%;
    color: #FFF;
 	float: left;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
 	background-color:#2980b9;
 	padding: 10px;
 }

 #body{
    background-color: #FFF;
    padding-top: 20px;
    padding-bottom: 20px;
    padding-left: 10px;
    margin-top: 30px;
 }
 #buttons{
    margin-top: 10px;
    float: right;
    margin-right: 15px;
 }

input{
    border-style: none;
    padding: 5px;
}

#accept{
    background-color: #27ae60;
    color: #FFF;
    transition-duration: 0.5s;
    padding-right: 7px;
    padding-left: 7px;
}
 
#accept:hover{
    background-color: #FFF;
    color: #27ae60;
    transition-duration: 0.5s;
    padding-right: 7px;
    padding-left: 7px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}

#deny{
    background-color: #E3000E;
    color: #FFF;
    transition-duration: 0.5s;
    padding-right: 7px;
    padding-left: 7px;
}

#deny:hover{
    background-color: #FFF;
    color: #E3000E;
    transition-duration: 0.5s;
    padding-right: 7px;
    padding-left: 7px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}




 </style>
 <div id="data"></div>
 <div id="white-background"></div>
 <div id="box">
 <div id="dialog_box"> 	
 <div id="dialog_header">
 	Confirmation for trashing a song
 </div>
 <div id="body"></div>
 <div id="buttons">
 	<input type="submit" name="accept" id="accept" value="Yes, trash the song" style="margin-right:10px;">
    <input type="submit" name="deny" id="deny" value="No, don't">
 </div>
 </div>
 </div>
 <script type="text/javascript">
 	$(".fa-trash").click(function(){
 		var song_to_be_deleted = $(this).siblings().text();
 		 var whitebg = document.getElementById("white-background");
             var dlg = document.getElementById("dialog_box");
             $(whitebg).css("transition-duration","0.5s");
             whitebg.style.display = "block";
             dlg.style.display = "block";

            var winWidth = window.innerWidth;
            var winHeight = window.innerHeight;
                
            dlg.style.left = (winWidth/2) - 480/2 + "px";
            dlg.style.top = "150px";

            if(song_to_be_deleted.length > 34);
           document.getElementById("body").innerHTML = "Are you sure, you want to delete:<br>" + song_to_be_deleted.substring(0,35) + "...";
            
     
        $("#deny").click(function(){
            var whitebg = document.getElementById("white-background");
            var dlg = document.getElementById("dialog_box");
            whitebg.style.display = "none";
            dlg.style.display = "none";
            
           })

          $("#accept").click(function(){
            $.post("delete.php",{song_to_be_deleted:song_to_be_deleted},function(data){
                $("#data").html(data);
            });
            var whitebg = document.getElementById("white-background");
            var dlg = document.getElementById("dialog_box");
            whitebg.style.display = "none";
            dlg.style.display = "none";
            return false;
        }) 
 		
 	});
 </script>