<?php

include("dbcon.php");
$id_usuario = intval($_GET["usuario"]);

$deletar = "DELETE FROM registros WHERE id = '$id_usuario'";
$conn = $con->query($deletar) or die($con->error);

if ($conn){
    echo '
    <script>
    alert ("Usuário deletado com sucesso.")
    location.href = "exibir-contatos.php"
    </script>';
}else{
    echo '
    <script> 
    alert ("Não foi possível deletar o usuário.")
    location.href = "exibir-contatos.php"
    </script>';
}

?>