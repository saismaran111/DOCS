<?php
session_start();
$img='avatar.jpg';
$mysqli=NEW MySQLi('localhost','id14078026_sai','root123','id14078026_mydb');
$mail=$_SESSION["email"];
$users = $mysqli->query("SELECT * FROM users ORDER by current_times DESC");
$activeusers = $mysqli->query("SELECT * FROM users WHERE current_times >= NOW() - INTERVAL 10 MINUTE");
$activeusershour = $mysqli->query("SELECT * FROM users WHERE current_times >= NOW() - INTERVAL 1 HOUR");
$activeusersday = $mysqli->query("SELECT * FROM users WHERE current_times >= NOW() - INTERVAL 1 DAY");
$myfiles = $mysqli->query("SELECT * FROM users_files WHERE email = '$mail'");

$status=$statusMsg="success";
if(isset($_POST["share"])){
	$status="error";
	$to = $_POST["toname"];
	$from = $_SESSION["email"];
	if(!empty($_FILES["fileToUpload"]["name"])) { 
		$check = $mysqli->query("SELECT * FROM users WHERE email = '$to'");
		if($check->num_rows == 1){
        $fileName = basename($_FILES["fileToUpload"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif','txt','JPG','PNG','JPEG'); 
        if(in_array($fileType, $allowTypes)){ 
            $file = $_FILES['fileToUpload']['name']; 
            $imgContent = addslashes(file_get_contents($file)); 
         	$name = $to;
       	$insert = $mysqli->query("INSERT into users_files (email, file_name, fromuser) VALUES ('".$name."','".$imgContent."','".$from."')");
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        	}
        	else{
        		$statusMsg = 'file format should be png or jpg or txt';
        	}
    		}else{
    			$statusMsg = 'Email_Id doesnot exist';
    		}
		}else{ 
        	$statusMsg = 'Please select an image file to upload.'; 
   		} 
	} 

?>
<!DOCTYPE html>
<html>
<head>
	<title>DOCS</title>
	<style type="text/css">
		body{
			margin: 0;
			padding: 0;
			background: #30968a;
			overflow-x: hidden;
		}
		table, th, td {
  			border: 1px solid black;
  			border-collapse: collapse;
  			align-content: center;
  			margin-left: 400px;
  			margin-top: 20px;
		}
		select{
			margin-left: 100px;
			margin-top: 40px;
		}
		td,h1{
			color:white;
			font-weight: bold;
			font-size: 20px;
		}
		h1{
			font-size: 35px;
			color: red;
			text-decoration: underline;
			font-weight: bold;
		}
		button{
			color: black;
			font-weight: bold;
			font-size: 10px;
			cursor: pointer;
		}
		button:hover{
			font-size: 12px;
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
			width: 130px;
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
		select{
			margin-left: 350px;
			margin-top: 45px;
  			position: absolute;
  			border: 1px solid grey;
  			border-radius: 6px;
  			color: black;
		}
		#but{
			margin-left: 480px;
			margin-top: 47px;
  			border: 1px solid grey;
  			border-radius: 6px;
  			color: black;
		}
		#share-buttons img {
			width: 35px;
			padding: 2px;
			position: absolute;
			margin-left: 620px;
			margin-top: -27px;
		}
		.avatar {
  			margin-left: 700px;
  			margin-top: -35px;
  			position: absolute;
  			width: 50px;
  			height: 50px;
 			border-radius: 50%;
		}
		.inside{
			width: 40px;
			height: 40px;
			border-radius: 80%;
		}
		.image{
			width: 100%;
			height: 100%;
			background-color: rgba(0,0,0,0.7);
			position: absolute;
			top: 0px;
			display: none;
			justify-content: center;
			align-items: center;

		}
		.content{
			width: 350px;
			height: 200px;
			background-color: white;
			border-radius: 70%;
			text-align: center;
			padding: 10px;
			position: relative;
			line-height: 1px;

		}
		.popimage{
			height: 50px;
			height: 50px;
			text-align: center;
			border-radius: 50%;
		}
		.close{
			position: absolute;
			top: 30px;
			right: 80px;
			font-size: 42px;
			color: #333;
			transform: rotate(45deg);
			cursor: pointer;
			font-size: 30px;
		}
		.close:hover{
			color: red;
			font-weight: bold;
			font-size: 45px;
		}
		.input {
			display: block;
			width: 100%;
			padding: 8px;
		}
		.file{
			width: 100%;
			height: 100%;
			background-color: rgba(0,0,0,0.7);
			position: absolute;
			top: 0px;
			display: none;
			justify-content: center;
			align-items: center;

		}
		.filecontent{
			width: 400px;
			height: 150px;
			background-color: white;
			border-radius: 4px;
			text-align: left;
			padding: 25px;
			position: relative;
			line-height: 1px;

		}
		.fileclose{
			position: absolute;
			top: 30px;
			right: 40px;
			font-size: 42px;
			color: #333;
			transform: rotate(45deg);
			cursor: pointer;
			font-size: 30px;
		}
		.fileclose:hover{
			color: red;
			font-weight: bold;
			font-size: 45px;
		}
		.msg a{
			font-weight: bold;
			font-size: 40px;
			text-decoration: none;
			color: black;
			text-align: center;

		}
		.in{
			text-align: center;
			font-weight: bold;
			font-size: 40px;
			color: white;
			background: black;
		}

	</style>
</head>
<body>
	<a class="top"></a>
	<form name="myform" action="" method="post">
		<nav class="nav">
		<ul>
			<li><a href="#myfiles">MyFiles</a></li>
			<li><a href="#feedback">Feedback</a></li>
			<li><a href="#about">About</a></li>
			<li><a href="#contact">Contact</a></li>			
			<li><a href="login.php" style="color: red;text-decoration: underline;">Logout</a></li>
		</ul>
		<div name="time1">
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<select name="time">
  			<option value="none">All Users</option>
    		<option value="active">Active</option>
    		<option value="hour">Active last 1 hour</option>
    		<option value="day">Active last 1 day</option>
  		</select>&nbsp<button name="active" id="but">SHOW</button></li></div>
		<div id="share-buttons">
  		<a href="#" id="filebutton" class="filebutton"><img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
    	</a></div>

  		
  		
  		

	<div class="ava">
	<a href="#" id="button" class="button">
        <img src="avatar.jpg" alt="image" class="avatar" />
    	</a>
  	</div>
  </nav>
</form>
  	<div class="image">
		<div class="content">
			<div class="close">+</div>
			<div class="input">	
				<img src="avatar.jpg" class="popimage"><br/>
			<p>User Name: <span><?php echo $_SESSION["name"];?></span></p><br/>
			<p>Mobile Number: <span><?php echo $_SESSION["mobile"];?></span></p><br/>
			<p>Email Id: <span><?php echo $_SESSION["email"];?></span></p><br/></div>
		</div>
	</div>
	<div class="file">
		<div class="filecontent">
			<div class="fileclose">+</div>
			<div class="input">	
		<form action="" method="post" enctype="multipart/form-data">
			<label>To: </label> &nbsp&nbsp<input type="text" name="toname" placeholder="email..." /><br/><br/><br/><br/><br/><br/>
			<label>File: </label><input type="file" name="fileToUpload" id="fileToUpload"><br/><br/><br/><br/><br/><br/>
			<br/><button name="share" onclick="alert('<?php echo $statusMsg ?>')">Share</button><br/>
			
		</form>
		</div>		
		</div>
	</div>
	<table cellspacing="50px" cellpadding="10px">
		<tr><th></th><th>User_Name</th><th>Last_Active</th><th>Recent_Active</th></tr>
		<?php
			if(isset($_POST['active'])){
				$select = $_POST['time'];

				if($select == "active"){
				while($row = $activeusers->fetch_assoc()){
					$name=$row['name'];
					$mobile=$row['mobile'];
					$email=$row['email'];
					$last_active=$row['last_active'];
					$current_times=$row['current_times'];
            		echo "<tr>";
            		echo "<td>";
            		
            		echo "<a href='#' id='button' class='button'><img src='$img' class='inside'/></a>";
            		
            		echo "</td>";
	    	        echo "<td>".$name."</td>";
    		        echo "<td>".$last_active."</td>";
	        	    echo "<td>".$current_times."</td>";
            		echo "</tr>";

        		}
        		}
        		else if($select == "none"){
        			while($row = $users->fetch_assoc()){
					$name=$row['name'];
					$msg="Not_Active";
					$last_active=$row['last_active'];
					$current_times=$row['current_times'];
            		echo "<tr>";
            		echo "<td>";
            		echo "<a href='#' id='button' class='button'><img src='$img' class='inside'/></a>";
            		echo "</td>";
	    	        echo "<td>".$name."</td>";
    		        echo "<td>".$last_active."</td>";
	        	    echo "<td>".$current_times."</td>";
            		echo "</tr>";
        		}
        		}
        		else if($select == "hour"){
        			while($row = $activeusershour->fetch_assoc()){
					$name=$row['name'];
					$msg="Active";
					$last_active=$row['last_active'];
					$current_times=$row['current_times'];
            		echo "<tr>";
            		echo "<td>";
            		echo "<a href='#' id='button' class='button'><img src='$img' class='inside'/></a>";
            		echo "</td>";
	    	        echo "<td>".$name."</td>";
    		        echo "<td>".$last_active."</td>";
	        	    echo "<td>".$current_times."</td>";
            		echo "</tr>";
        		}
        		}
        		else if($select == "day"){
        			while($row = $activeusersday->fetch_assoc()){
					$name=$row['name'];
					$msg="Active";
					$last_active=$row['last_active'];
					$current_times=$row['current_times'];
            		echo "<tr>";
            		echo "<td>";
            		echo "<a href='#' id='button' class='button'><img src='$img' class='inside'/></a>";
            		echo "</td>";
	    	        echo "<td>".$name."</td>";
    		        echo "<td>".$last_active."</td>";
	        	    echo "<td>".$current_times."</td>";
            		echo "</tr>";
        		}
        		}

			}
			else {
				while($row = $users->fetch_assoc()){
					$name=$row['name'];
					$msg="Not_Active";
					$last_active=$row['last_active'];
					$current_times=$row['current_times'];
            		echo "<tr>";
            		echo "<td>";
            		echo "<a href='#' id='button' class='button'><img src='$img' class='inside'/></a>";
            		echo "</td>";
	    	        echo "<td>".$name."</td>";
    		        echo "<td>".$last_active."</td>";
	        	    echo "<td>".$current_times."</td>";
            		echo "</tr>";
        		}
        	}
		?>
	</table>

<script type="text/javascript">
 	document.getElementById('button').addEventListener("click", function() {document.querySelector('.image').style.display = "flex";});
	document.querySelector('.close').addEventListener("click", function() {	document.querySelector('.image').style.display = "none";});
	document.getElementById('filebutton').addEventListener("click", function() {document.querySelector('.file').style.display = "flex";});
	document.querySelector('.fileclose').addEventListener("click", function() {	document.querySelector('.file').style.display = "none";});
 </script>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<a name="myfiles">	
		<?php 
		if($myfiles->num_rows >= 1){
		echo "<table>";
		echo "<tr><th>Files</th><th>Received From</th><th>Sent On</th></tr>";
			while($row = $myfiles->fetch_assoc()){
				$user=$row['fromuser'];
				$date = $row['uploaded_on'];
				echo "<tr>";
				echo "<td>";
				echo '<img src="data:image/jpeg;base64,'.base64_encode($row['file_name'] ).'" height="100" width="100"/>';
				echo "</td>";
				echo "<td>".$user."</td>";
				echo "</td>";
				echo "<td>".$date."</td>";
				echo "</tr>";
			}
		}else{
			?>
			<div class="msg">
				<a href="#top" class="msg">
			<?php
			echo "<p>No Files has been Received.</p>";
		}
		?></a>
		<br><br><a href="#top" style=" font-size: 25px;color: red;margin-left: 650px;">Home</a>
	</div>
	</table>	
</a>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<a  name="feedback"></a><br/>
	<form>
		<label style="color: white;font-size: 40px;font-weight: bold;">Feedback:</label><br/>
		<textarea style="background: transparent;width: 80%;height: 300px;color: white;font-size: 25px;" placeholder="Provide feedback...."></textarea><input type="submit" name="" value="provide" />
	</form>
	<a href="#top" style=" font-size: 25px;color: red;">Home</a>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	
	<a  name="about"></a>
	<p style="font-size:30px;color: white;">- Docs is small and medium sized application <br> to share the files among users with a easy <br/> drag and drop features.<br/>- This is a presence server which also shows<br/>the active users. <br/>-By telling stories from a wide range of <br/>perspectives, we tell the larger story of who<br/> The Docs is and how The Docs core business <br/>practices contribute to a better India.</p>
	<img src="doc.png" style="float: right;height: 350px;width: 470px;margin-top: -350px;margin-right: 50px;opacity: 0.8">
	<a href="#top" style="font-size: 25px;color: red;">Home</a>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<a  name="contact"></a>
	<p class="in">
		<span style="color: red;">Contact number:</span> 7871030008<br/>
		<span style="color: red;">Email:</span>saismaran111@gmail.com</p>
		<p style="margin-bottom: 400px;"><a href="#top" style="font-size: 25px;color: red;margin-left: 650px;">Home</a></p>


</body>
</html>