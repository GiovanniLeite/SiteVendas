<?php require_once("../../conexao/conexaoVenda.php") ?>  
<?php

if(isset($_POST["codigoCli"])) 
{

    $codigo = $_POST['codigoCli'];  
    $email = $_POST['emailSeguranca']; 

    $retorno = array();
    
    //validando email
    $consulta = "SELECT * FROM usuario";

    $qConsulta = mysqli_query($conecta,$consulta);
    if($qConsulta)//Consulta a tabela usuario
    {
        $cont = 0;
        foreach($qConsulta as $usuarioS)//percorre a lista de usuarios
        {  

            if($usuarioS["email"] == $email)//verifica se email ja existe
            {
                $retorno["sucesso"] = false;
                $retorno["mensagem"] = "EMAIL INDISPONÍVEL.";  
                $retorno["mensagem1"] = "Email indisponível.";
                $cont ++;

                if($cont > 0 && $usuarioS["codigo"] == $codigo)
                {
                    $cont = 0;
                }
            }
        }

        if($cont == 0)//email esta livre
        {
            $retorno["mensagem"] = "EMAIL LIVRE";   

            // Objeto para alterar
            $alterar = "UPDATE usuario ";
            $alterar .= "SET ";
            $alterar .= "email = '{$email}' ";
            $alterar .= "WHERE codigo = {$codigo} ";

            $operacaoAlterar = mysqli_query($conecta, $alterar);
            if($operacaoAlterar) 
            {
                $retorno["sucesso"] = true;
                $retorno["mensagem1"] = "Email alterado com sucesso.";
            } 
            else 
            {
                $retorno["sucesso"] = false;
                $retorno["mensagem1"] = "Falha no sistema-(ALTERAR), tente mais tarde.";
            }
        }
    } 
    else//Erro na consulta a tabela usuario
    {
        $retorno["sucesso"] = false;
        $retorno["mensagem"] = "ERRO - CPF, RG E EMAIL Não verificados.";
        $retorno["mensagem1"] = "Falha no sistema-(CONSULTA), tente mais tarde..";
    }
    
    echo json_encode($retorno); 
}


unset($_POST);

// Fechar conexao
mysqli_close($conecta);
?>
