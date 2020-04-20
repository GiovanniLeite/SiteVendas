$('#formAtualizarCadastro').submit(function(e) {
    e.preventDefault();

    var formulario = $(this);
    var retorno = alterarFormulario(formulario)

});

function alterarFormulario(dados) {
    $.ajax({
        type:"POST",
        data:dados.serialize(),
        url:"../../../_scripts/crud/cliente/atualizarCadastro.php",
        async:true
    }).done(function(data){
        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];

        if($sucesso)
        {
            $('#mensagem p').html($mensagem);        
        }
        else//aq e quando houve uma falha no momento da operacao 
        {
            $('#mensagem p').html($mensagem);       
        }
    }).fail(function(){//essa falha ele nem conseguiu se comunicar com a pagina atualizar.php
         $('#mensagem p').html("Erro no sistema, tente mais tarde."); 
    }).always(function(){
         $('#mensagem').show(); 
    })
}