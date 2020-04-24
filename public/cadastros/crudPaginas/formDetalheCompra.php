<?php require_once("../../../_scripts/conexao/conexaoVenda.php") ?>
<?php
    session_start();
    /**************Transacao*******************/
    // Consulta a tabela de 
    $tr = "SELECT * FROM transacao ";
    if(isset($_GET["codigo"]) ) {
        $id = $_GET["codigo"];
        $tr .= "WHERE codigo = {$id} ";
    } else {
        $tr .= "WHERE codigo = 1 ";
    }


    $conTran = mysqli_query($conecta,$tr);
    if(!$conTran) {
        die("Erro na consulta Transacao");
    }
    $transacao = mysqli_fetch_assoc($conTran);
    /************Transacao********************/

    /*************Produtos**********************/
    $itens = "SELECT * FROM produtovenda ";
    $itens .= "WHERE pedido = ";
    $itens .= $transacao["pedido"];

    // cria objeto com dados da 
    $conProduto = mysqli_query($conecta,$itens);
    /*************Produtos**********************/

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Compras - Detalhe</title>
        
        <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="../../../_css/formDetalheCompra.css" rel="stylesheet">
        <!-- estilo form -->
        <link href="../../../_css/estilo.css" rel="stylesheet">
    </head>
    <body>
        <?php include_once("../../principal/_incluir/topo.php"); ?>
        
        <main>
            <div id="detalheCliente">
                <h2>Cliente - Detalhe</h2>
                <p><strong><?php echo "Transação código: " . $transacao["codigo"] ?></strong></p>

                <div id="compras">
                    <ul id="titulo">
                        <li><p>Foto</p></li>
                        <li><p>Nome</p></li>
                        <li><p>Quantidade</p></li>
                        <li><p>Valor</p></li>
                    </ul>
                    <div id="listaProduto">
                        <?php
                            while($linha = mysqli_fetch_assoc($conProduto)) {
                        ?>
                        <ul title="<?php echo $linha["codigo"] ?>">
                            <li><img src="../../../_img/VENDAS.png"; id="fotoProduto"><?php /*echo "."/*$linha["foto"]*/ ?></li>
                            <li><p><?php echo $linha["nome"] ?></p></li>
                            <li><p><?php echo $linha["quantidade"] ?></p></li>
                            <li><p><?php echo $linha["valor"] ?></p></li>
                        </ul>
                        <?php
                            }
                        ?>
                    </div>
                    <ul id="valorTotal">
                        <li> Total da Compra: <?php echo $transacao["totalVenda"] ?></li>
                    </ul>
                </div>
            </div>
        </main>
        
        <?php include_once("../../principal/_incluir/rodape.php"); ?>
        
        <script src="../../../_scripts/js/topo2.js"></script>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>