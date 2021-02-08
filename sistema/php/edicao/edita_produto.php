<?php
require_once('../conecta_db.php');

$id = $_POST['id'];
$nome = $_POST['nome'];
$marca = $_POST['marca'];
$preco = $_POST['preco'];
$preco_v = $_POST['preco_v'];
$quantidade = $_POST['quantidade'];
$detalhes = $_POST['detalhes'];


$sql = "UPDATE `produto` SET `nome`='$nome',`marca`='$marca',`precoCompra`='$preco',`precoVenda`='$preco_v',`quantidade`='$quantidade',`detalhes`='$detalhes' WHERE `idProduto` = $id";
//  echo $sql;

$query = mysqli_query($conn, $sql);
header("Location: ../../produtos/");