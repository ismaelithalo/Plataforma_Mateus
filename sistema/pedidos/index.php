<?php
    if (!isset($_SESSION)) session_start();
    if ($_SESSION['UsuarioNivel'] != 2) {
      header ("Location: ../../"); } 
      require_once('../php/conecta_db.php');
?>

<!DOCTYPE html>

<html lang="pt-BR">
<head>
    <title>Mateus</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="../styles/general.css" rel="stylesheet" type="text/css" media="all">
    <link href="../styles/footer.css" rel="stylesheet" type="text/css" media="all">

</head>

<body>
    
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Administração</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link"  href="../produtos">Ger. Produtos</a>
              <a class="nav-link " href="../clientes">Ger. Clientes</a>
              <a class="nav-link active" aria-current="page" href="#">Ger. Pedidos</a>
              <a class="nav-link" href="#">Relatório</a>
              <a class="nav-link" href="../php/login/encerra_sessao.php" tabindex="-1" >Sair</a>
            </div>
          </div>
        </div>
      </nav>


      <!-- Titulo de seção -->
      <section class="py-4 bg-dark text-white sec-title" id="sobre">
        <div class="container">
          <div class="row">
            <div class="col">
              <h4 class="sec-title-text">Gerenciar Pedidos</h4>
            </div>
            <div class="col">
              <a type="button" class="btn btn-light" data-toggle="modal" data-target="#cadastro" style="float: right;">Adicionar</a>
            </div>
            
          </div>
        </div>
      </section>
      <!--  -->

      <?php
      //Funçao de php apenas recebe uma variavel de erro da pagina de validaçao caso aconteça algum erro. A ideia é que é que seja enviada a variavel "log" pelo metodo get com /?log=1 caso a validação não seja concluída
      if (isset($_GET['falta']))
      echo "<div class='alert alert-danger' role='alert' style='padding-left: 5vw;'>
                Não foi possível realizar o pedido pois o produto: '".$_GET['falta']." - ".$_GET['comp']."' está sem estoque.
            </div>"
      ?>

      <div class="tabela table-responsive" style="padding-left: 5vw; padding-right: 5vw;">
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Cliente</th>
                <th scope="col">Produtos</th>
                <th scope="col">Valor</th>
                <th scope="col">Detalhes</th>
                <th scope="col">Registro</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">NF-e</th>
                <th scope="col">Excluir</th>
              </tr>
            </thead>
            <tbody>

              <?php

              $sql = "SELECT * FROM `pedido` WHERE 1";
              $resultado = mysqli_query($conn, $sql);
              if($resultado){
                  while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

                    $id_pedido = $registros['idPedido'];

                    $id_cliente = $registros['idCliente'];
                    $req = "SELECT `nome`, `cpf`,`endereco` FROM `cliente` WHERE `idCliente` = $id_cliente";

                    $resultado1 = mysqli_query($conn, $req);
                    if($resultado1){
                        $registros1 = mysqli_fetch_array($resultado1, MYSQLI_ASSOC);
                        $nomeCliente = $registros1['nome'];
                        $cpfCliente = $registros1['cpf'];
                        $adrCliente = $registros1['endereco'];
                    }

                    $produtos_id_str = $registros['idProdutos'];
                    $produtos_id = explode(",", $produtos_id_str);
                    $produtos_arr = [];

                    foreach ($produtos_id as $id) {
                        $req1 = "SELECT `nome` FROM `produto` WHERE `idProduto` = $id";
                        $resultado2 = mysqli_query($conn, $req1);

                        if($resultado2){
                            $registros2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                            array_push($produtos_arr, $registros2['nome']);
                        }
                    }

                    $produtos = implode(", ", $produtos_arr);

                  $valor = $registros['valor'];
                  $detalhes = $registros['detalhes'];
                  $dataPedido = $registros['dataPedido'];

                  echo '<tr class="table-light">';
                  echo '<td>'.$nomeCliente.' - '.$cpfCliente.'</td>';
                  echo '<td>'.$produtos.'</td>';
                  echo '<td>R$'.$valor.',00</td>';
                  echo '<td>'.$detalhes.'</td>';
                  echo '<td>'.$dataPedido.'</td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td><a href="#" class="btn btn-warning fa fa-file-text" value="print" onclick="PrintDiv();"></a></td>';
                  echo '<td><a href="../php/exclusao/apaga_pedido.php?id='.$id_pedido.'" class="btn btn-danger fa fa-trash-o" onclick="return confirm(`Tem certeza que deseja apagar este pedido?`)"></a></td>';
                  echo '</tr>';

              ?>

              <script type="text/javascript">     
                  function PrintDiv() {    
                    var divToPrint = document.getElementById('divToPrint');
                    var popupWin = window.open('', '_blank', 'width=700,height=600');
                    popupWin.document.open();
                    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                      popupWin.document.close();
                          }
              </script>

                <div id="divToPrint" style="display:none;">
                  <div>
                    <?php
                    
                        $html ="
                            <fieldset>
                              <h1>Recibo de Pedido</h1>
                              <p class='center sub-titulo'>
                                Nº 
                                  <strong>00".$id_pedido."</strong> 
                                -
                                VALOR 
                                  <strong>R$ ".$valor.",00</strong>
                              </p>

                              <p>Valor correspondente a(os) seguinte(s) produto(s):<br>

                               <strong>".$produtos."<strong></p>

                              <p class='direita'> Data do pedido:
                                ".$dataPedido."
                              </p>
                              <p>Assinatura ......................................................................................................................................</p>
                              <p>Nome do Cliente: 
                                  <strong>".$nomeCliente."</strong><br> 
                                CPF/CNPJ: 
                                  <strong>".$cpfCliente."</strong>
                              </p>
                              <p>Endereço:  
                                <strong>".$adrCliente."</strong></p>
                            </fieldset>
                        ";
                        echo $html;

                      ?>      
                  </div>
                </div>

              <?php
                    }
                }

              ?>

            </tbody>
          </table>
        </div>

      <!-- Modal -->
      <div class="modal fade" id="cadastro" tabindex="-1" aria-labelledby="Cadastrar Item" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="Cadastrar">Cadastrar Pedido</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <form method="POST" action="../php/cadastros/cadastra_pedido.php">
                <div class="form-group row">
                    <label for="cliente" class="col-sm-2 col-form-label">Cliente</label>
                    <div class="col-sm-10">
                    <select name="cliente" class="form-control">
                        <option value="NULL" selected>Selecione o cliente</option> 
                        <?php
                                $sql = "SELECT * FROM `cliente` WHERE 1";
                                $resultado = mysqli_query($conn, $sql);
                                if($resultado){
                                    while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                                    $id_cliente = $registros['idCliente'];
                                    $nome = $registros['nome'];
                                    $cpf = $registros['cpf'];
                                    echo '<option value="'.$id_cliente.'">'.$nome.' - '.$cpf.'</option>';
                                    }
                                }              
                        ?>
                    </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="produtos" class="col-sm-2 col-form-label">Produtos</label>
                    <div class="col-sm-8" style="margin-left: 13px; border:2px solid #ccc; height: 100px; overflow-y: scroll;">
                        
                        <?php
                            $sql = "SELECT * FROM `produto` WHERE 1";
                            $resultado = mysqli_query($conn, $sql);
                            if($resultado){
                                while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                                $id_produto = $registros['idProduto'];
                                $nome = $registros['nome'];
                                $marca = $registros['marca'];
                                $preco = $registros['precoVenda'];
                                echo '<input name="produtos[]" type="checkbox" value="'.$id_produto.'"/> '.$nome.' - '.$marca.' - R$'.$preco.'<br />';
                                }
                            }              
                        ?>
                    </div>
                
                </div>

                <div class="form-group row">
                  <label for="valor" class="col-sm-2 col-form-label">Valor</label>
                  <div class="col-sm-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text">R$</span>
                    <input type="text" class="form-control" id="valor" name="valor">
                  </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="detalhes" class="col-sm-2 col-form-label">Detalhes</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="detalhes" name="detalhes" rows="3"></textarea>
                  </div>
                </div>

            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit">Cadastrar</button>
            </form>
            </div>
          </div>
        </div>
      </div>


</body>