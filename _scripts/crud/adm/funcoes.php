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

    $codigo_data = $agora['year'] . "_" . $agora["yday"];
    $codigo_data .= $agora['hours'] . $agora['minutes'] . $agora['seconds'];

    return "foto_" . $codigo_data . "_" . $resultado;
}

function getExtensao($nome) 
{
    return strrchr($nome,"."); //pega oq tiver depois do "."
}

function retornarErro($numero_erro) 
{
    $array_erro = array(
        UPLOAD_ERR_OK =>            "Sem erro.",
        UPLOAD_ERR_INI_SIZE =>      "O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini.",
        UPLOAD_ERR_FORM_SIZE =>     "O arquivo excede o limite máximo de 600Kb.",
        UPLOAD_ERR_PARTIAL =>       "O upload do arquivo foi feito parcialmente.",
        UPLOAD_ERR_NO_FILE =>       "Nenhum arquivo foi enviado.",
        UPLOAD_ERR_NO_TMP_DIR =>    "Pasta temporária ausente.",
        UPLOAD_ERR_CANT_WRITE =>    "Falha em escrever o arquivo em disco.",
        UPLOAD_ERR_EXTENSION =>     "Uma extensão do PHP interrompeu o upload do arquivo."
    ); 

    return $array_erro[$numero_erro];
}

function publicarImagem($imagem,$grandePequena) 
{
    $arquivo_temporario = $imagem['tmp_name'];
    $nome_original      = $imagem['name'];
    $nome_novo          = gerarCodigoUnico() . getExtensao($nome_original);
    $nome_completo      = "../../../_img/produtos/" . $nome_novo;

    //verifica se e pequena ou grande

    if($grandePequena == "grande")
    {
        $nome_completo      = "../../../_img/produtos/original/" . $nome_novo;
    }
    else if($grandePequena == "pequena")
    {
        $nome_completo      = "../../../_img/produtos/preview/" . $nome_novo;
    }

    //move a imagem
    if(move_uploaded_file($arquivo_temporario, $nome_completo)) 
    {
        return array("Imagem publicada com sucesso",$nome_novo);  
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