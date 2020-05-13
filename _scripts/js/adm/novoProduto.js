$('#formularioNovoProduto').submit(function(e) {
    e.preventDefault();
    $("#janelaConfirmar").modal('hide');

    //pegando valores dos campos
    var nome = $('#nome').val().trim();
    var fornecedor = $('#fornecedor').val().trim();
    var descricao = $('#descricao').val().trim();
    var preco = $('#preco').val().trim();
    var quantidade = $('#quantidade').val().trim();
    
    var foto1 = $('#fotoGrande1').val().trim();
    var foto2 = $('#fotoGrande2').val().trim();
    var foto3 = $('#fotoGrande3').val().trim();
    var foto4 = $('#fotoGrande4').val().trim();
    var foto5 = $('#fotoPequena1').val().trim();
    var foto6 = $('#fotoPequena2').val().trim();
    var foto7 = $('#fotoPequena3').val().trim();
    var foto8 = $('#fotoPequena4').val().trim();
    
    //console.log(foto);
    
    //Validacao de campos
    if(nome == "" || fornecedor == "" || descricao == "" || preco == "" || quantidade == "" || foto1 == "" || foto2 == "" || foto3 == "" || foto4 == "" || foto5 == "" || foto6 == "" || foto7 == "" || foto8 == "")
    { 
        alert("Um ou mais campos obrigatórios permanecem em branco.");
    }
    else
    {
        var formData = new FormData(document.getElementById("formularioNovoProduto"));
        var retorn = inserirFormulario(formData);
    }
    
});

function inserirFormulario(formData) {
    $.ajax({
        type:"POST",
        data:formData,
        url:"../../../_scripts/crud/adm/novoProduto.php",
        processData: false,
        contentType: false,
        async:true
    }).done(function(data){

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
            $('#mensagem p').html($mensagem);   
            $('#mensagem1 p').html($mensagem1); 
            $('#mensagem2 p').html($mensagem2); 
            $('#mensagem3 p').html($mensagem3); 
            $('#mensagem4 p').html($mensagem4); 
            $('#mensagem5 p').html($mensagem5); 
            $('#mensagem6 p').html($mensagem6); 
            $('#mensagem7 p').html($mensagem7); 
            $('#mensagem8 p').html($mensagem8); 
        }
        else//aq e quando houve uma falha no momento da operacao 
        {
            $('#mensagem p').html($mensagem);   
            $('#mensagem1 p').html($mensagem1); 
            $('#mensagem2 p').html($mensagem2); 
            $('#mensagem3 p').html($mensagem3); 
            $('#mensagem4 p').html($mensagem4); 
            $('#mensagem5 p').html($mensagem5); 
            $('#mensagem6 p').html($mensagem6); 
            $('#mensagem7 p').html($mensagem7); 
            $('#mensagem8 p').html($mensagem8);
        }
    }).fail(function(){//essa falha ele nem conseguiu se comunicar com a pagina atualizar.php
         $('#mensagem p').html("Erro no sistema, tente mais tarde."); 
    }).always(function(){
         $('#mensagem').show(); 
    })
}