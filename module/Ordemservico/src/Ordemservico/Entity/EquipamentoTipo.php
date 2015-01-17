<?php
/**
 * Created by PhpStorm.
 * User: wesley
 * Date: 09/01/15
 * Time: 03:26
 */

namespace Ordemservico\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class EquipamentoTipo
 * @package Ordemservico\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="Tipo_equipamento")
 */
class EquipamentoTipo {

    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $descricao;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

}