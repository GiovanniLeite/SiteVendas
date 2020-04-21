$('#formExcluir').submit(function(e) {
    e.preventDefault();

    var fl = $(this);
    var ret = excluir(fl);
})


 
function excluir(dados) {
    $.ajax({
        type:"POST",
        data:dados.serialize(),
        url:"../../_scripts/crud/cliente/excluir.php",
        async:true
    }).done(function(data){
        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];

        if($sucesso)
        {
            $('#mensagemExcluir p').html($mensagem);        
        }
        else//aq e quando houve uma falha no momento da operacao 
        {
            $('#mensagemExcluir p').html($mensagem);       
        }
    }).fail(function(){//essa falha ele nem conseguiu se comunicar com a pagina atualizar.php
         $('#mensagemExcluir p').html("Erro no sistema, tente mais tarde."); 
    }).always(function(){
         $('#mensagemExcluir').show(); 
    })
}