<?php require_once("../../conexao/conexaoVenda.php") ?>  
<?php
if (isset($_POST['nome'])) {

    $adm = '0';
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $retorno = array();

    //validando cpf, rg, email, usuario
    $consulta = "SELECT * FROM usuario";

    $qConsulta = mysqli_query($conecta, $consulta);
    if ($qConsulta) //Consulta a tabela usuario
    {
        $cont = 0;
        foreach ($qConsulta as $usuarioS) //percorre a lista de usuarios
        {

            if ($usuarioS["cpf"] == $cpf || $usuarioS["rg"] == $rg || $usuarioS["usuario"] == $usuario || $usuarioS["email"] == $email) //verifica se cpf, rg, email e usuario ja existem
            {
                $retorno["sucesso"] = false;
                $retorno["mensagem"] = "CPF, RG, EMAIL E/OU USUARIO INDISPONÍVEIS.";
                $retorno["mensagem1"] = "CPF, RG, EMAIL E/OU USUARIO INDISPONÍVEIS Cadastro não efetuado.";
                $cont++;
            }
        }

        if ($cont == 0) //cpf, rg, email e usuario estao livres
        {
            $retorno["mensagem"] = "CPF, RG, EMAIL E USUARIO LIVRES";

            // Insercao no banco
            $inserir = "INSERT INTO usuario ";
            $inserir .= "(adm,nome,cpf,rg,telefone,celular,cep,endereco,bairro,cidade,estado,email,usuario,senha,transacao) ";
            $inserir .= "VALUES ";
            $inserir .= "('$adm','$nome','$cpf','$rg','$telefone','$celular','$cep','$endereco','$bairro','$cidade','$estado','$email','$usuario','$senha',0)";

            $qInserir = mysqli_query($conecta, $inserir);
            if ($qInserir) //conseguiu inserir o cadastro
            {
                $retorno["sucesso"] = true;
                $retorno["mensagem1"] = "Cadastro criado com sucesso.";
            } else // erro ao inserir o cadastro
            {
                $teste1 = mysqli_errno($conecta);
                $teste2 = mysqli_error($conecta);
                $retorno["sucesso"] = false;
                $retorno["mensagem1"] = "ERRO-(INSERIR) Cadastro não efetuado."; //$teste2;//"Cadastro não efetuado";
            }
        }
    } else //Erro na consulta a tabela usuario
    {
        $retorno["sucesso"] = false;
        $retorno["mensagem"] = "ERRO - CPF, RG, EMAIL E USUARIO Não verificados.";
        $retorno["mensagem1"] = "ERRO-(CONSULTA) Cadastro não efetuado.";
    }

    echo json_encode($retorno);
}
unset($_POST);

// Fechar conexao
mysqli_close($conecta);
?>
