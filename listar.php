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
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Mensagens</title> 
</head>
<body>
    <div class="perfil">
<?php
if(isset($_SESSION['id']) and (isset($_SESSION['usuario']))){

    //Conexão com o banco de dados;
    include_once "conection.php";

    $query_tarefa = "SELECT tar.id, tar.tarefa, tar.conteudo, tar.responsavel, tar.prazo, tar.setor,
    usr.usuario
    FROM tarefas AS tar
    INNER JOIN usuarios AS usr ON usr.id=tar.responsavel
    WHERE responsavel=:responsavel
    ORDER BY tar.id DESC";
    $result_tarefa = $connection->prepare($query_tarefa);
    $result_tarefa->bindParam('responsavel', $_SESSION['id'], PDO::PARAM_INT);
    $result_tarefa->execute();

    if(($result_tarefa) and ($result_tarefa->rowCount() !== 0)){
        while($row_tarefa = $result_tarefa->fetch((PDO::FETCH_ASSOC))){
            extract($row_tarefa);
            echo "ID da tarefa: $id <br>";
            echo "Titulo da tarefa: $tarefa <br>"; //as variáveis vêm já do nome da posição do array.
            echo "Descrição da tarefa: $conteudo <br>";
            echo "Usuário: $usuario <br>";
        };
    }else{
        echo "Não existem tarefas para você no momento. Volte mais tarde.";
    }    
    
}else{
    $_SESSION['msg'] = "Necessário fazer login";
    header("Location: index.php");
};
?>
</div>

</br>
</br>

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

