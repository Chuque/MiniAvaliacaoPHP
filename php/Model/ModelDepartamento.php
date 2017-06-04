<?php
class ModelDepartamento {

	private $idDepartamento;
	private $nome; 
	private $sigla;

    /**
     * Popula um obj departamento com os dados vindos da tabela departamento. Funciona como um construtor
     *
     * @param um array com dados da tupla proveniente do DB, em que o nome do atributo na entidade é o mesmo do atributo no objeto
     *
     * @return não há retorno.
     */
    public function setDepartamentoFromDataBase($linha){
        $this->setIdDepartamento($linha["idDepartamento"])
               ->setNome($linha["nome"])
               ->setSigla($linha["sigla"]);
    }

    public function setDepartamentoFromPOST(){
        $this->setIdDepartamento(null)
               ->setNome($_POST["nome"])
               ->setSigla($_POST["sigla"]);
    }

    /**
     * Gets the value of idDepartamento.
     *
     * @return mixed
     */
    public function getIdDepartamento()
    {
        return $this->idDepartamento;
    }

    /**
     * Sets the value of idDepartamento.
     *
     * @param mixed $idDepartamento the id departamento
     *
     * @return self
     */
    public function setIdDepartamento($idDepartamento)
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of sigla.
     *
     * @return mixed
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Sets the value of sigla.
     *
     * @param mixed $sigla the sigla
     *
     * @return self
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla ;

        return $this;
    }

}