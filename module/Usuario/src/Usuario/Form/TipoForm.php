<?php
/**
 * Created by PhpStorm.
 * User: wesley
 * Date: 07/01/15
 * Time: 00:09
 */

namespace Usuario\Form;


use Zend\Form\Form;

class TipoForm extends Form {

    function  __construct($name = null){

        parent::__construct('TipoUsuario');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'nome',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'col-sm-10 form-control',
                'id'  => '',
                'placeholder' => 'Nome do Tipo do Usuario'
            ),
            'options' => array(
                'label' => 'Nome: ',
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