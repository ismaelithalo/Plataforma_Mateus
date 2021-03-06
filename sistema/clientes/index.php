<?php
    if (!isset($_SESSION)) session_start();
    if ($_SESSION['UsuarioNivel'] != 2) {
      header ("Location: ../../"); } 
      require_once('../php/conecta_db.php');
?>

<!DOCTYPE html>

<html lang="pt-BR">
<head>
    <title>Administração - MSO Info Tecnologia</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="../../imagens/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
              <a class="nav-link"  href="../produtos">Ger. Produtos</a>
              <a class="nav-link active" aria-current="page" href="#">Ger. Clientes</a>
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
              <h4 class="sec-title-text">Gerenciar Clientes</h4>
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
                <th scope="col">Endereço</th>
                <th scope="col">Telefone</th>
                <th scope="col">CPF</th>
                <th scope="col">Registro</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
              </tr>
            </thead>
            <tbody>

              <?php

              $sql = "SELECT * FROM `cliente` WHERE 1";
              $resultado = mysqli_query($conn, $sql);
              if($resultado){
                  while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

                  $id_cliente = $registros['idCliente'];
                  $nome = $registros['nome'];
                  $endereco = $registros['endereco'];
                  $telefone = $registros['telefone'];
                  $cpf = $registros['cpf'];
                  $dataRegistro = $registros['dataRegistro'];

                  echo '<tr class="table-light">';
                  echo '<td>'.$nome.'</td>';
                  echo '<td>'.$endereco.'</td>';
                  echo '<td>'.$telefone.'</td>';
                  echo '<td>'.$cpf.'</td>';
                  echo '<td>'.$dataRegistro.'</td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td><a href="#" class="btn btn-warning fa fa-pencil-square-o" data-toggle="modal" data-target="#edita_'.$id_cliente.'"></a></td>';
                  echo '<td><a href="../php/exclusao/apaga_cliente.php?id='.$id_cliente.'" class="btn btn-danger fa fa-trash-o" onclick="return confirm(`Tem certeza que deseja apagar este cliente?`)"></a></td>';
                  echo '</tr>';

                  ?>    

                    <!-- Modal -->
                    <div class="modal fade" id="edita_<?php echo $id_cliente; ?>" tabindex="-1" aria-labelledby="Editar Item" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="Cadastrar">Editar <?php echo $nome; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            
                            <form method="POST" action="../php/edicao/edita_cliente.php">
                              <input type="hidden" name="id" value="<?php echo $id_cliente; ?>">
                              <div class="form-group row">
                                <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="name" required class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="endereco" class="col-sm-2 col-form-label">Endereço</label>
                                <div class="col-sm-10">
                                  <input type="text" required class="form-control" id="endereco" name="endereco" value="<?php echo $endereco; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
                                <div class="col-sm-10">
                                  <input type="text" required class="form-control" id="telefone" name="telefone" value="<?php echo $telefone; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="cpf" class="col-sm-2 col-form-label">CPF</label>
                                <div class="col-sm-10">
                                  <input type="text" required class="form-control" id="cpf" name="cpf" value="<?php echo $cpf; ?>">
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
              <h5 class="modal-title" id="Cadastrar">Cadastrar Cliente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <form method="POST" action="../php/cadastros/cadastra_cliente.php">
                <div class="form-group row">
                  <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                  <div class="col-sm-10">
                    <input type="name" required class="form-control" id="nome" name="nome">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="endereco" class="col-sm-2 col-form-label">Endereço</label>
                  <div class="col-sm-10">
                    <input type="text" required class="form-control" id="endereco" name="endereco">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
                  <div class="col-sm-10">
                    <input type="text" required class="form-control" id="telefone" name="telefone">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="cpf" class="col-sm-2 col-form-label">CPF</label>
                  <div class="col-sm-10">
                    <input type="text" required class="form-control" id="cpf" name="cpf">
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