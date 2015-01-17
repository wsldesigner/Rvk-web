<?php

namespace Usuario\Controller;

use Usuario\Entity\Tipo;
use Usuario\Entity\Usuario;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuario\Form\UsuarioForm;

class IndexController extends AbstractActionController
{

    public $em;
    public function indexAction()
    {
        $em = $this->serviceDoctrine();
        $usuarios = $em->getRepository('Usuario\Entity\Usuario')->findAll();

        //print_r($usuarios[0]->toArray());

        return new ViewModel(array(
            'usuarios' => $usuarios,
            'flashMessages' => $this->flashMessenger()->getMessages(),
        ));
    }

    public function addAction(){

        $form = new UsuarioForm(null, $this->arraySelect());

        $usuario = new Usuario();

        $request = $this->getRequest();

        $this->arraySelect();

        if($request->isPost()){

            $form->setInputFilter($usuario->getInputFilter());

            $form->setData($request->getPost());

            if($form->isValid()) {

                $usuario->exchangeArray($form->getData());
                //$tipo = $this->serviceDoctrine()->
                $em = $this->serviceDoctrine();
                $tipo = $em->getRepository('\Usuario\Entity\Tipo')->find($usuario->getTipo());
                $usuario->setTipo($tipo);
                $em->persist($usuario);
                $em->flush();

                $this->flashMessenger()->addMessage('Usuario: '.$usuario->getNome().' Código: '.$usuario->getCodigoUsuario().' Foi adicionado com sucesso!' );
                return $this->redirect()->toRoute('usuario');
            }

        }

        return array(
            'form' => $form,
            'flashMessages' => $this->flashMessenger()->getMessages(),
        );
    }

    public function editAction()
    {
        $codigo = (int) $this->params()->fromRoute('codigo', null);

        $usuario = $this->serviceDoctrine()->
                        getRepository('\Usuario\Entity\Usuario')->
                        findOneBy(array('codigoUsuario' => $codigo));

        $value = $usuario->getTipo()->getId();

        $form = new UsuarioForm(null, $this->arraySelect(), $value);

        $form->add(array(
            'name' => 'cancelar',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Cancelar',
                ),
        ));
        $form->bind($usuario);

        $request = $this->getRequest();

        if($request->isPost()){

            $form->setInputFilter($usuario->getInputFilter());

            $form->setData($request->getPost());

            if($form->isValid()){

                if($request->getPost('cancelar')){
                    return $this->redirect()->toRoute('usuario');
                }

                $formData = $form->getData();

                $data['id']   = $formData->getId();
                $data['nome'] = $formData->getNome();
                $data['codigoUsuario'] = $formData->getCodigoUsuario();
                $data['endereco'] = $formData->getEndereco();
                $data['telefone'] = $formData->getTelefone();
                $data['celular'] = $formData->getCelular();
                $data['cpf'] = $formData->getCpf();
                $data['senha'] = $formData->getSenha();
                $data['email'] = $formData->getEmail();

                $usuario->exchangeArray($data);

                $em = $this->serviceDoctrine();

                $tipo = $em->getRepository('\Usuario\Entity\Tipo')->find($request->getPost()->get('tipo_usuario'));
                $usuario->setTipo($tipo);

                $em->persist($usuario);

                $em->flush();

                $this->flashMessenger()->addMessage('Usuario '.$data['nome'].' '.$data['codigoUsuario'].' foi alterado com sucesso!');

                return $this->redirect()->toRoute('usuario');
            }
        }

        return array(
            'form' => $form,
            'codigo' => $codigo,
        );

    }

    /**
     * Retorno do Doctrine para serviço manager
     */
    public function serviceDoctrine(){
        if(null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
   }
    public function arraySelect(){
        //Retornando dados do banco de dados da tabela Tipo
        $tipos = $this->serviceDoctrine()->getRepository('\Usuario\Entity\Tipo')->findAll();

        foreach($tipos as $tipo){
            $dado[$tipo->getId()] = $tipo->getNome();
        }
        return $dado;
    }
}
