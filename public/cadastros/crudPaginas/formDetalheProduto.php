<?php require_once("../../../_scripts/conexao/conexaoVenda.php") ?>
<?php
    session_start();
    // Consulta a tabela de transportadoras
    $tr = "SELECT * FROM produto ";
    if(isset($_GET["codigo"]) ) {
        $id = $_GET["codigo"];
        $tr .= "WHERE codigo = {$id} ";
    } else {
        $tr .= "WHERE codigo = 45 ";
    }

    // cria objeto com dados da transportadora
    $conProduto = mysqli_query($conecta,$tr);
    if(!$conProduto) {
        die("Erro na consulta");
    }
    $infoProduto = mysqli_fetch_assoc($conProduto);

    // consulta aos estados
    $fornecedores = "SELECT * ";
    $fornecedores .= "FROM fornecedor ";
    $listaFornecedores = mysqli_query($conecta, $fornecedores);
    if(!$listaFornecedores) {
       die("erro no banco"); 
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administrador - Detalhe</title>
        
        <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="../../../_css/formNovoProduto.css" rel="stylesheet">
        <!-- estilo form -->
        <link href="../../../_css/estilo.css" rel="stylesheet">
    </head>
    <body>
        <?php include_once("../../principal/_incluir/topo.php"); ?>
        
        <main>
            <div id="formulario">
                <h2>Administrador - Detalhe</h2>
                <p><strong><?php echo "Giovanni Moraes de Oliveira Leite"/*$infoAdm["nome"]*/ ?></strong></p>

                <div class="container">
                    <form>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["codigo"]  ?>" name="codigo" id="codigo" placeholder="Código" disabled/>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label for="nome">Nome*</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["nome"]  ?>" name="nome" id="nome" title="Campo Obrigatório" placeholder="Nome" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="codigoFornecedor">Código do Fornecedor*</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["codFornecedor"]  ?>" name="codigoFornecedor" id="codigoFornecedor" title="Campo Obrigatório" placeholder="Código" disabled/>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label for="fornecedor">Nome do Fornecedor*</label>
                                    <select class="form-control" name="fornecedor" id="fornecedor" title="Campo Obrigatório" disabled>
                                        <?php 
                                            $meuFornecedor = $infoProduto["codFornecedor"];
                                            while($linha = mysqli_fetch_assoc($listaFornecedores)) {
                                                $fornecedorPrincipal = $linha["codFornecedor"];
                                                if($meuFornecedor == $fornecedorPrincipal) {
                                        ?>
                                            <option value="<?php echo $linha["codFornecedor"] ?>" selected>
                                                <?php echo $linha["nome"] ?>
                                            </option>
                                        <?php
                                                } else {
                                        ?>
                                            <option value="<?php echo $linha["codFornecedor"] ?>" >
                                                <?php echo $linha["nome"] ?>
                                            </option>                        
                                        <?php 
                                                }
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
                                    <textarea class="form-control" name="descricao" id="descricao" maxlength="255" placeholder="Descrição" title="Campo Obrigatório" disabled><?php echo $infoProduto["descricao"]  ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="preco">Preço*</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["preco"]  ?>" name="preco" id="preco" placeholder="Preço" title="Campo Obrigatório" disabled/>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="quantidade">Quantidade*</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["quantidade"]  ?>" name="quantidade" id="quantidade" placeholder="Quantidade" title="Campo Obrigatório" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fotoGrande">Foto Grande*</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["fotoGrande"]  ?>" name="fotoGrande" id="fotoGrande" placeholder="Endereço da foto Grande" title="Campo Obrigatório" disabled/>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fotoPequena">Foto Pequena*</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["fotoPequena"]  ?>" name="fotoPequena" id="fotoPequena" placeholder="Endereço da foto Pequena" title="Campo Obrigatório" disabled/>
                                </div>
                            </div>
                        </div>


                        <div class="row" id="crud">
                            <div class="col-12">
                                <div class="form-group">
                                    <a href="formAtualizarProduto.php?&codigo='<?php echo $infoProduto["codigo"] ?>'" class="btn btn-success btn-block" id="modificar">Modificar</a>
                                </div>
                            </div>
                        </div>

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
    // Fechar conexao
    mysqli_close($conecta);
?>