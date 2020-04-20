$('#compras ul li a#excluir').click(function(e){
    e.preventDefault();

    var id =  $(this).parent().parent().attr("title");
    var elemento = $(this).parent().parent();

    $.ajax({
        type:"POST",
        data:"codigo=" + id,
        url:"../../../_scripts/crud/adm/excluirProduto.php",
        async:true

    }).done(function(data){
        $sucesso = $.parseJSON(data)["sucesso"];

        if($sucesso)
        {
            elemento.fadeOut();//remove o registro da lista
        }
        else
        {
            console.log("Erro na exclusão");
        }
    }).fail(function(){
        console.log("Erro");
    });
});