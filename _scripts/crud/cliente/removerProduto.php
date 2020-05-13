<?php require_once("../../conexao/conexaoVenda.php") ?>
<?php
    
if(isset($_POST['prodR']))
{
    $tranc = $_POST['tranc'];
    $produto = $_POST['prodR'];
    $valor = $produto['valor'];


    /***************Transação***************/
    $consulta = "SELECT * FROM transacaotemp ";
    $consulta .= "WHERE pedido = '{$tranc['codigo']}' ";
    $opConsulta = mysqli_query($conecta,$consulta);
    if($opConsulta) 
    {
        $transacao = mysqli_fetch_assoc($opConsulta);
        $totalVenda = $tranc['totalVenda'] - $valor;

        $alterar = "UPDATE transacaotemp ";
        $alterar .= "SET ";
        $alterar .= "totalVenda = '{$totalVenda}' ";
        $alterar .= "WHERE codigo = {$tranc['codigo']} ";

        $opAlterar = mysqli_query($conecta,$alterar);

        if($opAlterar) 
        {
            $retorno["mensagem"] = "Valor da Transação atualizado.";

            $excluirProdTemp = "DELETE FROM produtovendatemp ";
            $excluirProdTemp .= "WHERE codigo = {$produto['codigo']}";

            $opExcluirProdTemp = mysqli_query($conecta,$excluirProdTemp);
            if($opExcluirProdTemp) 
            {
                $retorno["sucesso"] = true;
                $retorno["mensagem1"] = "Produto removido com sucesso.";
            } 
            else 
            {
                $retorno["sucesso"] = false;
                $retorno["mensagem1"] = "Produto não pode ser removido.";
            }
        }
        else
        {
            //$teste = mysqli_error($conecta);
            $retorno["sucesso"] = false;
            $retorno["mensagem"] = "Erro na alteração - Valor da Transação não atualizado";
            $retorno["mensagem1"] = "Produto não pode ser removido.";
        }
    } 
    else 
    {
        $retorno["sucesso"] = false;
        $retorno["mensagem"] = "Erro na consulta - Valor da Transação não atualizado";
        $retorno["mensagem1"] = "Produto não pode ser removido.";
    }
    /***************Transação***************/

    echo json_encode($retorno);
}

unset($_POST);

// Fechar conexao
mysqli_close($conecta);
?>










































