<?php session_start(); ?>
<?php include('dbcon.php'); ?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">
<title> Signup Page </title>

</head>

<body>
<div class="form-wrapper">
  
  <form action="#" method="post">
    <h3>Register here</h3>
	
    <div class="form-item">
		<input type="text" name="name" required="required" placeholder="Name" autofocus required></input>
    </div>
    
    <div class="form-item">
		<input type="text" name="user" required="required" placeholder="Username" required></input>
    </div>

    <div class="form-item">
		<input type="password" name="pass" required="required" placeholder="Password" required></input>
    </div>
    
    <div class="button-panel">
		<input type="submit" class="button" title="Register" name="register" value="Register"></input>
    </div>
  </form>
  <?php
	if (isset($_POST['register']))
    {

    $name = $_REQUEST["name"];
    $username = $_REQUEST["user"];
    $password = $_REQUEST["pass"];

    $sql = "INSERT INTO users (username, password, name) VALUES ('$username', '$password', '$name')";

    if(mysqli_query($con, $sql)){

        header("Location: home.php");
        
    } else{
        echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($con);
    }
    
    mysqli_close($con);
    }
  ?>
  <div class="reminder">
    <p>Already a member? <a href="index.php">Login now</a></p>
  </div>
  
</div>

</body>
</html>