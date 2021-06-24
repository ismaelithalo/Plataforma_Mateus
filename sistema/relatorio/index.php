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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../scripts/moment.js"></script>

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
              <a class="nav-link " href="../pedidos">Ger. Pedidos</a>
              <a class="nav-link"  href="../gastos">Gastos</a>
              <a class="nav-link active" aria-current="page" href="#">Relatório</a>
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
              <h4 class="sec-title-text">Relatórios</h4>
            </div>
          </div>
        </div>
      </section>
      
      <h1>Ranking do Mês</h1>

        <div>
            <canvas id="balanco-lucros"></canvas>
        </div>
        
        <?php
          $sql = "SELECT * FROM `pedido` WHERE 1";
          $resultado = mysqli_query($conn, $sql);
          $vendas = array();
          if($resultado){
              while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
                // $vendas[] = {
                //   data: $registros['dataPedido']
                //   valor: $registros['valor']
                // }
              }
          }
        ?>
        
    <script>
    
    var ctx = document.getElementById('balanco-lucros').getContext('2d');
    var config = {
        data: {
            datasets: [{
                label: 'Vendas',
                backgroundColor: 'rgba(20, 28, 105, 0)',
                borderColor: 'rgb(46, 143, 21, 1)',
                data: [],
                type: 'bar',
                pointRadius: 0,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 0
            },
            bounds: 'data',
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        displayFormats: {
                            month: 'MM/YYYY'
                        },
                        tooltipFormat: 'MM/YYYY',
                        minUnit: 'month'
                    },
                    distribution: 'linear',
                    offset: true,
                    ticks: {
                        major: {
                            enabled: true,
                            fontStyle: 'bold'
                        },
                        source: 'data',
                        autoSkip: true,
                        autoSkipPadding: 350,
                        maxRotation: 0,
                        sampleSize: 100
                    }
                }],
                yAxes: [{

                    scaleLabel: {
                        display: true,
                        labelString: 'Valores (R$)'
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            tooltips: {
                intersect: false,
                mode: 'index'
            }
        }
    };
    var graficoBalanco = new Chart(ctx, config);
    
    const adicionaZero = (numero) => {
      if (numero <= 9)
        return "0" + numero;
      else
        return numero;
    } 

    const preencheGrafico = () => {
      let vendas = <?php echo $vendas; ?>;
      console.log(JSON.parse(vendas[0]));
      let dateArr= [];
      if (vendas.length > 0) {
        graficoBalanco.config.data.datasets[0].data = [];

        vendas.forEach((venda) => { 
          venda = JSON.parse(venda);
          let day = new Date(venda.data);
          dateArr.push(day.getFullYear() + "-" + (adicionaZero(day.getMonth() + 1).toString()) + '-01');
        })

        let dateUnicos = [...new Set(dateArr)];

        dateUnicos = Array.from(dateUnicos);

        dateUnicos.sort((a, b) => {
          return new Date(a) - new Date(b);
        });

        dateUnicos.forEach(data => {
          temp = [];
          tempValor = 10;

          vendas.forEach((venda) => { 
            venda = JSON.parse(venda);
            let vendaData = new Date(venda.data);
            let dataVenda = vendaData.getFullYear() + "-" + (adicionaZero(vendaData.getMonth() + 1).toString()) + '-01'
            if (data === vendaData) {
                temp.push(venda);
            }
          });
        
          temp.forEach(venda => {
            venda = JSON.parse(venda);
            tempValor += venda.valor
          });

          graficoBalanco.config.data.datasets[0].data.push({
            t: moment(data, 'YYYY-MM-DD').valueOf(),
            y: tempValor
          });
        });
        graficoBalanco.update();
      }
    }
    preencheGrafico();

  </script>
</body>