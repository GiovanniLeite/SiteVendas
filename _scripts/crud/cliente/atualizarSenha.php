<?php require_once("../../conexao/conexaoVenda.php") ?>  
<?php

if(isset($_POST["codigoCl"])) 
{

    $codigo = $_POST['codigoCl'];  
    $senha = $_POST['senha']; 

    // Objeto para alterar
    $alterar = "UPDATE usuario ";
    $alterar .= "SET ";
    $alterar .= "senha = '{$senha}' ";
    $alterar .= "WHERE codigo = {$codigo} ";

    $retorno = array();
    $operacaoAlterar = mysqli_query($conecta, $alterar);
    if($operacaoAlterar) 
    {
        $retorno["sucesso"] = true;
        $retorno["mensagem"] = "Senha alterada com sucesso.";
    } 
    else 
    {
        $retorno["sucesso"] = false;
        $retorno["mensagem"] = "Falha no sistema, tente mais tarde.";
    }

    echo json_encode($retorno); 
}


unset($_POST);

// Fechar conexao
mysqli_close($conecta);
?>
