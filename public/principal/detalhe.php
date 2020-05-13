<?php require_once("../../_scripts/conexao/conexaoVenda.php"); ?>
<?php
    session_start();
    /************Produto**************************/
    // Consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= "FROM produto ";
    if(isset($_GET["codigo"]) ) 
    {
        $produto_id = $_GET["codigo"];
        $consulta .= "WHERE codigo = {$produto_id} ";
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
    else 
    {
        $dados_detalhe = mysqli_fetch_assoc($detalhe);
        $codigo     = $dados_detalhe["codigo"];
        $nomeproduto    = $dados_detalhe["nome"];
        $descricao      = $dados_detalhe["descricao"];
        $preco  = $dados_detalhe["preco"];
        $estoque        = $dados_detalhe["quantidade"];
        $foto1   = $dados_detalhe["foto1"];
        $foto2   = $dados_detalhe["foto2"];
        $foto3   = $dados_detalhe["foto3"];
        $foto4   = $dados_detalhe["foto4"];
        $foto5   = $dados_detalhe["foto5"];
        $foto6   = $dados_detalhe["foto6"];
        $foto7   = $dados_detalhe["foto7"];
        $foto8   = $dados_detalhe["foto8"];
    }
    /************Produto**************************/

    /************VERIFICA SE TEM TRANSACAO**************************/

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
            $pedidoU = "SP";
        }
    }

    /*********VERIFICA SE TEM TRANSACAO******************************/
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Detalhe</title>
        

        
        <!-- estilo -->
        
        
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
            <div id="detalhe_produto">
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
    // Fechar as queries
    mysqli_free_result($detalhe);
    mysqli_free_result($detalheU);
    mysqli_free_result($conCarrinho);

    // Fechar conexao
    mysqli_close($conecta);
?>