<?php
namespace Studenti\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceManager;
use Studenti\Model\SubjectsTable;
use Studenti\Form\SubjectsForm;
use Studenti\Model\Subject;

class SubjectsController extends AbstractActionController
{
    private $serviceManageer;
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManageer = $serviceManager;    
    }
    
    public function indexAction()
    {
        $subjectsTable = $this->serviceManageer->get(SubjectsTable::class);
        $subjects = $subjectsTable->fetchAll();
        return ['subjects' => $subjects];
    }
    
    public function addAction()
    {
        $form = new SubjectsForm();
        $request = $this->getRequest();
        if(! $request->isPost())
        {
            return ['form' => $form];
        }
        
        $subject = new Subject();
        $form->setData($request->getPost());
        if(! $form->isValid())
        {
            return ['form' => $form];
        }
        
        $subject->exchangeArray($form->getData());
        $subjectsTable = $this->serviceManageer->get(SubjectsTable::class);
        $subjectsTable->saveSubject($subject);
        
        return $this->redirect()->toRoute('predmeti', ['action' => 'index']);
    }
    
    public function editAction()
    {
        $table = $this->serviceManageer->get(SubjectsTable::class);
        $id = (int) $this->params()->fromRoute('id', 0);
        if(0 == $id)
        {
            return $this->redirect()->toRoute('predmeti', ['action' => 'add']);
        }
        
        try {
            $subject = $table->getSubject($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('predmeti', ['action' => 'index']);
        }
        
        $form = new SubjectsForm();
        $form->bind($subject);
        $form->get('submit')->setAttribute('value', 'Promeni podatke');
        
        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];
        $viewModel = new ViewModel($viewData);
        $viewModel->setTemplate('/studenti/subjects/add');
        
        if(! $request->isPost()) {
            return $viewModel;
        }
                
        $form->setData($request->getPost());
        
        if(! $form->isValid()) {
            return $viewModel;
        }
        
        $table->saveSubject($subject);
        
        return $this->redirect()->toRoute('predmeti', ['action' => 'index']);
    }
}

