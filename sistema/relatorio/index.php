<?php
if (!isset($_SESSION)) session_start();
if ($_SESSION['UsuarioNivel'] != 2) {
  header("Location: ../../");
}
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
  <script src="https://cdn.jsdelivr.net/npm/moment@2.27.0"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@0.1.1"></script>

</head>

<body>

  <style>
      
      .sec-titles {
        margin-top: 5vh;
        margin-bottom: 3vh;
        background-color: #a3a3a3 !important;
        padding-left: 20px;
      }
      .sec-titles-text {
          font-size: 1.2rem;
      }
      .grafico {
        width: 100%;
        /* height:60vh; */
      }
      .grafico-section {
        width: 70vw;
      }

    </style>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Administração</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" href="../produtos">Ger. Produtos</a>
          <a class="nav-link " href="../clientes">Ger. Clientes</a>
          <a class="nav-link " href="../pedidos">Ger. Pedidos</a>
          <a class="nav-link" href="../gastos">Gastos</a>
          <a class="nav-link active" aria-current="page" href="#">Relatório</a>
          <a class="nav-link" href="../php/login/encerra_sessao.php" tabindex="-1">Sair</a>
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
  
  <!-- Titulo de seção -->
  <section class="py-4 bg-dark text-white sec-titles" id="sobre">
        <div class="container">
          <div class="row">
            <h4 class="sec-titles-text">Ranking do Mês</h4>
          </div>
        </div>
      </section>
      <!--  -->
      
      
      
      
  
  <!-- Titulo de seção -->
  <section class="py-4 bg-dark text-white sec-titles" id="sobre">
        <div class="container">
          <div class="row">
            <h4 class="sec-titles-text">Balanço de Gastos</h4>
          </div>
        </div>
      </section>
      <!--  -->
      
  <!-- <div style="justify-content: center; display: flex;"> -->
  <div class="container-fluid">
    <div class="row" style="justify-content: center; display: flex;">
      <form method="GET" action="./index.php">
      
        <div class="form-group row">
          <label for="campoano" class="col-sm-4 col-form-label">Insira o ano</label>
          <div class="col-sm-10">
            <div class="input-group-prepend">
            <input type="number" class="form-control" id="campoano" placeholder="Ex. 2021" name="ano" required value="<?php if(isset($_GET['ano'])) echo $_GET['ano']; ?>">
            <button type="submit" class="btn btn-secondary" style="margin-left: 10px;">Pesquisar</button>
            </div>
          </div>
        </div>
      
      </form>
    </div>
    <div class="row" style="justify-content: center; display: flex;">
      <div class="grafico-section">
        <div class="grafico">
          <canvas id="balanco-lucros"></canvas>
        </div>
      </div>
    </div>
  </div>
  
  

    <?php
    
      if(!isset($_GET['ano'])) {
        $sql1 = "SELECT * FROM `pedido` WHERE YEAR(dataPedido) = 2021";
        $sql2 = "SELECT * FROM `gastos` WHERE YEAR(data) = 2021";
      }
      else {
        $ano = $_GET['ano'];
        $sql1 = "SELECT * FROM `pedido` WHERE YEAR(dataPedido) = $ano";
        $sql2 = "SELECT * FROM `gastos` WHERE YEAR(data) = $ano";
      }
      
      $resultado = mysqli_query($conn, $sql1);
      $vendas = array();
      if ($resultado) {
        while ($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
          $arr = array('data' => $registros['dataPedido'], 'valor' => $registros['valor']);
          $vendas[] = json_encode($arr);
        }
        $vendas = json_encode($vendas);
      }
      
      $resultado = mysqli_query($conn, $sql2);
      $gastos = array();
      if ($resultado) {
        while ($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
          $arr = array('data' => $registros['data'], 'valor' => $registros['valor']);
          $gastos[] = json_encode($arr);
        }
        $gastos = json_encode($gastos);
      }
    ?>

    <script>
      var ctx = document.getElementById('balanco-lucros').getContext('2d');
      var config = {
        data: {
          datasets: [{
              label: 'Ganhos',
              backgroundColor: 'rgba(46, 143, 21, 1)',
              borderColor: 'rgba(46, 143, 21, 1)',
              data: [],
              type: 'bar',
              pointRadius: 0,
              borderWidth: 4
            },
            {
              label: 'Gastos',
              backgroundColor: 'rgba(219, 0, 0, 1)',
              borderColor: 'rgba(219, 0, 0, 1)',
              data: [],
              type: 'bar',
              pointRadius: 0,
              borderWidth: 4
            }
          ]
        },
        options: {
          responsive: true,
          animation: {
            duration: 0
          },
          bounds: 'data',
          scales: {
            x: {
              type: 'time',
              adapters: {
                date: 'moment'
              },
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
              }
            },
            y: {
              title: {
                display: true,
                text: 'Valores (R$)'
              },
              ticks: {
                beginAtZero: true
              }
            }
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
        let gastos = <?php echo $gastos; ?>;

        let dateArr = [];
        vendas = vendas.map(venda => JSON.parse(venda));
        gastos = gastos.map(gasto => JSON.parse(gasto));

        graficoBalanco.config.data.datasets[0].data = [];
        graficoBalanco.config.data.datasets[1].data = [];

        vendas.forEach((venda) => {
          let day = new Date(venda.data);
          dateArr.push(day.getFullYear() + "-" + (adicionaZero(day.getMonth() + 1).toString()) + '-10');
        })
        gastos.forEach((gasto) => {
          let day = new Date(gasto.data);
          dateArr.push(day.getFullYear() + "-" + (adicionaZero(day.getMonth() + 1).toString()) + '-10');
        })

        let dateUnicos = [...new Set(dateArr)];

        dateUnicos = Array.from(dateUnicos);

        dateUnicos.sort((a, b) => {
          return new Date(a) - new Date(b);
        });

        dateUnicos.forEach(data => {
          temp = [];
          tempGasto = [];
          tempValor = 0;
          tempValorGasto = 0;

          vendas.forEach((venda) => {
            let vendaData = new Date(venda.data);
            let dataVenda = vendaData.getFullYear() + "-" + (adicionaZero(vendaData.getMonth() + 1).toString()) + '-10'
            if (data === dataVenda) {
              temp.push(venda);
            }
          });

          gastos.forEach((gasto) => {
            let gastoData = new Date(gasto.data);
            let dataGasto = gastoData.getFullYear() + "-" + (adicionaZero(gastoData.getMonth() + 1).toString()) + '-10'
            if (data === dataGasto) {
              tempGasto.push(gasto);
            }
          });

          temp.forEach(venda => tempValor += parseInt(venda.valor));
          tempGasto.forEach(gasto => tempValorGasto += parseInt(gasto.valor));

          if (tempValor > 0)
            graficoBalanco.config.data.datasets[0].data.push({
              x: moment(data, 'YYYY-MM-DD').valueOf(),
              y: tempValor
            });
          if (tempValorGasto > 0)
            graficoBalanco.config.data.datasets[1].data.push({
              x: moment(data, 'YYYY-MM-DD').valueOf(),
              y: tempValorGasto
            });
        });
        graficoBalanco.update();
      }

      preencheGrafico();
    </script>
</body>