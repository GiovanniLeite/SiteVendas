$('#formExcluir').submit(function (e) {
    e.preventDefault();

    $("#janelaConfirmar2").modal('hide');

    //pegando valores dos campos
    var us = $('#usuario').val().trim()
    var sa = $('#senhaExcluir').val().trim()

    //Validacao de campos
    if (us == "" || sa == "") {
        alert("Usuário e/ou Senha estão vazios.");
    } else {
        var fl = $(this);
        var ret = excluir(fl);
    }

})

function excluir(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        url: "../../_scripts/crud/cliente/excluir.php",
        async: true
    }).done(function (data) {
        console.log(data);

        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];

        if ($sucesso) {
            alert("Conta excluída com sucesso, você sera redirecionado.");
            window.location.href = "../principal/sair.php";
        } else //aq e quando houve uma falha no momento da operacao 
        {
            $('#mensagemExcluir p').html($mensagem);
        }

    }).fail(function () { //essa falha ele nem conseguiu se comunicar com a pagina
        $('#mensagemExcluir p').html("Erro no sistema, tente mais tarde.");
    }).always(function () {
        $('#mensagemExcluir').show();
    })
}