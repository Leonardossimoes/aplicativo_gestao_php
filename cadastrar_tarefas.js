const cadForm = document.getElementById('cadastro');
const tarefa = document.getElementById('tarefa');
const conteudo = document.getElementById('conteudo');
const responsavel = document.getElementById('responsavel');
const prazo = document.getElementById('prazo');
const setor = document.getElementById('setor');
const msgCadError = document.getElementById('msgCadAlertError');

cadForm.addEventListener("submit", async(e) => {
    (e).preventDefault();

    const cadDados = new FormData(cadForm);
    const dados = await fetch("./cadastrar_tarefas.php", {
        method: "POST",
        body: cadDados,
    })

    const cadRespostas = await dados.json();
    console.log(cadRespostas);

    if(cadRespostas['erro']){
        msgCadError.innerHTML = cadRespostas['msg'];
    }else{
        msgCadError.innerHTML = "Tarefa cadastrada com sucesso!"
        cadForm.reset();
    }
});