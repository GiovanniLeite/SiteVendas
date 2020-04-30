document.getElementById("linkCentral").href="../../public/principal/listagem.php";
document.getElementById("imagemCentral").src="../../_img/VENDAS.png";
var topoA1 = document.getElementsByClassName("inicio")[0];
topoA1.href="../principal/listagem.php";
var topoA2 = document.getElementsByClassName("inicio")[1];
topoA2.href="../principal/listagem.php";
if(adm == 0)
{
    document.getElementById("clienteAdm").href="../../public/cadastros/formCliente.php";
    document.getElementById("topoCompras").href="../../public/cadastros/formCliente.php#tabs-3";
    document.getElementById("topoCarrinho").href="../../public/cadastros/formCliente.php#tabs-4";
}
else if(adm == 1)
{
    document.getElementById("clienteAdm").href="../../public/cadastros/formAdm.php";
    document.getElementById("topoCompras").style.display = "none";
    document.getElementById("topoCarrinho").style.display = "none";
    document.getElementById("topoB1").style.display = "none";
    document.getElementById("topoB2").style.display = "none";
}