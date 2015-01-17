<?php
/**
 * Created by PhpStorm.
 * User: wesley
 * Date: 06/01/15
 * Time: 23:36
 */

namespace Usuario\Controller;


use Usuario\Form\TipoForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TipoController extends AbstractActionController {

    public function indexAction(){
        return new ViewModel();
    }

    public function addAction(){

        $form = new TipoForm();

        return array(
            'form' => $form,
        );
    }

}