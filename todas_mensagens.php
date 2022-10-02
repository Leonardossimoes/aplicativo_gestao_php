<?php
session_start();

include_once "conection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./perfil_usuarios.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Tarefas de <?php {echo $_SESSION['usuario'];}?></title> 
</head>
<body>

    <div class="faixa-inicial">
        <?php
            {   echo "<img src='./public/logo-sem-nome.png' width='60px' height='60px'>";
            }      
        ?>
    </div>

    <div class="perfil">
<?php
if(isset($_SESSION['id']) and (isset($_SESSION['usuario']))){

    //Conexão com o banco de dados;
    

    $query_tarefa = "SELECT tar.id, tar.tarefa, tar.conteudo, tar.prazo, tar.responsavel, tar.setor, usr.usuario 
    FROM tarefas AS tar
    INNER JOIN usuarios AS usr ON usr.id=tar.responsavel
    ORDER BY tar.id DESC";
    $result_tarefa = $connection->prepare($query_tarefa);
    $result_tarefa->bindParam('responsavel', $_SESSION['id'], PDO::PARAM_INT);
    $result_tarefa->execute();

    if(($result_tarefa) and ($result_tarefa->rowCount() !== 0)){
        while($row_tarefa = $result_tarefa->fetch((PDO::FETCH_ASSOC))){
            extract($row_tarefa);
            echo "ID da tarefa: $id <br>";
            echo "Titulo da tarefa: $tarefa <br>"; //as variáveis vêm já do nome da posição do array.
            echo "ID da tarefa: $conteudo <br>";
            echo "Responsável: $usuario <br><br><br>";
        };
    }
?>
<?php
  
}else{
    $_SESSION['msg'] = "Necessário fazer login";
    header("Location: index.php");
};
?>
</div>

</br>
</br>

<div class="cadastro-novas-tarefas">
        
    <form action="cadastrar_tarefas.php" method="POST" id="cadastro">

        <input  class="formulario-tarefas" type="text" placeholder="Tarefa" name="tarefa" id="tarefa">
        <input class="formulario-tarefas" type="textarea" placeholder="Descrição da Tarefa" name="conteudo" id="conteudo">
        <select name="responsavel" id="responsavel">
            
        <?php
                    $query_listar = "SELECT id, usuario, password, email FROM usuarios ORDER BY id DESC";
                    $result_listar = $connection->prepare($query_listar);
                    $result_listar->execute();
                
                    if(($result_listar) and ($result_listar->rowCount() !== 0)){
                        while($row_listar = $result_listar->fetch((PDO::FETCH_ASSOC))){ ?>
                        <option value="<?php extract($row_listar);echo $id ?>"><?php extract($row_listar);echo $usuario."<br>";?></option>
                        <?php    
                
                        };
                    }
        ?>

        </select>
        <input  class="formulario-tarefas" type="date" placeholder="Prazo final" name="prazo" id="prazo">
        <select name="setor" id="setor">
            <option value="car">Car</option>
            <option value="licenciamento">Licenciamento</option>
            <option value="corte">Corte</option>
        </select>
        <input type="submit" class="button-cadastro" value="Cadastrar" id="cad_button">
</div>

<div class="voltar">
    <?php

    if(isset($_SESSION['id']) and (isset($_SESSION['usuario']))){
    include_once "conection.php";

    echo "<a href='telainicio.php'>Voltar</a>";
    }
    ?>
</div>

<span id="msgCadAlertError"></span>
</form>
</body>

<script src="./cadastrar_tarefas.js"></script>



</html>

