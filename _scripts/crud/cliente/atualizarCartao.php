<?php require_once("../../conexao/conexaoVenda.php") ?>  
<?php
    // conferir se a navegacao veio pelo preenchimento do formulario
    if(isset($_POST["numeroCartao"])) {
        
        $codigo = $_POST['codCartao'];  
        $nomeTitular = $_POST['nomeTitular'];
        $bandeira = "Visa";
        $numeroCartao = $_POST['numeroCartao'];
        $validade = $_POST['validade'];
        $codigoSeguranca = $_POST['codigoSeguranca'];
        $credito = "1";
        
        // Objeto para alterar
        $alterar = "UPDATE cartao ";
        $alterar .= "SET ";
        $alterar .= "titular = '{$nomeTitular}', ";
        $alterar .= "bandeira = '{$bandeira}', ";
        $alterar .= "numero = '{$numeroCartao}', ";
        $alterar .= "validade = '{$validade}', ";
        $alterar .= "codSegu = '{$codigoSeguranca}', ";
        $alterar .= "credito = '{$credito}' ";
        $alterar .= "WHERE codigo = {$codigo} ";
        
        $retorno = array();
        $operacao_alterar = mysqli_query($conecta, $alterar);
        if($operacao_alterar) {
            $retorno["sucesso"] = true;
            $retorno["mensagem"] = "Dados do cartão alterados com sucesso.";
        } else {
            $retorno["sucesso"] = false;
            $retorno["mensagem"] = "Falha no sistema, tente mais tarde.";
        }
        
        echo json_encode($retorno); 
    }
	
    
    unset($_POST);
    
	// Fechar conexao
    mysqli_close($conecta);
?>
