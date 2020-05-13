<?php require_once("../../conexao/conexaoVenda.php") ?>
<?php
    
if(isset($_POST['cod']))
{

    //ProdutoVendaTemp
    $pedido = $_POST['ped'];
    $quantidade = $_POST['quan'];
    $codProduto = $_POST['cod'];
    $nome = $_POST['nom'];
    $valor = $_POST['val'];
    $foto = $_POST['ft'];
    $codCliente = $_POST['cl'];

    //retorno
    $retorno = array();

    if($pedido == "SP") //primeira compra do cliente SP = sem pedido pois n existe uma transacao temporaria pra ele ainda
    {
        $totalVenda = $valor;
        $dataVenda = "00/00/00";
        $pedido = gerarPedido();

        //Cria a transacao permanente
        $inserirTransacao = "INSERT INTO transacaotemp ";
        $inserirTransacao .= "(totalVenda,dataVenda,codCliente,pedido) ";
        $inserirTransacao .= "VALUES ";
        $inserirTransacao .= "('$totalVenda','$dataVenda','$codCliente','$pedido')";

        $opInserirTransacao = mysqli_query($conecta,$inserirTransacao);
        if($opInserirTransacao) {
            $retorno["inseriuTran"] = "Transação salva com sucesso.";

            /***************Usuario***************/
            $alterarCli = "UPDATE usuario ";
            $alterarCli .= "SET ";
            $alterarCli .= "transacao = '1' ";
            $alterarCli .= "WHERE codigo = {$codCliente} ";
            $opAlterarCli = mysqli_query($conecta,$alterarCli);
            if($opAlterarCli) 
            {
                $retorno["alterouCli"] = "Transacao alterada no cliente";

                /***************Produto***************/
                //Cria o produtoVenda permanente
                $inserirProdVend = "INSERT INTO produtovendatemp ";
                $inserirProdVend .= "(quantidade,codProduto,nome,valor,foto,pedido) ";
                $inserirProdVend .= "VALUES ";
                $inserirProdVend .= "('$quantidade','$codProduto','$nome','$valor','$foto','$pedido')";

                $opInserirProdVend = mysqli_query($conecta,$inserirProdVend);
                if($opInserirProdVend) {
                    $retorno["inseriuProd"] = "ProdutoVenda temporário salvo com sucesso.";
                } else {
                    $retorno["inseriuProd"] = "ProdutoVenda temporário não pode ser salvo.";
                }

                /***************Produtos**************/
            } 
            else 
            {
                $retorno["alterouCli"] = "Erro ao alterar - Cliente continua SP";
                $retorno["inseriuProd"] = "ProdutoVenda temporário não pode ser salvo.";
            }
            /***************Usuario***************/
        } 
        else 
        {
            $retorno["inseriuTran"] = "Transação não pode ser salva.";
            $retorno["alterouCli"] = "Erro ao alterar - Cliente continua SP";
            $retorno["inseriuProd"] = "ProdutoVenda temporário não pode ser salvo.";
        }
    }
    else
    {
        /***************Transação***************/
        $consulta = "SELECT * FROM transacaotemp ";
        $consulta .= "WHERE pedido = '{$pedido}' ";
        $opConsulta = mysqli_query($conecta,$consulta);
        if($opConsulta) 
        {
            $transacao = mysqli_fetch_assoc($opConsulta);
            $totalVenda = $valor + $transacao['totalVenda'];

            $alterar = "UPDATE transacaotemp ";
            $alterar .= "SET ";
            $alterar .= "totalVenda = '{$totalVenda}' ";
            $alterar .= "WHERE codigo = {$transacao['codigo']} ";
            $opAlterar = mysqli_query($conecta,$alterar);

            if($opAlterar) 
            {
                $retorno["alterouTran"] = "Valor da Transação atualizado";

                /***************Produto***************/
                //Cria o produtoVenda permanente
                $inserirProdVend = "INSERT INTO produtovendatemp ";
                $inserirProdVend .= "(quantidade,codProduto,nome,valor,foto,pedido) ";
                $inserirProdVend .= "VALUES ";
                $inserirProdVend .= "('$quantidade','$codProduto','$nome','$valor','$foto','$pedido')";

                $opInserirProdVend = mysqli_query($conecta,$inserirProdVend);
                if($opInserirProdVend) 
                {
                    $retorno["inseriuProd"] = "ProdutoVenda temporário salvo com sucesso.";
                } 
                else 
                {
                    $retorno["inseriuProd"] = "ProdutoVenda temporário não pode ser salvo.";
                }
                /***************Produtos**************/
            }
            else
            {
                $retorno["alterouTran"] = "Erro na alteração - Valor da Transação não atualizado";
                $retorno["inseriuProd"] = "ProdutoVenda temporário não pode ser salvo.";
            }
        } 
        else 
        {
            $retorno["alterouTran"] = "Erro na consulta - Valor da Transação não atualizado";
            $retorno["inseriuProd"] = "ProdutoVenda temporário não pode ser salvo.";
        }
        /***************Transação***************/
    }
    
    echo print_r($retorno);
}

unset($_POST);

// Fechar conexao
mysqli_close($conecta);

function gerarPedido() 
{
    $alfabeto = "23456789ABCDEFGHJKMNPQRS";
    $tamanho = 20;
    $letra = "";
    $resultado = "";

    for($i = 1; $i < $tamanho ;$i++)
    {
        $letra = substr($alfabeto, rand(0,23), 1); //sorteia
        $resultado .= $letra;
    }

    date_default_timezone_set('America/Sao_Paulo');
    $agora = getdate();

    $codigo_data = $agora['year'] . $agora["yday"];
    $codigo_data .= $agora['hours'] . $agora['minutes'] . $agora['seconds'];

    return "PD" . $codigo_data . $resultado . "PD";
}
?>










































