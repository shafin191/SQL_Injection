<html>
	<head>
		<title> SQL Injection </title> 
	</head>
	<body>
		
		
		<?php
		
		$name = "";
		$pass ="";
		$error="";
		
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "userInfo";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  $name = $_POST["name"];
		  $pass = $_POST["pass"];
		  
		}
	

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		//echo "Connected successfully";
		
		
		
		
		
		
		
		// Bind Parameter
		
		$stmt = $conn->prepare("SELECT userid, userName,userPassword FROM userTable where userName= ? and userPassword = ?");
		
		$stmt->bind_param("ss", $name, $pass); // 's' specifies the variable type => 'string'
		//$stmt->bind_param('s', $pass);
		

		$stmt->execute();
	
	
		$result = $stmt->get_result();
		if ($row = $result->fetch_assoc()) {
		    
			session_start();
 		    $_SESSION['user'] = $name;
		   
            header("location: verification.php");
		}
		else
		{
				$error = "Usename or Password is incorrect";

		}
		
		
		
		//SQL Injection
		/*
		
		$sql = "SELECT userid, userName,userPassword FROM userTable where userName= '$name' AND userPassword= '$pass'";		
		
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);	
		
		
		$active = $row['active'];
		
		
		
        $count = mysqli_num_rows($result);
          
		
        if($count >= 1) {
      
		   session_start();

		   $_SESSION['user'] = $name;
         
           header("location: verification.php");
        }
		
		else
		{
			if ($name)
			{
				$error = "Usename or Password is incorrect";
			}
		}
		*/
		$conn->close();
		
		?>
		
		<h1 style="margin-left:30px; margin-top:30px"> This is a demo SQL Injection Project </h1>
		
		<form action="" method="post" style="margin-left:30px">
		Username: <input type="text" name="name"><br><br>
		Password: <input type="text" name="pass"><br><br>
		<input type="submit">
		</form>
		
		<div style = "font-size:20px; color:#cc0000; margin-top:10px;margin-left:30px;"><br><?php echo $error; ?></div>
		
		
		
	</body>
</html>