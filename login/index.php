<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/login.css">
    <!-- Acrescentar caminho -->
    <link rel="icon" href="">
    <title>Realizar login</title>
</head>
<body>
<div class="login-page">
    <div class="form">
    <h2> Iniciar sessão </h2>
      <?php
      //Funçao de php apenas recebe uma variavel de erro da pagina de validaçao caso aconteça algum erro. A ideia é que é que seja enviada a variavel "log" pelo metodo get com /?log=1 caso a validação não seja concluída
      if (isset($_GET['log']))
      echo "Usuário e/ou senha inválido(s)"."<br>"."<br>"; 
      ?>
      <!-- Acrescentar caminho -->
      <form class="login-form" method="POST" action="../sistema/php/login/valida_dados.php">
        <input type="text" name="usuario" placeholder="Usuário"/>
        <input type="password" name="senha" placeholder="Senha"/>
        <button type="submit">login</button>
      </form>
    </div>
  </div>    
</body>
</html>