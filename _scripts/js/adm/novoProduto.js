$('#formularioNovoProduto').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var formData = new FormData(form);
    var retorn = inserirFormulario(formData)

});

function inserirFormulario(formData) {
    $.ajax({
        type:"POST",
        data:formData,
        url:"../../../../_scripts/crud/adm/novoProduto.php",
        async:true
    }).done(function(data){
        /*$('#mensagem p').html(data);*/
        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];
        $mensagem1 = $.parseJSON(data)["mensagem1"];
        $mensagem2 = $.parseJSON(data)["mensagem2"];

        if($sucesso)
        {
            $('#mensagem p').html($mensagem);   
            $('#mensagem1 p').html($mensagem1); 
            $('#mensagem2 p').html($mensagem2); 
        }
        else//aq e quando houve uma falha no momento da operacao 
        {
            $('#mensagem p').html($mensagem); 
            $('#mensagem1 p').html($mensagem1); 
            $('#mensagem2 p').html($mensagem2); 
        }
    }).fail(function(){//essa falha ele nem conseguiu se comunicar com a pagina atualizar.php
         $('#mensagem p').html("Erro no sistema, tente mais tarde."); 
    }).always(function(){
         $('#mensagem').show(); 
    })
}