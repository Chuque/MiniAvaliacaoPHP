<?php
include_once $_SESSION["root"].'php/Util/Util.php';
class ModelPermissao {

	private $idPermissao;
	private $nivel;

    /**
     * Popula um obj permissao com os dados vindos da tabela permissao. Funciona como um construtor
     *
     * @param um array com dados da tupla proveniente do DB, em que o nome do atributo na entidade é o mesmo do atributo no objeto
     *
     * @return não há retorno.
     */
    public function setPermissaoFromDataBase($linha){
        $this->setIdPermissao($linha["idPermissao"])
               ->setNivel($linha["nivel"]);
    }
    public function setPermissaoFromPOST(){
        $this->setIdPermissao(null)
               ->setNivel($_POST["nivel"]);
                
        //$this->setIdDepartamento(1);
    }

    /**
     * Gets the value of idPermissao.
     *
     * @return mixed
     */
    public function getIdPermissao()
    {
        return $this->idPermissao;
    }

    /**
     * Sets the value of idPermissao.
     *
     * @param mixed $idPermissao the id permissao
     *
     * @return self
     */
    public function setIdPermissao($idPermissao)
    {
        $this->idPermissao = $idPermissao;

        return $this;
    }

    /**
     * Gets the value of nivel.
     *
     * @return mixed
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Sets the value of nivel.
     *
     * @param mixed $nivel the nivel
     *
     * @return self
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }
}