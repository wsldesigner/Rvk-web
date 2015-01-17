<?php
/**
 * Created by PhpStorm.
 * User: wesley
 * Date: 09/01/15
 * Time: 03:22
 */

namespace Ordemservico\Controller;


use Ordemservico\Entity\Ordemservico;
use Ordemservico\Form\OrdemservicoForm;
use Usuario\Entity\Tecnico;
use Usuario\Entity\Usuario;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController{

    public $em;

    public function indexAction(){

        $e = $this->getEM()->getRepository('\Usuario\Entity\Usuario')->find('1');
        print_r($this->getUsuarioTecnico());
        print_r($e->toArray());

        return new ViewModel();
    }

    public function addAction(){
        //Criando variavel data com o formato de dia/mes/ano hora:minuto:segundo
        $data = date('d/m/Y H:i:s');
        $dataInsert = new \DateTime("now");
        //print_r($dataInsert);

        //Associando parametro do URL com a variavel
        $codigoUsuario = (int) $this->params()->fromRoute('usuario', null);

        //Criando objeto Form
        $form = new OrdemservicoForm(null, $this->getUsuarioTecnico());
        $Ordemservico = new Ordemservico();

        //Setando valor dis input do form
        $form->get('dataAbertura')->setValue($data);
        $form->get('numero')->setValue($this->getNumeroOs($data));
        $request = $this->getRequest();

        if($request->isPost()){
            $form->setInputFilter($Ordemservico->getInputFilter());
            $form->setData($request->getPost());

            if($form->isValid()){
                $Ordemservico->exchangeArray($form->getData());
                $Ordemservico->setDataAbertura($dataInsert);
                $em = $this->getEM();
                $usuario = $em->getRepository('\Usuario\Entity\Usuario')->find($codigoUsuario);

                $tipo = $em->getRepository('\Usuario\Entity\Tipo')->find($form->get('tipo_tecnico')->getValue());

                $tecnico = $em->getRepository('\Usuario\Entity\Tecnico')->
                                            find(1);

                print_r($tecnico);die();
                $Ordemservico->setUsuario($usuario);

                $em->persist($Ordemservico);
                $em->flush();
                print_r($usuario->getNome());
            }
        }
        return array(
            'form' => $form,
            'codigoUsuario' => $codigoUsuario,
        );
    }

    public function editAction(){

    }

    /**
     * Faz a consulta na tabela Usuario  e retorna
     * @params int
     * @return object
     */
    public function getUsuario($codigoUsuario){

        $usuario = $this->getEM()->getRepository('\Usuario\Entity\Usuario')->find($codigoUsuario);

        return $usuario;

    }

    /**
     * Retorna a entidade do doctrine
     * @return array|object
     */
    public function getEM(){
        if($this->em === null){
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    /**
     * Método para criar o número da OS usando o formato ANO.MES.DIA.NÚMERO_ULTIMO_CHAMADO
     *
     * @param $date
     * @return string
     */
    public function getNumeroOs($date)
    {
        $dateForm = explode(' ', $date);
        $dataForm1 = explode('/', $dateForm[0]);

        $dataOs = $dataForm1[2].$dataForm1[1].$dataForm1[0];

        $l = $this->getEM()->createQuery('SELECT MAX(u.id) FROM Ordemservico\Entity\Ordemservico u ');
        $lastId = $l->getResult();

        switch (strlen($lastId[0][1])){
            case 0:
                $data = $dataOs.'0000';
                break;
            case 1:
                $data = $dataOs.'000'.$lastId[0][1];
                break;
            case 2:
                $data = $dataOs.'00'.$lastId[0][1];
                break;
            case 3:
                $data = $dataOs.'0'.$lastId[0][1];
                break;
            default:
                $data = $dataOs.$lastId[0][1];
                break;
        }
        return $data;
    }

    public function getUsuarioTecnico(){

        $em = $this->getEM();
        $tipo = $em->getRepository('\Usuario\Entity\Tipo')->findBy(array('nome' => 'tecnico'));
        $t = $em->getRepository('\Usuario\Entity\Usuario')->findBy(array('tipo' => $tipo[0]->getId()));
        $tecnicos=array();
        foreach($t as $tecnico){
            $tecnicos[$tecnico->getId()] = $tecnico->getNome();
        }
        return $tecnicos;
    }
}