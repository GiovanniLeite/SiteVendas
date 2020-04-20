<?php require_once("../../_scripts/conexao/conexaoVenda.php"); ?>
<?php
    session_start();
    /*
    if(!isset($_SESSION["user_portal"]))
    {
       header("location:login.php");
    }*/
    
    // Determinar localidade BR
    setlocale(LC_ALL, 'pt_BR');

    // Consulta ao banco de dados
    
    $produtos = "SELECT codigo, nome, quantidade, preco, fotoPequena ";
    $produtos .= "FROM produto ";
    if ( isset($_GET["produto"]) ) {
        $nome_produto = $_GET["produto"];
        $produtos .= "WHERE nome LIKE '%{$nome_produto}%' ";
    }
    $resultado = mysqli_query($conecta, $produtos);
    if(!$resultado) {
        die("Falha na consulta ao banco");   
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listagem</title>
        
        <!-- estilo -->
        <link href="../../_css/estilo.css" rel="stylesheet">
        <link href="../../_css/produtos.css" rel="stylesheet">
        <link href="../../_css/produto_pesquisa.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        
        <main>
            <div id="janela_pesquisa">
                <form action="listagem.php" method="get">
                    <input type="text" name="produto" placeholder="Pesquisa">
                    <input type="image"  src="assets/botao_search.png">
                </form>
            </div>
            
            <div id="listagem_produtos"> 
            <?php
                while($linha = mysqli_fetch_assoc($resultado)) {
            ?>
                <ul>
                    <li class="imagem">
                        <a href="detalhe.php?codigo=<?php echo $linha['codigo'] ?>">
                            <img src="<?php echo $linha["fotoPequena"] ?>">
                        </a>
                    </li>
                    <li><h3><?php echo $linha["nome"] ?></h3></li>
                    <li>Quantidade : <?php echo $linha["quantidade"] ?></li>
                    <li>Preço Unitário : <?php echo $linha["preco"] ?>
                </ul>
             <?php
                }
            ?>           
            </div>
            
            <a href="../cadastros/public/formAdm.php">Adm</a>
            <a href="../cadastros/public/formCliente.php">Cliente</a>
        </main>

        <?php include_once("_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>