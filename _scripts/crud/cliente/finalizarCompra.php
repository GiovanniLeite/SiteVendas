<?php require_once("../../conexao/conexaoVenda.php") ?>
<?php include_once("gerarPedido.php") ?>
<?php
    
if(isset($_POST['tran']))
{

    /***************Pegando transacao e produtos***************/
    $transacao = $_POST['tran'];
    $produtos = $_POST['prod'];
    /***************Pegando transacao e produtos***************/

    /***************Transacao************************************************/

    //Pega os dados da transacao temporaria
    $codTranTemp = $transacao['codigo'];
    $totalVenda = $transacao['totalVenda'];
    //$dataVenda = $transacao['dataVenda'];
    $codCliente = $transacao['codCliente'];
    $pedido = $transacao['pedido'];

    //pegando a data
    date_default_timezone_set('America/Sao_Paulo');
    $hoje = getdate();
    $dataVenda = $hoje["mday"] . "/" . $hoje['mon'] . "/" . $hoje['year'];

    //Cria a transacao permanente
    $inserirTransacao = "INSERT INTO transacao ";
    $inserirTransacao .= "(totalVenda,dataVenda,codCliente,pedido) ";
    $inserirTransacao .= "VALUES ";
    $inserirTransacao .= "('$totalVenda','$dataVenda','$codCliente','$pedido')";

    $retorno = array();//RETORNO

    $opInserirTransacao = mysqli_query($conecta,$inserirTransacao);
    if($opInserirTransacao) {
        $retorno["inseriuTran"] = "Transação permanente salva com sucesso.";
    } else {
        $retorno["inseriuTran"] = "Transação permanente não pode ser salva.";
    }

    //Zera a transacao temporaria
    $pedidoAleatorio = gerarPedido();

    $tranTemp = "UPDATE transacaotemp ";
    $tranTemp .= "SET ";
    $tranTemp .= "totalVenda = 'R$ 00,00', ";
    $tranTemp .= "dataVenda = '00/00/0000', ";
    $tranTemp .= "pedido = '{$pedidoAleatorio}' ";
    $tranTemp .= "WHERE codigo = {$codTranTemp}";

    $optranTemp = mysqli_query($conecta,$tranTemp);
    if($optranTemp) {
        $retorno["zerouTran"] = "Transação temporária zerada com sucesso.";
    } else {
        $retorno["zerouTran"] = "Transação temporária não pode ser zerada.";
    }
    /***************Transacao**************************************************/

    /***************Produtos***************************************************/
    $cont = 1;
    foreach($produtos as $produto){

        //Pega os dados do produto temporario
        $codProdutoTemp = $produto['codigo'];
        $quantidade = $produto['quantidade'];
        $codProduto = $produto['codProduto'];
        $nome = $produto['nome'];
        $valor = $produto['valor'];
        $foto = $produto['foto'];
        $pedido = $produto['pedido'];

        //Cria o produtoVenda permanente
        $inserirProdVend = "INSERT INTO produtovenda ";
        $inserirProdVend .= "(quantidade,codProduto,nome,valor,foto,pedido) ";
        $inserirProdVend .= "VALUES ";
        $inserirProdVend .= "('$quantidade','$codProduto','$nome','$valor','$foto','$pedido')";

        $opInserirProdVend = mysqli_query($conecta,$inserirProdVend);
        if($opInserirProdVend) {
            $retorno["inseriuProd" . $cont] = "ProdutoVenda permanente salvo com sucesso.";
        } else {
            $retorno["inseriuProd" . $cont] = "ProdutoVenda permanente não pode ser salvo.";
        }

        //Apaga o produtovenda temporario
        $excluirProdTemp = "DELETE FROM produtovendatemp ";
        $excluirProdTemp .= "WHERE codigo = {$codProdutoTemp}";

        $opExcluirProdTemp = mysqli_query($conecta,$excluirProdTemp);
        if($opExcluirProdTemp) {
            $retorno["apagouProd" . $cont] = "ProdutoVenda temporária excluída com sucesso.";
        } else {
            $retorno["apagouProd" . $cont] = "ProdutoVenda temporária não pode ser excluída.";
        }

        $cont ++;
    }
    /***************Produtos**************************************************/

    echo json_encode($retorno);
}

unset($_POST);

// Fechar conexao
mysqli_close($conecta);

?>










































