<?php
//Add a classe responsavel por fazer a conexao com banco de dados
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelPermissao.php';
include_once $_SESSION["root"].'php/Util/Util.php';
class PermissaoDAO {
	/*Como o PHP tem inferência de tipo, esse método, assim como outros, poderia ser mais "simples", porém estou fazendo de uma maneira que acho mais didático*/
	function getAllPermissoes(){	

		//pego uma ref da conexão
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		//Faço o select usando prepared statement
		$statement = $conn->prepare("SELECT * FROM permissao");		
		$statement->execute();

		//linhas recebe todas as tuplas retornadas do banco		
		$linhas = $statement->fetchAll();

		//Verifico se houve algum retorno, senão retorno null
		if(count($linhas)==0)
				return null;

		//Var que irá armazenar um array de obj do tipo permissao
		$permissoes;		
		//Util::debug($linhas);
		foreach ($linhas as $value) {
			$permissao = new ModelPermissao();
			$permissao->setPermissaoFromDataBase($value);			
			$permissoes[]=$permissao;
		}	
		return $permissoes;		
	}
	//Retorna 1 se conseguiu inserir;
	
	function setPermissao($dep){			

		try {
			//monto a query
            $sql = "INSERT INTO permissao (		
                idPermissao,
                nivel) 
                VALUES (
                :idPermissao,
                :nivel)"
        	;

            //pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);

            $statement->bindValue(":idPermissao", $dep->getIdPermissao());
            $statement->bindValue(":nivel", $dep->getNivel());
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }		
	}

	function getPermissaoById($id){			

		try {
			//pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();

			$statement = $conn->prepare("SELECT * FROM permissao WHERE idPermissao = $id");
			$statement->execute();

			$linhas = $statement->fetchAll();

			if(count($linhas) == 0){
				return null;
			}

			$permissao = new ModelPermissao();
			foreach($linhas as $value){
				$permissao->setPermissaoFromDataBase($value);
			}

			return($permissao);
			
        } catch (PDOException $e) {
            echo "Erro ao ler da base de dados.".$e->getMessage();
        }		
	}
}