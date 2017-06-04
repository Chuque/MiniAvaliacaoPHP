<?php
$titulo="Exibir Departamentos";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Departamentos	</h1>
			<table class="table table-striped">
			<?php 
				//$departamentos foi criado no controller que chamou essa classe;
				echo "<tr>";
					echo "<th>Nome</th>";
					echo "<th>Sigla</th>";
					/*if($_SESSION["idPermissao"] == 1){
						echo "<th>Editar</th>";
						echo "<th>Excluir</th>";
					}*/
				echo "</tr>";
				foreach ($departamentos as $value) {
					echo "<tr>";
						echo "<td>".$value->getNome()."</td>";
						echo "<td>".$value->getSigla()."</td>";
						/*if($_SESSION["idPermissao"] == 1){
							echo "<td><a href='editarDepartamento?id={$value->getIdDepartamento()}'><img src='includes/imgs/iconeEditar.png' alt='Editar' height='30' width='30'></a></td>";
							echo "<td><a href='deletarDepartamento?id={$value->getIdDepartamento()}'><img src='includes/imgs/iconeDeletar.png' alt='Editar' height='30' width='30'></a></td>";
						}*/
					echo "</tr>";
				}
			?>
			</table>
		</div>
	</div>	
</body>
<!-- add no footer -->
<?php 
	include $_SESSION["root"].'includes/footer.php';		
	 ?>
<!-- fim footer -->
<script>		
	$(document).ready(function () {
        $('.visualizarDepartamento').addClass('active');
    });
</script>