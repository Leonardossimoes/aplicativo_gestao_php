<?php

include_once "conection.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['tarefa'])){
    $retorna = ['erro' => true, 'msg' => "Coloque um título para a tarefa"];
}else if(empty($dados['conteudo'])){ //chamando la do html!
    $retorna = ['erro' => true, 'msg' => "Favor insira um conteúdo"];
}else if(empty($dados['responsavel'])){
    $retorna = ['erro' => true, 'msg' => "Favor insira um número de registro"];
}else if(empty($dados['prazo'])){
    $retorna = ['erro' => true, 'msg' => "Favor insira um prazo"];
}else if(empty($dados['setor'])){
    $retorna = ['erro' => true, 'msg' => "Favor insira um setor"];
}else{

    $query_cadastro_tarefa = "SELECT id FROM tarefas WHERE tarefa=:tarefa LIMIT 1";
    $result_cadastro_tarefa = $connection->prepare($query_cadastro_tarefa);
    $result_cadastro_tarefa->bindParam(':tarefa', $dados['tarefa'], PDO::PARAM_STR);
    $result_cadastro_tarefa->execute();

    if (($result_cadastro_tarefa) and ($result_cadastro_tarefa->rowCount() != 0)) {
        $retorna = ['erro' => true, 'msg' => "Tarefa já cadastrada!"];
    }else{
        $query_cadastro = "INSERT INTO tarefas (tarefa, conteudo, responsavel, prazo, setor) VALUES (:tarefa,:conteudo,:responsavel, :prazo, :setor)";
        $cad_tarefa = $connection->prepare($query_cadastro);
        $cad_tarefa->bindParam(':tarefa', $dados['tarefa'], PDO::PARAM_STR);
        $cad_tarefa->bindParam(':conteudo', $dados['conteudo'], PDO::PARAM_STR);
        $cad_tarefa->bindParam(':responsavel', $dados['responsavel'], PDO::PARAM_INT);
        $cad_tarefa->bindParam(':prazo', $dados['prazo'], PDO::PARAM_STR);
        $cad_tarefa->bindParam(':setor', $dados['setor'], PDO::PARAM_STR);
   
        $cad_tarefa->execute();

        if ($cad_tarefa->rowCount() !== 0) {   
            $retorna = ['erro' => false, 'msg' => "Deu certo"];
            
        }
        else {
            $retorna = ['erro' => false, 'msg' => "Deu errado"];
        }
    }
}

echo json_encode($retorna);