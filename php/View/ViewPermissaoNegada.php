<?php 
$titulo="Login";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<h1>Você não tem permissão para acessar essa página</h1>
	<a class="btn btn-warning" href="javascript:history.back()">Voltar</a>
<?php 
	include $_SESSION["root"].'includes/footer.php';	
?>