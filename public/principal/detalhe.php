<?php require_once("../../_scripts/conexao/conexaoVenda.php"); ?>
<?php
    session_start();
    /************Produto**************************/
    // Consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= "FROM produto ";
    if(isset($_GET["codigo"]) ) //se n vier o codigo do produto por get redireciona
    {
        $produtoId = $_GET["codigo"];
        $consulta .= "WHERE codigo = {$produtoId} ";
    } 
    else 
    {
        header("Location:login.php");
    }

    $detalhe = mysqli_query($conecta,$consulta);

    // Testar erro
    if ( !$detalhe ) 
    {
        die("Falha no Banco de dados - Produto não encontrado");
    } 
    else //dados do produto
    {
        $dadosDetalhe = mysqli_fetch_assoc($detalhe);
        $codigo     = $dadosDetalhe["codigo"];
        $nomeproduto    = $dadosDetalhe["nome"];
        $descricao      = $dadosDetalhe["descricao"];
        $preco  = $dadosDetalhe["preco"];
        $estoque        = $dadosDetalhe["quantidade"];
        $foto1   = $dadosDetalhe["foto1"];
        $foto2   = $dadosDetalhe["foto2"];
        $foto3   = $dadosDetalhe["foto3"];
        $foto4   = $dadosDetalhe["foto4"];
        $foto5   = $dadosDetalhe["foto5"];
        $foto6   = $dadosDetalhe["foto6"];
        $foto7   = $dadosDetalhe["foto7"];
        $foto8   = $dadosDetalhe["foto8"];
    }
    /************Produto**************************/

    /************VERIFICA SE TEM TRANSACAO**************************/
    //caso o usuario esteja logado verifica se ele tem uma transacao ativa no carrinho ou se sera preciso criar outra
    $selectU = "SELECT * FROM usuario ";
    if(isset($_SESSION["user_portal"]) ) 
    {
        $selectU .= "WHERE codigo = {$_SESSION["user_portal"]} ";
    }

    $detalheU = mysqli_query($conecta,$selectU);

    // Testar erro
    if ( !$detalheU ) 
    {
        die("Falha no Banco de dados - Usuário não encontrado");
    } 
    else 
    {
        //entra de qualquer jeito, mas se eu n estiver logado como cliente nd acontece
        $dadosU = mysqli_fetch_assoc($detalheU);
        $tranU     = $dadosU["transacao"];
        if($tranU == 1)
        {
        /********Transacao**********************************/
    
            // Consulta a tabela de 
            $selectCarrinho = "SELECT * FROM transacaotemp ";
            $selectCarrinho .= "WHERE codCliente = {$_SESSION["user_portal"]} ";

            // cria objeto com dados do
            $conCarrinho = mysqli_query($conecta,$selectCarrinho);
            if(!$conCarrinho) 
            {
                die("Erro na consulta - Transação não encontrada");
            }

            $infoCarrinho = mysqli_fetch_assoc($conCarrinho);
            
            $pedidoU = $infoCarrinho["pedido"];

        /********Transacao**********************************/
        }
        else
        {
            $pedidoU = "SP"; //cliente nao tem uma transacao para adicionar produtos
        }
    }

    /*********VERIFICA SE TEM TRANSACAO******************************/
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Detalhe - Produto</title>

        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="../../_scripts/js/jquery.js"></script>

        <script type="text/javascript" src="js/xzoom.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/xzoom.css" media="all" /> 

        <link href="../../_css/produtoDetalhe.css" rel="stylesheet">
        <link href="../../_css/estilo.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        
        <main>  
            <div id="detalheProduto">
                <!-- teste -->
                <section id="foto" class="padding-top0">
                    <div class="xzoom-container">
                        <img class="xzoom" id="fotoPrincipal" src="<?php echo "../../_img/produtos/preview/" . $foto5 ?>" xoriginal="<?php echo "../../_img/produtos/original/" . $foto1 ?>">
                        <div class="xzoom-thumbs" id="fotoPequena">
                            <a href="<?php echo "../../_img/produtos/original/" . $foto1 ?>"><img class="xzoom-gallery" width="80" src="<?php echo "../../_img/produtos/preview/" . $foto5 ?>" title="vendas.com.br"></a>

                            <a href="<?php echo "../../_img/produtos/original/" . $foto2 ?>"><img class="xzoom-gallery" width="80" src="<?php echo "../../_img/produtos/preview/" . $foto6 ?>" title="vendas.com.br"></a>

                            <a href="<?php echo "../../_img/produtos/original/" . $foto3 ?>"><img class="xzoom-gallery" width="80" src="<?php echo "../../_img/produtos/preview/" . $foto7 ?>" title="vendas.com.br"></a>

                            <a href="<?php echo "../../_img/produtos/original/" . $foto4 ?>"><img class="xzoom-gallery" width="80" src="<?php echo "../../_img/produtos/preview/" . $foto8 ?>" title="vendas.com.br"></a>
                        </div>
                    </div>        
                  <div class="large-7 column" id="teste"></div>
                </section>
                <!-- teste -->
                <ul>
                    <li><h1><?php echo $nomeproduto ?></h1></li>
                    <li>Vendido e entregue por:<b> vendas.com.br</b></li>
                    <li><b>Apenas: R$ </b><?php echo $preco ?><b> à vista</b></li>
                    <li><b>Descrição: </b><?php echo $descricao ?></li>
                    
                    <li><b>Disponíveis: </b><?php echo $estoque ?></li>
                    <li>Cód.: <?php echo $codigo ?></li>
                    <button id="comprar" data-toggle="modal" data-target="#janelaConfirmar">Comprar</button>
                </ul>
            </div>
            <!-- MODAL -->
            <section id="janelaConfirmar" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header border-0 rounded-0">
                            <h5 class="modal-title">Adicionar produto ao carrinho?</h5>
                            <button class="close cp" data-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body pt-0">
                            <div class="col mt-sm-4">
                                <button id="botaoNao" data-dismiss="modal" class="btn btn-block">Não</button>
                            </div>
                            <div class="col mt-2 mt-sm-4">
                                <button id="botaoSim" data-dismiss="modal" class="btn btn-block" onclick='comprar(1,<?php echo $codigo; ?>,"<?php echo $nomeproduto; ?>","<?php echo $preco; ?>","<?php echo $foto5  ?>","<?php echo $pedidoU  ?>",<?php echo $_SESSION["user_portal"] ?>)'>Sim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- MODAL -->
        </main>

        <?php include_once("_incluir/rodape.php"); ?>
        
        <script>
            if(adm != 0)
            {
                document.getElementById("comprar").disabled = true;
                document.getElementById("comprar").title = "Faça o login para comprar";
                $('#comprar').css('background-color','#333');
                $('#comprar').css('cursor','default');
                $('#comprar').css('opacity','0.8');
            }
        </script>
        
        <script src="../../_scripts/js/cliente/comprar.js">
        </script>
        
        <script src="../../_scripts/js/topo.js">
        </script>
        <!-- teste -->
        <script src="js/setup.js"></script>
        <!-- teste -->

        <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>