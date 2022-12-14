<?php 

include('dbcon.php');
include('functions.php');
$id_usuario = intval($_GET["usuario"]);
$dados = "SELECT * FROM contatos WHERE id = '$id_usuario'";
$conn = $con->query($dados) or die($con->error);
$dados2 = $conn->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<title> Editar cadastro </title>


</head>

<body class="body">


<h2 class="titulo"> Edição de cadastro
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

<div class="form-wrapper-cadLogin">
  
  	<form class="form" action="#" method="post">
    	<h3> Insira os dados para editar cadastro:</h3>
		
		<div class="form-item">
			Nome Completo: <input type="text" name="nome" required="required" id="nome" value = "<?= $dados2["nome"]?>" autofocus required></input>
		</div>
		
		<div class="form-item">
			Idade: <input type="text" name="idade" required="required" id="idade" value="<?= date("Y") - $dados2["anoNasc"]?>" required ></input>
		</div>

		<div class="form-item">
			Telefone: <input type="text" name="tel" required="required" id="tel" value = "<?= mask(strval($dados2["telefone"]), "(##) #####-####")?>" required></input>
		</div>
		
		<div class="button-panel">
			<button type="submit" class="btn btn-primary" data-bs-toggle="button" title="Save" name="save" value="Save">Salvar</button>
			<a href="exibir-contatos.php">
			<button type="button" class="btn btn-primary" data-bs-toggle="button" title="Register" name="register" value="Registrar">Exibir Registros</button>
			</a>
		</div>

    
	<?php
	if (isset($_POST['save']))
    {
		$nome = $_REQUEST["nome"];
		$anoNasc = date('Y') - intval($_REQUEST["idade"]);
		$telefone = preg_replace('/\(|\)|-|\ /', '', $_REQUEST["tel"]);

		$sql = "UPDATE contatos SET 
        nome = '$nome',
        anoNasc = '$anoNasc',
        telefone = '$telefone'
        WHERE id = '$id_usuario'";

		$con->query($sql);

		if ($con){
		    echo("<h5 class='aviso certo'>Edições salvas com sucesso.</h5>");             
        }else{
            echo("<h5 class='aviso erro'>Erro ao salvar edições. Tente novamente.");
        }
		?>
		<script>
			document.getElementById("nome").value = "";
			document.getElementById("idade").value = "";
			document.getElementById("tel").value = "";
        </script>
	<?php
	}
  	?>



	</form>
		
</div>

<script type="text/javascript">
    $("#tel").mask("(00) 0 0000-0000");
</script>

<div class="rodape r3">
	<h6> ® Crystian Marques 2022. Todos os direitos reservados. </h6>
</div>

</body>
</html>