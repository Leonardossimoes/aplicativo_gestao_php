<?php

include_once "conection.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['email'])){
    $retorna = ['erro' => true, 'msg' => "Favor escolha um email"];
}else if(empty($dados['usuario'])){ //chamando la do html!
    $retorna = ['erro' => true, 'msg' => "Favor insira um usuário."];
}else if(empty($dados['password'])){
    $retorna = ['erro' => true, 'msg' => "Favor escolha uma senha"];
}else if(($dados['password']) !== ($dados['passwordConfirm'])){
    $retorna = ['erro' => true, 'msg' => "As senhas não conferem"];
}
else{

    $query_usuario_pes = "SELECT id FROM usuarios WHERE email=:email LIMIT 1";
    $result_usuario = $connection->prepare($query_usuario_pes);
    $result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $result_usuario->execute();

    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $retorna = ['erro' => true, 'msg' => "Usuário já cadastrado!"];
    }else{
        $query_usuario = "INSERT INTO usuarios (usuario, password, email) VALUES (:usuario,:password,:email)";
        $cad_usuario = $connection->prepare($query_usuario);
        $cad_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':password', $dados['password'], PDO::PARAM_STR);

        $cad_usuario->execute();

        if ($cad_usuario->rowCount() !== 0) {   
            $retorna = ['erro' => false, 'msg' => "Deu certo"];
            
        }
        else {
            $retorna = ['erro' => false, 'msg' => "Deu errado"];
        }
    }
}
echo json_encode($retorna);

            