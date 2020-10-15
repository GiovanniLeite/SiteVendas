<?php require_once("../../conexao/conexaoVenda.php") ?>  
<?php

if (isset($_POST["nome"])) {

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

    $retorno = array();

    //validando cpf, rg, email
    $consulta = "SELECT * FROM usuario";

    $qConsulta = mysqli_query($conecta, $consulta);
    if ($qConsulta) //Consulta a tabela usuario
    {
        $cont = 0;
        foreach ($qConsulta as $usuarioS) //percorre a lista de usuarios
        {

            if ($usuarioS["cpf"] == $cpf || $usuarioS["rg"] == $rg || $usuarioS["email"] == $email) //verifica se cpf, rg e email ja existem
            {
                $retorno["sucesso"] = false;
                $retorno["mensagem"] = "CPF, RG E/OU EMAIL INDISPONÍVEIS.";
                $retorno["mensagem1"] = "Cadastro não alterado CPF, RG E/OU EMAIL INDISPONÍVEIS.";
                $cont++;

                if ($cont > 0 && $usuarioS["codigo"] == $codigo) {
                    $cont = 0;
                }
            }
        }

        if ($cont == 0) //cpf, rg, email e usuario estao livres
        {
            $retorno["mensagem"] = "CPF, RG E EMAIL LIVRES";

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

            $operacaoAlterar = mysqli_query($conecta, $alterar);
            if ($operacaoAlterar) {
                $retorno["sucesso"] = true;
                $retorno["mensagem1"] = "Cadastro alterado com sucesso.";
            } else {
                $retorno["sucesso"] = false;
                $retorno["mensagem1"] = "Falha no sistema-(ALTERAR), tente mais tarde.";
            }
        }
    } else //Erro na consulta a tabela usuario
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
