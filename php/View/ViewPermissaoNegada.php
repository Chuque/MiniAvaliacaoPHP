<?php 
$titulo="Permissão negada";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container" >
		<div id="principal" >
			<form action="postLogin" method="POST" class="center-block">
				<div class="row">					
					<h1  class="text-center">Você não tem permissão para acessar essa página</h1>
					<div class="col-md-4 col-md-offset-4 text-center">
						<!-- O href do botao abaixo faz com que o navegador volte à pagina anterior -->
						<a class="btn btn-warning" href="javascript:history.back()">Voltar</a>
					</div>					
		  		</div>
			</form>
		</div>
	</div>
<?php 
	include $_SESSION["root"].'includes/footer.php';	
?>
