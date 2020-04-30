$('#compras ul li a#excluir').click(function(e){
    e.preventDefault();
    /*console.log("asdasd");*/
    console.log("seila");
    confirmBox();
    //console.log("2");
    /*
    if (confirm("E ai?")) 
    {
        console.log("Foi")
    }
    else
    {
        console.log("Não foi")
    }
    /*
    var id =  $(this).parent().parent().attr("title");
    var elemento = $(this).parent().parent();

    $.ajax({
        type:"POST",
        data:"codigo=" + id,
        url:"../../_scripts/crud/adm/excluirProduto.php",
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
    });*/
})

function confirmBox() {
    if (confirm("E ai?")) {
        console.log("Foi");
    }else{
        console.log("Não foi");
   }
}