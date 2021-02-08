<?php
require_once('../conecta_db.php');

$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];

date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d');

$sql = "INSERT INTO `cliente`(`idCliente`, `nome`, `endereco`, `telefone`, `cpf`, `dataRegistro`) VALUES (NULL,'$nome','$endereco','$telefone','$cpf','$data')";
// echo $sql;

$query = mysqli_query($conn, $sql);
header("Location: ../../clientes/");