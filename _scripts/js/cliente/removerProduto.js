function remover(posicao, produtoRemovido, transac) {

    $.ajax({
        type: "POST",
        url: "../../_scripts/crud/cliente/removerProduto.php",
        data: {
            prodR: produtoRemovido,
            tranc: transac
        }
    }).done(function (data) {
        console.log(data);
        $sucesso = $.parseJSON(data)["sucesso"];
        $mensagem = $.parseJSON(data)["mensagem"];
        $mensagem1 = $.parseJSON(data)["mensagem1"];

        console.log($mensagem);

        if ($sucesso) {
            $('#ul' + posicao).fadeOut();
            location.reload();
        } else {
            alert("Erro no sistema, tente mais tarde.");
        }
    }).fail(function () {
        alert("Erro no sistema, tente mais tarde.");
    })
}