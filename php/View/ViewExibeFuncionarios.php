<?php
$titulo="Exibir Funcionários";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Funcionários	</h1>
			<?php
				if(isset($_SESSION["senhaFoiAlterada"])){
					echo"<div class='bg-success text-center msg'>Dados do Funcionário editado com sucesso</div>";
				}
			?>
			<table class="table table-striped">
			<?php 
				//$funcionarios foi criado no controller que chamou essa classe;
				echo "<tr>";
					echo "<th>Nome</th>";
					echo "<th>Salário</th>";
					echo "<th>Login</th>";
					echo "<th>Permissão</th>";
					echo "<th>Departamento</th>";
					if($_SESSION["idPermissao"] == 1){
						echo "<th>Editar</th>";
						echo "<th>Excluir</th>";
					}
				echo "</tr>";
				foreach ($funcionarios as $value) {
					echo "<tr>";
						echo "<td>".$value->getNome()."</td>";
						echo "<td>".$value->getSalario()."</td>";
						echo "<td>".$value->getLogin()."</td>";
						echo "<td>".$value->getPermissao()->getNivel()."</td>";
						echo "<td>".$value->getDepartamento()->getNome()."</td>";
						if($_SESSION["idPermissao"] == 1){
							echo "<td><a href='editarFuncionario?id={$value->getIdFuncionario()}'><img src='includes/imgs/iconeEditar.png' alt='Editar' height='30' width='30'></a></td>";
							echo "<td><a href='deletarFuncionario?id={$value->getIdFuncionario()}'><img src='includes/imgs/iconeDeletar.png' alt='Editar' height='30' width='30'></a></td>";
						}
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
	unset($_SESSION['idFuncionario'], $_SESSION['senhaFoiAlterada']);		
	 ?>
<!-- fim footer -->
<script>		
	$(document).ready(function () {
        $('.visualizarFuncionario').addClass('active');
    });
</script>