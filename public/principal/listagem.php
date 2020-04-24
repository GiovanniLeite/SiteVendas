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
        
        
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- estilo -->
        <link href="../../_css/produtos.css" rel="stylesheet">
        <link href="../../_css/produto_pesquisa.css" rel="stylesheet">
        <link href="../../_css/estilo.css" rel="stylesheet">
        
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        
        <main>
            <div id="janela_pesquisa">
                <form action="listagem.php" method="get">
                    <div class="row">
                        <input type="text" name="produto" placeholder="Pesquisar" title="Pesquisar">
                        <button name="botaoProcurar" id="botaoProcurar" type="submit" title="Procurar">Procurar</button>
                    </div>
                </form>
            </div>
            
            <div id="listagem_produtos"> 
            <?php
                while($linha = mysqli_fetch_assoc($resultado)) {
            ?>
                <ul>
                    <li class="imagem"><img src="<?php echo $linha["fotoPequena"] ?>"></li>
                    <li><h3><?php echo $linha["nome"] ?></h3></li>
                    <li>Quantidade : <?php echo $linha["quantidade"] ?></li>
                    <li>
                        <a href="detalhe.php?codigo=<?php echo $linha['codigo'] ?>">Apenas : <?php echo $linha["preco"] ?></a>
                    </li>
                </ul>
             <?php
                }
            ?>           
            </div>
        </main>

        <?php include_once("_incluir/rodape.php"); ?>  
        
        <script src="../../_scripts/js/topo.js">
        </script>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>