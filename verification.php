<html>
<body>
	


<h3> Welcome <?php
 session_start();
 echo $_SESSION["user"]; 
 
 //echo $name;
 ?>
</h3>
 <br>
 
 <a href="logout.php">
 click here to log out</a>


</body>
</html>