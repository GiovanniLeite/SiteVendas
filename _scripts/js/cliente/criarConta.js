$('#formCriarConta').submit(function(e) {
    e.preventDefault();
    
    //pegando valores dos campos
    var nome = $('#nome').val().trim();
    var cpf = $('#cpf').val().trim();
    var rg = $('#rg').val().trim();
    var telefone = $('#telefone').val().trim();
    var celular = $('#celular').val().trim();
    var cep = $('#cep').val().trim();
    var endereco = $('#endereco').val().trim();
    var bairro = $('#bairro').val().trim();
    var cidade = $('#cidade').val().trim();
    var estado = $('#estado').val().trim();
    var email = $('#email').val().trim();
    var usuario = $('#usuario').val().trim();
    var senha = $('#senha').val().trim();
    var confirmarSenha = $('#confirmarSenha').val().trim();
    
    //Validacao de campos
    if(senha != confirmarSenha)
    {
        alert("Senha e confirmação precisam ser iguais.");
    }
    else if(nome == "" || cpf == "" || rg == "" || telefone == "" || celular == "" || cep == "" || endereco == "" || bairro == "" 
            || cidade == "" || estado == "" || email == "" || usuario == "" || senha == "" || confirmarSenha == "")
    { 
        alert("Um ou mais campos obrigatórios permanecem em branco.");
    }
    else if(senha == confirmarSenha)
    {
        var formulario = $(this);
        var retorno = inserirFormulario(formulario);
    }
});

function inserirFormulario(dados) {
    $.ajax({
        type:"POST",
        data:dados.serialize(),
        url:"../../_scripts/crud/cliente/criarConta.php"
    }).done(function(data){
        
        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem1 = $.parseJSON(data)["mensagem1"];
        $mensagem = $.parseJSON(data)["mensagem"];

        if($sucesso)
        {
            $('#mensagem p').html($mensagem1);  
            console.log($mensagem);
        }
        else//aq e quando houve uma falha no momento da operacao 
        {
            $('#mensagem p').html($mensagem1);  
            console.log($mensagem);
        }
        
    }).fail(function(){//essa falha ele nem conseguiu se comunicar com a pagina php
         $('#mensagem p').html("Erro no sistema, tente mais tarde."); 
    }).always(function(){
         $('#mensagem').show(); 
    })
}