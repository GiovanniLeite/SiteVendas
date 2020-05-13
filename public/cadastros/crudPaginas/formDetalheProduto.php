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

    $tr = "SELECT * FROM produto ";
    if(isset($_GET["codigo"]) ) 
    {
        $id = $_GET["codigo"];
        $tr .= "WHERE codigo = {$id} ";
    } 
    else 
    {
        header("location:../../principal/login.php");
    }
    $conProduto = mysqli_query($conecta,$tr);
    if(!$conProduto) {
        die("Erro na consulta");
    }
    $infoProduto = mysqli_fetch_assoc($conProduto);

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administrador - Detalhe</title>
        
        <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="../../../_css/formProduto.css" rel="stylesheet">
        <!-- estilo form -->
        <link href="../../../_css/estilo.css" rel="stylesheet">
    </head>
    <body>
        <?php include_once("../../principal/_incluir/topo.php"); ?>
        
        <main>
            <div id="formulario">
                <h2>Administrador - Detalhe</h2>
                <p><strong><?php echo $infoAdm["nome"] ?></strong></p>

                <div class="container">
                    <form>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["codigo"]  ?>" name="codigo" id="codigo" disabled/>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["nome"]  ?>" name="nome" id="nome" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fornecedor">Nome do Fornecedor</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["nomeFornecedor"]  ?>" name="fornecedor" id="fornecedor" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <textarea class="form-control" name="descricao" id="descricao" maxlength="255" placeholder="Descrição" disabled><?php echo $infoProduto["descricao"]  ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="preco">Preço</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["preco"]  ?>" name="preco" id="preco" disabled/>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="quantidade">Quantidade</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["quantidade"]  ?>" name="quantidade" id="quantidade" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fotoGrande">Foto Grande 1</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["foto1"]  ?>" name="fotoGrande" id="fotoGrande" disabled/>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fotoGrande">Foto Grande 2</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["foto2"]  ?>" name="fotoGrande" id="fotoGrande" disabled/>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fotoGrande">Foto Grande 3</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["foto3"]  ?>" name="fotoGrande" id="fotoGrande" disabled/>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fotoGrande">Foto Grande 4</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["foto4"]  ?>" name="fotoGrande" id="fotoGrande" disabled/>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fotoPequena">Foto Pequena 1</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["foto5"]  ?>" name="fotoPequena" id="fotoPequena" disabled/>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fotoPequena">Foto Pequena 2</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["foto6"]  ?>" name="fotoPequena" id="fotoPequena" disabled/>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fotoPequena">Foto Pequena 3</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["foto7"]  ?>" name="fotoPequena" id="fotoPequena" disabled/>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fotoPequena">Foto Pequena 4</label>
                                    <input class="form-control" type="text" value="<?php echo $infoProduto["foto8"]  ?>" name="fotoPequena" id="fotoPequena" disabled/>
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
    // Fechar as queries
    mysqli_free_result($conAdm);
    mysqli_free_result($conProduto);

    // Fechar conexao
    mysqli_close($conecta);
?>