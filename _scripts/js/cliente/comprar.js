function comprar(quantidade,codProduto,nome,valor,foto,pedido) {
    
    console.log("Atributos: ",quantidade,codProduto,nome,valor,foto,pedido);
    
    $.ajax({
        type:"POST",
        url:"../../_scripts/crud/cliente/comprar.php",
        data:{quan:quantidade,cod:codProduto,nom:nome,val:valor,ft:foto,ped:pedido},
        async:true
    }).done(function(data){
        
        console.log(data);

        alert("Produto adicionado ao carrinho.");
        
    }).fail(function(){//essa falha ele nem conseguiu se comunicar com a pagina atualizar.php
         alert("Erro no sistema, tente mais tarde.");
    })
}