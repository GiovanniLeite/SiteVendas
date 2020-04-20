<?php require_once("../../conexao/conexaoVenda.php") ?>  
<?php
    // conferir se a navegacao veio pelo preenchimento do formulario
    if(isset($_POST["nome"])) {
        
        $codigo = $_POST['codigoCliente'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $telefone = $_POST['telefone'];
        $celular = $_POST['celular'];
        $email = $_POST['email'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];   
        
        // Objeto para alterar
        $alterar = "UPDATE usuario ";
        $alterar .= "SET ";
        $alterar .= "nome = '{$nome}', ";
        $alterar .= "cpf = '{$cpf}', ";
        $alterar .= "rg = '{$rg}', ";
        $alterar .= "telefone = '{$telefone}', ";
        $alterar .= "celular = '{$celular}', ";
        $alterar .= "email = '{$email}', ";
        $alterar .= "cep = '{$cep}', ";
        $alterar .= "endereco = '{$endereco}', ";
        $alterar .= "bairro = '{$bairro}', ";
        $alterar .= "cidade = '{$cidade}', ";
        $alterar .= "estado = '{$estado}' ";
        $alterar .= "WHERE codigo = {$codigo} ";
        
        $retorno = array();
        $operacao_alterar = mysqli_query($conecta, $alterar);
        if($operacao_alterar) {
            $retorno["sucesso"] = true;
            $retorno["mensagem"] = "Cadastro alterado com sucesso.";
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
