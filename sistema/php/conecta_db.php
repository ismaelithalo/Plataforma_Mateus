<?php
    // $servidor = "localhost";
    // $usuario = "root";
    // $senha = "meuroot";
    // $dbname = "plataformamateus";  
    
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "mateus_db";   

    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    if(!$conn){
        die("Falha na conexao: " . mysqli_connect_error());
    }else{
        // echo "Conexao realizada com sucesso";
    }      
?>