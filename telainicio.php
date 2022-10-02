<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style_pagina_inicio.css">
    <script src="https://kit.fontawesome.com/e6d51bd94b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title><?php
    {echo "Bem vindo, " .$_SESSION['usuario']."";}
        ?></title> 
</head>
<body>
<div class="faixa-inicial">
<?php
    {   echo "<img src='./public/logo-sem-nome.png' width='60px' height='60px'>";
    }      
?>
</div>

<div id="bem-vindo">
    <?php
    {   echo "<div class=cabecalho> Bem vindo(a), " .$_SESSION['usuario']."</br> </div>";
        echo "<div class=cabecalho></button><a href='sair.php'>Sair</a></div>";
    }
    ?>
    </div> 

    <div class="content">

    <?php 
        echo "<a class=content_one href='perfil.php'><i class='fa-solid fa-user'></i>Perfil</a>";
    ?>

    <?php 
        echo "<a class=content_one href='listar.php'><i class='fa-solid fa-bars-progress'></i></i>Minhas Tarefas</a>";
    ?>

    <?php 
        echo "<a class=content_one href='todas_mensagens.php'><i class='fa-solid fa-list-check'></i>Tarefas Gerais</a>";
    ?>
    </div>





   

</body>
<script src="./login.js"></script>

</html>