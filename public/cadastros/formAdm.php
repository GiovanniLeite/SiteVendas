<?php require_once("../../_scripts/conexao/conexaoVenda.php") ?>
<?php
    session_start();
    /**********ADM****************/
    // tabela de adm
    $selectAdm = "SELECT * FROM usuario ";
    if(isset($_GET["codigo"]) ) {
        $cod = $_GET["codigo"];
        $selectAdm .= "WHERE codigo = {$cod} ";
    } else {
        $selectAdm .= "WHERE codigo= 1 ";
    }

    // cria objeto com dados do usuario
    $conAdm = mysqli_query($conecta,$selectAdm);
    if(!$conAdm) {
        die("Erro na consulta");
    }

    $infoAdm = mysqli_fetch_assoc($conAdm);
    /***********ADM***************/

    /***********Produtos****************/
    // tabela de produtos
    $selectProduto = "SELECT * FROM produto ";
    if ( isset($_GET["produto"]) ) {
        $nomeProduto = $_GET["produto"];
        $selectProduto .= "WHERE nome LIKE '%{$nomeProduto}%' ";
    }
    // cria objeto com dados dos produtos
    $conProduto = mysqli_query($conecta,$selectProduto);
    if(!$conProduto) {
        die("Erro na consulta");
    }

    /* $listaProduto = mysqli_fetch_assoc($conProduto); */
    /***********Produtos***************/
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administrador</title>
        
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="../../_css/adm.css" rel="stylesheet">
        <!-- estilo form -->
        <link href="../../_css/estilo.css" rel="stylesheet">
        
        <script src="../../_scripts/js/jquery.js"></script>
        
        <style>
            header {
                height:66px;
            }
        </style>
    </head>
    <body>
        <?php include_once("../principal/_incluir/topo.php"); ?>
        
        <div id="main">
            <div id="crud">
                <h2>Administrador</h2>
                <p><strong><?php echo $infoAdm["nome"] ?></strong></p>

                <div id="compras">
                    <form>
                        <input type="text" name="produto" id="produto" placeholder="Procurar" title="Procurar">
                        <input class="btn-default" name="botaoProcurar" id="botaoProcurar" type="submit" value="Procurar" title="Procurar">
                    </form>
                    <ul id="titulo">
                        <li>Código</li>
                        <li>Produto</li>
                    </ul>
                    <div id="produto">
                        <?php
                            while($linha = mysqli_fetch_assoc($conProduto)) {
                        ?>
                        <ul title="<?php echo $linha["codigo"] ?>">
                            <li><?php echo $linha["codigo"] ?></li>
                            <li><?php echo $linha["nome"] ?></li>
                            <li><a href="crudPaginas/formDetalheProduto.php?&codigo='<?php echo $linha["codigo"] ?>'" class="botao">Detalhes</a></li>
                            <li><a href="crudPaginas/formAtualizarProduto.php?&codigo='<?php echo $linha["codigo"] ?>'" class="botao">Atualizar</a></li>
                            <li><a href="" class="botao" id="excluir">Excluir</a></li>
                        </ul>
                        <?php
                            }
                        ?>
                    </div>
                    <ul id="rodape">
                        <li><a href="crudPaginas/formNovoProduto.php" class="botao">+ Novo</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <?php include_once("../principal/_incluir/rodape.php"); ?>
        
        <script src="../../_scripts/js/adm/excluirProduto.js"></script>
        
        <script src="../../_scripts/js/topo.js"></script>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>