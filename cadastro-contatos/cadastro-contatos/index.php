<?php 
include('dbcon.php');
?>

<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<title> Login </title>

</head>

<body class="body">
	<div class="form-wrapper-cadLogin">
	
		<form class="form" action="#" method="post">
			<h3>Realize o login para continuar</h3>
			
			<div class="form-item">
				<input type="text" name="user" required="required" placeholder="Username" autofocus required></input>
			</div>
			
			<div class="form-item">
				<input type="password" name="pass" required="required" placeholder="Password" required></input>
			</div>
			
			<div class="button-panel">
				<input type="submit" class="button" title="Log In" name="login" value="Login"></input>
			</div>
		</form>
		<?php
			if (isset($_POST['login']))
				{
					$username = $_POST['user'];
					$password = $_POST['pass'];
					
					$query = $con->query("SELECT * FROM usuarios WHERE  senha_usuario='$password' and username='$username'");
					$queryArray = $query->fetch(PDO::FETCH_ASSOC);
					
					//Verificando se o query e fecth funcionaram
					if ($query) {
						if ($queryArray != false){
							$user = $queryArray['username'];
							$pass = $queryArray['senha_usuario'];
							$id = $queryArray['id_usuario'];
							
							//Após definir valores, realiza uma verificação se os dados batem
							//Em seguida ocorre o login e muda de página

							if ($user == $username && $pass == $password){
								header ('location:home.php');
							}
							
						}
						else {
							echo 'Invalid Username and Password Combination';
						}
					}
					
				}
		?>
	
	</div>

	<div class="rodape r1">
	<h5> ® Crystian Marques 2022. Todos os direitos reservados. </h5>
</div>

</body>
</html>