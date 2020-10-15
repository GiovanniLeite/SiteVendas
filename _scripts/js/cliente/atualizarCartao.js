$('#formAtualizarCartao').submit(function (e) {
    e.preventDefault();
    $("#janelaConfirmarCartao").modal('hide');

    //pegando valores dos campos
    var numeroC = $('#numeroCartao').val().trim();
    var nomeT = $('#nomeTitular').val().trim();
    var va = $('#validade').val().trim();
    var ban = $('#bandeira').val().trim();
    var codS = $('#codigoSeguranca').val().trim();
    var tip = $('#tipo').val().trim();

    //Validacao de campos
    if (numeroC == "" || nomeT == "" || va == "" || ban == "" || codS == "" || tip == "") {
        alert("Um ou mais campos obrigatórios estão vazios.");
    } else {
        var form = $(this);
        var retorn = atualizarCartao(form);
    }
});

function atualizarCartao(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        url: "../../_scripts/crud/cliente/atualizarCartao.php",
        async: true
    }).done(function (data) {
        console.log(data);

        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];

        if ($sucesso) {
            $('#mensagemCartao p').html($mensagem);
            location.reload();
        } else //aq e quando houve uma falha no momento da operacao 
        {
            $('#mensagemCartao p').html($mensagem);
        }
    }).fail(function () { //essa falha ele nem conseguiu se comunicar com a pagina
        $('#mensagemCartao p').html("Erro no sistema, tente mais tarde.");
    }).always(function () {
        $('#mensagemCartao').show();
    })
}