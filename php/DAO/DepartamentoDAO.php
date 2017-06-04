<?php
//Add a classe responsavel por fazer a conexao com banco de dados
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelDepartamento.php';
include_once $_SESSION["root"].'php/Util/Util.php';
class DepartamentoDAO {
	/*Como o PHP tem inferência de tipo, esse método, assim como outros, poderia ser mais "simples", porém estou fazendo de uma maneira que acho mais didático*/
	function getAllDepartamentos(){	

		//pego uma ref da conexão
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		//Faço o select usando prepared statement
		$statement = $conn->prepare("SELECT * FROM departamento");		
		$statement->execute();

		//linhas recebe todas as tuplas retornadas do banco		
		$linhas = $statement->fetchAll();

		//Verifico se houve algum retorno, senão retorno null
		if(count($linhas)==0)
				return null;

		//Var que irá armazenar um array de obj do tipo departamento
		$departamentos;		
		//Util::debug($linhas);
		foreach ($linhas as $value) {
			$departamento = new ModelDepartamento();
			$departamento->setDepartamentoFromDataBase($value);			
			$departamentos[]=$departamento;
		}	
		return $departamentos;		
	}
	//Retorna 1 se conseguiu inserir;
	
	function setDepartamento($dep){			

		try {
			//monto a query
            $sql = "INSERT INTO departamento (		
                idDepartamento,
                nome,
                sigla) 
                VALUES (
                :idDepartamento,
                :nome,
                :sigla)"
        	;

            //pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);

            $statement->bindValue(":idDepartamento", $dep->getIdDepartamento());
            $statement->bindValue(":nome", $dep->getNome());
            $statement->bindValue(":sigla", $dep->getSigla());
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }		
	}

	function getDepartamentoById($id){	
			
		//pego uma ref da conexão
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		$statement = $conn->prepare("SELECT * FROM departamento WHERE idDepartamento = $id");
		$statement->execute();

		$linhas = $statement->fetchAll();

		if(count($linhas) == 0){
			return null;
		}

		$departamento = new ModelDepartamento();
		foreach($linhas as $value){
			$departamento->setDepartamentoFromDataBase($value);
		}

		return($departamento);
	}
}