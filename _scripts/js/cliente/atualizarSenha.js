$('#formSenha').submit(function(e) {
    e.preventDefault();
    
    $("#janelaConfirmarSenha").modal('hide');

    //pegando valores dos campos
    var se = $('#senha').val().trim()
    var cs = $('#confirmarSenha').val().trim()
    
    //Validacao de campos
    if(se == "" || cs == "")
    { 
        alert("Campo Senha e/ou Confirmar Senha estão vazios");
    }
    else if(se != cs)
    { 
        alert("Senha e Confirmação não coincidem");
    }
    else if(se == cs)
    {
        var fo = $(this);
        var re = atualizarSenha(fo);
    }
})


 
function atualizarSenha(dados) {
    $.ajax({
        type:"POST",
        data:dados.serialize(),
        url:"../../_scripts/crud/cliente/atualizarSenha.php",
        async:true
    }).done(function(data){
        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];

        if($sucesso)
        {
            $('#mensagemSenha p').html($mensagem);        
        }
        else//aq e quando houve uma falha no momento da operacao 
        {
            $('#mensagemSenha p').html($mensagem);       
        }
    }).fail(function(){//essa falha ele nem conseguiu se comunicar com a pagina
         $('#mensagemSenha p').html("Erro no sistema, tente mais tarde."); 
    }).always(function(){
         $('#mensagemSenha').show(); 
    })
}