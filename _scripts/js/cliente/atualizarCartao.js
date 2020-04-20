$('#formAtualizarCartao').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var retorn = atualizarCartao(form)

});
 
function atualizarCartao(dados) {
    $.ajax({
        type:"POST",
        data:dados.serialize(),
        url:"../../../_scripts/crud/cliente/atualizarCartao.php",
        async:true
    }).done(function(data){
        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];

        if($sucesso)
        {
            $('#mensagemCartao p').html($mensagem);        
        }
        else//aq e quando houve uma falha no momento da operacao 
        {
            $('#mensagemCartao p').html($mensagem);       
        }
    }).fail(function(){//essa falha ele nem conseguiu se comunicar com a pagina atualizar.php
         $('#mensagemCartao p').html("Erro no sistema, tente mais tarde."); 
    }).always(function(){
         $('#mensagemCartao').show(); 
    })
}