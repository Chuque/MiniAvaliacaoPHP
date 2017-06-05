<?php
include_once $_SESSION["root"].'php/Util/Util.php';
include_once $_SESSION["root"].'php/DAO/FuncionarioDAO.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';

class ControllerFuncionario {
	
	function getAllFuncionarios(){
		$funcDAO = new FuncionarioDAO();
		$funcionarios=$funcDAO->getAllFuncionarios();

		foreach($funcionarios as $funcionario){
			$cDep = new ControllerDepartamento();
			$funcionario->setDepartamento($cDep->getDepartamentoById($funcionario->getDepartamento()->getIdDepartamento()));

			$cPerm = new ControllerPermissao();
			$funcionario->setPermissao($cPerm->getPermissaoById($funcionario->getPermissao()->getIdPermissao()));
		}

		//Util::debug($funcionarios);
		return $funcionarios;
	}

	function editFuncionario(){
		$id=$_GET["id"];
		$funcDAO = new FuncionarioDAO();
		$funcionario=$funcDAO->getFuncionarioById($id);
		//Util::debug($funcionarios);
		return $funcionario;
	}
	
	function setFuncionario(){
		$funcDAO = new FuncionarioDAO();
		$funcionario = new ModelFuncionario();
		$funcionario->setFuncionarioFromPOST();
		$resultadoInsercao = $funcDAO->setFuncionario($funcionario);
		Util::debug($funcionario);
		
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Funcionário Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;			
		}
		else{
			$_SESSION["flash"]["msg"]="O Login já existe no banco";
			$_SESSION["flash"]["sucesso"]=false;
			//Var temp de feedback	
			$_SESSION["flash"]["nome"]=$funcionario->getNome();
			//$_SESSION["flash"]["login"]=$funcionario->getLogin();
			$_SESSION["flash"]["salario"]=$funcionario->getSalario();
		}
	}

	function getFuncionarioById($id){
		$funcDAO = new FuncionarioDAO();
		$cDep = new ControllerDepartamento();
		$cPerm = new ControllerPermissao();
		
		$funcionario = $funcDAO->getFuncionarioById($id);

		$funcionario->setDepartamento($cDep->getDepartamentoById($funcionario->getDepartamento()->getIdDepartamento()));
		$funcionario->setPermissao($cPerm->getPermissaoById($funcionario->getPermissao()->getIdPermissao()));

		return $funcionario;
	}

	function preencherCamposFuncionario($func){
		$_SESSION["flash"]["login"] = $func->getLogin();
		$_SESSION["flash"]["nome"] = $func->getNome();
		$_SESSION["flash"]["senha"] = $func->getSenha();
		$_SESSION["flash"]["salario"] = $func->getSalario();
		$_SESSION["flash"]["idPermissao"] = $func->getPermissao()->getIdPermissao();
		$_SESSION["flash"]["nivelPermissao"] = $func->getPermissao()->getNivel();
		$_SESSION["flash"]["idDepartamento"] = $func->getDepartamento()->getIdDepartamento();
		$_SESSION["flash"]["nomeDepartamento"] = $func->getDepartamento()->getNome();
		
	}

	function updateFuncionario($id){
		$funcDAO = new FuncionarioDAO();
		$funcionario = $funcDAO->getFuncionarioById($id);
		$funcionario->updateFuncionarioFromPost($id);
		if($_SESSION['senhaFoiAlterada'] == true){
			$resultadoInsercao = $funcDAO->updateFuncionarioComSenha($funcionario);
		}
		else{
			$resultadoInsercao = $funcDAO->updateFuncionarioSemSenha($funcionario);
		}

		if($resultadoInsercao){
			$_SESSION['flash']['msg'] = "Funcionario atualizado com sucesso";
			$_SESSION['flash']['sucesso'] = true;
		}
		else{
			$_SESSION['flash']['msg'] = "Funcionario não foi atualizado";
			$_SESSION['flash']['sucesso'] = false;
			$_SESSION['flash']['nome'] = $funcionario->getNome();
			$_SESSION['flash']['login'] = $funcionario->getLogin();
			$_SESSION['flash']['salario'] = $funcionario->getSalario();
		}
	}

	function deletarFuncionario($id){
		$funcDAO = new FuncionarioDAO();

		$resultadoInsercao = $funcDAO->deleteFuncionario($id);

		if($resultadoInsercao){
			$_SESSION['flash']['msg'] = "Funcionario removido com sucesso";
			$_SESSION['flash']['sucesso'] = true;
		}
		else{
			$_SESSION['flash']['msg'] = "O funcionario não foi removido";
			$_SESSION['flash']['sucesso'] = false;
		}
	}
}