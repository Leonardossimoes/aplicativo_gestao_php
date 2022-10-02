const loginForm = document.getElementById("login");
const email = document.getElementById("email");
const password = document.getElementById("password");
const msgAlertError = document.getElementById("msgAlertError");

loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (document.getElementById("email").value === "") {
        msgAlertErroLogin.innerHTML = "Favor preencha o campo de usuário";
    } else if (document.getElementById("password").value === "") {
        msgAlertErroLogin.innerHTML = "Favor preencha o campo de senha.";
    } else {
        const dadosForm = new FormData(loginForm);

        const dados = await fetch("./validar.php", {
            method: "POST",
            body: dadosForm
        });

        const resposta = await dados.json();

        if(resposta['erro']){
            msgAlertError.innerHTML = resposta['msg']
        }else{
            document.getElementById("dados-usuario").innerHTML = "Bem vindo(a), " + resposta['dados'].usuario + "<a href='rota_login.php'>Entrar na conta</a><br>";
            loginForm.reset();
        }
    }
});
