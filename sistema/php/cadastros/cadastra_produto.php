<?php
require_once('../conecta_db.php');

$nome = $_POST['nome'];
$marca = $_POST['marca'];
$preco = $_POST['preco'];
$preco_v = $_POST['preco_v'];
$quantidade = $_POST['quantidade'];
$detalhes = $_POST['detalhes'];

$imagem = $_FILES[ 'imagem' ][ 'name' ];
$arquivo_tmp = $_FILES['imagem']['tmp_name'];

$extensao = pathinfo ( $imagem, PATHINFO_EXTENSION );
$extensao = strtolower ( $extensao );

if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
    $novoNome = $nome.'-'.uniqid ( time () ) . '.' . $extensao;
    $destino = "sistema/imagens/".$novoNome;
    move_uploaded_file( $arquivo_tmp, $_SERVER['DOCUMENT_ROOT']."/Mateus"."/".$destino);
}

$sql = "INSERT INTO `produto`(`idProduto`, `nome`, `marca`, `imagem`, `precoCompra`, `precoVenda`, `quantidade`, `detalhes`) VALUES (NULL,'$nome','$marca','$destino','$preco','$preco_v','$quantidade','$detalhes')";
//  echo $sql;
$query = mysqli_query($conn, $sql);
header("Location: ../../produtos/");