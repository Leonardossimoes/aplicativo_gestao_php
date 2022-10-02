<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./perfil_usuario.css">
    <script src="https://kit.fontawesome.com/e6d51bd94b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title><?php
    {echo "Perfil de " .$_SESSION['usuario'];}
        ?></title> 
</head>
<body>

    <div class="faixa-inicial">
        <?php
            {   echo "<img src='./public/logo-sem-nome.png' width='60px' height='60px'>";
            }      
        ?>
    </div>

    <div class="perfil">
    <i class="fa-solid fa-user"></i>
<?php
if(isset($_SESSION['id']) and (isset($_SESSION['usuario']))){
    include_once "conection.php";

    $query_usuario = "SELECT id, usuario, email FROM usuarios WHERE id=:id LIMIT 1";
    $result_usuario = $connection->prepare($query_usuario);
    $result_usuario->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
    $result_usuario->execute();
    if(($result_usuario) and ($result_usuario->rowCount() !== 0)){
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

        echo "Número de Registro: ".$row_usuario['id']."<br>";
        echo "Login: ".$row_usuario['usuario']."<br>";
        echo "Email: ".$row_usuario['email'];
    }else{
        $_SESSION['msg'] = "Necessário fazer login";
    }
}else{
    $_SESSION['msg'] = "Necessário fazer login";
    header("Location: index.php");
};
?>
</div>

<div class="voltar">
    <?php

    if(isset($_SESSION['id']) and (isset($_SESSION['usuario']))){
    include_once "conection.php";

    echo "<a href='telainicio.php'>Voltar</a>";
    }
    ?>
</div>

</body>
</html>

