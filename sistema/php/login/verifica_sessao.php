<?php
  if (!isset($_SESSION)) session_start();
    
  if ($_SESSION['UsuarioNivel'] == 2) {
      header("Location: ../../produtos/"); exit;
  }
  else {
      header("Location: ../../../");exit;
  }


  ?>