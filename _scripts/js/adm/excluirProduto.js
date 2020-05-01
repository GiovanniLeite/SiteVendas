var cProduto = 0;
var idUl = "";

function teste(codigoProduto,numeroUl)
{
    var codUl = "ul" + numeroUl;
     
    //console.log("Codigo do produto: ", codigoProduto);
    //console.log("Número da ul: ", codUl);
    //$('#'+codUl).fadeOut();
    
    idUl = "ul" + numeroUl;
    cProduto = codigoProduto;
}

$('#botaoSim').click(function(e){
    e.preventDefault();
    
    //console.log("Clicou SIM");
    //console.log(cProduto);
    //console.log(idUl);
    //$('#'+idUl).fadeOut();
    
    $.ajax({
        type:"POST",
        data:"codigo=" + cProduto,
        url:"../../_scripts/crud/adm/excluirProduto.php",
        async:true

    }).done(function(data){
        $sucesso = $.parseJSON(data)["sucesso"];

        if($sucesso)
        {
            $('#'+idUl).fadeOut();//remove o registro da lista
        }
        else
        {
            console.log("Erro na exclusão");
        }
    }).fail(function(){
        console.log("Erro");
    });
});