<?php
/**
 * Created by PhpStorm.
 * User: wesley
 * Date: 03/01/15
 * Time: 10:04
 */

namespace Ordemservico\Form\View\Helper;


use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElementErrors;

class FormElementErros extends FormElementErrors {

    public function render(ElementInterface $element, array $attributes = array()){

        //Associando menssagem com varivel
        $messages = $element->getMessages();

        //Verificando se $message está vazio
        if(empty($messages)){
            return '';
        }


        $markup = '<div class="alert alert-danger col-sm-10 col-sm-offset-2" role="alert">';
        $markup .= implode(' - ', $messages);
        $markup .= '</div>';
        return $markup;
    }

}