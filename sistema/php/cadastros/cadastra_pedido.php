<?php
require_once('../conecta_db.php');


if (!isset($_POST['cliente'])) {
    header("Location: ../../pedidos/?cliente=0");
    exit;
}
else if (!isset($_POST['produtos'])) {
    header("Location: ../../pedidos/?produto=0");
    exit;
}

$cliente = $_POST['cliente'];
$valor = $_POST['valor'];
$detalhes = $_POST['detalhes'];

$produtos = $_POST['produtos'];
$produtos_lista = implode(",", $produtos);

foreach ($produtos as $id) {
    if ($_POST[$id] == 0) {
        header("Location: ../../pedidos/?sel=0");
        exit;
    }
}

// print_r($arr);
// echo '<br><br>';

date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d');

foreach ($produtos as $id) {
    $req = "SELECT * FROM `produto` WHERE `idProduto` = $id";
    $resultado = mysqli_query($conn, $req);
              if($resultado){
                  while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

                    $quantidade = $registros['quantidade'];
                    $nome = $registros['nome'];
                    $marca = $registros['marca'];

                    if($quantidade == 0) {
                        // echo "Produto $nome - $marca indisponível <br>";
                        header("Location: ../../pedidos/?falta=$nome&comp=$marca");
                        exit;
                    }
                    else if ($_POST[$id] > $quantidade) {
                        header("Location: ../../pedidos/?falta1=$nome&comp=$marca");
                        exit;
                    }
                    
                    else {
                        $qtd = $quantidade - $_POST[$id];
                        $req2 = "UPDATE `produto` SET `quantidade`= $qtd WHERE `idProduto` = $id";
                        $query = mysqli_query($conn, $req2);
                        $detalhes = $detalhes."\n O foram pedidas ".$_POST[$id]." unidades do produto ".$nome." - ".$marca;
                    }
                }
            }
}

$sql = "INSERT INTO `pedido`(`idPedido`, `idProdutos`, `idCliente`, `valor`, `detalhes`, `dataPedido`) VALUES (NULL,'$produtos_lista','$cliente','$valor','$detalhes','$data')";
// echo $sql.'<br><br>';

$query = mysqli_query($conn, $sql);

header("Location: ../../pedidos/");