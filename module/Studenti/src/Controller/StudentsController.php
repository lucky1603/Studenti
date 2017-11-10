<?php
namespace Studenti\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Studenti\Model\StudentsTable;
use Zend\ServiceManager\ServiceManager;
use Studenti\Form\StudentsForm;
use Studenti\Model\Student;
use Zend\View\Model\ViewModel;

class StudentsController extends AbstractActionController
{
    private $serviceManager;
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }
    
    public function indexAction()
    {
        $studentsTable = $this->serviceManager->get(StudentsTable::class);
        $students = $studentsTable->fetchAll();
        
        return ['students' => $students];               
    }
    
    public function addAction()
    {
        $imgDir = getcwd() . '/public';
        
        $form = new StudentsForm();
        $request = $this->getRequest();
        if(! $request->isPost())
        {
            return ['form' => $form];
        }
        
        $student = new Student();
        $data = $request->getPost();
        $file = $this->params()->fromFiles('image');
        $data['image']  = '/img/studenti/'.$file['name'];
        
        $form->bind($student);
        $form->setData($data);
        if(! $form->isValid())
        {
            return ['form' => $form];
        }
        
        copy($file['tmp_name'], $imgDir.$data['image']);
        
        
        //$student->exchangeArray($form->getData());
        $studentsTable = $this->serviceManager->get(StudentsTable::class);
        $studentsTable->saveStudent($student);
        
        return $this->redirect()->toRoute('studenti', ['action' => 'index']);
    }
    
    public function editAction()
    {
        $imgDir = getcwd() . '/public';
        
        $form = new StudentsForm();
        $table = $this->serviceManager->get(StudentsTable::class);
        
        $id = (int) $this->params()->fromRoute('id', 0);
        if(0 == $id)
        {
            return $this->redirect()->toRoute('studenti', ['action' => 'add']);
        }
        
        try {
            $student = $table->getStudent($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('studenti');
        }
        
        $photo = $student->image;
        $form->bind($student);
        $request = $this->getRequest();
        $data = $request->getPost();
        $file = $this->params()->fromFiles('image');
        $data['image']  = '/img/studenti/'.$file['name'];
        
        
        $viewData = ['id' => $id, 'form' => $form, 'photo' => $photo];
        $viewModel = new ViewModel($viewData);
        $viewModel->setTemplate('/studenti/students/add');
        if(! $request->isPost())
        {
            return $viewModel;
        }
        
        $form->setData($request->getPost());
        if(! $form->isValid())
        {
            return $viewModel;
        }
        
        copy($file['tmp_name'], $imgDir.$data['image']);
        
        $table->saveStudent($student);
        
        return $this->redirect()->toRoute('studenti');
        
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if(0 == $id)
        {
            return $this->redirect()->toRoute('studenti');
        }
        
        $table = $this->serviceManager->get(StudentsTable::class);
        $table->deleteStudent($id);
        
        return $this->redirect()->toRoute('studenti');
        
    }
}

