<?php
session_start();
$error=NULL;
$name=$pass=$confirm_pass=$email=$mobile=$msg=$msg1=$id=$pass1=$query=$msg2="";
if(isset($_POST['signup'])){
$name=$_POST['name'];
$pass=$_POST['pass'];
$confirm_pass=$_POST['pass1'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];

if($name !='' && $pass !=''&& $confirm_pass !=''&& $email !=''){
	if(preg_match("/^\d{10}$/",$mobile)){
		if($pass==$confirm_pass){
			$_SESSION["user"]=$name;
			$mysqli=NEW MySQLi('localhost','id14078026_sai','root123','id14078026_mydb');
			$name = $mysqli->real_escape_string($name);
			$pass = $mysqli->real_escape_string($pass);
			$email = $mysqli->real_escape_string($email);
			$mobile = $mysqli->real_escape_string($mobile);

			$insert = $mysqli->query("INSERT INTO users (name, pass, email, mobile) 
			VALUES ('".$name."','".$pass."','".$email."','".$mobile."')");

			if($insert){
				header('location:http://localhost/googledocs/login.php');
			}else{
				echo $mysqli->error;
			}
		}
		else{
			$msg2="***password does not match***";
		}
	}
	else {
		$msg="***mobile number should contain 10digits***";
	}
}else{
	$msg="***please fill all fields***";
}
} 
?>

<html>
<head>
	<title>DOCS</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<style type="text/css">
	body{
		margin: 0;
		padding: 0;
		background: white;
		overflow-x: hidden;
		overflow-y: hidden;
		font-family: Calibri, sans-serif;
	}
	.nav{
			width: 100%;
			background : black;
			overflow: hidden;
			height: 100px;



		}
		ul{
			margin: 0;
			padding: 0;
			list-style: none;
			line-height: 60px;
		}
		li{
			float:left;
		}
		li>a{
			margin-top: 25px;
			background: black;
			color:white;
			text-decoration: none;
			width: 200px;
			display: block;
			text-align: center;
			font-size: 20px;
			font-family: sans-serif;
			letter-spacing: 0.5px;

		}
		li>a:hover{
			color: red;
			opacity: 0.5;
			font-size: 25px;
			font-weight: bold;
		}
		.search-box{
			position: absolute;
			top: 60px;
			left: 90%;
			transform: translate(-50%,-50%);
			background:white;
			height: 40px;
			border-radius: 40px;
			padding: 2px;
		}

		.search-box:hover>.search-btn{
			background: #fff;
		}
		.search-btn{
			color: #30968a;
			float: right;
			width: 40px;
			height: 40px;
			border-radius: 50%;
			margin-top: -40px;
			margin-left: 90%;
			background:#2f3640;
			display:flex;
			justify-content: center;
			align-items: center;
			text-decoration: none;
		}

		.search-txt{
			border: none;
			background:none;
			outline:none;
			float:left;
			padding:0;
			color:black;
			font-size: 16px:
			transition:0.4s;
			line-height: 40px; 
			width: 240px;
		}
	td,h1{
		color:black;
		font-weight: bold;
		font-size: 20px;
		font-family: Calibri, sans-serif;
	}
	h1{
		font-size: 35px;
		color: red;
		text-decoration: underline;
		font-weight: bold;
	}
	button{
		background: black;
		color: white;
		font-weight: bold;
		font-size: 20px;
		cursor: pointer;
	}
	button:hover{
		font-size: 25px;
	}
	input{
		background-color: #f1f1f1;
		color: black;
		font-family: Calibri, sans-serif;
		border-radius: 3%;
		font-weight: bold;
		border: 1px solid black;
		font-size: 20px;
	}
		.signup{
			margin-left: 150px;
			margin-top: 10px;
			width: 500px;
			float:left;
			position: relative;
		}
		span{
			color:red;
			font-weight: bold;
			font-size: 20px;
			background-color: black;
		}
		.in{
			text-align: center;
			font-weight: bold;
			font-size: 40px;
			color: white;
			background: black;
		}
		.hero{
			height: 100%;
			width: 100%;
			background-image: url(sky.jpg);
			background-position: center;
			position: relative;
			overflow-x: hidden;

		}
		.highway{
			height: 200px;
			width: 500%;
			display: block;
			background-image: url(road.jpg);
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			z-index: 1;
			background-repeat: repeat-x;
			animation: highway 5s linear infinite;
		}
		@keyframes highway{
			100%{
				transform: translateX(-3400px);
			}
		}
		.city{
			height: 250px;
			width: 500%;
			background-image: url(city.png);
			position: absolute;
			bottom: 200px;
			left: 0;
			right: 0;
			display: block;
			background-repeat: repeat-x;
			animation: city 20s linear infinite;
		}
		@keyframes city{
			100%{
				transform: translateX(-1400px);
			}
		}
		.car{
			width: 400px;
			left: 80%;
			bottom: 120px;
			transform: translateX(-50%);
			position: absolute;
			z-index: 2;
		}
		.car img{
			width: 100%;
			animation: car 1s linear infinite;
		}
		@keyframes car{
			100%{
				transform: translateY(-1px);
			}
			100%{
				transform: translateY(1px);
			}
			100%{
				transform: translateY(-1px);
			}
		}
		.wheel{
			left: 80%;
			bottom: 198px;
			transform: translateX(-50%);
			position: absolute;
			z-index: 2;
			
		}
		.wheel img{
			width: 72px;
			height: 72px;
			animation: wheel 1s linear infinite;
		}
		.back-wheel{
			left: -165px;
			position: absolute;
		}
		.front-wheel{
			left: 80px;
			position: absolute;
		}
		@keyframes wheel{
			100%{
				transform: rotate(360deg);
			}
		}
		.text{
			left: 65%;
			top: 70px;
			font-size: 40px;
			position: absolute;
			display: flex;
			width: 35%;
   			justify-content: center;
   			align-items: center;
   			font-family: 'Codystar';
   			background: black;
   			background-image: url('data:image/svg+xml,%3Csvg width="42" height="44" viewBox="0 0 42 44" xmlns="http://www.w3.org/2000/svg"%3E%3Cg id="Page-1" fill="none" fill-rule="evenodd"%3E%3Cg id="brick-wall" fill="%239C92AC" fill-opacity="0.4"%3E%3Cpath d="M0 0h42v44H0V0zm1 1h40v20H1V1zM0 23h20v20H0V23zm22 0h20v20H22V23z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
		}
		@import url('https://fonts.googleapis.com/css?family=Codystar:300&display=swap');
		.neons {
   			margin-top: 20px;
   			text-align: center;
		}

		.neons h1 {
  			font-size: 40px;
  			text-align: center;
   			font-weight: bold;
  			-webkit-animation: glow 2s ease-in-out infinite alternate;
  			-moz-animation: glow 2s ease-in-out infinite alternate;
  			animation: glow 2s ease-in-out infinite alternate;
		}

		@-webkit-keyframes glow {
     		from {
      			color: #fff;
    			text-shadow: 0 0 10px #00fff2, 0 0 20px #00fff2, 0 0 30px #00fff2, 0 0 40px #00fff2, 0 0 50px #00fff2, 0 0 60px #00fff2;
  				}
  
 			to {
     			color: red;
    			text-shadow: 0 0 20px #00fff2, 0 0 30px #00fff2, 0 0 40px #00fff2, 0 0 50px #00fff2, 0 0 60px #00fff2, 0 0 70px #00fff2;
  			}
		}

	</style>
</head>
<body >
	<a  name="home"></a>
	<nav class="nav">
		<ul>
			<li><a href="#home">Welcome to DOCS</a></li>
			<li><a href="#feedback">Feedback</a></li>
			<li><a href="#about">About</a></li>
			<li><a href="#contact">Contact</a></li>
			<li><a href="login.php" style="color: red;">SIGNIN</a></li>
		</ul>
		<div class="search-box">
		<input class="search-txt" type="text" name="" placeholder="search"/>
		<a class="search-btn" href="#">
		<i class="fas fa-search"></i></a>
	</div>
	</nav>
	<div>
				<div class="hero">
		<div class="highway"></div>
		<div class="city"></div>
		<div class="text">
		<div class="container">
   			<div class="row">
      			<div class="neons col-12">
         			<h1><em>-Never rush to share files-<br> just signup</em></h1>
      			</div>
   			</div>
		</div>
		</div>
		<div class="car"><img src="car.png"></div>
		<div class="wheel"><img src="wheel.png" class="back-wheel"><img src="wheel.png" class="front-wheel"></div>

	<form name="myform" autocomplete="on" action="" method="post">
		<div class="signup">
		<span><?php echo $msg;?></span>
		<h1 align="center">SIGN UP</h1>
		<table cellpadding="10px" cellspacing="10px">
		<tr><td>User_Name </td><td><input type="text" name="name"/><br/></td></tr>
		<tr><td>Password</td><td><input type="Password" name="pass"/></td></tr>
		<tr><td>Confirm Password</td><td><input type="password" name="pass1"/><br/><span><?php echo $msg2;?></span></td></tr>
		<tr><td>Email</td><td><input type="email" name="email"/></td></tr>
		<tr><td>Mobile</td><td><input type="text" name="mobile"/></td></tr>
		<tr><td colspan="2"><button name="signup">Signup</button></td></tr>
		</table>
		</div>	
		</div>	

		<?php echo $error ; ?>	
	</form>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<a  name="feedback"></a><br/>
	<form>
		<label style="color: black;font-size: 40px;font-weight: bold;">Feedback:</label><br/>
		<textarea style="width: 80%;height: 300px;color: white;font-size: 25px;" placeholder="Provide feedback...."></textarea><input type="submit" name="" value="provide" />
	</form>
	<a href="#home" style=" font-size: 25px;color: red;">Home</a>
		<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	
	<a  name="about"></a>
	<p style="font-size:30px;color: black;">- Docs is small and medium sized application <br> to share the files among users with a easy <br/> drag and drop features.<br/>- This is a presence server which also shows<br/>the active users. <br/>-By telling stories from a wide range of <br/>perspectives, we tell the larger story of who<br/> The Docs is and how The Docs core business <br/>practices contribute to a better India.</p>
	<img src="doc.png" style="float: right;height: 350px;width: 470px;margin-top: -350px;margin-right: 50px;opacity: 0.8">
	<a href="#top" style="font-size: 25px;color: red;">Home</a>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<a  name="contact"></a>
	<p class="in">
		<span style="color: red;">Contact number:</span> 7871030008<br/>
		<span style="color: red;">Email:</span>saismaran111@gmail.com</p>
		<p style="margin-bottom: 400px;"><a href="#home" style="font-size: 25px;color: red;margin-left: 650px;">Home</a></p>
</div>
</body>
</html>
