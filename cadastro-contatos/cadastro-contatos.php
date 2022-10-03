<?php 
include('dbcon.php');
?>

<!DOCTYPE html>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<title> Cadastrar Contato </title>

</head>

<body class="body">

<h2 class="titulo"> Cadastro de contatos
	<a href="index.php"> 
        <button type="button" class="btn btn-primary logout" data-bs-toggle="button" title="Register" name="register" value="Registrar">Logout</button> 
    </a>
</h2>

<table class="tableMenu">
    <tr class="menu">
        <th class="thMenu"><a href="home.php" class="linkMenu">Home</a></th>
        <th class="thMenu"><a href="cadastro-usuarios.php" class="linkMenu">Cadastrar Usuario</a></th>
        <th class="thMenu"><a href="cadastro-contatos.php" class="linkMenu">Cadastrar Contato</a></th>
        <th class="thMenu"><a href="exibir-contatos.php" class="linkMenu">Exibir Contatos</a></th>
        <th class="thMenu"><a href="misc.php" class="linkMenu">Outros</a></th>
    </tr>
</table>

<div class="form-wrapper-juros">
  
  	<form class="form" action="#" method="post">
    	<h3> Por favor, insira os dados para cadastro:</h3>
		
		<div class="form-item">
			Nome Completo: <input type="text" name="nome" required="required" placeholder="Nome completo" id="nome" autofocus required></input>
		</div>
		
		<div class="form-item">
			Idade: <input type="text" name="idade" required="required" placeholder="Idade" id="idade" required></input>
		</div>

		<div class="form-item">
			Telefone: <input type="text" name="tel" required="required" placeholder="(00) 00000-0000" id="tel" required></input>
		</div>
		
		<div class="button-panel">
			<button type="submit" class="btn btn-primary" data-bs-toggle="button" title="Register" name="register" value="Registrar">Registrar</button>
			&ensp;
			<a style="float: right;" href="exibir-contatos.php">
			<button type="button" class="btn btn-primary" data-bs-toggle="button" title="Register" name="register" value="Registrar">Exibir Registros</button>
			</a>
		</div>

	<?php
	if (isset($_POST['register']))
    {
		$nome = $_REQUEST["nome"];
		$anoNasc = date('Y') - intval($_REQUEST["idade"]);
		$telefone =  preg_replace('/\(|\)|-|\ /', '', $_REQUEST["tel"]);
		$dataCadastro = date('Y-m-d');

		$sql = "INSERT INTO contatosgistros (data_cadastro, nome, anoNasc, telefone) VALUES ('$dataCadastro','$nome', '$anoNasc', '$telefone')";

		$con->query($sql);
		
		if ($con){
			echo("<h5 class='aviso certo'>Cadastro realizado com sucesso.</h4>");
		}else{
			echo("<h5 class='aviso erro'>Erro no cadastro. Tente novamente.</h4>");
		}
	}
  	?>
	</form>

<script type="text/javascript">
    $("#tel").mask("(00) 0 0000-0000");
</script>

</div>

<div class="rodape r1">
	<h5> ® Crystian Marques 2022. Todos os direitos reservados. </h5>
</div>
</body>
</html>