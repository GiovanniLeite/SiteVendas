function finalizar(transacao,produtos) {
    
    $.ajax({
        type:"POST",
        url:"../../_scripts/crud/cliente/finalizarCompra.php",
        data:{tran:transacao,prod:produtos},
        async:true
    }).done(function(data){
        
        console.log(data);

        alert("Compra realizada com sucesso, em breve informações serão enviadas para o seu email.");
        
    }).fail(function(){//essa falha ele nem conseguiu se comunicar com a pagina atualizar.php
         alert("Erro no sistema, tente mais tarde.");
    })
}