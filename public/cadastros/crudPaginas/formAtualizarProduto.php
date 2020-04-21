<?php require_once("../../../_scripts/conexao/conexaoVenda.php") ?>
<?php include_once("../../../_scripts/crud/adm/funcoes.php") ?>
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


    /**************************************************************/
    // conferir se a navegacao veio pelo preenchimento do formulario
    if(isset($_POST["nome"])) {
        
        $resultado1 = publicarImagem($_FILES['fotoGrande']);
        $resultado2 = publicarImagem($_FILES['fotoPequena']);
        $mensagem1 = $resultado1[0]; 
        $mensagem2 = $resultado2[0];
        
        $imagemGrande  = $resultado1[1];
        $imagemPequena = $resultado2[1];
        
        $codigo = $_POST['codigoProduto'];
        $nome = $_POST['nome'];
        $codigoFornecedor = $_POST['codigoFornecedor'];
        $fornecedor = $_POST['fornecedor'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];

        // Insercao no banco
        $alterar = "UPDATE produto ";
        $alterar .= "SET ";
        $alterar .= "nome = '{$nome}', ";
        $alterar .= "preco = '{$preco}', ";
        $alterar .= "descricao = '{$descricao}', ";
        $alterar .= "quantidade = '{$quantidade}', ";
        $alterar .= "codFornecedor = '{$codigoFornecedor}', ";
        $alterar .= "nomeFornecedor = '{$fornecedor}', ";
        $alterar .= "fotoPequena = '{$imagemPequena}', ";
        $alterar .= "fotoGrande = '{$imagemGrande}' ";
        $alterar .= "WHERE codigo = {$codigo} ";
        
        $operacaoAlterar = mysqli_query($conecta,$alterar);
        if($operacaoAlterar) {
            $mensagem = "Cadastro alterado com sucesso.";
        } else {
            $mensagem = "Falha no sistema, tente mais tarde.";
        }
        
        unset($_POST);
    }
    /**************************************************************/
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administrador - Atualizar</title>
        
        <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="../../../_css/formNovoProduto.css" rel="stylesheet">
        <!-- estilo form -->
        <link href="../../../_css/estilo.css" rel="stylesheet">
        
        <style>
            header {
                height:66px;
            }
        </style>
    </head>
    <body>
        <?php include_once("../../principal/_incluir/topo.php"); ?>
        
        <div id="main">
            <h2>Administrador - Atualizar</h2>
            <p><strong><?php echo "Giovanni Moraes de Oliveira Leite"/*$infoAdm["nome"]*/ ?></strong></p>
            
            <div class="container">
                <form id="formularioAtualizarProduto" action="formAtualizarProduto.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input class="form-control" type="text" value="<?php echo $infoProduto["codigo"]  ?>" name="codigo" id="codigo" placeholder="Código" disabled/>
                                <input type="hidden" name="codigoProduto" value="<?php echo $infoProduto["codigo"]  ?>">
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="form-group">
                                <label for="nome">Nome*</label>
                                <input class="form-control" type="text" value="<?php echo $infoProduto["nome"]  ?>" name="nome" id="nome" title="Campo Obrigatório" placeholder="Nome"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="codigoFornecedor">Código do Fornecedor*</label>
                                <input class="form-control" type="text" value="<?php echo $infoProduto["codFornecedor"]  ?>" name="codigoFornecedor" id="codigoFornecedor" title="Campo Obrigatório" placeholder="Código"/>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="form-group">
                                <label for="fornecedor">Nome do Fornecedor*</label>
                                <select class="form-control" name="fornecedor" id="fornecedor" title="Campo Obrigatório">
                                    <?php 
                                        $meuFornecedor = $infoProduto["codFornecedor"];
                                        while($linha = mysqli_fetch_assoc($listaFornecedores)) {
                                            $fornecedorPrincipal = $linha["codFornecedor"];
                                            if($meuFornecedor == $fornecedorPrincipal) {
                                    ?>
                                        <option value="<?php echo $linha["nome"] ?>" selected>
                                            <?php echo $linha["nome"] ?>
                                        </option>
                                    <?php
                                            } else {
                                    ?>
                                        <option value="<?php echo $linha["nome"] ?>" >
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
                                <textarea class="form-control" name="descricao" id="descricao" maxlength="255" placeholder="Descrição" title="Campo Obrigatório"><?php echo $infoProduto["descricao"]  ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="preco">Preço*</label>
                                <input class="form-control" type="text" value="<?php echo $infoProduto["preco"]  ?>" name="preco" id="preco" placeholder="Preço" title="Campo Obrigatório"/>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="quantidade">Quantidade*</label>
                                <input class="form-control" type="text" value="<?php echo $infoProduto["quantidade"]  ?>" name="quantidade" id="quantidade" placeholder="Quantidade" title="Campo Obrigatório"/>
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
                                            echo $mensagem1;
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
                                            echo $mensagem2;
                                        }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="crud">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-success btn-block" type="submit" name="inserirProduto" id="inserirProduto">Atualizar</button>
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
        
        <?php include_once("../../principal/_incluir/rodape.php"); ?>
        
        <script src="../../../_scripts/js/topo2.js"></script>
    </body>
</html>

<?php
    // Fechar as queries
    mysqli_free_result($listaFornecedores);

?>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>