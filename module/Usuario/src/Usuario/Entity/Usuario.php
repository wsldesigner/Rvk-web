<?php

namespace Usuario\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

/**
 *
 * @author wesley
 *
 *
 *@ORM\Entity
 *@ORM\Table(name="Usuario")

 */
class Usuario implements InputFilterAwareInterface {
	/**
	 * @ORM\Id @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 *
	 * @var Integer
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 *
	 * @var String
	 */
	private $nome;

	/**
	 * @ORM\Column(type="integer", length=255, unique=true, nullable=false)
	 *
	 * @var integer
	 */
	private $codigoUsuario;

    /**
     * @ORM\Column(type="string", nullable=false, unique=true, length=255)
     *
     * @var string
     */
    private $email;

	/**
	 * @ORM\Column(type="string", nullable=false)
	 *
	 * @var string
	 */
	private $endereco;

	/**
	 * Atributo resposnavel pelo número do telefone do usuario
	 *
	 * @ORM\Column(type="integer", length=10, nullable=true)
	 *
	 * @var integer
	 */
	private $telefone;

	/**
	 * Atributo responsavel pelo número do celular do cliente
	 *
	 * @ORM\Column(type="string", length=11, unique=true, nullable=false)
	 *
	 * @var integer
	 */
	private $celular;

	/**
	 * Atributo com os números do CPF do Usuario
	 *
	 * @ORM\Column(type="string", length=11, unique=true, nullable=false)
	 *
	 * @var integer
	 */
	private $cpf;

	/**
	 * Atributo com a senha do usuario
	 *
	 * @ORM\Column(type="string", length=10, nullable=false)
	 *
	 * @var string
	 */
	private $senha;

    /**
     * @ORM\ManyToOne(targetEntity="\Usuario\Entity\Tipo")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id", unique=false)
     */
    private $tipo;

    /**
     * Atributo com os inputfilters
     *
     * @var
     */
    protected $inputFilter;



    public function toArray(){
        $data['id']             = $this->getId();
        $data['nome']           = $this->getNome();
        $data['codigoUsuario']  = $this->getCodigoUsuario();
        $data['email']          = $this->getEmail();
        $data['endereco']       = $this->getEndereco();
        $data['telefone']       = $this->getTelefone();
        $data['celular']        = $this->getCelular();
        $data['cpf']            = $this->getCpf();
        $data['senha']          = $this->getSenha();

        $x = 0;
        foreach($this->ordemservico as $os){
            $data['Ordemservico'][$x++] = $os->toArray();
        }

        return $data;
    }

    public function __construct(){
        $this->ordemservico = new ArrayCollection();
    }

	public function exchangeArray($data)
	{
	    $this->id       = (isset($data['id'])) ? $data['id'] : null;
	    $this->nome     = (isset($data['nome'])) ? $data['nome'] : null;
	    $this->codigoUsuario   = (isset($data['codigoUsuario'])) ? $data['codigoUsuario'] : null;
        $this->email    = (isset($data['email'])) ? $data['email'] : null;
	    $this->endereco = (isset($data['endereco'])) ? $data['endereco'] : null;
	    $this->telefone = (isset($data['telefone'])) ? $data['telefone'] : null;
	    $this->celular  = (isset($data['celular'])) ? $data['celular'] : null;
	    $this->cpf      = (isset($data['cpf'])) ? $data['cpf'] : null;
	    $this->senha    = (isset($data['senha'])) ? $data['senha'] : null;
        //$this->tipo = new Tipo();
        $this->tipo = (isset($data['tipo_usuario'])) ? $data['tipo_usuario'] : null;
	}

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome(String $nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getCodigoUsuario()
    {
        return $this->codigoUsuario;
    }

    public function setCodigoUsuario($codigo)
    {
        $this->codigoUsuario = $codigo;
        return $this;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone(integer $telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular(integer $celular)
    {
        $this->celular = $celular;
        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf(integer $cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;
        return $this;
    }

    /**
     * @return mixed
      */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getOrdemservico()
    {
        return $this->ordemservico;
    }

    /**
     * @param mixed $ordemservico
     */
    public function setOrdemservico($ordemservico)
    {
        $this->ordemservico = $ordemservico;
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
        throw new \Exception("Não Usar");
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function     getInputFilter()
    {
        if(!$this->inputFilter){
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();


            //Criando input Id
            $inputFilter->add($factory->createInput(array(
                'name' => 'id',
                'required' => false,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));

            //Criando Input Nome
            $inputFilter->add($factory->createInput(array(
                'name' => 'nome',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),

                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 10,
                            'max' => 255,
                            'messages' => array(
                                StringLength::TOO_SHORT => 'Campo precisa ter mais que 10 letras',
                                StringLength::TOO_LONG => 'Campo muito Longo, pode pode ter mais de 255 letras',
                            ),
                        ),
                    ),
                ),
            )));

            //Criando Inout Codigo_usuario
            $inputFilter->add($factory->createInput(array(
                'name' => 'codigoUsuario',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                    array('name' => 'Digits'),
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                               NotEmpty::IS_EMPTY => "Campo Vazio",
                            ),
                        ),
                    ),
                    array(
                        'name' => "StringLength",
                        'options' => array(
                            'min' => 4,
                            'max' => 10,
                            'messages' => array(
                                StringLength::INVALID => 'Não é valido esse tipo de dados',
                                StringLength::TOO_LONG => 'Máximo 10',
                                StringLength::TOO_SHORT => 'Minimo 4'
                            ),
                        ),
                    ),
                )
            )));

            //Criando Input Endereco
            $inputFilter->add($factory->createInput(array(
                'name' => 'endereco',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 10,
                            'max' => 255,
                            'messages' => array(),
                        ),
                    ),
                ),
            )));

            //Criando Input Tefefone
            $inputFilter->add($factory->createInput(array(
                'name' => 'telefone',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 8,
                            'max' => 10,
                            'messages' => array(),
                        ),
                    ),
                ),
            )));

            //criando Input Celular
            $inputFilter->add($factory->createInput(array(
                'name' => 'celular',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => '9',
                            'max' => '11',
                            'messages' => array(),
                        ),
                    ),
                ),
            )));

            //Criando Input CPF
            $inputFilter->add($factory->createInput(array(
                'name' => 'cpf',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => '9',
                            'max' => '11',
                            'messages' => array(),
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'senha',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => '4',
                            'max' => '11',
                            'messages' => array(),
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'tipo_usuario',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'email',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}

?>