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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</head>

<body>
    
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Administração</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="#">Ger. Produtos</a>
              <a class="nav-link" href="../clientes">Ger. Clientes</a>
              <a class="nav-link" href="../pedidos">Ger. Pedidos</a>
              <a class="nav-link"  href="../gastos">Gastos</a>
              <a class="nav-link" href="../relatorio">Relatório</a>
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
              <h4 class="sec-title-text">Gerenciar Produtos</h4>
            </div>
            <div class="col">
              <a type="button" class="btn btn-light" data-toggle="modal" data-target="#cadastro" style="float: right;">Adicionar</a>
            </div>
            
          </div>
        </div>
      </section>
      <!--  -->

      <div class="tabela table-responsive" style="padding-left: 5vw; padding-right: 5vw;">
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Marca</th>
                <th scope="col">Imagem</th>
                <th scope="col">Preço Compra</th>
                <th scope="col">Preço Venda</th>
                <th scope="col">QTD</th>
                <th scope="col">Detalhes</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
              </tr>
            </thead>
            <tbody>

              <?php

              $sql = "SELECT * FROM `produto` WHERE 1";
              $resultado = mysqli_query($conn, $sql);
              if($resultado){
                  while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

                  $id_produto = $registros['idProduto'];
                  $nome = $registros['nome'];
                  $marca = $registros['marca'];
                  $imagem = $registros['imagem'];
                  $preco = $registros['precoCompra'];
                  $preco_v = $registros['precoVenda'];
                  $quantidade = $registros['quantidade'];
                  $detalhes = $registros['detalhes'];

                  echo '<tr class="table-light">';
                  echo '<td>'.$nome.'</td>';
                  echo '<td>'.$marca.'</td>';
                  echo '<td><a href="../../'.$imagem.'" target="_blank" class="">
                    <img src="../../'.$imagem.'" height="60px;"/>
                  </a></td>';
                  echo '<td>R$'.$preco.',00</td>';
                  echo '<td>R$'.$preco_v.',00</td>';
                  echo '<td>'.$quantidade.'</td>';
                  echo '<td>'.$detalhes.'</td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td><a href="#" class="btn btn-warning fa fa-pencil-square-o" data-toggle="modal" data-target="#edita_'.$id_produto.'"></a></td>';
                  echo '<td><a href="../php/exclusao/apaga_produto.php?id='.$id_produto.'&imagem='.$imagem.'" class="btn btn-danger fa fa-trash-o" onclick="return confirm(`Tem certeza que deseja apagar este produto?`)"></a></td>';
                  echo '</tr>';
                  
                  ?>

                  <!-- Modal -->
                  <div class="modal fade" id="edita_<?php echo $id_produto; ?>" tabindex="-1" aria-labelledby="Cadastrar Item" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="Cadastrar">Editar <?php echo $nome; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            
                            <form method="POST" action="../php/edicao/edita_produto.php">
                              <input type="hidden" name="id" value="<?php echo $id_produto; ?>">
                              <div class="form-group row">
                                <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="name" required class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="marca" class="col-sm-2 col-form-label">Marca</label>
                                <div class="col-sm-10">
                                  <input type="text" required class="form-control" id="marca" name="marca" value="<?php echo $marca; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="preco" class="col-sm-2 col-form-label">Preço Compra</label>
                                <div class="col-sm-10">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                  <input type="number" required step="0.01" class="form-control" id="preco" name="preco" value="<?php echo $preco; ?>">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="preco_v" class="col-sm-2 col-form-label">Preço Venda</label>
                                <div class="col-sm-10">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                  <input type="number" required step="0.01" class="form-control" id="preco_v" name="preco_v" value="<?php echo $preco_v; ?>">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="quantidade" class="col-sm-2 col-form-label">Quantidade</label>
                                <div class="col-sm-10">
                                  <input type="number" required class="form-control" id="quantidade" name="quantidade" value="<?php echo $quantidade; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="detalhes" class="col-sm-2 col-form-label">Detalhes</label>
                                <div class="col-sm-10">
                                  <textarea type="text" class="form-control" id="detalhes" name="detalhes" rows="3" ><?php echo $detalhes; ?></textarea>
                                </div>
                              </div>

                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Salvar</button>
                          </form>
                          </div>
                        </div>
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
              <h5 class="modal-title" id="Cadastrar">Cadastrar Produto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <form method="POST" action="../php/cadastros/cadastra_produto.php" enctype="multipart/form-data">
                <div class="form-group row">
                  <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                  <div class="col-sm-10">
                    <input type="name" required class="form-control" id="nome" name="nome">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="marca" class="col-sm-2 col-form-label">Marca</label>
                  <div class="col-sm-10">
                    <input type="text" required class="form-control" id="marca" name="marca">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="imagem" class="col-sm-2 col-form-label">Imagem</label>
                  <div class="col-sm-10">
                    <input name="imagem" required type="file" accept="image/png, image/jpeg, image/jpg" id="imagem"/>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="preco" class="col-sm-2 col-form-label">Preço Compra</label>
                  <div class="col-sm-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text">R$</span>
                    <input type="number" required step="0.01" class="form-control" id="preco" name="preco">
                  </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="preco_v" class="col-sm-2 col-form-label">Preço Venda</label>
                  <div class="col-sm-10">
                    <div class="input-group-prepend">
                      <span class="input-group-text">R$</span>
                    <input type="number" required step="0.01" class="form-control" id="preco_v" name="preco_v">
                  </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="quantidade" class="col-sm-2 col-form-label">Quantidade</label>
                  <div class="col-sm-10">
                    <input type="number" required class="form-control" id="quantidade" name="quantidade">
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

      <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</body>