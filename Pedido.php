<?php
 
 if (isset($_POST['txtId']))
 {
$idPed = $_POST['txtId'];
}
 if (isset($_POST['cmbProduto']))
 {
$idProduto = $_POST['cmbProduto'];
}
 if (isset($_POST['cmbCliente']))
 {
$idCliente = $_POST['cmbCliente'];
}
 if (isset($_POST['txtQuantidade']))
 {
$quantidade = $_POST['txtQuantidade'];
}
$conec = mysql_connect('sql5.freemysqlhosting.net:3306','sql5106852','Ig2KJjisyN');
$db = mysql_select_db('sql5106852');

if (isset($_POST["btnSalvar"]))
{
if ($idPed == 0) //Inclusao
{
// validacao de quantidade
				$queryValida = "Select quantidade from produto where id = ". $idProduto;
				$sql = mysql_query($queryValida,$conec);
				
				$linha = mysql_fetch_row($sql);
				
				if ($linha[0] < $quantidade)
				{
					                 echo"<div class='alert alert-warning'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Quantidade em estoque menor que a solicidada. Não é possível realizar o pedido.";
				echo"</div>";
				}
				else
				{
				//  baixa de produto
				$query1 = "Update produto set quantidade = quantidade - ".$quantidade." where id = ".$idProduto;
                $sql1 = mysql_query($query1,$conec);
				
                $query2 = "INSERT INTO pedido (idProduto,idCliente, quantidadeProduto) VALUES (".$idProduto.", ".$idCliente.",".$quantidade.")";
                $sql2 = mysql_query($query2,$conec);
                if($sql2){
				echo"<div class='alert alert-success'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Pedido cadastrado com sucesso!";
				echo"</div>";
              
                }else{
                echo"<div class='alert alert-danger'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Ocorreu um problema";
				echo"</div>";
                }
	}}
	else //Alteracao
	{
	
		                $query = "update pedido set idProduto =".$idProduto.", idCliente = ".$idCliente.", telefone = ".$quantidade." where id =". $idPed;
                $sql = mysql_query($query,$conec);
                if($sql){
				echo"<div class='alert alert-success'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Pedido alterado com sucesso!";
				echo"</div>";
              
                }else{
                echo"<div class='alert alert-danger'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Ocorreu um problema";
				echo"</div>";
                }
	}
}


if (isset($_GET["id"]))
{
$idPed = $_GET["id"];
if (($_GET["Acao"]=="A"))
{
	$idPed = $_GET["id"];
				$query = "select id, idProduto, idCliente, quantidade from pedido where id = ".$idPed;
				$sql = mysql_query($query,$conec);
				$linha =  mysql_fetch_array($sql);
				$_POST['id'] = $linha['id'];
				$_POST['idProduto']  = $linha['idProduto'];
				$_POST['idCliente'] = $linha['idCliente'];
				$_POST['quantidade'] = $linha['quantidade'];
}
else 
{
				// devolvendo o produto
				$query1 = "Update produto set quantidade = quantidade + (select quantidadeProduto from pedido where id = ".$idPed . ")";
                $sql1 = mysql_query($query1,$conec);
                $query = "delete from pedido where id =". $idPed;
                $sql = mysql_query($query,$conec);
                 
                if($sql){
				echo"<div class='alert alert-success'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Pedido excluido com sucesso!";
				echo"</div>";
              
                }else{
                echo"<div class='alert alert-danger'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Ocorreu um problema";
				echo"</div>";
                }
}
}

?>
<html>
<head>
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/grid.css" rel="stylesheet">
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="starter-template.css" rel="stylesheet">
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Controle de Estoque</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="CadastroProduto.php">Cadastro de Produtos</a></li>
            <li ><a href="CadastroCliente1.php">Cadastro de Clientes</a></li>
            <li><a class="active" href="pedido.php">Pedidos</a></li>
          </ul>
        </div>
      </div>
    </nav>
