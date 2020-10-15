$('#formAtualizarCadastro').submit(function (e) {
    e.preventDefault();
    $("#janelaConfirmarCadastro").modal('hide');

    //pegando valores dos campos
    var nom = $('#nome').val().trim();
    var cp = $('#cpf').val().trim();
    var r = $('#rg').val().trim();
    var telefon = $('#telefone').val().trim();
    var celula = $('#celular').val().trim();
    var emai = $('#email').val().trim();
    var ce = $('#cep').val().trim();
    var enderec = $('#endereco').val().trim();
    var bairr = $('#bairro').val().trim();
    var cidad = $('#cidade').val().trim();
    var estad = $('#estado').val().trim();

    //Validacao de campos
    if (nom == "" || cp == "" || r == "" || telefon == "" || celula == "" || emai == "" || ce == "" || enderec == "" || bairr == "" || cidad == "" || estad == "") {
        alert("Campos obrigatórios estão vazios.");
    } else {
        var formulario = $(this);
        var retorno = alterarFormulario(formulario);
    }
});

function alterarFormulario(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        url: "../../_scripts/crud/cliente/atualizarCadastro.php",
        async: true
    }).done(function (data) {
        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];
        $mensagem1 = $.parseJSON(data)["mensagem1"]

        if ($sucesso) {
            console.log($mensagem);
            $('#mensagem p').html($mensagem1);
        } else //aq e quando houve uma falha no momento da operacao 
        {
            console.log($mensagem);
            $('#mensagem p').html($mensagem1);
        }
    }).fail(function () { //essa falha ele nem conseguiu se comunicar com a pagina
        $('#mensagem p').html("Erro no sistema, tente mais tarde.");
    }).always(function () {
        $('#mensagem').show();
    })
}