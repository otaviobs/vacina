<?php

namespace App\Models\Entity;

/**
 * @Entity @Table(name="vacina_paciente")
 */
class VacinaPaciente {

    /**
     * @var int
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;

    /**
     * @Column(type="datetime") 
     */
    public $dataVacinacao;

    /**
     * @Column(type="integer")
     */
    public $idPaciente;

    /**
     * @Column(type="integer")
     */
    public $idVacina;

    /**
     * @var string
     * @Column(type="string")
     */
    public $idDose;

    /**
     * @var string
     * @Column(type="string")
     */
    public $controleDose;

    public function __construct(int $vacina, int $paciente)
    {
        $this->idVacina = $vacina;
        $this->idPaciente = $paciente;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of dataVacinacao
     */
    public function getDataVacinacao()
    {
        return $this->dataVacinacao;
    }

    /**
     * Get the value of idPaciente
     */
    public function getIdPaciente()
    {
        return $this->idPaciente;
    }

    /**
     * Get the value of idVacina
     */
    public function getIdVacina()
    {
        return $this->idVacina;
    }

    /**
     * Get the value of idDose
     */
    public function getIdDose()
    {
        return $this->idDose;
    }

    /**
     * Get the value of controleDose
     */
    public function getControleDose()
    {
        return $this->controleDose;
    }


    /**
     * Set the value of dataVacinacao
     */
    public function setDataVacinacao($dataVacinacao): self
    {
        $this->dataVacinacao = $dataVacinacao;

        return $this;
    }


    /**
     * Set the value of idDose
     */
    public function setIdDose($idDose): self
    {
        $this->idDose = $idDose;

        return $this;
    }


    /**
     * Set the value of controleDose
     */
    public function setControleDose($controleDose): self
    {
        $this->controleDose = $controleDose;

        return $this;
    }
}