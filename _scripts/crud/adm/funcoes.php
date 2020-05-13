<?php
function gerarCodigoUnico() 
{
    $alfabeto = "23456789ABCDEFGHJKMNPQRS";
    $tamanho = 50;
    $letra = "";
    $resultado = "";

    for($i = 1; $i < $tamanho ;$i++)
    {
        $letra = substr($alfabeto, rand(0,23), 1); //sorteia
        $resultado .= $letra;
    }

    date_default_timezone_set('America/Sao_Paulo');
    $agora = getdate();

    $codigoData = $agora['year'] . "_" . $agora["yday"];
    $codigoData .= $agora['hours'] . $agora['minutes'] . $agora['seconds'];

    return "foto_" . $codigoData . "_" . $resultado;
}

function getExtensao($nome) 
{
    return strrchr($nome,"."); //pega oq tiver depois do "."
}

function retornarErro($numeroErro) 
{
    $arrayErro = array(
        UPLOAD_ERR_OK =>            "Sem erro.",
        UPLOAD_ERR_INI_SIZE =>      "O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini.",
        UPLOAD_ERR_FORM_SIZE =>     "O arquivo excede o limite máximo de 600Kb.",
        UPLOAD_ERR_PARTIAL =>       "O upload do arquivo foi feito parcialmente.",
        UPLOAD_ERR_NO_FILE =>       "Nenhum arquivo foi enviado.",
        UPLOAD_ERR_NO_TMP_DIR =>    "Pasta temporária ausente.",
        UPLOAD_ERR_CANT_WRITE =>    "Falha em escrever o arquivo em disco.",
        UPLOAD_ERR_EXTENSION =>     "Uma extensão do PHP interrompeu o upload do arquivo."
    ); 

    return $arrayErro[$numeroErro];
}

function publicarImagem($imagem,$grandePequena) 
{
    $arquivoTemporario = $imagem['tmp_name'];
    $nomeOriginal      = $imagem['name'];
    $nomeNovo          = gerarCodigoUnico() . getExtensao($nomeOriginal);
    $nomeCompleto      = "../../../_img/produtos/" . $nomeNovo;

    //verifica se e pequena ou grande

    if($grandePequena == "grande")
    {
        $nomeCompleto      = "../../../_img/produtos/original/" . $nomeNovo;
    }
    else if($grandePequena == "pequena")
    {
        $nomeCompleto      = "../../../_img/produtos/preview/" . $nomeNovo;
    }

    //move a imagem
    if(move_uploaded_file($arquivoTemporario, $nomeCompleto)) 
    {
        return array("Imagem publicada com sucesso",$nomeNovo);  
    } 
    else 
    {
        //return array("Erro","caminhoErrado");
        return array(retornarErro($imagem['error']),"");            
    }
}

function apagarImagem($foto,$tamanho) 
{
    if($tamanho == "grande")
    {
        $caminho = "../../../_img/produtos/original/" . $foto;
    }
    else if($tamanho == "pequena")
    {
        $caminho = "../../../_img/produtos/preview/" . $foto;
    }

    //apagar imagem
    if(unlink($caminho)) 
    {
        return "Apagou a foto.";  
    } 
    else 
    {
        return "Não apagou a foto.";            
    }
}


?>