<?php
namespace Usuario\Form;

use DoctrineORMModule\Options\EntityManager;
use Zend\Form\Form;

class UsuarioForm extends Form
{

     public function __construct($name = null, Array $data = null, $value=null) {
        parent::__construct('usuario');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name'=> 'nome',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'col-sm-10 form-control',
                'id'  => '',
                'placeholder' => 'Nome Completo'
            ),
            'options' => array(
                'label' => 'Nome: ',
            ),
        ));

         $this->add(array(
             'name' => 'codigoUsuario',
             'attributes' => array(
                 'type'  => 'text',
                 'class' => 'col-sm-10 form-control',
                 'id'  => '',
                 'placeholder' => 'Código Cliente'
             ),
             'options' => array(
                 'label' => 'Código: ',
             ),
         ));

        $this->add(array(
            'name' => 'endereco',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'col-sm-10 form-control',
                'id'  => '',
                'placeholder' => 'Endereço do Cliente'
            ),
            'options' => array(
                'label' => 'Endereço: ',
            ),
        ));

        $this->add(array(
            'name' => 'telefone',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'col-sm-10 form-control',
                'id'  => '',
                'placeholder' => '(DD)XXXX-XXXX'
            ),
            'options' => array(
                'label' => 'Telefone: ',
            ),
        ));

        $this->add(array(
            'name' => 'celular',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'col-sm-10 form-control',
                'id'  => '',
                'placeholder' => '(DD)9XXXX-XXXX'
            ),
            'options' => array(
                'label' => 'Celular: ',
            ),
        ));

        $this->add(array(
            'name' => 'cpf',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'col-sm-10 form-control',
                'id'  => '',
                'placeholder' => 'XXX.XXX.XXX-XX'
            ),
            'options' => array(
                'label' => 'CPF: ',
            ),
        ));

        $this->add(array(
            'name' => 'senha',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'col-sm-10 form-control',
                'id'  => '',
                'placeholder' => 'Senha - mínimo 4'
            ),
            'options' => array(
                'label' => 'Senha',
            ),
        ));

        $this->add(array(
            'name' => 'codigo',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Codigo',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'email',
                'class' => 'col-sm-10 form-control',
                'placeholder' => 'Email do Usuario'
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));

        $this->add(array(
            'name' => 'tipo_usuario',
            'type' => 'select',
            'options' => array(
                'empty_option' => 'Escolher tipo',
                'label' => 'Tipo Usuario',
                'value_options' => $data
            ),
            'attributes' => array(
                'value' => $value,
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Adicionar',
            ),
        ));


     }



}

?>