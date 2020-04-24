<?php require_once("../../_scripts/conexao/conexaoVenda.php"); ?>
<?php
    session_start();
    /*
    if(!isset($_SESSION["user_portal"]))
    {
       header("location:login.php");
    }*/
    

    /* USAR ESTE
    if ( isset($_GET["codigo"]) ) {
        $produto_id = $_GET["codigo"];
    } else {
        header("Location:login.php");
    }*/
    
    $selectAdm = "SELECT * FROM usuario ";
    if(isset($_GET["codigo"]) ) {
        $cod = $_GET["codigo"];
        $selectAdm .= "WHERE codigo = {$cod} ";
    } else {
        $selectAdm .= "WHERE codigo= 1 ";
    }

    // Consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= "FROM produto ";
    if(isset($_GET["codigo"]) ) {
        $produto_id = $_GET["codigo"];
        $consulta .= "WHERE codigo = {$produto_id} ";
    } else {
        $consulta .= "WHERE codigo= 47 ";
    }
    $detalhe = mysqli_query($conecta,$consulta);

    // Testar erro
    if ( !$detalhe ) {
        die("Falha no Banco de dados");
    } else {
        $dados_detalhe = mysqli_fetch_assoc($detalhe);
        $codigo     = $dados_detalhe["codigo"];
        $nomeproduto    = $dados_detalhe["nome"];
        $descricao      = $dados_detalhe["descricao"];
        $preco  = $dados_detalhe["preco"];
        $estoque        = $dados_detalhe["quantidade"];
        $imagemgrande   = $dados_detalhe["fotoGrande"];
    }

    /********Transacao**********************************/
    
    // Consulta a tabela de 
    $selectCarrinho = "SELECT * FROM transacaotemp ";
    $selectCarrinho .= "WHERE codCliente = 2 ";
    /***refazer quando começar a passar o codigo do cliente praca
    if(isset($_GET["codigo"]) ) {
        $codCliente = $_GET["codigo"];
        $selectCarrinho .= "WHERE codCliente = {$cod} ";
    } else {
        $selectCarrinho .= "WHERE codCliente = 2 ";
    }
    ***/
    // cria objeto com dados do
    $conCarrinho = mysqli_query($conecta,$selectCarrinho);
    if(!$conCarrinho) {
        die("Erro na consulta");
    }

    $infoCarrinho = mysqli_fetch_assoc($conCarrinho);

    /********Transacao**********************************/
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Detalhe</title>
        
        <!-- estilo -->
        <link href="../../_css/estilo.css" rel="stylesheet">
        <link href="../../_css/produto_detalhe.css" rel="stylesheet">
        
        <script src="../../_scripts/js/jquery.js"></script>
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        
        <main>  
            <div id="detalhe_produto">
                <ul>
                    <li class="imagem"><img src="<?php echo $imagemgrande ?>"></li>
                    <li><h2><?php echo $nomeproduto ?></h2></li>
                    <li><b>Descri&ccedil;&atilde;o: </b><?php echo $descricao ?></li>
                    <li><b>Pre&ccedil;o Unit&aacute;rio: </b><?php echo $preco ?></li>
                    <li><b>Estoque: </b><?php echo $estoque ?></li>
                    <button name="comprar" id="comprar" onclick='comprar(7,<?php echo $codigo; ?>,"<?php echo $nomeproduto; ?>","<?php echo $preco; ?>","foto","<?php echo $infoCarrinho["pedido"]; ?>")'>Comprar</button>
                </ul>
               
            </div>
        </main>

        <?php include_once("_incluir/rodape.php"); ?>
        
        <script>
            if(adm == 1)
            {
                document.getElementById("comprar").disabled = true;
            }
        </script>
        
        <script src="../../_scripts/js/cliente/comprar.js">
        </script>
        
        <script src="../../_scripts/js/topo.js">
        </script>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>