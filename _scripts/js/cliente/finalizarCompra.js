function finalizar(transacao, produtos) {

    if (transacao == "" || produtos == "") {
        alert("Nenhum pedido para finalizar.");
    } else {
        $.ajax({
            type: "POST",
            url: "../../_scripts/crud/cliente/finalizarCompra.php",
            data: {
                tran: transacao,
                prod: produtos
            }
        }).done(function (data) {

            console.log(data);
            alert("Compra realizada com sucesso, em breve informações serão enviadas para o seu email.");
            location.reload();

        }).fail(function () { //essa falha ele nem conseguiu se comunicar com a pagina
            alert("Erro no sistema, tente mais tarde.");
        })
    }
}