<?php require_once("../../conexao/conexaoVenda.php") ?>
<?php
    
    if(isset($_POST['cod'])){

        /***************Transacao colocar valor na transacao*********************
        
        //Pega os dados da transacao temporaria
        $codTranTemp = $transacao['codigo'];
        $totalVenda = $transacao['totalVenda'];
        $dataVenda = $transacao['dataVenda'];
        $codCliente = $transacao['codCliente'];
        $pedido = $transacao['pedido'];
        
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

        //Apaga a transacao temporaria
        $excluirTranTemp = "DELETE FROM transacaotemp ";
        $excluirTranTemp .= "WHERE codigo = {$codTranTemp}";
        
        $opExcluirTranTemp = mysqli_query($conecta,$excluirTranTemp);
        if($opExcluirTranTemp) {
            $retorno["apagouTran"] = "Transação temporária excluída com sucesso.";
        } else {
            $retorno["apagouTran"] = "Transação temporária não pode ser excluída.";
        }
        /***************Transacao colocar valor na transacao***********************/
        
        
        /***************Produto***************/
        $quantidade = $_POST['quan'];
        $codProduto = $_POST['cod'];
        $nome = $_POST['nom'];
        $valor = $_POST['val'];
        $foto = $_POST['ft'];
        $pedido = $_POST['ped'];
        
        //Cria o produtoVenda permanente
        $inserirProdVend = "INSERT INTO produtovendatemp ";
        $inserirProdVend .= "(quantidade,codProduto,nome,valor,foto,pedido) ";
        $inserirProdVend .= "VALUES ";
        $inserirProdVend .= "('$quantidade','$codProduto','$nome','$valor','$foto','$pedido')";

        $retorno = array();
        
        $opInserirProdVend = mysqli_query($conecta,$inserirProdVend);
        if($opInserirProdVend) {
            $retorno["inseriuProd"] = "ProdutoVenda temporário salvo com sucesso.";
        } else {
            $retorno["inseriuProd"] = "ProdutoVenda temporário não pode ser salvo.";
        }

        /***************Produtos**************************************************/

        echo print_r($retorno);

    }
    
    unset($_POST);

	// Fechar conexao
    mysqli_close($conecta);
?>










































