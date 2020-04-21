$('#formSenha').submit(function(e) {
    e.preventDefault();

    var fo = $(this);
    var re = atualizarSenha(fo);
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
    }).fail(function(){//essa falha ele nem conseguiu se comunicar com a pagina atualizar.php
         $('#mensagemSenha p').html("Erro no sistema, tente mais tarde."); 
    }).always(function(){
         $('#mensagemSenha').show(); 
    })
}