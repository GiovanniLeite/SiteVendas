<?php require_once("../../conexao/conexaoVenda.php") ?>  
<?php
    // conferir se a navegacao veio pelo preenchimento do formulario
    if(isset($_POST["codigoCli"])) {
        
        $codigo = $_POST['codigoCli'];  
        $email = $_POST['emailSeguranca']; 
        
        // Objeto para alterar
        $alterar = "UPDATE usuario ";
        $alterar .= "SET ";
        $alterar .= "email = '{$email}' ";
        $alterar .= "WHERE codigo = {$codigo} ";
        
        $retorno = array();
        $operacaoAlterar = mysqli_query($conecta, $alterar);
        if($operacaoAlterar) {
            $retorno["sucesso"] = true;
            $retorno["mensagem"] = "Email alterado com sucesso.";
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