<title> Pedidos </title>
</head>
<body>
<br/>
<br/>
<br/>
<form method="POST" action="pedido.php">




<div class="Cadastro">

<?php
$conec = mysql_connect('sql5.freemysqlhosting.net:3306','sql5106852','Ig2KJjisyN');
$db = mysql_select_db('sql5106852');
            $query = "select pe.id, p.Nome as produto, c.Nome as cliente, pe.quantidadeProduto from pedido pe inner join produto p on p.id = pe.idProduto inner join cliente c on c.id= pe.idCliente ";
            $sql = mysql_query($query,$conec);
			echo "<b><div class='row'>";
      echo "  <div class='col-md-4'>Cliente</div>";
      echo " <div class='col-md-3'>Produto</div>";
      echo " <div class='col-md-3'>Quantidade</div></b>";
	  echo " <div class='col-md-1'></div></b>";
	  echo " <div class='col-md-1'></div></b>";
      echo "</div>";
while($linha = mysql_fetch_array($sql))
  {
    echo "<div class='row'>";
      echo "  <div class='col-md-4'>".$linha['cliente']."</div>";
      echo " <div class='col-md-3'>".$linha['produto']."</div>";
      echo " <div class='col-md-3'>".$linha['quantidadeProduto']."</div>";
	  echo "<div class='col-md-1'><a href='pedido.php?id=".$linha['id']."&Acao=A'>Alterar</a></div>";
	  echo "<div class='col-md-1'><a href='pedido.php?id=".$linha['id']."&Acao=E'>Excluir</a></div>";
      echo "</div>";
  }
  
?>
<BR> <BR><BR> <BR>
<?php
if (isset($_POST["id"]))
{
	$idPed = $_POST['id'];
}else {$idPed = 0;}
if (isset($_POST["idProduto"]))
{
	$idProduto = $_POST["idProduto"];
} else {$idProduto = "";}
if (isset($_POST["idCliente"]))
{
	$idCliente = $_POST['idCliente'];
	} else {$idCliente = "";}
if (isset($_POST["quantidade"]))
{
	$quantidade = $_POST["quantidade"];
} else {$quantidade = "";}

$conec = mysql_connect('sql5.freemysqlhosting.net:3306','sql5106852','Ig2KJjisyN');
$db = mysql_select_db('sql5106852');
$queryp = "SELECT id, nome from produto";
$sqlprod = mysql_query($queryp, $conec);
$queryc = "SELECT id, nome from cliente";
$sqlcli = mysql_query($queryc, $conec);

echo "<input type=	'hidden' name='txtId' id='txtId' value='".$idPed."'><br>";

echo "<div class='md-7'><label>Cliente:</label></div><div class='md-5'>";
echo "<select class='lbl' name = 'cmbCliente'>";
while (($linha = mysql_fetch_array($sqlcli)) != null)
{
    echo "<option value = '".$linha['id']."'";
    if ($idCliente == $linha['id'])
        echo "selected = 'selected'";
    echo ">".$linha['nome']."</option>";
}
echo "</select></div><br>";

echo "<div class='md-7'><label>Produto:</label></div><div class='md-5'>";
echo "<select class='lbl' name = 'cmbProduto'>";
while (($linha = mysql_fetch_array($sqlprod)) != null)
{
    echo "<option value = '".$linha['id']."'";
    if ($idProduto == $linha['id'])
        echo "selected = 'selected'";
    echo ">".$linha['nome']."</option>";
}
echo "</select></div><br>";

echo "<div class='md-7'><label>Quantidade:</label></div><div class='md-5'><input class='lbl' type='text' name='txtQuantidade' id='txtQuantidade' value='".$quantidade."'></div><br>";

?>
<input type="submit" class ="btn btn-default" value="Salvar" id="btnSalvar" name="btnSalvar">
<div>
</form>
</body>
</html>


