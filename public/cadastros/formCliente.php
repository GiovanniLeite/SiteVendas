<?php require_once("../../_scripts/conexao/conexaoVenda.php") ?>
<?php
session_start();
/********Usuário**********************************/
// Consulta a tabela de usuario
if (isset($_SESSION["user_portal"])) {
    $selectUsuario = "SELECT * FROM usuario ";
    $selectUsuario .= "WHERE codigo = {$_SESSION["user_portal"]} ";

    // cria objeto com dados do usuario
    $conUsuario = mysqli_query($conecta, $selectUsuario);
    if (!$conUsuario) {
        die("Erro ao consultar usuário");
    }

    $infoUsuario = mysqli_fetch_assoc($conUsuario);

    if ($infoUsuario["adm"] != 0) {
        header("location:../principal/login.php");
    }
} else {
    header("location:../principal/login.php");
}
/********Usuário**********************************/

/********Cartão**********************************/
// Consulta a tabela de cartao
$selectCartao = "SELECT * FROM cartao WHERE codCliente = {$_SESSION["user_portal"]} ";
$conCartao = mysqli_query($conecta, $selectCartao);
if (!$conCartao) {
    die("Erro ao consultar cartão");
}

$infoCartao = mysqli_fetch_assoc($conCartao);
/********Cartão**********************************/

/********Compras**********************************/
// Consulta a tabela de transacoes
$selectTransacao = "SELECT * FROM transacao WHERE codCliente = {$_SESSION["user_portal"]} ";
$conTransacao = mysqli_query($conecta, $selectTransacao);
if (!$conTransacao) {
    die("Erro ao consultar compras");
}
/********Compras**********************************/

/********Carrinho - Transacao**********************************/

// Consulta a tabela de 
$selectCarrinho = "SELECT * FROM transacaotemp WHERE codCliente = {$_SESSION["user_portal"]} ";
$conCarrinho = mysqli_query($conecta, $selectCarrinho);
if (!$conCarrinho) {
    die("Erro ao consultar carrinho");
}

$infoCarrinho = mysqli_fetch_assoc($conCarrinho);

/*****Itens do Carrinho*****/
$selectItens = "SELECT * FROM produtovendatemp WHERE pedido = '";
$selectItens .= $infoCarrinho["pedido"] . "'";
$conItens = mysqli_query($conecta, $selectItens);

/**************************/
$crudItens = [];
$cont = 0;
$retirados = array();
$contRetirados = 0;
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
            $("#tabs").tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
            $("#tabs li").removeClass("ui-corner-top").addClass("ui-corner-left").addClass("ui-corner-right");
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- estilo form -->
    <link href="../../_css/estilo.css" rel="stylesheet">
    <link href="../../_css/cliente.css" rel="stylesheet">
</head>

