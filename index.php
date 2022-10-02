<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
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
    
    <form id="login" method="POST">

    <div id="dados-usuario">

    <div class="login">
        <h2>Login</h2>
        <input  class="campo-tela-inicial" type="text" autocomplete="on" placeholder="Email" name="email" id="email">
        <input class="campo-tela-inicial" type="password" autocomplete="on" placeholder="Senha" name="password" id="password">
        <input type="submit" class="button-tela-inicial" value="Login">
    </div>

    </div>

    <span id="msgAlertError">
        <?php
            if(isset($_SESSION['msg'])){
                echo$_SESSION['msg'];
                 unset($_SESSION['msg']);
            };
        ?>
    </span>
    
 </form>
</body>
<script src="./custom.js"></script>

</html>