<?php 
include('dbcon.php');
include('functions.php');
$consulta = "SELECT * FROM contatos";
$conn = $con->query($consulta) or die($con->error);

?>

<!DOCTYPE html>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<title> Exibir Contatos</title>

</head>

<body class="body">
<h2 class="titulo"> 
    Exibição de contatos cadastrados
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
<div class="form-wrapper-exibir">
  

    <h3 class="cads-salvo"> Contatos salvos </h3><br>
		
	<table class="table-bordered border border-2 border-dark">
        <tr class="tr-color">
            <th class="thExibir">Id</th>
            <th class="thExibir">Data de cadastro</th>
            <th class="thExibir">Nome</th>
            <th class="thExibir">Ano de nasc.</th>
            <th class="thExibir">Telefone</th>
            <th style="text-align: center" class="thExibir">Opções</th>
        </tr>

        <?php while($dados = $conn->fetch(PDO::FETCH_ASSOC)){ ?>

        <tr>
            <td class="tdExibir" style="width: 5%"><?php echo $dados["id"]; ?></td>
            <td class="tdExibir" style="width: 15%"><?php echo date("d/m/Y", strtotime($dados["data_cadastro"])); ?></td>
            <td class="tdExibir" style="width: 30%"><?php echo $dados["nome"]; ?></td>
            <td class="tdExibir" style="width: 10%"><?php echo $dados["anoNasc"]; ?></td>
            <td class="tdExibir" style="width: 15%"><?php echo mask(strval($dados["telefone"]), "(##) # ####-####"); ?></td>
            <td class="tdExibir" style="text-align: center; width: 15%">
                <a href='editar-contatos.php?usuario=<?php echo $dados["id"]; ?>' class="linkTableCad">Editar</a>
                &ensp;&ensp;&ensp;|&ensp;&ensp;&ensp;
                <a href='javascript: if (confirm("Tem certeza que deseja deletar o cadastro de <?php echo $dados['nome']; ?>?")) 
                location.href="delete.php?usuario=<?php echo $dados['id']; ?>";' class="linkTableCad">Deletar</a>
            </td>
        </tr>

        <?php } ?>
        
    </table> <br>
            
    <a href="cadastro-contatos.php">
		<button type="button" class="btn btn-primary" data-bs-toggle="button" title="Register" name="register" value="Registrar">Cadastrar novo contato</button>
	</a>

</div>
<div class="rodape r2">
	<h6> ® Crystian Marques 2022. Todos os direitos reservados. </h6>
</div>
</body>
</html>