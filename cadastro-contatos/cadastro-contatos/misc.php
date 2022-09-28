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

<h2 class="titulo"> Outras Opções
    <a href="index.php"> 
        <button type="button" class="btn btn-primary logout" data-bs-toggle="button" title="Register" name="register" value="Registrar">Logout</button> 
    </a>
</h2>

<table class="tableMenu">
    <tr class="menu">
        <th class="thMenu"><a href="home.php" class="linkMenu">Home</a></th>
        <th class="thMenu"><a href="cadastro-usuario.php" class="linkMenu">Cadastrar Usuario</a></th>
        <th class="thMenu"><a href="cadastro-contatos.php" class="linkMenu">Cadastrar Contato</a></th>
        <th class="thMenu"><a href="exibir-contatos.php" class="linkMenu">Exibir Contatos</a></th>
        <th class="thMenu"><a href="misc.php" class="linkMenu">Outros</a></th>
    </tr>
</table>
<br><br><br>
<table class="tableMisc">
    <tr>
        <td class="tdMisc">
            <form class="formMisc">
                <a href="calculo-juros.php" class="linkTableCad"><h3 class="formMiscItem">Calcular juros</h3></a>
            </form>
        </td>
        <td class="tdMisc">
            <form class="formMisc">
                <h3 class="formMiscItem">-</h3>
            </form>
        </td>
        <td class="tdMisc">
            <form class="formMisc">
               <h3 class="formMiscItem">-</h3>
            </form>
         </td>
    </tr>
    <tr>
        <td class="tdMisc">
            <form class="formMisc">
			    <h3 class="formMiscItem">-</h3>
		    </form>
        </td>
        <td  class="tdMisc">
            <form class="formMisc">
			    <h3 class="formMiscItem">-</h3>
		    </form>
        </td>
        <td class="tdMisc">
            <form class="formMisc">
			    <h3 class="formMiscItem">-</h3>
		    </form>
        </td>
    </tr>
</table>

<div class="rodape r1">
	<h5> ® Crystian Marques 2022. Todos os direitos reservados. </h5>
</div>
		
</body>
</html>