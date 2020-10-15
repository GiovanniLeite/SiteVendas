<?php require_once("../../_scripts/conexao/conexaoVenda.php") ?>
<?php
session_start();
/**********ADM****************/
// tabela de adm
if (isset($_SESSION["user_portal"])) {
    $selectAdm = "SELECT * FROM usuario ";
    $selectAdm .= "WHERE codigo = {$_SESSION["user_portal"]} ";

    // cria objeto com dados do usuario
    $conAdm = mysqli_query($conecta, $selectAdm);
    if (!$conAdm) {
        die("Erro na consulta - Usuário");
    }

    $infoAdm = mysqli_fetch_assoc($conAdm);

    if ($infoAdm["adm"] != 1) {
        header("location:../principal/login.php");
    }
} else {
    header("location:../principal/login.php");
}
/***********ADM***************/

/***********Produtos****************/
// tabela de produtos
$selectProduto = "SELECT * FROM produto ";
if (isset($_GET["produto"])) {
    $nomeProduto = $_GET["produto"];
    $selectProduto .= "WHERE nome LIKE '%{$nomeProduto}%' ";
}
// cria objeto com dados dos produtos
$conProduto = mysqli_query($conecta, $selectProduto);
if (!$conProduto) {
    die("Erro na consulta - Produto");
}
/***********Produtos***************/
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrador</title>

    <script src="../../_scripts/js/jquery.js"></script>

    <link href="../../_css/adm.css" rel="stylesheet">
    <link href="../../_css/estilo.css" rel="stylesheet">
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once("../principal/_incluir/topo.php"); ?>

    <main>
        <div id="crud">
            <h2>Administrador</h2>
            <p><strong><?php echo $infoAdm["nome"] ?></strong></p>

            <div id="gerenciar">
                <form>
                    <div class="row">
                        <input class="form-control" type="text" name="produto" id="produto" placeholder="Procurar" title="Procurar por nome">
                        <button class="btn btn-success btn-block" name="botaoProcurar" id="botaoProcurar" type="submit" title="Procurar">Procurar</button>
                    </div>
                </form>
                <ul id="titulo">
                    <li>Código</li>
                    <li>Produto</li>
                </ul>
                <div id="produto">
                    <?php
                    $cont = 0;
                    while ($linha = mysqli_fetch_assoc($conProduto)) {
                        $cont++;
                    ?>
                        <ul id="<?php echo 'ul' . $cont ?>">
                            <li><?php echo $linha["codigo"] ?></li>
                            <li><?php echo $linha["nome"] ?></li>
                            <li><a href="crudPaginas/formDetalheProduto.php?&codigo='<?php echo $linha["codigo"] ?>'" class="botao">Detalhes</a></li>
                            <li><a href="crudPaginas/formAtualizarProduto.php?&codigo='<?php echo $linha["codigo"] ?>'" class="botao">Atualizar</a></li>
                            <li><button id="excluir" class="botao" data-toggle="modal" data-target="#janelaConfirmar" onclick="teste(<?php echo $linha["codigo"] ?>,<?php echo $cont ?>)">Excluir</button>
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
        <!-- MODAL -->
        <section id="janelaConfirmar" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 rounded-0">
                        <h5 class="modal-title">Excluir o produto?</h5>
                        <button class="close cp" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="col mt-sm-4">
                            <button id="botaoNao" data-dismiss="modal" class="btn btn-block">Não</button>
                        </div>
                        <div class="col mt-2 mt-sm-4">
                            <button id="botaoSim" data-dismiss="modal" class="btn btn-block">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- MODAL -->
    </main>

    <?php include_once("../principal/_incluir/rodape.php"); ?>

    <script src="../../_scripts/js/adm/excluirProduto.js"></script>

    <script src="../../_scripts/js/topo.js"></script>

    <script src="../../_scripts/js/sair.js"></script>

    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Fechar as queries
mysqli_free_result($conAdm);
mysqli_free_result($conProduto);

// Fechar conexao
mysqli_close($conecta);
?>