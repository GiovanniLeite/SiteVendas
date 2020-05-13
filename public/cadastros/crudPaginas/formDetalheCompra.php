<?php require_once("../../../_scripts/conexao/conexaoVenda.php") ?>
<?php
    session_start();

    /********Usuário**********************************/
    // Consulta a tabela de usuario
     if(isset($_SESSION["user_portal"]))
        {
            $selectUsuario = "SELECT * FROM usuario ";
            $selectUsuario .= "WHERE codigo = {$_SESSION["user_portal"]} ";

            // cria objeto com dados do usuario
            $conUsuario = mysqli_query($conecta,$selectUsuario);
            if(!$conUsuario) 
            {
                die("Erro na consulta - Usuário");
            }

            $infoUsuario = mysqli_fetch_assoc($conUsuario);

            if($infoUsuario["adm"] != 0)
            {
                header("location:../../principal/login.php");
            }
        }
        else
        {
            header("location:../../principal/login.php");
        }
    /********Usuário**********************************/
    /**************Transacao*******************/
    // Consulta a tabela de 
    $tr = "SELECT * FROM transacao ";
    if(isset($_GET["codigo"]) ) 
    {
        $id = $_GET["codigo"];
        $tr .= "WHERE codigo = {$id} ";
    } 
    else 
    {
        header("location:../../principal/login.php");
    }


    $conTran = mysqli_query($conecta,$tr);
    if(!$conTran) {
        die("Erro na consulta Transacao");
    }
    $transacao = mysqli_fetch_assoc($conTran);
    /************Transacao********************/

    /*************Produtos**********************/
    $itens = "SELECT * FROM produtovenda ";
    $itens .= "WHERE pedido = '";
    $itens .= $transacao["pedido"] . "'";

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
                            <li><img src="<?php echo "../../../_img/produtos/preview/" . $linha["foto"] ?>"; id="fotoProduto"></li>
                            <li><p><?php echo $linha["nome"] ?></p></li>
                            <li><p><?php echo $linha["quantidade"] ?></p></li>
                            <li><p>R$ <?php echo $linha["valor"] ?></p></li>
                        </ul>
                        <?php
                            }
                        ?>
                    </div>
                    <ul id="valorTotal">
                        <li> Total da Compra: R$ <?php echo $transacao["totalVenda"] ?></li>
                    </ul>
                </div>
                <p><a href="../formCliente.php"><i class="fas fa-undo-alt"></i> Voltar</a></p>
            </div>
        </main>
        
        <?php include_once("../../principal/_incluir/rodape.php"); ?>
        
        <script src="../../../_scripts/js/topo2.js"></script>
        
        <script src="../../../_scripts/js/sair2.js"></script>
    </body>
</html>

<?php
    // Fechar as queries
    mysqli_free_result($conUsuario);
    mysqli_free_result($conTran);
    mysqli_free_result($conProduto);

    // Fechar conexao
    mysqli_close($conecta);
?>