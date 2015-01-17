<?php
/**
 * Created by PhpStorm.
 * User: wesley
 * Date: 09/01/15
 * Time: 03:35
 */

namespace Ordemservico\Entity;

use Doctrine\ORM\Mapping as ORM;


use Usuario\Entity\Usuario;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Class Ordemservico
 * @package Ordemservico\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="Ordemservico")
 */

class Ordemservico implements  InputFilterAwareInterface{

    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $numero;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dataAbertura;

    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    protected $descricaoDefeito;

    /**
     * @ORM\ManyToOne(targetEntity="\Usuario\Entity\Usuario", inversedBy="ordemservico", cascade={"all"}, fetch="LAZY")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", unique=false, nullable=false)
     */
    protected $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="\Usuario\Entity\Tipo",
     * @var
     */

    protected $inputFilter;

    function __construct(){
        $this->Tecnico = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function exchangeArray($data)
    {
        $this->id               = (isset($data['id'])) ? $data['id'] : null;
        $this->numero           = (isset($data['numero'])) ? $data['numero'] : null;
        $this->descricaoDefeito = (isset($data['descricaoDefeito'])) ? $data['descricaoDefeito'] : null;
        $this->dataAbertura     = (isset($data['dataAbertura'])) ? $data['dataAbertura'] : null;
    }

    public function toArray(){
        $data['id']                 = $this->getId();
        $data['codigo']             = $this->getNumero();
        $data['dataAbertura']       = $this->getDataAbertura();
        $data['descricaoDefeito']   = $this->getDescricaoDefeito();
        //$data['Usuario']        = $usuario->ToArray();
        return $data;
    }

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
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getDataAbertura()
    {
        return $this->dataAbertura;
    }

    /**
     * @param mixed $dataAbertura
     */
    public function setDataAbertura($dataAbertura)
    {
        $this->dataAbertura = $dataAbertura;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    /**
     * @param string $descricaoServico
     */
    public function setDescricaoServico($descricaoServico)
    {
        $this->descricaoServico = $descricaoServico;
    }

    /**
     * @return string
     */
    public function getDescricaoDefeito()
    {
        return $this->descricaoDefeito;
    }

    /**
     * @param string $descricaoDefeito
     */
    public function setDescricaoDefeito($descricaoDefeito)
    {
        $this->descricaoDefeito = $descricaoDefeito;
    }

    /**
     * @return Object
     */
    public function getTecnico()
    {
        return $this->Tecnico;
    }

    /**
     * @param Object $Tecnico
     */
    public function setTecnico($Tecnico)
    {
        $this->Tecnico = $Tecnico;
    }



    public function getArrayCopy()
    {
        return get_object_vars($this);
    }


    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        // TODO: Implement setInputFilter() method.
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if(!$this->inputFilter){
            $inputFilter = new InputFilter();
            $factory = new Factory();

            $inputFilter->add($factory->createInput(array(
                'name' => 'id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'numero',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'dataAbertura',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'descricaoDefeito',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            )));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}