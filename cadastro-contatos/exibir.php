<?php 
include('dbcon.php');
$consulta = "SELECT * FROM registros";
$conn = $con->query($consulta) or die($con->error);

function mask($val, $mask){
    $maskared = '';
    $k = 0;
    for($i = 0; $i<=strlen($mask)-1; $i++) {
        if($mask[$i] == '#'){
            if(isset($val[$k]))
            $maskared .= $val[$k++];
        } else {
            if(isset($mask[$i]))
            $maskared .= $mask[$i];
        }
    }
    return $maskared;
}

?>

<!DOCTYPE html>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<title> Exibir Cadastros </title>

</head>

<body class="body">
<h2 class="titulo"> Exibição de cadastros</h2>
<div class="form-wrapper">
  

    <h3> Cadastros salvos </h3><br>
		
	<table class="table-color table table-bordered table-striped border border-2 border-dark">
        <tr class="th-color">
            <th>Id</th>
            <th>Data de cadastro</th>
            <th>Nome</th>
            <th>Ano de nascimento</th>
            <th>Telefone</th>
            <th>Opções</th>
        </tr>

        <?php while($dados = $conn->fetch(PDO::FETCH_ASSOC)){ ?>

        <tr>
            <td><?php echo $dados["id"]; ?></td>
            <td><?php echo date("d/m/Y", strtotime($dados["data_cadastro"])); ?></td>
            <td><?php echo $dados["nome"]; ?></td>
            <td><?php echo $dados["anoNasc"]; ?></td>
            <td><?php echo mask(strval($dados["telefone"]), "(##) #####-####"); ?></td>
            <td>
                <a href='editar.php?usuario=<?php echo $dados["id"]; ?>'>Editar</a>
                <a href='javascript: if (confirm("Tem certeza que deseja deletar o cadastro de <?php echo $dados['nome']; ?>?")) 
                location.href="delete.php?usuario=<?php echo $dados['id']; ?>";'>Deletar</a>
            </td>
        </tr>

        <?php } ?>
        
    </table> <br>
            
    <a href="index.php">
		<button type="button" class="btn btn-primary" data-bs-toggle="button" title="Register" name="register" value="Registrar">Cadastrar novo contato</button>
	</a>

</div>
<div class="rodape r2">
	<h6> ® Crystian Marques 2022. Todos os direitos reservados. </h6>
</div>
</body>
</html>