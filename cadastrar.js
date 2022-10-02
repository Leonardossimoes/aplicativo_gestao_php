const registerForm = document.getElementById("register");
const regEmail = document.getElementById("email"); 
const regUsuario = document.getElementById("usuario"); 
const regPassword = document.getElementById("password");
const passwordConfirm = document.getElementById("passwordConfirm"); 
const msgError = document.getElementById('msgRegAlertError');

registerForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const registerDados = new FormData(registerForm);
    const dados = await fetch("./cadastrar.php", {
        method: "POST",
        body: registerDados,
    })
    const regResposta = await dados.json();
    console.log(regResposta);

    if(regResposta['erro']){
        msgError.innerHTML = regResposta['msg'];
    }else{
        msgError.innerHTML = "Usuário cadastrado com sucesso!"
        registerForm.reset(); 
    }
});