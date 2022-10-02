<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_registrar_usuarios.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Sistema de Gestão</title>
</head>
<body>

    <div class="cabecalho">
        <ul>
            <a href="/gestaom"><li>Home</li></a>
            <a href="/gestaom/registrar_usuarios.php"><li>Registrar</li></a>
        </ul>
    </div>

    <form id="register" method="POST" action="cadastrar.php">
    <div id="dados-usuario">

      <div class="register">
        <h2>Registrar</h2>
        <input  class="campo-tela-inicial" type="email" autocomplete="on" placeholder="Email" name="email" id="email">
        <input  class="campo-tela-inicial" type="text" autocomplete="on" placeholder="Seu nome" name="usuario" id="usuario">
        <input class="campo-tela-inicial" type="password" autocomplete="on" placeholder="Senha" name="password" id="password">
        <input class="campo-tela-inicial" type="password" autocomplete="on" placeholder="Confirme sua senha" name="passwordConfirm" id="passwordConfirm">
        <input type="submit" class="button-tela-inicial" value="Registrar">
    </div>
    </div>
    </div>

    <?php

    if(isset($_SESSION['id']) and (isset($_SESSION['usuario']))){
        echo "Bem vindo, " .$_SESSION['usuario']."</br>";
        echo "<a href='sair.php'>Sair</a>";
    }
    ?>
</br>
</br>

        <span id="msgRegAlertError"></span>
    
 </form>
</body>

<script src="./cadastrar.js"></script>

</html>