var cProduto = 0;
var idUl = "";

function teste(codigoProduto,numeroUl)
{
    var codUl = "ul" + numeroUl;
    
    idUl = "ul" + numeroUl;
    cProduto = codigoProduto;
}

$('#botaoSim').click(function(e){
    e.preventDefault();
    
    $.ajax({
        type:"POST",
        data:"codigo=" + cProduto,
        url:"../../_scripts/crud/adm/excluirProduto.php",
        async:true

    }).done(function(data){
        
        console.log(data);
        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];
        $mensagem1 = $.parseJSON(data)["mensagem1"];
        $mensagem2 = $.parseJSON(data)["mensagem2"];
        $mensagem3 = $.parseJSON(data)["mensagem3"];
        $mensagem4 = $.parseJSON(data)["mensagem4"];
        $mensagem5 = $.parseJSON(data)["mensagem5"];
        $mensagem6 = $.parseJSON(data)["mensagem6"];
        $mensagem7 = $.parseJSON(data)["mensagem7"];
        $mensagem8 = $.parseJSON(data)["mensagem8"];

        if($sucesso)
        {
            $('#'+idUl).fadeOut();//remove o registro da lista
            console.log("Apagou produto");
            console.log($mensagem1);
            console.log($mensagem2);
            console.log($mensagem3);
            console.log($mensagem4);
            console.log($mensagem5);
            console.log($mensagem6);
            console.log($mensagem7);
            console.log($mensagem8);
        }
        else
        {
            console.log("Erro na exclusão do produto");
            console.log($mensagem);
            console.log($mensagem1);
            console.log($mensagem2);
            console.log($mensagem3);
            console.log($mensagem4);
            console.log($mensagem5);
            console.log($mensagem6);
            console.log($mensagem7);
            console.log($mensagem8);
        }
        
    }).fail(function(){
        console.log("Erro");
    });
});