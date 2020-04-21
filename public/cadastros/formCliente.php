<?php require_once("../../_scripts/conexao/conexaoVenda.php") ?>
<?php
    session_start();
    /********Usuário**********************************/
    
    // Consulta a tabela de usuario
    $selectUsuario = "SELECT * FROM usuario ";
    if(isset($_GET["codigo"]) ) {
        $cod = $_GET["codigo"];
        $selectUsuario .= "WHERE codigo = {$cod} ";
    } else {
        $selectUsuario .= "WHERE codigo= 2 ";
    }

    // cria objeto com dados do usuario
    $conUsuario = mysqli_query($conecta,$selectUsuario);
    if(!$conUsuario) {
        die("Erro na consulta");
    }

    $infoUsuario = mysqli_fetch_assoc($conUsuario);

    /********Usuário**********************************/
        /**/
    /********Cartão**********************************/

    // Consulta a tabela de cartao
    $selectCartao = "SELECT * FROM cartao ";
    if(isset($_GET["codigo"]) ) {
        $codCliente = $_GET["codigo"];
        $selectCartao .= "WHERE codCliente = {$codCliente} ";
    } else {
        $selectCartao .= "WHERE codCliente= 2 ";
    }

    // cria objeto com dados do cartao
    $conCartao = mysqli_query($conecta,$selectCartao);
    if(!$conCartao) {
        die("Erro na consulta");
    }

    $infoCartao = mysqli_fetch_assoc($conCartao);

    /********Cartão**********************************/
        /**/
    /********Compras**********************************/

    // Consulta a tabela de transacoes
    $selectTransacao = "SELECT * FROM transacao ";
    if(isset($_GET["codigo"]) ) {
        $codCliente = $_GET["codigo"];
        $selectTransacao .= "WHERE codCliente = {$codCliente} ";
    } else {
        $selectTransacao .= "WHERE codCliente= 2 ";
    }

    // cria objeto com dados do transacao
    $conTransacao = mysqli_query($conecta,$selectTransacao);
    if(!$conTransacao) {
        die("Erro na consulta");
    }

    /********Compras**********************************/

    /********Carrinho - Transacao**********************************/
    
    // Consulta a tabela de 
    $selectCarrinho = "SELECT * FROM transacaotemp ";
    if(isset($_GET["codigo"]) ) {
        $codCliente = $_GET["codigo"];
        $selectCarrinho .= "WHERE codCliente = {$cod} ";
    } else {
        $selectCarrinho .= "WHERE codCliente = 2 ";
    }

    // cria objeto com dados do
    $conCarrinho = mysqli_query($conecta,$selectCarrinho);
    if(!$conCarrinho) {
        die("Erro na consulta");
    }

    $infoCarrinho = mysqli_fetch_assoc($conCarrinho);

    /*****Itens do Carrinho*****/
    $selectItens = "SELECT * FROM produtovendatemp WHERE pedido = '";
    $selectItens .= $infoCarrinho["pedido"] . "'";
    $conItens = mysqli_query($conecta,$selectItens);

    /**************************/
    $crudItens = [];
    $cont = 0;
    /***************************/

    /********Carrinho - Transacao**********************************/
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastro do Cliente</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function() {
                $( "#tabs" ).tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
                $( "#tabs li" ).removeClass("ui-corner-top" ).addClass("ui-corner-left").addClass("ui-corner-right");
            });
        </script>
        
        
        
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="../../_css/cliente.css" rel="stylesheet">
        <!-- estilo form -->
        <link href="../../_css/estilo.css" rel="stylesheet">
        
        <style>
            header {
                height:66px;
            }
        </style>
    </head>
    <body>
        <?php include_once("../principal/_incluir/topo.php"); ?>
        
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Giovanni</a></li>
                <li><a href="#tabs-2">Cartao</a></li>
                <li><a href="#tabs-3">Compras</a></li>
                <li><a href="#tabs-4">Carrinho</a></li>
                <li><a href="#tabs-5">Segurança</a></li>
            </ul>
            
            <div id="tabs-1">
                <div class="container">
                    <form id="formAtualizarCadastro">
                        
                        <input type="hidden" name="codigoCliente" value="<?php echo $infoUsuario["codigo"] ?>">
                        
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="nome">Nome*</label>
                                    <input class="form-control" type="text" name="nome" id="nome" value="<?php echo $infoUsuario["nome"] ?>" placeholder="Nome" title="Campo Obrigatório"/>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cpf">CPF*</label>
                                    <input class="form-control" type="text" name="cpf" id="cpf" value="<?php echo $infoUsuario["cpf"] ?>" placeholder="CPF" title="Campo Obrigatório"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">


                            <div class="col-4">
                                <div class="form-group">
                                    <label for="rg">RG*</label>
                                    <input class="form-control" type="text" name="rg" id="rg" value="<?php echo $infoUsuario["rg"] ?>" placeholder="RG" title="Campo Obrigatório"/>
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="telefone">Telefone*</label>
                                    <input class="form-control" type="text" name="telefone" id="telefone" value="<?php echo $infoUsuario["telefone"] ?>" placeholder="Ex: (15)3227-5064" title="Campo Obrigatório"/>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="celular">Celular*</label>
                                    <input class="form-control" type="text" name="celular" id="celular" value="<?php echo $infoUsuario["celular"] ?>" placeholder="Ex: (15)98127-5064" title="Campo Obrigatório"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input class="form-control" type="email" name="email" id="email" value="<?php echo $infoUsuario["email"] ?>" placeholder="Email" title="Campo Obrigatório"/>
                                </div>
                            </div>
                    
                        </div>
                        
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cep">CEP*</label>
                                    <input class="form-control" type="text" name="cep" id="cep" value="<?php echo $infoUsuario["cep"] ?>" maxlength="9" placeholder="Ex: 18016-410" title="Campo Obrigatório">
                                </div>
                            </div>
                            
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="endereco">Endereço*</label>
                                    <input class="form-control" type="text" name="endereco" id="endereco" value="<?php echo $infoUsuario["endereco"] ?>" placeholder="Endereço" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="bairro">Bairro*</label>
                                    <input class="form-control" type="text" name="bairro" id="bairro" value="<?php echo $infoUsuario["bairro"] ?>" placeholder="Bairro" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cidade">Cidade*</label>
                                    <input class="form-control" type="text" name="cidade" id="cidade" value="<?php echo $infoUsuario["cidade"] ?>" placeholder="Cidade" title="Campo Obrigatório">
                                </div>
                            </div>
                                    
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="estado">Estado*</label>
                                    <input class="form-control" type="text" name="estado" id="estado" value="<?php echo $infoUsuario["estado"] ?>" placeholder="Estado" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success btn-block" type="submit" name="atualizarCadastro" id="atualizarCadastro">Atualizar Cadastro</button>
                        
                        <div id="mensagem">
                            <p></p>
                        </div>
                    </form>
                </div>
            </div>
            
            <div id="tabs-2">
                <div class="container">
                    <form id="formAtualizarCartao">
                        
                        <input type="hidden" name="codCartao" value="<?php echo $infoCartao["codigo"] ?>">
                        
                        <div class="form-group">
                            <label for="numeroCartao">Número do Cartão*</label>
                            <input class="form-control" type="text" name="numeroCartao" id="numeroCartao" value="<?php echo $infoCartao["numero"] ?>" placeholder="Número do Cartão" title="Campo Obrigatório"/>  
                        </div>
                        
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    
                                    
                                    <label for="nomeTitular">Nome do Titular*</label>
                                    <input class="form-control" type="text" name="nomeTitular" id="nomeTitular" value="<?php echo $infoCartao["titular"] ?>" placeholder="Nome do Titular" title="Campo Obrigatório"/>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="bandeira">Bandeira*</label>
                                    <select class="form-control" name="bandeira" id="bandeira" title="Campo Obrigatório">
                                        <option>Visa</option>    
                                        <option>Mastercard</option>   
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="validade">Validade MM/AAAA*</label>
                                    <input class="form-control" type="text" name="validade" id="validade" value="<?php echo $infoCartao["validade"] ?>" placeholder="Validade MM/AAAA" title="Campo Obrigatório"/>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigoSeguranca">Código*</label>
                                    <input class="form-control" type="text" name="codigoSeguranca" id="codigoSeguranca" value="<?php echo $infoCartao["codSegu"] ?>" placeholder="Código de Segurança" title="Campo Obrigatório"/>
                                </div>
                            </div>
                        </div>

                        <div class="checkbox">
                            <label title="Campo Obrigatório">Tipo*</label>
                            <div class="col-12">
                                <label for="credito">
                                    <input type="checkbox" name="credito" id="credito">Crédito
                                </label>
                            </div>
                            <div class="col-12">
                                <label for="debito">
                                    <input type="checkbox" name="debito" id="debito">Débito
                                </label>
                            </div>
                        </div>
                        
                      <button class="btn btn-success btn-block" type="submit" name="atualizarCartao" id="atualizarCartao">Atualizar Cartão</button>
                        
                        <div id="mensagemCartao">
                            <p></p>
                        </div>
                    </form>
                </div>
            </div>
            
            <div id="tabs-3">
                <div id="compras">
                    <ul id="titulo">
                        <li>Código</li>
                        <li>Valor Total</li>
                        <li>Data</li>
                    </ul>
                    <div id="listaCompras">
                        <?php
                            while($linha = mysqli_fetch_assoc($conTransacao)) {
                        ?>
                        <ul>
                            <li><?php echo $linha["codigo"] ?></li>
                            <li><?php echo $linha["totalVenda"] ?></li>
                            <li><?php echo $linha["dataVenda"] ?></li>
                            <li><a href="crudPaginas/formDetalheCompra.php?&codigo='<?php echo $linha["codigo"] ?>'">Detalhes</a></li>
                        </ul>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            
            <div id="tabs-4">

                <div id="carrinho">
                    <ul id="legenda">
                        <li>Foto</li>
                        <li>Nome</li>
                        <li>Quantidade</li>
                        <li>Valor</li>
                    </ul>
                    <div id="produto">
                        <?php
                            while($linha = mysqli_fetch_assoc($conItens)) {
                                $crudItens[$cont] = $linha;
                                $cont ++;
                        ?>
                        <ul title="<?php echo $testeArray[i]. $linha["codigo"] ?>">
                            <li><?php echo $linha["foto"] ?></li>
                            <li><?php echo $linha["nome"] ?></li>
                            <li><?php echo $linha["quantidade"] ?></li>
                            <li><?php echo $linha["valor"] ?></li>
                        </ul>
                        <?php
                            }
                        ?>
                    </div>
                    <ul id="rodape">
                        <li><?php echo 'Total da compra ' . $infoCarrinho["totalVenda"] ?></li>
                        <button name="finalizarCompra" onclick='finalizar(<?php echo json_encode($infoCarrinho); ?>,<?php echo json_encode($crudItens); ?>)' id="finalizarCompra">Finalizar Compra</button>
                    </ul>
                </div>
            </div>
            
            <div id="tabs-5">
                <div class="container">
                    <form id="formEmail" name="formEmail">
                        
                        <input type="hidden" name="codigoCli" value="<?php echo $infoUsuario["codigo"] ?>">
                        
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="emailSeguranca">Email*</label>
                                    <input class="form-control" type="email" name="emailSeguranca" id="emailSeguranca" placeholder="exemplo@outlook.com" title="Campo Obrigatório"/>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <button class="btn btn-success" name="atualizarEmail" id="atualizarEmail" type="submit" title="Atualizar Email">Alterar Email  </button>
                                </div>
                            </div>
                        </div>
                        <div id="mensagemEmail">
                            <p></p>
                        </div>
                    </form>
                    <form id="formSenha">
                        <input type="hidden" name="codigoCl" value="<?php echo $infoUsuario["codigo"] ?>">
                        
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="senha">Senha*</label>
                                    <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" title="Campo Obrigatório"/>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="form-group">
                                    <label for="confirmarSenha">Confirmar Senha*</label>
                                    <input class="form-control" type="password" name="confirmarSenha" id="confirmarSenha" placeholder="Senha" title="Campo Obrigatório"/>
                                </div>
                            </div>
                            
                            <div class="col-3">
                                <div class="form-group">
                                    <button class="btn btn-success" name="atualizarSenha" id="atualizarSenha" type="submit" title="Atualizar Senha">Alterar Senha</button>
                                </div>
                            </div>
                        </div>
                        
                        <div id="mensagemSenha">
                            <p></p>
                        </div>
                    </form>
                    <form id="formExcluir">
                        <input type="hidden" name="codigoC" value="<?php echo $infoUsuario["codigo"] ?>">
                        
                        <button class="btn btn-warning" name="excluirConta" id="excluirConta" type="submit" title="Confirme Email e Senha para Excluir">Excluir Conta</button>
                        
                        <div id="mensagemExcluir">
                            <p></p>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        
        <?php include_once("../principal/_incluir/rodape.php"); ?>
        
        <script>
            $('#cep').blur(function(e){
                var cep = $('#cep').val();
                var url = "https://viacep.com.br/ws/" + cep + "/json/";
                var validaCEP = /^[0-9]{5}-?[0-9]{3}$/;
                
                if(validaCEP.test(cep))
                {
                    $('#mensagem').hide();
                    var retorno = pesquisarCEP(url);
                }
                else
                {
                    $('#mensagem').show();
                    $('#mensagem p').html("CEP inválido");
                }
            });
            
            function pesquisarCEP(endereco){
                $.ajax({
                    type:"GET",
                    url:endereco,
                    async:false
                }).done(function(data){
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                    $('#endereco').val(data.logradouro);
                }).fail(function(){
                    console.log("erro");
                });
            }
        </script>

        <script src="../../_scripts/js/cliente/atualizarCadastro.js">
        </script>
        
        <script src="../../_scripts/js/cliente/atualizarCartao.js">
        </script>
        
        <script src="../../_scripts/js/cliente/atualizarEmail.js">
        </script>
        
        <script src="../../_scripts/js/cliente/atualizarSenha.js">
        </script>
        
        <script src="../../_scripts/js/cliente/excluir.js">
        </script>
        
        <script src="../../_scripts/js/cliente/finalizarCompra.js">
        </script>
        
        <script src="../../_scripts/js/topo.js">
        </script>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>