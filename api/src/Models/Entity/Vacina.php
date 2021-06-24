<?php

namespace App\Models\Entity;

/**
 * @Entity @Table(name="vacinas")
 **/
class Vacina {

    /**
     * @var int
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;

    /**
     * @var int
     * @Column(type="integer") 
     */
    public $lote;

    /**
     * @var int
     * @Column(type="integer") 
     */
    public $nDoses;

    /**
     * @var int
     * @Column(type="integer") 
     */
    public $intervalo;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $fabricante;

    /**
     * @Column(type="datetime") 
     */
    public $dataValidade;

    

    /**
     * @return int id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int lote
     */
    public function getLote()
    {
        return $this->lote;
    }

    /**
     * @return Vacina()
     */
    public function setLote($lote)
    {
        $this->lote = $lote;

        return $this;
    }

    /**
     * @return int nDoses
     */
    public function getNDoses()
    {
        return $this->nDoses;
    }

    /**
     * @return Vacina()
     */
    public function setNDoses($nDoses)
    {
        $this->nDoses = $nDoses;

        return $this;
    }

    /**
     * @return int intervalo
     */
    public function getIntervalo()
    {
        return $this->intervalo;
    }

    /**
     * @return Vacina()
     */
    public function setIntervalo($intervalo)
    {
        $this->intervalo = $intervalo;

        return $this;
    }

    /**
     * @return string fabricante
     */
    public function getFabricante()
    {
        return $this->fabricante;
    }

    /**
     * @return Vacina()
     */
    public function setFabricante($fabricante)
    {
        $this->fabricante = $fabricante;

        return $this;
    }

    /**
     * @return datetime dataValidade
     */
    public function getDataValidade()
    {
        return $this->dataValidade;
    }

    /**
     * @return Vacina()
     */
    public function setDataValidade($dataValidade)
    {
        $this->dataValidade = $dataValidade;

        return $this;
    }
}