$('#formSeguranca').submit(function(e) {
    e.preventDefault();

    var f = $(this);
    var r = atualizarEmail(f);
})


 
function atualizarEmail(dados) {
    $.ajax({
        type:"POST",
        data:dados.serialize(),
        url:"../../_scripts/crud/cliente/atualizarEmail.php",
        async:true
    }).done(function(data){
        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];

        if($sucesso)
        {
            $('#mensagemEmail p').html($mensagem);        
        }
        else//aq e quando houve uma falha no momento da operacao 
        {
            $('#mensagemEmail p').html($mensagem);       
        }
    }).fail(function(){//essa falha ele nem conseguiu se comunicar com a pagina atualizar.php
         $('#mensagemEmail p').html("Erro no sistema, tente mais tarde."); 
    }).always(function(){
         $('#mensagemEmail').show(); 
    })
}