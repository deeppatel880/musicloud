<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>musiCloud - Log In or Sign Up</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type = "text/javascript"
         src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<meta charset="utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
    <!-- This is a wide open CSP declaration. To lock this down for production, see below. -->
    <meta http-equiv="Content-Security-Policy" content="default-src * 'unsafe-inline'; style-src 'self' 'unsafe-inline'; media-src *" />	
      <script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
         <script type="text/javascript" src="cordova.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
      <script type="text/javascript">
      	$(document).ready(function(){
      		var login_class = $("#login").attr('class');
      		var signup_class = $("#signup").attr('class');
      		function remove(){
      			$("#login").css("display","none");
      			$('#data').html('');
      			$('#signup').show().toggleClass('animated fadeInRight');
      		}

      		function getback(){
      			$("#signup").css("display","none");
      			$('#result').html('');
      			$("#login").css("display","block");
      			$('#login').toggleClass('animated fadeInLeft');
      		}
      		$('#signup').hide();
      		$("#login").toggleClass('animated flipInX');
      		$('#submit').click(function(){
      			$('#login').removeClass();
      			var username = $('#username').val();
      			var password = $('#password').val();
      			$.post("verify/checklogin.php",{username:username,password:password},function(data){
      				$("#data").html(data + "<br>");

      				if (data == "<div id='fail'>Please provide login information</div>" || data == "<div id='fail'>Invalid username or password</div>") {
      					$("#login").addClass('animated jello');
      				}else{
      					location.reload();
      				}	

      			});
      			return false;
      		});
      		$('#submit1').click(function(){
      			$("#signup").removeClass();
      			
      			var firstname = $("#firstname").val();
      			var lastname  = $("#lastname").val();
      			var susername = $("#susername").val();
      			var email = $("#email").val();
      			var spassword = $("#spassword").val();
      			var rpassword = $("#rpassword").val()
      			
      			$.post("verify/checksignup.php",{firstname:firstname,lastname:lastname,susername:susername,email:email,spassword:spassword,rpassword:rpassword},function(data){
      				$("#result").html(data + "<br>");

      				if(data == "<div id='success'>Your account has been successfully created</div>"){
      					location.reload(true);
      				}else{
      					$("#signup").addClass("animated jello");
      				}
      			})






      			return false;
      		});

      		$("#sign").click(function(){
      				$('#login').removeClass();
      				$('#signup').removeClass();
      				$('#login').addClass('animated fadeOutLeft');
      				setTimeout(remove, 500);
      			
      			
      		});
      		$("#log").click(function(){
      			$('#login').removeClass();
      			$('#signup').removeClass();
      			$('#signup').addClass('animated fadeOutRight');
      			setTimeout(getback, 500);
      		});
      	});
      </script>   
</head>
<body>
<?php if(isset($_SESSION['username'])){ ?>
<?php header("location: songs.php");?>
<?php } else{?>
<div id="logo">
	<p>musiCloud</p>
</div>
<div id="nav">
	<button id="sign">Sign Up</button>
	<button id="log">Log In</button>
</div><br><br><br><br><br><br><br><br><br><br><br>
<div id="login">
	<h4>Log In</h4>
	<div id="data"></div>
	<form action="" method="post">
		<input type="text" name="username" id="username" placeholder="Enter your username"></input><br><br>
		<input type="password" name="password" id="password" placeholder="Enter your password"></input><br><br>
		<button name="login" id="submit"><span>Log In</span></button>
	</form>
</div>
<div id="signup">
	<form action="" method="post">
	<h4>Sign Up</h4>
	<div id="result"></div>
		<input type="text" name="firstname" id="firstname" placeholder="Firstname"></input><br><br>
		<input type="text" name="lastname" id="lastname" placeholder="Lastname"></input><br><br>
		<input type="text" name="susername" id="susername" placeholder="Username"></input><br><br>
		<input type="email" name="email" id="email" placeholder="Email"></input><br><br>
		<input type="password" name="spassword" id="spassword" placeholder="New Password"></input><br><br>
		<input type="password" name="rpassword" id="rpassword" placeholder="Re-enter Password"></input><br><br>
		<button name="signup" id="submit1"><span>Sign Up</span></button>
	</form>
</div>	
</body>
<?php } ?>
</html>