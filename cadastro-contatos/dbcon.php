<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'cadastro-contatos');
define('PORT', '3306');

//conexão com banco de dados usando o PDO
//Try/Catch verifica a conexão.
try {
    $con = new PDO('mysql:host=' . HOST . ';port=' . PORT . ';dbname=' . DBNAME, USER, PASS);
} catch (PDOException $e) {
    echo "Erro: Conexão com banco de dados não foi realizada com sucesso. Erro gerado " . $e->getMessage();
}

?>
