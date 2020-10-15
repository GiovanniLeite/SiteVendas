$('#formEmail').submit(function (e) {
    e.preventDefault();
    $("#janelaConfirmarEmail").modal('hide');

    //pegando valores dos campos
    var em = $('#emailSeguranca').val().trim();

    //Validacao de campos
    if (em == "") {
        alert("Campo Email está vazio.");
    } else {
        var f = $(this);
        var r = atualizarEmail(f);
    }
})



function atualizarEmail(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        url: "../../_scripts/crud/cliente/atualizarEmail.php",
        async: true
    }).done(function (data) {
        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];
        $mensagem1 = $.parseJSON(data)["mensagem1"];

        if ($sucesso) {
            console.log($mensagem);
            $('#mensagemEmail p').html($mensagem1);
        } else //aq e quando houve uma falha no momento da operacao 
        {
            console.log($mensagem);
            $('#mensagemEmail p').html($mensagem1);
        }
    }).fail(function () { //essa falha ele nem conseguiu se comunicar com a pagina
        $('#mensagemEmail p').html("Erro no sistema, tente mais tarde.");
    }).always(function () {
        $('#mensagemEmail').show();
    })
}