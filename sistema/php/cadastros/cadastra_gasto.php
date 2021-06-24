<?php
require_once('../conecta_db.php');

$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$data = $_POST['data'];

$sql = "INSERT INTO `gastos`(`idGasto`, `descricao`, `valor`, `data`) VALUES (NULL,'$descricao','$valor','$data')";
// echo $sql;

$query = mysqli_query($conn, $sql);
header("Location: ../../gastos/");