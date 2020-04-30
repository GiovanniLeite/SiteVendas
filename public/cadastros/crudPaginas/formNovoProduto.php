<?php require_once("../../../_scripts/conexao/conexaoVenda.php") ?>
<?php include_once("../../../_scripts/crud/adm/funcoes.php") ?>
<?php
    session_start();
    // Consulta a tabela de fornecedores
    $selectFornecedor = "SELECT * FROM fornecedor ";
    $conFornecedor = mysqli_query($conecta,$selectFornecedor);
    if(!$conFornecedor) {
        die("Erro na consulta");
    }

    /*********************************************/
    // conferir se a navegacao veio pelo preenchimento do formulario
    if(isset($_POST["nome"])) {
        
        $resultado1 = publicarImagem($_FILES['fotoGrande']);
        $resultado2 = publicarImagem($_FILES['fotoPequena']);
        $mensagem1 = $resultado1[0]; 
        $mensagem2 = $resultado2[0];

        $nome = $_POST['nome'];
        $codigoFornecedor = $_POST['codigoFornecedor'];
        $fornecedor = $_POST['fornecedor'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];

        $imagemGrande  = $resultado1[1];
        $imagemPequena = $resultado2[1];

        // Insercao no banco
        $inserir = "INSERT INTO produto ";
        $inserir .="(nome,preco,descricao,fotoPequena,fotoGrande,quantidade,codFornecedor,nomeFornecedor) ";
        $inserir .="VALUES ";
        $inserir .="('$nome','$preco','$descricao','$imagemPequena','$imagemGrande','$quantidade','$codigoFornecedor','$fornecedor')";
        
        $operacaoInserir = mysqli_query($conecta,$inserir);
        if($operacaoInserir) {
            $mensagem = "Cadastro inserido com sucesso.";
        } else {
            $mensagem = "Falha no sistema, tente mais tarde.";
        }
        
        unset($_POST);

    }
    /*********************************************/

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administrador - Inserir</title>
        
        <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="../../../_css/formNovoProduto.css" rel="stylesheet">
        <!-- estilo form -->
        <link href="../../../_css/estilo.css" rel="stylesheet">
        
        <script src="../../../_scripts/js/jquery.js"></script>
    </head>
    <body>
        <?php include_once("../../principal/_incluir/topo.php"); ?>
        
        <main>
            <div id="formulario">
                <h2>Administrador - Inserir</h2>
                <p><strong><?php echo "Giovanni Moraes de Oliveira Leite"/*$infoAdm["nome"]*/ ?></strong></p>

                <div class="container">
                    <form id="formularioNovoProduto" action="formNovoProduto.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input class="form-control" type="text" name="codigo" id="codigo" placeholder="Código" disabled/>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label for="nome">Nome*</label>
                                    <input class="form-control" type="text" name="nome" id="nome" title="Campo Obrigatório" placeholder="Nome"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="codigoFornecedor">Código do Fornecedor*</label>
                                    <input class="form-control" type="text" name="codigoFornecedor" id="codigoFornecedor" title="Campo Obrigatório" placeholder="Código"/>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label for="fornecedor">Nome do Fornecedor*</label>
                                    <select class="form-control" name="fornecedor" id="fornecedor" title="Campo Obrigatório">
                                        <?php
                                            while($linha = mysqli_fetch_assoc($conFornecedor)) {
                                        ?>
                                            <option value="<?php echo $linha["nome"];  ?>">
                                                <?php echo $linha["nome"];  ?>
                                            </option>
                                        <?php
                                            }
                                        ?> 
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="descricao">Descrição*</label>
                                    <textarea class="form-control" name="descricao" id="descricao" maxlength="255" placeholder="Descrição" title="Campo Obrigatório"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="preco">Preço*</label>
                                    <input class="form-control" type="text" name="preco" id="preco" placeholder="Preço" title="Campo Obrigatório"/>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="quantidade">Quantidade*</label>
                                    <input class="form-control" type="text" name="quantidade" id="quantidade" placeholder="Quantidade" title="Campo Obrigatório"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">

                                    <label for="fotoGrande">Foto Grande*</label>
                                    <input type="file" name="fotoGrande" id="fotoGrande" title="Campo Obrigatório">
                                    <span class="resposta">
                                        <?php
                                            if( isset($mensagem1) ) {
                                                echo "<p>" . $mensagem1 . "</p>";
                                            }    
                                        ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fotoPequena">Foto Pequena*</label>
                                    <input type="file" name="fotoPequena" id="fotoPequena" title="Campo Obrigatório">
                                    <span class="resposta">
                                        <?php
                                            if( isset($mensagem2) ) {
                                                echo "<p>" . $mensagem2 . "</p>";
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-success btn-block" type="submit" name="inserirProduto" id="inserirProduto">Inserir Produto</button>
                                </div>
                            </div>
                        </div>

                        <?php
                            if( isset($mensagem) ) {
                                echo "<p>" . $mensagem . "</p>";
                            }
                        ?>

                    </form>

                </div>
            </div>
        </main>
        
        <?php include_once("../../principal/_incluir/rodape.php"); ?>
        
        <script src="../../../_scripts/js/topo2.js"></script>
        
        <script src="../../../_scripts/js/sair2.js"></script>
    </body>
</html>

<?php
    // Fechar as queries
    mysqli_free_result($conFornecedor);
?>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>