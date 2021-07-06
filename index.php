<!DOCTYPE html>

<html lang="pt-BR">
<head>
    <title>MSO Info Tecnologia</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="imagens/icon.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

    <link href="./styles/top-bar.css" rel="stylesheet" type="text/css" media="all">
    <link href="./styles/general.css" rel="stylesheet" type="text/css" media="all">
    <link href="./styles/produtos.css" rel="stylesheet" type="text/css" media="all">
    <link href="./styles/footer.css" rel="stylesheet" type="text/css" media="all">
    <link href="./styles/contato.css" rel="stylesheet" type="text/css" media="all">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

</head>

<body id="top" onscroll = "scrollFunction()">

    <!-- NavBar -->
    <div class="wrapper row0">
        <div id="topbar" class="hoc clear"> 
          <div class="fl_left">
            <ul class="nospace">
              <li><a href="#">Home</a></li>
              <li><a href="#sobre" class="">Sobre</a></li>
              <li><a href="#produtos">Produtos</a></li>
              <li><a href="#contatos">Contatos</a></li>
              <li><a href="login/">Login</a></li>
            </ul>
          </div>
          <div class="fl_right">
            <ul class="nospace">
              <li><i class="fas fa-phone rgtspace-5"></i><a href="https://wa.me/5561986675983?text=Eu%20tenho%20interesse%20em%20um%20or%C3%A7amento" target="_blank"> +55 (61) 98667 5983</a></li>
              <li><i class="fas fa-envelope rgtspace-5"></i> mail@mail.com</li>
            </ul>
          </div>
        </div>
      </div>
      <!--  -->

      <!-- Carrousel -->
      <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="imagens/MSO-banner-1.png" id="img-car-1" class="d-block w-100 banner" alt="...">
          </div>
          <div class="carousel-item">
            <img src="imagens/MSO-banner-2.png" id="img-car-2" class="d-block w-100" alt="...">
          </div>
          <!-- <div class="carousel-item">
            <img src="https://dummyimage.com/1920x600/03dffc/fff" id="img-car-3" class="d-block w-100" alt="...">
          </div> -->
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
      </div>
      <!--  -->

      <!-- Titulo de seção -->
      <section class="py-4 bg-dark text-white sec-title" id="sobre">
        <div class="container">
          <div class="row">
            <h4 class="sec-title-text">MSO INFO TECNOLOGIA</h4>
          </div>
        </div>
      </section>
      <!--  -->

      <section class="container-fluid sobre">
        <div class="row">
          <div class="col-md">
            <img src="imagens/MSO-8x6.png" class="d-block w-100" alt="...">
          </div>
          <div class="col-md">
            <p style="margin-top: 25px;">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit eros ut sem gravida commodo ac nec neque. Nunc mattis sem in pulvinar tincidunt. Mauris euismod vulputate sollicitudin. Aliquam enim magna, auctor sed faucibus vel, accumsan ac turpis. Suspendisse potenti. Proin nec varius justo. Duis non laoreet est. Sed id venenatis tortor. In nec accumsan elit. Pellentesque vestibulum, turpis at imperdiet fringilla, est arcu tincidunt eros, ac egestas sem ipsum ut turpis. Ut nec ante non nisi volutpat volutpat imperdiet ut neque. Aliquam convallis euismod tempor.
            </p>
          </div>
        </div>
      </section>


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
          require_once('sistema/php/conecta_db.php');
          $sql = "SELECT * FROM `produto` WHERE 1 ORDER BY `idProduto` DESC LIMIT 10";
          $resultado = mysqli_query($conn, $sql);
          if($resultado){
              while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

              $nome = $registros['nome'];
              $marca = $registros['marca'];
              $imagem = $registros['imagem'];
              $preco_v = $registros['precoVenda'];
              $detalhes = $registros['detalhes'];
              
              echo '<div class="card" style="width: 18rem;">
                    <img src="'.$imagem.'" class="card-img-top" alt="'.$nome.'">
                      <div class="card-body">
                      <p class="card-text"><b>'.$nome.' - '.$marca.'</b><br/>'.$detalhes.'</p>
                    </div>
                  </div>';
              
            }
          }
        
        ?>

            <a href="produtos/" class="redirect link-dark"> Mais produtos</a>

      </section>

      <!-- Titulo de seção -->
      <section class="py-4 bg-dark text-white sec-title" id="contatos">
        <div class="container">
          <div class="row">
            <h4 class="sec-title-text">Contatos</h4>
          </div>
        </div>
      </section>
      <!--  -->

      <section class="contatos">
          <section class="contact" id="contact">
            <div class="container">
                <div class="main wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="row">
                        <div class="col-lg-8 left">
                            <h3>Entre em contato!</h3>

                            <form method="POST" action="sistema/php/mailer/envia.php">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Seu nome" name="nome" id="nome">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" placeholder="Seu e-mail" name="email_user" id="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" id="comment" placeholder="Mensagem" name="texto" id="mensagem"></textarea>
                                </div>
                                <button class="btn btn-block" type="submit">Enviar</button>
                            </form>
                        </div>
                        <!-- Left -->
                        <div class="col-lg-4">
                            <div class="right">
                                <h4>Informações</h4>
                                <div class="info d-flex align-items-center">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>Endereço<br>Complemento</span>
                                </div>
                                <div class="info d-flex align-items-center">
                                    <i class="fa fa-chrome" aria-hidden="true"></i>
                                    <span> +55 (61) 98667 5983
                                      </span>
                                </div>
                                <div class="info d-flex align-items-center">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>email@mail.com
                                      </span>
                                </div>
                                <div class="social">
                                    <a href="#0">
                                        <i class="fa fa-dribbble" aria-hidden="true"></i>
                                    </a>
                                    <a href="#0">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </a>
                                    <a href="#0">
                                        <i class="fa fa-github" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
</html>
<?php 
      if(isset($_GET['mail']))
        echo '<script>window.onload = function () { 
              alert("Mensagem enviada com sucesso!");}
              </script>';
  ?>