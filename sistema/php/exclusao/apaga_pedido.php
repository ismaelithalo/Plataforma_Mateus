<?php

    require_once('../conecta_db.php');
    if (!isset($_SESSION)) session_start();
    if ($_SESSION['UsuarioNivel'] != 2) {
        header ("Location: ../../../"); }
    
    $id = $_GET['id'];

    $sql = "DELETE FROM `pedido` WHERE `idPedido` = $id";

    // echo $sql;

    $query = mysqli_query($conn, $sql);

     
    header("Location: ../../pedidos");

    ?>