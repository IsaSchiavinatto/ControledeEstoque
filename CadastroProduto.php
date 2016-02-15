<?php
 
 if (isset($_POST['txtId']))
 {
$idProd = $_POST['txtId'];
}
 if (isset($_POST['txtNome']))
 {
$nome = $_POST['txtNome'];
}
 if (isset($_POST['txtDescricao']))
 {
$descricao = $_POST['txtDescricao'];
}
 if (isset($_POST['txtPreco']))
 {
$preco = $_POST['txtPreco'];
}
 if (isset($_POST['txtQuantidade']))
 {
$quantidade = $_POST['txtQuantidade'];
}
$conec = mysql_connect('sql5.freemysqlhosting.net:3306','sql5106852','Ig2KJjisyN');
$db = mysql_select_db('sql5106852');

if (isset($_POST["btnSalvar"]))
{
if ($idProd == 0) //Inclusao
{
                $query = "INSERT INTO produto (nome,descricao, preco, quantidade) VALUES ('".$nome."', '".$descricao."',".$preco." ,'".$quantidade."')";
                $sql = mysql_query($query,$conec);
                 
                if($sql){
				echo"<div class='alert alert-success'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Produto cadastrado com sucesso!";
				echo"</div>";
              
                }else{
                echo"<div class='alert alert-danger'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Ocorreu um problema";
				echo"</div>";
                }
	}
	else //Alteracao
	{
	
		                $query = "update produto set nome ='".$nome."', descricao = '".$descricao."', preco = '".$preco."',  quantidade = '".$quantidade."' where id =". $idProd;
                $sql = mysql_query($query,$conec);
                if($sql){
				echo"<div class='alert alert-success'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Produto alterado com sucesso!";
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
$idProd = $_GET["id"];
if (($_GET["Acao"]=="A"))
{
	$idProd = $_GET["id"];
				$query = "select id, nome, descricao,preco, quantidade from produto where id = ".$idProd;
				$sql = mysql_query($query,$conec);
				$linha =  mysql_fetch_array($sql);
				$_POST['id'] = $linha['id'];
				$_POST['nome']  = $linha['nome'];
				$_POST['descricao'] = $linha['descricao'];
				$_POST['preco'] = $linha['preco'];
				$_POST['quantidade'] = $linha['quantidade'];
}
else //exclusao
{
                $query = "delete from produto where id =". $idProd;
                $sql = mysql_query($query,$conec);
                 
                if($sql){
				echo"<div class='alert alert-success'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Produto excluido com sucesso!";
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
		<script src="dist/js/bootstrap.min.js"></script>
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
            <li class="active" ><a href="Cadastroproduto.php">Cadastro de produtos</a></li>
            <li  ><a href="CadastroCliente1.php">Cadastro de Clientes</a></li>
            <li><a href="Pedido.php">Pedidos</a></li>
          </ul>
        </div>
      </div>
    </nav>
<title> Cadastro de produto </title>
</head>
<body>
<br/>
<br/>
<br/>
<form method="POST" action="Cadastroproduto.php">




<div class="Cadastro">

<?php
$conec = mysql_connect('sql5.freemysqlhosting.net:3306','sql5106852','Ig2KJjisyN');
$db = mysql_select_db('sql5106852');
            $query = "select id,nome,descricao,preco, quantidade from produto";
            $sql = mysql_query($query,$conec);
			echo "<b><div class='row'>";
      echo "  <div class='col-md-3'>Nome</div>";
      echo " <div class='col-md-4'>Descricao</div>";
      echo " <div class='col-md-1'>Preco</div></b>";
	  echo " <div class='col-md-2'>Quantidade</div></b>";
	  echo " <div class='col-md-1'></div></b>";
	  echo " <div class='col-md-1'></div></b>";
      echo "</div>";
while($linha = mysql_fetch_array($sql))
  {
    echo "<div class='row'>";
      echo "  <div class='col-md-3'>".$linha['nome']."</div>";
      echo " <div class='col-md-4'>".$linha['descricao']."</div>";
      echo " <div class='col-md-1'>".$linha['preco']."</div>";
	  echo " <div class='col-md-2'>".$linha['quantidade']."</div>";
	  echo "<div class='col-md-1'><a href='Cadastroproduto.php?id=".$linha['id']."&Acao=A'>Alterar</a></div>";
	  echo "<div class='col-md-1'><a href='Cadastroproduto.php?id=".$linha['id']."&Acao=E'>Excluir</a></div>";
      echo "</div>";
  }
  
?>
<BR> <BR><BR> <BR>
<?php
if (isset($_POST["id"]))
{
	$idProd = $_POST['id'];
}else {$idProd = 0;}
if (isset($_POST["nome"]))
{
	$nome = $_POST["nome"];
} else {$nome = "";}
if (isset($_POST["descricao"]))
{
	$descricao = $_POST['descricao'];
	} else {$descricao = "";}
if (isset($_POST["preco"]))
{
	$preco = $_POST["preco"];
} else {$preco = "";}
if (isset($_POST["quantidade"]))
{
	$quantidade = $_POST["quantidade"];
} else {$quantidade = "";}

echo "<input type=	'hidden' name='txtId' id='txtId' value='".$idProd."'><br>";
echo "<div class='md-7'><label>Nome:</label></div><div class='md-5'><input class='lbl' type='text' name='txtNome' id='txtNome' value='".$nome."'></div><br>";
echo "<div class='md-7'><label>Descricao:</label></div><div class='md-5'><input class='lbl' type='text' name='txtDescricao' id='txtDescricao' value='".$descricao."'></div><br>";
echo "<div class='md-7'><label>Preco:</label></div><div class='md-5'><input class='lbl' type='text' name='txtPreco' id='txtPreco' value='".$preco."'></div><br>";
echo "<div class='md-7'><label>Quantidade:</label></div><div class='md-5'><input class='lbl' type='text' name='txtQuantidade' id='txtQuantidade' value='".$quantidade."'></div><br>";



?>
<input type="submit" class ="btn btn-default" value="Salvar" id="btnSalvar" name="btnSalvar">
<div>
</form>
</body>
</html>


