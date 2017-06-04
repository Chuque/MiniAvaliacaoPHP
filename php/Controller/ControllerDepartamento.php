<?php
include_once $_SESSION["root"].'php/Util/Util.php';
include_once $_SESSION["root"].'php/DAO/DepartamentoDAO.php';
include_once $_SESSION["root"].'php/Model/ModelDepartamento.php';

class ControllerDepartamento {
	
	function getAllDepartamentos(){
		$depDAO = new DepartamentoDAO();
		$Departamentos=$depDAO->getAllDepartamentos();
		//Util::debug($Departamentos);
		return $Departamentos;
	}
	
	function setDepartamento(){
		$depDAO = new DepartamentoDAO();
		$Departamento = new ModelDepartamento();
		$Departamento->setDepartamentoFromPOST();
		$resultadoInsercao = $depDAO->setDepartamento($Departamento);
		//Util::debug();
			
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Departamento Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;			
		}
		else{
			$_SESSION["flash"]["msg"]="Essa sigla já está cadastrada";
			$_SESSION["flash"]["sucesso"]=false;
			//Var temp de feedback	
			$_SESSION["flash"]["nome"]=$Departamento->getNome();
			$_SESSION["flash"]["sigla"]=$Departamento->getSigla();
		}
	}

	function getDepartamentoById($id){
		$depDAO = new DepartamentoDAO();
		$departamento = $depDAO->getDepartamentoById($id);
		return $departamento;
	}
}