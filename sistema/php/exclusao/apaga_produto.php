<?php

    require_once('../conecta_db.php');
    if (!isset($_SESSION)) session_start();
    if ($_SESSION['UsuarioNivel'] != 2) {
        header ("Location: ../../../"); }
    
    $id = $_GET['id'];
    $imagem = $_GET['imagem'];
    $caminho = '../../../'.$imagem;

    $sql = "DELETE FROM `produto` WHERE `idProduto` = $id";

    // echo $sql;
    // echo '<br>'.$caminho;
    $query = mysqli_query($conn, $sql);
    unlink($caminho);
     
    header("Location: ../../produtos");

    ?>