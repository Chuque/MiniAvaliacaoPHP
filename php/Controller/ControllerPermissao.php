<?php
include_once $_SESSION["root"].'php/Util/Util.php';
include_once $_SESSION["root"].'php/DAO/PermissaoDAO.php';
include_once $_SESSION["root"].'php/Model/ModelPermissao.php';

class ControllerPermissao {
	
	function getAllPermissoes(){
		$permDAO = new PermissaoDAO();
		$Permissoes=$permDAO->getAllPermissoes();
		//Util::debug($Permissoes);
		return $Permissoes;
	}
	
	function getPermissaoById($id){
		$permDAO = new PermissaoDAO();
		$Permissao=$permDAO->getPermissaoById($id);
		//Util::debug($Permissao);
		return $Permissao;
	}
}