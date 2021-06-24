<?php
require_once('../conecta_db.php');

$id = $_POST['id'];
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];


$sql = "UPDATE `cliente` SET `nome`='$nome',`endereco`='$endereco',`telefone`='$telefone',`cpf`='$cpf' WHERE `idCliente` = $id";
// echo $sql;

$query = mysqli_query($conn, $sql);
header("Location: ../../clientes/");