<?php require_once("../../conexao/conexaoVenda.php") ?>  
<?php
if (isset($_POST["numeroCartao"])) {

    $codCliente = $_POST['codigoCliente'];
    $codigo = $_POST['codCartao'];
    $nomeTitular = $_POST['nomeTitular'];
    $bandeira = $_POST['bandeira'];
    $numeroCartao = $_POST['numeroCartao'];
    $validade = $_POST['validade'];
    $codigoSeguranca = $_POST['codigoSeguranca'];
    $tipo = $_POST['tipo'];
    $retorno = array();

    $consult = "SELECT * FROM cartao WHERE codigo = {$codigo}";
    $operacaoConsult = mysqli_query($conecta, $consult);
    if ($operacaoConsult) //cliente ja tem cartao registrado
    {
        // Objeto para alterar
        $alterar = "UPDATE cartao ";
        $alterar .= "SET ";
        $alterar .= "titular = '$nomeTitular', ";
        $alterar .= "bandeira = '$bandeira', ";
        $alterar .= "numero = '$numeroCartao', ";
        $alterar .= "validade = '$validade', ";
        $alterar .= "codSegu = '$codigoSeguranca', ";
        $alterar .= "tipo = '$tipo' ";
        $alterar .= "WHERE codigo = $codigo ";

        $operacaoAlterar = mysqli_query($conecta, $alterar);
        if ($operacaoAlterar) {
            $retorno["sucesso"] = true;
            $retorno["mensagem"] = "Dados do cartão alterados com sucesso.";
        } else {
            /*$teste1 = mysqli_errno($conecta);
            $teste2 = mysqli_error($conecta);*/
            $retorno["sucesso"] = false;
            $retorno["mensagem"] = "Falha no sistema-(Alterar), tente mais tarde. ";
        }
    } else {   //primeiro registro de cartao do cliente
        $inserirCartao = "INSERT INTO cartao ";
        $inserirCartao .= "(codCliente,titular,bandeira,numero,validade,codSegu,tipo) ";
        $inserirCartao .= "VALUES ";
        $inserirCartao .= "($codCliente,'$nomeTitular','$bandeira','$numeroCartao','$validade','$codigoSeguranca','$tipo')";

        $operacaoInserir = mysqli_query($conecta, $inserirCartao);
        if ($operacaoInserir) {
            $retorno["sucesso"] = true;
            $retorno["mensagem"] = "Cartão atualizado com sucesso.";
        } else {
            $retorno["sucesso"] = false;
            $retorno["mensagem"] = "Falha no sistema-(Inserir), tente mais tarde. ";
        }
    }


    echo json_encode($retorno);
}


unset($_POST);

// Fechar conexao
mysqli_close($conecta);
?>