<body>
    <?php include_once("../principal/_incluir/topo.php"); ?>

    <main>
        <div id="formCliente">
            <h2>Cadastro do Cliente</h2>
            <p><strong><?php echo $infoUsuario["nome"] ?></strong></p>

            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">Cadastro</a></li>
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
                                        <input class="form-control" type="text" name="nome" id="nome" maxlength="35" value="<?php echo $infoUsuario["nome"] ?>" placeholder="Nome" title="Campo Obrigatório" />
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cpf">CPF*</label>
                                        <input class="form-control" type="text" name="cpf" id="cpf" value="<?php echo $infoUsuario["cpf"] ?>" placeholder="CPF" title="Campo Obrigatório" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">


                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="rg">RG*</label>
                                        <input class="form-control" type="text" name="rg" id="rg" maxlength="12" value="<?php echo $infoUsuario["rg"] ?>" placeholder="RG" title="Campo Obrigatório" />
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="telefone">Telefone*</label>
                                        <input class="form-control" type="text" name="telefone" id="telefone" value="<?php echo $infoUsuario["telefone"] ?>" placeholder="Ex: (15)3227-5064" title="Campo Obrigatório" />
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="celular">Celular*</label>
                                        <input class="form-control" type="text" name="celular" id="celular" value="<?php echo $infoUsuario["celular"] ?>" placeholder="Ex: (15)98127-5064" title="Campo Obrigatório" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <input class="form-control" type="email" name="email" id="email" maxlength="50" value="<?php echo $infoUsuario["email"] ?>" placeholder="Email" title="Campo Obrigatório" />
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
                                        <input class="form-control" type="text" name="endereco" id="endereco" maxlength="35" value="<?php echo $infoUsuario["endereco"] ?>" placeholder="Endereço" title="Campo Obrigatório">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="bairro">Bairro*</label>
                                        <input class="form-control" type="text" name="bairro" id="bairro" maxlength="50" value="<?php echo $infoUsuario["bairro"] ?>" placeholder="Bairro" title="Campo Obrigatório">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cidade">Cidade*</label>
                                        <input class="form-control" type="text" name="cidade" id="cidade" maxlength="27" value="<?php echo $infoUsuario["cidade"] ?>" placeholder="Cidade" title="Campo Obrigatório">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="estado">Estado*</label>
                                        <input class="form-control" type="text" name="estado" id="estado" maxlength="27" value="<?php echo $infoUsuario["estado"] ?>" placeholder="Estado" title="Campo Obrigatório">
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-success btn-block" name="atualizarCadastro" id="atualizarCadastro" data-toggle="modal" data-target="#janelaConfirmarCadastro">Atualizar Cadastro</button>

                            <div id="mensagem">
                                <p></p>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="tabs-2">
                    <div class="container">
                        <form id="formAtualizarCartao">

                            <input type="hidden" name="codigoCliente" value="<?php echo $infoUsuario["codigo"] ?>">
                            <input type="hidden" name="codCartao" value="<?php echo $infoCartao["codigo"] ?>">

                            <div class="form-group">
                                <label for="numeroCartao">Número do Cartão*</label>
                                <input class="form-control" type="text" name="numeroCartao" id="numeroCartao" maxlength="16" value="<?php echo $infoCartao["numero"] ?>" placeholder="Número do Cartão" title="Campo Obrigatório" />
                            </div>

                            <div class="row">
                                <div class="col-9">
                                    <div class="form-group">


                                        <label for="nomeTitular">Nome do Titular*</label>
                                        <input class="form-control" type="text" name="nomeTitular" id="nomeTitular" maxlength="50" value="<?php echo $infoCartao["titular"] ?>" placeholder="Nome do Titular" title="Campo Obrigatório" />
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="bandeira">Bandeira*</label>
                                        <select class="form-control" name="bandeira" id="bandeira" title="Campo Obrigatório">
                                            <option <?= ($infoCartao["bandeira"] == 'Visa') ? 'selected' : '' ?>>Visa</option>
                                            <option <?= ($infoCartao["bandeira"] == 'Mastercard') ? 'selected' : '' ?>>Mastercard</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="validade">Validade MM/AA*</label>
                                        <input class="form-control" type="text" name="validade" id="validade" maxlength="7" value="<?php echo $infoCartao["validade"] ?>" placeholder="Validade MM/AA" title="Campo Obrigatório" />
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="codigoSeguranca">Código*</label>
                                        <input class="form-control" type="text" name="codigoSeguranca" id="codigoSeguranca" maxlength="3" value="<?php echo $infoCartao["codSegu"] ?>" placeholder="Código de Segurança" title="Campo Obrigatório" />
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="tipo">Tipo*</label>
                                        <select class="form-control" name="tipo" id="tipo" title="Campo Obrigatório">
                                            <option <?= ($infoCartao["tipo"] == 'Crédito') ? 'selected' : '' ?>>Crédito</option>
                                            <option <?= ($infoCartao["tipo"] == 'Débito') ? 'selected' : '' ?>>Débito</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <button type="button" class="btn btn-success btn-block" name="atualizarCartao" id="atualizarCartao" data-toggle="modal" data-target="#janelaConfirmarCartao">Atualizar Cartão</button>

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
                            <li>Informações</li>
                        </ul>
                        <div id="listaCompras">
                            <?php
                            while ($linha = mysqli_fetch_assoc($conTransacao)) {
                            ?>
                                <ul>
                                    <li><?php echo $linha["codigo"] ?></li>
                                    <li>R$ <?php echo $linha["totalVenda"] ?></li>
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
                            while ($linha = mysqli_fetch_assoc($conItens)) {
                                $crudItens[$cont] = $linha;
                            ?>
                                <ul id="<?php echo "ul" . $cont; ?>">
                                    <li><img src="<?php echo "../../_img/produtos/preview/" . $linha["foto"] ?>" id="fotoProduto"></li>
                                    <li><?php echo $linha["nome"] ?></li>
                                    <li><?php echo $linha["quantidade"] ?></li>
                                    <li>R$ <?php echo $linha["valor"] ?></li>
                                    <li><button id="remover" title="Remover Produto" onclick='remover(<?php echo $cont ?>,<?php echo json_encode($linha) ?>,<?php echo json_encode($infoCarrinho) ?>)'>X</button></li>
                                </ul>
                            <?php
                                $cont++;
                            }
                            ?>
                        </div>
                        <ul id="rodape">
                            <li><?php echo 'Total da compra: R$ ' . $infoCarrinho["totalVenda"] ?></li>
                            <button name="finalizarCompra" data-toggle="modal" data-target="#janelaConfirmar">Finalizar Compra</button>
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
                                        <input class="form-control" type="email" name="emailSeguranca" id="emailSeguranca" maxlength="55" placeholder="exemplo@outlook.com" title="Campo Obrigatório" />
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success" name="atualizarEmail" id="atualizarEmail" title="Atualizar Email" data-toggle="modal" data-target="#janelaConfirmarEmail">Alterar Email </button>
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
                                        <label for="senha">Nova Senha*</label>
                                        <input class="form-control" type="password" name="senha" id="senha" maxlength="25" placeholder="Senha" title="Campo Obrigatório" />
                                    </div>
                                </div>

                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="confirmarSenha">Confirmar Nova Senha*</label>
                                        <input class="form-control" type="password" name="confirmarSenha" id="confirmarSenha" maxlength="25" placeholder="Senha" title="Campo Obrigatório" />
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success" name="atualizarSenha" id="atualizarSenha" itle="Atualizar Senha" data-toggle="modal" data-target="#janelaConfirmarSenha">Alterar Senha</button>
                                    </div>
                                </div>
                            </div>

                            <div id="mensagemSenha">
                                <p></p>
                            </div>
                        </form>
                        <form id="formExcluir">
                            <input type="hidden" name="codigoC" value="<?php echo $infoUsuario["codigo"] ?>">

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="usuario">Usuário*</label>
                                        <input class="form-control" type="password" name="usuario" id="usuario" maxlength="25" placeholder="Senha" title="Campo Obrigatório" />
                                    </div>
                                </div>

                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="senhaExcluir">Senha*</label>
                                        <input class="form-control" type="password" name="senhaExcluir" id="senhaExcluir" maxlength="25" placeholder="Senha" title="Campo Obrigatório" />
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-warning" name="excluirConta" id="excluirConta" title="Confirme Usuário e Senha para Excluir" data-toggle="modal" data-target="#janelaConfirmar2">Excluir Conta</button>
                                    </div>
                                </div>
                            </div>

                            <div id="mensagemExcluir">
                                <p></p>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

        <!-- MODAL 1-->
        <section id="janelaConfirmar" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 rounded-0">
                        <h5 class="modal-title">Tem certeza de que quer finalizar a compra?</h5>
                        <button class="close cp" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="col mt-sm-4">
                            <button data-dismiss="modal" class="btn btn-block botaoNao">Não</button>
                        </div>
                        <div class="col mt-2 mt-sm-4">
                            <button data-dismiss="modal" class="btn btn-block botaoSim" onclick='finalizar(<?php echo json_encode($infoCarrinho); ?>,<?php echo json_encode($crudItens); ?>)' id="finalizarCompra">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- MODAL 1-->
        <!-- MODAL 2-->
        <section id="janelaConfirmar2" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 rounded-0">
                        <h5 class="modal-title">Tem certeza de que quer excluir a conta?</h5>
                        <button class="close cp" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="col mt-sm-4">
                            <button data-dismiss="modal" class="btn btn-block botaoNao">Não</button>
                        </div>
                        <div class="col mt-2 mt-sm-4">
                            <button type="submit" form="formExcluir" class="btn btn-block botaoSim">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- MODAL 2-->
        <!-- MODAL 3-->
        <section id="janelaConfirmarEmail" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 rounded-0">
                        <h5 class="modal-title">Tem certeza de que quer alterar o email?</h5>
                        <button class="close cp" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="col mt-sm-4">
                            <button data-dismiss="modal" class="btn btn-block botaoNao">Não</button>
                        </div>
                        <div class="col mt-2 mt-sm-4">
                            <button type="submit" form="formEmail" class="btn btn-block botaoSim">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- MODAL 3-->
        <!-- MODAL 4-->
        <section id="janelaConfirmarSenha" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 rounded-0">
                        <h5 class="modal-title">Tem certeza de que quer alterar a senha?</h5>
                        <button class="close cp" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="col mt-sm-4">
                            <button data-dismiss="modal" class="btn btn-block botaoNao">Não</button>
                        </div>
                        <div class="col mt-2 mt-sm-4">
                            <button type="submit" form="formSenha" class="btn btn-block botaoSim">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- MODAL 4-->
        <!-- MODAL 5-->
        <section id="janelaConfirmarCartao" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 rounded-0">
                        <h5 class="modal-title">Tem certeza de que quer alterar o cartão?</h5>
                        <button class="close cp" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="col mt-sm-4">
                            <button data-dismiss="modal" class="btn btn-block botaoNao">Não</button>
                        </div>
                        <div class="col mt-2 mt-sm-4">
                            <button type="submit" form="formAtualizarCartao" class="btn btn-block botaoSim">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- MODAL 5-->
        <!-- MODAL 6-->
        <section id="janelaConfirmarCadastro" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 rounded-0">
                        <h5 class="modal-title">Tem certeza de que quer alterar o cadastro?</h5>
                        <button class="close cp" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="col mt-sm-4">
                            <button data-dismiss="modal" class="btn btn-block botaoNao">Não</button>
                        </div>
                        <div class="col mt-2 mt-sm-4">
                            <button type="submit" form="formAtualizarCadastro" class="btn btn-block botaoSim">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- MODAL 6-->

    </main>

    <?php include_once("../principal/_incluir/rodape.php"); ?>

    <script>
        $('#cep').blur(function(e) {
            var cep = $('#cep').val();
            var url = "https://viacep.com.br/ws/" + cep + "/json/";
            var validaCEP = /^[0-9]{5}-?[0-9]{3}$/;

            if (validaCEP.test(cep)) {
                $('#mensagem').hide();
                var retorno = pesquisarCEP(url);
            } else {
                $('#mensagem').show();
                $('#mensagem p').html("CEP inválido");
            }
        });

        function pesquisarCEP(endereco) {
            $.ajax({
                type: "GET",
                url: endereco
            }).done(function(data) {
                $('#bairro').val(data.bairro);
                $('#cidade').val(data.localidade);
                $('#estado').val(data.uf);
                $('#endereco').val(data.logradouro);
            }).fail(function() {
                console.log("erro");
            });
        }

        $("#cpf").mask("000.000.000-00");
        $("#telefone").mask("(00)0000-0000");
        $("#celular").mask("(00)00000-0000");
        $("#cep").mask("00000-000");
        $("#validade").mask("00/00");
    </script>

    <script src="../../_scripts/js/cliente/atualizarCadastro.js"></script>

    <script src="../../_scripts/js/cliente/atualizarCartao.js"></script>

    <script src="../../_scripts/js/cliente/atualizarEmail.js"></script>

    <script src="../../_scripts/js/cliente/atualizarSenha.js"></script>

    <script src="../../_scripts/js/cliente/excluir.js"></script>

    <script src="../../_scripts/js/cliente/finalizarCompra.js"></script>

    <script src="../../_scripts/js/cliente/removerProduto.js"></script>

    <script src="../../_scripts/js/topo.js"></script>

    <script src="../../_scripts/js/sair.js"></script>

    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Fechar as queries
mysqli_free_result($conUsuario);
mysqli_free_result($conCartao);
mysqli_free_result($conTransacao);
mysqli_free_result($conCarrinho);
mysqli_free_result($conItens);

// Fechar conexao
mysqli_close($conecta);
?>