<?php
/**
 * Created by PhpStorm.
 * User: wesley
 * Date: 09/01/15
 * Time: 20:52
 */

namespace Ordemservico\Form;


use Zend\Form\Form;

class OrdemservicoForm extends Form{

    function __construct($name = null, $data=null, $value=null){
        parent::__construct('OrdemServico');

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(array(
            'name' =>'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'numero',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Número Ordem ',
            ),
        ));

        $this->add(array(
            'name' => 'dataAbertura',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Data Abertura: ',
            ),
        ));

        $this->add(array(
            'name' => 'descricaoDefeito',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Descrição do Defeito: '
            ),
        ));

        $this->add(array(
            'name' => 'tipo_tecnico',
            'type' => 'select',
            'options' => array(
                'empty_option' => 'Tec. Responsavel',
                'label' => 'Tecnico',
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