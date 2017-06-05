<?php
/*
Esse script funciona como um front controller, todas as requisições passam primeiro por aqui, também podemos enxergar como um gateway padrão. Isso só é possível graças ao htaccess que faz com que o todas as requisições feitas sejam redirecionadas para cá.
Da forma como esse arquivo de rotas funciona, nós não fazemos “links” para arquivos, nós associamos uma url a um controller.
****Descomentar os print_r abaixo para entender melhor****
*/

//Path é um array onde cada posição é um elemento da URL
$path = explode('/', $_SERVER['REQUEST_URI']);
//Action é a posição do array
$action = $path[sizeOf($path) - 1];
//Caso a ação tenha param GET esse param é ignorado, isso é particularmente útil para trabalhar com AJAX, já que o conteúdo do get será útil apenas para o controller e não para a rota
$action = explode('?', $action);
$action = $action[0];

//Descomentar esse bloco e acessar qualquer url do sistema.
/*echo "<pre>";
echo "A URL digitada<br>";
print_r($_SERVER['REQUEST_URI']);
echo "<br><br>A URL digitada explodida por / e tranformada em um array<br>";
print_r($path);
echo "<br><br>A ultima posição do array, que é a ação que o usuário/sistema quer realizar, é essa ação(string) que é mapeada(roteada) a um método de um controller<br>";
print_r($action);
echo "</pre>";*/

//Todo controller que tiver pelo menos uma rota associada a ele deve aparecer aqui.
include_once $_SESSION["root"].'php/Controller/ControllerLogin.php';
include_once $_SESSION["root"].'php/Controller/ControllerFuncionario.php';
include_once $_SESSION["root"].'php/Controller/ControllerDepartamento.php';
include_once $_SESSION["root"].'php/Controller/ControllerPermissao.php';
include_once $_SESSION["root"].'php/Util/Util.php';

//Sequencia de condicionais que verificam se a ação informada está roteada
if ($action == '' || $action == 'index' || $action == 'index.php' || $action == 'login') {
	require_once $_SESSION["root"].'php/View/ViewLogin.php';
}
else if ($action == 'postLogin') {
	$cLogin = new ControllerLogin();
	$cLogin->verificaLogin();
}
//verifica se o usuario está logado. se não estiver, redireciona o usuario à index.
else if($_SESSION["logado"] != 1){
    header("location:index.php");
}
else if ($action == 'exibeFuncionarios') {
	$cFunc = new ControllerFuncionario();
	$funcionarios=$cFunc->getAllFuncionarios();
	//Util::debug($funcionarios);
	include_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
}
else if ($action == 'cadastraFuncionario') {
	if($_SESSION["idPermissao"] != 1){
		header("location:permissaoNegada");
	}
	$cPerm = new ControllerPermissao();
	$permissoes=$cPerm->getAllPermissoes();
	$cDep = new ControllerDepartamento();
	$departamentos=$cDep->getAllDepartamentos();
	require_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
}
else if ($action == 'exibeDepartamentos') {
	$cDep = new ControllerDepartamento();
	$departamentos=$cDep->getAllDepartamentos();
	include_once $_SESSION["root"].'php/View/ViewExibeDepartamentos.php';
}
else if ($action == 'cadastraDepartamento') {
	if($_SESSION["idPermissao"] != 1){
		header("location:permissaoNegada");
	}
	require_once $_SESSION["root"].'php/View/ViewCadastraDepartamento.php';
}
else if ($action == 'postCadastraFuncionario') {
	$cDep = new ControllerDepartamento();
	$departamentos = $cDep->getAllDepartamentos();
	$cPerm = new ControllerPermissao();
	$permissoes = $cPerm->getAllPermissoes();
	$cFunc = new ControllerFuncionario();
	$cFunc->setFuncionario();
	//Não tem retorno, os dados de sucesso ou falha estão na sessão
	include_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
}
else if ($action == 'postCadastraDepartamento') {
	$cDep = new ControllerDepartamento();
	$cDep->setDepartamento();
	//Não tem retorno, os dados de sucesso ou falha estão na sessão
	include_once $_SESSION["root"].'php/View/ViewCadastraDepartamento.php';
}
else if ($action == 'editarFuncionario') {
	if($_SESSION["idPermissao"] != 1){
		header("location:permissaoNegada");
	}

	$cDep = new ControllerDepartamento();
	$departamentos = $cDep->getAllDepartamentos();
	$cPerm = new ControllerPermissao();
	$permissoes = $cPerm->getAllPermissoes();
	$cFunc = new ControllerFuncionario();
	$funcionario = $cFunc->getFuncionarioById($_GET["id"]);

	$cFunc->preencherCamposFuncionario($funcionario);

	$_SESSION["idFuncionario"] = $funcionario->getIdFuncionario();
	
	include_once $_SESSION["root"].'php/View/ViewEditarFuncionario.php';
}
else if ($action == 'postEditarFuncionario') {
	$cFunc = new ControllerFuncionario();
	$funcionario = $cFunc->updateFuncionario($_SESSION["idFuncionario"]);
	
	header("location:exibeFuncionarios");
}
else if ($action == 'postDeletarFuncionario') {
	if($_SESSION["idPermissao"] != 1){
		header("location:permissaoNegada");
	}
	if(isset($_GET['id'])){
		$cFunc = new ControllerFuncionario();
		$cFunc->deletarFuncionario($_GET['id']);
	}
	header("location:exibeFuncionarios");
}
else if ($action == 'logout') {
	session_unset();
	header("location:index.php");
}
else if ($action == 'permissaoNegada') {
	include_once $_SESSION["root"].'php/View/ViewPermissaoNegada.php';
}
else {
	echo "Página não encontrada!";
	//isso trata todo erro 404, podemos criar uma view mais elegante para exibir o aviso ao usuário.
}

?>