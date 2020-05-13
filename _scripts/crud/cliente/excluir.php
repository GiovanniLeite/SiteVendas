<?php require_once("../../conexao/conexaoVenda.php") ?>
<?php
    
if( isset($_POST["codigoC"]) ) 
{
    $codigo = $_POST["codigoC"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senhaExcluir"];

    // Consulta a tabela de usuario
    $sUsuario = "SELECT * FROM usuario WHERE codigo = {$codigo} ";

    // cria objeto com dados do usuario
    $conUsuario = mysqli_query($conecta,$sUsuario);
    if(!$conUsuario) 
    {
        $retorno["sucesso"] = false;
        $retorno["mensagem"] = "FALHA - Usuário não encontrado";
    }
    else
    {
        $infoUsuario = mysqli_fetch_assoc($conUsuario);
        $usuarioReal = $infoUsuario["usuario"];
        $senhaReal = $infoUsuario["senha"];
        if($usuario == $usuarioReal && $senha == $senhaReal)//confirmou certo
        {
            $exclusao = "DELETE FROM usuario ";
            $exclusao .= "WHERE codigo = {$codigo}";
            $conExclusao = mysqli_query($conecta,$exclusao);
            if($conExclusao) 
            {
                $retorno["sucesso"] = true;
                $retorno["mensagem"] = "Conta excluida com sucesso.";
            } 
            else 
            {
                $retorno["sucesso"] = false;
                $retorno["mensagem"] = "FALHA - O Sistema não pode excluir.";
            }
        }
        else//confirmou errado
        {
            $retorno["sucesso"] = false;
            $retorno["mensagem"] = "Usuário e/ou Senha não correspondem a esta conta.";
        }
    }

    // converter retorno em json
    echo json_encode($retorno);
}
unset($_POST);

// Fechar conexao
mysqli_close($conecta);

?>