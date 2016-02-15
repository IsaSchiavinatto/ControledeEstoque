<?php
 
 if (isset($_POST['txtId']))
 {
$idCli = $_POST['txtId'];
}
 if (isset($_POST['txtNome']))
 {
$nome = $_POST['txtNome'];
}
 if (isset($_POST['txtEmail']))
 {
$email = $_POST['txtEmail'];
}
 if (isset($_POST['txtTelefone']))
 {
$telefone = $_POST['txtTelefone'];
}
$conec = mysql_connect('sql5.freemysqlhosting.net:3306','sql5106852','Ig2KJjisyN');
$db = mysql_select_db('sql5106852');

if (isset($_POST["btnSalvar"]))
{
if ($idCli == 0) //Inclusao
{
                $query = "INSERT INTO cliente (nome,email, telefone) VALUES ('".$nome."', '".$email."','".$telefone."')";
                $sql = mysql_query($query,$conec);
                 
                if($sql){
				echo"<div class='alert alert-success'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Cliente cadastrado com sucesso!";
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
	
		                $query = "update cliente set nome ='".$nome."', email = '".$email."', telefone = '".$telefone."' where id =". $idCli;
                $sql = mysql_query($query,$conec);
                if($sql){
				echo"<div class='alert alert-success'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Cliente alterado com sucesso!";
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
$idCli = $_GET["id"];
if (($_GET["Acao"]=="A"))
{
	$idCli = $_GET["id"];
				$query = "select id, nome, email, telefone from cliente where id = ".$idCli;
				$sql = mysql_query($query,$conec);
				$linha =  mysql_fetch_array($sql);
				$_POST['id'] = $linha['id'];
				$_POST['nome']  = $linha['nome'];
				$_POST['email'] = $linha['email'];
				$_POST['telefone'] = $linha['telefone'];
}
else 
{
                $query = "delete from cliente where id =". $idCli;
                $sql = mysql_query($query,$conec);
                 
                if($sql){
				echo"<div class='alert alert-success'>";
				echo"<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>";
				echo"Cliente excluido com sucesso!";
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
            <li class="active" ><a href="CadastroCliente1.php">Cadastro de Clientes</a></li>
            <li><a href="Pedido.php">Pedidos</a></li>
          </ul>
        </div>
      </div>
    </nav>
<title> Cadastro de Cliente </title>
</head>
<body>
<br/>
<br/>
<br/>
<form method="POST" action="CadastroCliente1.php">




<div class="Cadastro">

<?php
$conec = mysql_connect('sql5.freemysqlhosting.net','sql5106852','Ig2KJjisyN');
$db = mysql_select_db('sql5106852');
            $query = "select id, nome, email, telefone from cliente";
            $sql = mysql_query($query,$conec);
			echo "<b><div class='row'>";
      echo "  <div class='col-md-4'>Nome</div>";
      echo " <div class='col-md-3'>E-mail</div>";
      echo " <div class='col-md-3'>Telefone</div></b>";
	  echo " <div class='col-md-1'></div></b>";
	  echo " <div class='col-md-1'></div></b>";
      echo "</div>";
while($linha = mysql_fetch_array($sql))
  {
    echo "<div class='row'>";
      echo "  <div class='col-md-4'>".$linha['nome']."</div>";
      echo " <div class='col-md-3'>".$linha['email']."</div>";
      echo " <div class='col-md-3'>".$linha['telefone']."</div>";
	  echo "<div class='col-md-1'><a href='CadastroCliente1.php?id=".$linha['id']."&Acao=A'>Alterar</a></div>";
	  echo "<div class='col-md-1'><a href='CadastroCliente1.php?id=".$linha['id']."&Acao=E'>Excluir</a></div>";
      echo "</div>";
  }
  
?>
<BR> <BR><BR> <BR>
<?php
if (isset($_POST["id"]))
{
	$idCli = $_POST['id'];
}else {$idCli = 0;}
if (isset($_POST["nome"]))
{
	$nome = $_POST["nome"];
} else {$nome = "";}
if (isset($_POST["email"]))
{
	$email = $_POST['email'];
	} else {$email = "";}
if (isset($_POST["telefone"]))
{
	$telefone = $_POST["telefone"];
} else {$telefone = "";}


echo "<input type=	'hidden' name='txtId' id='txtId' value='".$idCli."'><br>";
echo "<div class='md-7'><label>Nome:</label></div><div class='md-5'><input class='lbl' type='text' name='txtNome' id='txtNome' value='".$nome."'></div><br>";
echo "<div class='md-7'><label>Email:</label></div><div class='md-5'><input class='lbl' type='text' name='txtEmail' id='txtEmail' value='".$email."'></div><br>";
echo "<div class='md-7'><label>Telefone:</label></div><div class='md-5'><input class='lbl' type='text' name='txtTelefone' id='txtTelefone' value='".$telefone."'></div><br>";



?>
<input type="submit" class ="btn btn-default" value="Salvar" id="btnSalvar" name="btnSalvar">
<div>
</form>
</body>
</html>


