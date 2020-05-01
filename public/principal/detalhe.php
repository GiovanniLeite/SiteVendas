<?php require_once("../../_scripts/conexao/conexaoVenda.php"); ?>
<?php
    session_start();
    /*
    if(!isset($_SESSION["user_portal"]))
    {
       header("location:login.php");
    }*/
    

    /* USAR ESTE
    if ( isset($_GET["codigo"]) ) {
        $produto_id = $_GET["codigo"];
    } else {
        header("Location:login.php");
    }*/
    
    $selectAdm = "SELECT * FROM usuario ";
    if(isset($_GET["codigo"]) ) {
        $cod = $_GET["codigo"];
        $selectAdm .= "WHERE codigo = {$cod} ";
    } else {
        $selectAdm .= "WHERE codigo= 1 ";
    }

    // Consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= "FROM produto ";
    if(isset($_GET["codigo"]) ) {
        $produto_id = $_GET["codigo"];
        $consulta .= "WHERE codigo = {$produto_id} ";
    } else {
        $consulta .= "WHERE codigo= 47 ";
    }
    $detalhe = mysqli_query($conecta,$consulta);

    // Testar erro
    if ( !$detalhe ) {
        die("Falha no Banco de dados");
    } else {
        $dados_detalhe = mysqli_fetch_assoc($detalhe);
        $codigo     = $dados_detalhe["codigo"];
        $nomeproduto    = $dados_detalhe["nome"];
        $descricao      = $dados_detalhe["descricao"];
        $preco  = $dados_detalhe["preco"];
        $estoque        = $dados_detalhe["quantidade"];
        $imagemgrande   = $dados_detalhe["fotoGrande"];
    }

    /********Transacao**********************************/
    
    // Consulta a tabela de 
    $selectCarrinho = "SELECT * FROM transacaotemp ";
    $selectCarrinho .= "WHERE codCliente = 2 ";
    /***refazer quando começar a passar o codigo do cliente praca
    if(isset($_GET["codigo"]) ) {
        $codCliente = $_GET["codigo"];
        $selectCarrinho .= "WHERE codCliente = {$cod} ";
    } else {
        $selectCarrinho .= "WHERE codCliente = 2 ";
    }
    ***/
    // cria objeto com dados do
    $conCarrinho = mysqli_query($conecta,$selectCarrinho);
    if(!$conCarrinho) {
        die("Erro na consulta");
    }

    $infoCarrinho = mysqli_fetch_assoc($conCarrinho);

    /********Transacao**********************************/
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

        <link href="../../_css/produto_detalhe.css" rel="stylesheet">
        <link href="../../_css/estilo.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        
        <main>  
            <div id="detalhe_produto">
                <!-- teste -->
                <section id="foto" class="padding-top0">
                    <div class="xzoom-container">
                        <img class="xzoom" id="fotoPrincipal" src="<?php echo $imagemgrande ?>" xoriginal="images/gallery/original/01_b_car.jpg"><!--  -->
                        <div class="xzoom-thumbs" id="fotoPequena">
                            <a href="images/gallery/original/01_b_car.jpg"><img class="xzoom-gallery" width="80" src="<?php echo $imagemgrande ?>" title="Primeira foto"></a>

                            <a href="images/gallery/original/02_o_car.jpg"><img class="xzoom-gallery" width="80" src="<?php echo $imagemgrande ?>" title="Segunda foto"></a>

                            <a href="images/gallery/original/03_r_car.jpg"><img class="xzoom-gallery" width="80" src="<?php echo $imagemgrande ?>" title="Terceira foto"></a>

                            <a href="images/gallery/original/04_g_car.jpg"><img class="xzoom-gallery" width="80" src="<?php echo $imagemgrande ?>" title="Quarta foto"></a>
                        </div>
                    </div>        
                  <div class="large-7 column" id="teste"></div>
                </section>
                <!-- teste -->
                <ul>
                    <!-- <li class="imagem"><img src="<?php /*echo $imagemgrande*/ ?>"></li> -->
                    <li><h1><?php echo $nomeproduto . " Cachecol Limeira"?></h1></li>
                    <li>Vendido e entregue por:<b> vendas.com.br</b></li>
                    <li><b>Apenas </b><?php echo $preco ?><b> à vista</b></li>
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
                                <button id="botaoSim" data-dismiss="modal" class="btn btn-block" onclick='comprar(7,<?php echo $codigo; ?>,"<?php echo $nomeproduto; ?>","<?php echo $preco; ?>","foto","<?php echo $infoCarrinho["pedido"]; ?>")'>Sim</button>
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