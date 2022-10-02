<?php
include_once "conection.php";

session_start();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); //filter para receber todos os dados em forma de array, input post porque o método pelo que estaremos fazendo isso é post, e precisamos desses dados em formato string e aí por isso  o filter_default

if(empty($dados['email'])){
    $retorna = ['erro' => true, 'msg' => "Favor preencha o campo de usuário"];
}else if(empty($dados['password'])){
    $retorna = ['erro' => true, 'msg' => "Favor preencha o campo de senha"];
}else{
    $query_usuario = "SELECT id, usuario, password, email
                FROM usuarios
                WHERE email=:email
                LIMIT 1";
    $result_usuario = $connection->prepare($query_usuario);
    $result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);

    $result_usuario->execute();

    if(($result_usuario) and ($result_usuario->rowCount() != 0)){
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        if($dados['password'] == $row_usuario['password']){
            $_SESSION['id'] =  $row_usuario['id'];
            $_SESSION['usuario'] =  $row_usuario['usuario'];
            $_SESSION['email'] = $row_usuario['email'];
            
            $retorna = ['erro'=> false, 'dados' => $row_usuario];
        }else{
            $retorna = ['erro'=> true, 'msg' => "Usuário ou senha inválido(s)."];
        }        
    }else{
        $retorna = ['erro'=> true, 'msg' => "Usuário ou senha inválido(s)."];
    }    
}

echo json_encode($retorna);