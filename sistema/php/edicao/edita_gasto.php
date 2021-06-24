<?php
require_once('../conecta_db.php');

$id = $_POST['id'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$data = $_POST['data'];

$sql = "UPDATE `gastos` SET `descricao`='$descricao',`valor`=$valor,`data`='$data' WHERE `idGasto`= $id";
// echo $sql;

$query = mysqli_query($conn, $sql);
header("Location: ../../gastos/");