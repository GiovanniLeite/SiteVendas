<?php require_once("../../../_scripts/conexao/conexaoVenda.php") ?>
<?php
    session_start();
    /**********ADM****************/
    // tabela de adm
    if(isset($_SESSION["user_portal"]))
    {
        $selectAdm = "SELECT * FROM usuario ";
        $selectAdm .= "WHERE codigo = {$_SESSION["user_portal"]} ";
        
        // cria objeto com dados do usuario
        $conAdm = mysqli_query($conecta,$selectAdm);
        if(!$conAdm) 
        {
            die("Erro na consulta - Usuário");
        }

        $infoAdm = mysqli_fetch_assoc($conAdm);
       
        if($infoAdm["adm"] != 1)
        {
            header("location:../../principal/login.php");
        }
    }
    else
    {
        header("location:../../principal/login.php");
    }
    /***********ADM***************/


    // Consulta a tabela de fornecedores
    $selectFornecedor = "SELECT * FROM fornecedor ";
    $conFornecedor = mysqli_query($conecta,$selectFornecedor);
    if(!$conFornecedor) 
    {
        die("Erro na consulta - Fornecedor");
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administrador - Inserir</title>
        
        <script src="../../../_scripts/js/jquery.js"></script>
        
        <link href="../../../_css/formProduto.css" rel="stylesheet">
        <link href="../../../_css/estilo.css" rel="stylesheet">
        <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php include_once("../../principal/_incluir/topo.php"); ?>
        
        <main>
            <div id="formulario">
                <h2>Administrador - Inserir</h2>
                <p><strong><?php echo $infoAdm["nome"] ?></strong></p>

                <div class="container">
                    <form id="formularioNovoProduto" enctype="multipart/form-data">
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
                                    <input class="form-control" type="text" name="nome" id="nome" maxlength="60" title="Campo Obrigatório" placeholder="Nome"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fornecedor">Nome do Fornecedor*</label>
                                    <select class="form-control" name="fornecedor" id="fornecedor" title="Campo Obrigatório">
                                        <?php
                                            while($linha = mysqli_fetch_assoc($conFornecedor)) 
                                            {
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
                                    <input class="form-control" type="text" name="preco" id="preco" maxlength="8" placeholder="Preço" title="Campo Obrigatório"/>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="quantidade">Quantidade*</label>
                                    <input class="form-control" type="text" name="quantidade" id="quantidade" maxlength="3" placeholder="Quantidade" title="Campo Obrigatório"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">

                                    <label for="fotoGrande1">Foto Grande 1*</label>
                                    <input type="file" name="fotoGrande1" id="fotoGrande1" title="Campo Obrigatório">
                                    <span class="resposta">
                                        <div id="mensagem1">
                                            <p></p>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fotoPequena1">Foto Pequena 1*</label>
                                    <input type="file" name="fotoPequena1" id="fotoPequena1" title="Campo Obrigatório">
                                    <span class="resposta">
                                        <div id="mensagem5">
                                            <p></p>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">

                                    <label for="fotoGrande2">Foto Grande 2*</label>
                                    <input type="file" name="fotoGrande2" id="fotoGrande2" title="Campo Obrigatório">
                                    <span class="resposta">
                                        <div id="mensagem2">
                                            <p></p>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fotoPequena2">Foto Pequena 2*</label>
                                    <input type="file" name="fotoPequena2" id="fotoPequena2" title="Campo Obrigatório">
                                    <span class="resposta">
                                        <div id="mensagem6">
                                            <p></p>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">

                                    <label for="fotoGrande3">Foto Grande 3*</label>
                                    <input type="file" name="fotoGrande3" id="fotoGrande3" title="Campo Obrigatório">
                                    <span class="resposta">
                                        <div id="mensagem3">
                                            <p></p>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fotoPequena3">Foto Pequena 3*</label>
                                    <input type="file" name="fotoPequena3" id="fotoPequena3" title="Campo Obrigatório">
                                    <span class="resposta">
                                        <div id="mensagem7">
                                            <p></p>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">

                                    <label for="fotoGrande4">Foto Grande 4*</label>
                                    <input type="file" name="fotoGrande4" id="fotoGrande4" title="Campo Obrigatório">
                                    <span class="resposta">
                                        <div id="mensagem4">
                                            <p></p>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fotoPequena4">Foto Pequena 4*</label>
                                    <input type="file" name="fotoPequena4" id="fotoPequena4" title="Campo Obrigatório">
                                    <span class="resposta">
                                        <div id="mensagem8">
                                            <p></p>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-success btn-block" name="inserirProduto" id="inserirProduto" data-toggle="modal" data-target="#janelaConfirmar">Inserir Produto</button>
                                </div>
                            </div>
                        </div>

                        <div id="mensagem">
                            <p></p>
                        </div>

                    </form>

                </div>
            </div>
            
            <!-- MODAL -->
            <section id="janelaConfirmar" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header border-0 rounded-0">
                            <h5 class="modal-title">Inserir novo produto?</h5>
                            <button class="close cp" data-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body pt-0">
                            <div class="col mt-sm-4">
                                <button data-dismiss="modal" class="btn btn-block botaoNao">Não</button>
                            </div>
                            <div class="col mt-2 mt-sm-4">
                                <button type="submit" form="formularioNovoProduto" class="btn btn-block botaoSim" >Sim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- MODAL -->
        </main>
        
        <?php include_once("../../principal/_incluir/rodape.php"); ?>
        
        <script src="../../../_scripts/js/topo2.js"></script>
        
        <script src="../../../_scripts/js/sair2.js"></script>
        
        <script src="../../../_scripts/js/adm/novoProduto.js"></script>
        
        <script src="../../../bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

<?php
    // Fechar as queries
    mysqli_free_result($conAdm);
    mysqli_free_result($conFornecedor);

    // Fechar conexao
    mysqli_close($conecta);
?>