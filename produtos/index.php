<!DOCTYPE html>

<html lang="pt-BR">
<head>
    <title>Mateus</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>


    <link href="../styles/top-bar.css" rel="stylesheet" type="text/css" media="all">
    <link href="../styles/general.css" rel="stylesheet" type="text/css" media="all">
    <link href="../styles/produtos.css" rel="stylesheet" type="text/css" media="all">
    <link href="../styles/footer.css" rel="stylesheet" type="text/css" media="all">

</head>

<body id="top" onscroll = "scrollFunction()">

    <!-- NavBar -->
    <div class="wrapper row0">
        <div id="topbar" class="hoc clear"> 
          <div class="fl_left">
            <ul class="nospace">
              <li><a href="../">Home</a></li>
              <li><a href="../#sobre" class="">Sobre</a></li>
              <li><a href="#produtos">Produtos</a></li>
              <li><a href="../#contatos">Contatos</a></li>
              <li><a href="../login/">Login</a></li>
            </ul>
          </div>
          <div class="fl_right">
            <ul class="nospace">
              <li><i class="fas fa-phone rgtspace-5"></i> +55 (61) 98667 5983</li>
              <li><i class="fas fa-envelope rgtspace-5"></i> mail@mail.com</li>
            </ul>
          </div>
        </div>
      </div>
      <!--  -->

      <!-- Titulo de seção -->
      <section class="py-4 bg-dark text-white sec-title" id="produtos">
        <div class="container">
          <div class="row">
            <h4 class="sec-title-text">Produtos</h4>
          </div>
        </div>
      </section>
      <!--  -->

      <section class="produtos">

      <?php
          require_once('../sistema/php/conecta_db.php');
          $sql = "SELECT * FROM `produto` WHERE 1";
          $resultado = mysqli_query($conn, $sql);
          if($resultado){
              while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

              $nome = $registros['nome'];
              $marca = $registros['marca'];
              $imagem = $registros['imagem'];
              $preco_v = $registros['precoVenda'];
              $detalhes = $registros['detalhes'];
              
              echo '<div class="card" style="width: 18rem;">
                    <img src="../'.$imagem.'" class="card-img-top" alt="'.$nome.'">
                      <div class="card-body">
                      <p class="card-text"><b>'.$nome.' - '.$marca.'</b><br/>'.$detalhes.'</p>
                    </div>
                  </div>';
              
            }
          }
        ?>

      </section>

      <!-- Footer -->
      <div class="bottom section-padding">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="copyright">
                <p>Desenvolvido artesanalmente | Github:<a href="https://github.com/ismaelithalo" target="_blank"><font class="transition">@ismaelithalo</font></a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  -->


      <!-- Back to top btn -->
      <button onclick="subir()" class="btn fa fa-angle-up" id="btn-back-top"></button>
      <script src="./scripts/btn-back-top.js"></script>
      <!--  -->

</body>