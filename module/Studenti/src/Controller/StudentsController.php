<?php
namespace Studenti\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Studenti\Model\StudentsTable;
use Zend\ServiceManager\ServiceManager;
use Studenti\Form\StudentsForm;
use Studenti\Model\Student;
use Zend\View\Model\ViewModel;
use Studenti\Model\StudentModel;
use Zend\Session\Container;

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
        
        $session = new Container('models');
        if(isset($session->studentModelData))
        {
            unset($session->studentModelData);
        }
        
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
    
    public function addWithModelAction()
    {
        $imgDir = getcwd() . '/public';
        
        $form = new StudentsForm();
        
        $studentModel = $this->serviceManager->get(StudentModel::class);
        $session = new Container('models');
        if(isset($session->studentModelData)) {
            $studentModel->exchangeArray($session->studentModelData);
        }
        
        $request = $this->getRequest();
        if(! $request->isPost())
        {
            return ['form' => $form, 'model' => $studentModel];
        }
        
        $data = $request->getPost();
        
        $file = $this->params()->fromFiles('image');
        $data['image']  = '/img/studenti/'.$file['name'];
        
        $form->bind($studentModel->student);
        $form->setData($data);
        if(! $form->isValid())
        {
            return ['form' => $form, 'model' => $studentModel];
        }
        
        copy($file['tmp_name'], $imgDir.$data['image']);
        $studentModel->save();
        unset($session->studentModelData);
        
        return $this->redirect()->toRoute('studenti');
    }
    
    public function editAction()
    {
        $imgDir = getcwd() . '/public';
        
        $form = new StudentsForm();
        
        $table = $this->serviceManager->get(StudentsTable::class);
        
        $id = (int) $this->params()->fromRoute('id', 0);
        if(0 == $id)
        {
            die('redirected to add');
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
        $viewData = ['id' => $id, 'form' => $form, 'photo' => $photo];
        $viewModel = new ViewModel($viewData);
        $viewModel->setTemplate('/studenti/students/add');
        if(! $request->isPost())
        {
            return $viewModel;
        }
                
        $data = $request->getPost();
               
        $file = $this->params()->fromFiles('image');
        if(! empty($file['name']) && $file['name'] != "")
        {
            $data['image']  = '/img/studenti/'.$file['name'];
        }
        
        $form->setData($request->getPost());
        if(! $form->isValid())
        {
            return $viewModel;
        }
        
        if(! empty($file['name']) && $file['name'] != null) {
            copy($file['tmp_name'], $imgDir.$data['image']);
        }
                
        $table->saveStudent($student);
        
        return $this->redirect()->toRoute('studenti');
    }
    
    public function editWithModelAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if(0 == $id)
        {
            return $this->redirect()->toRoute('studenti', ['action' => 'addWithModel']);
        }
        
        $studentModel = $this->serviceManager->get(StudentModel::class);
        $session = new Container('models');
        if(isset($session->studentModelData))
        {
            $studentModel->exchangeArray($session->studentModelData);
            if($studentModel->student->id != $id)
            {
                $studentModel->setId($id);
            }
        } else {
            $studentModel->setId($id);
        }
        
        $imgDir = getcwd() . '/public';
        $form = new StudentsForm();
        
        $photo = $studentModel->student->image;
        $form->bind($studentModel->student);
        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form, 'photo' => $photo, 'model' => $studentModel];
        $viewModel = new ViewModel($viewData);
        $viewModel->setTemplate('/studenti/students/add-with-model');
        if(! $request->isPost())
        {
            return $viewModel;
        }
        
        $data = $request->getPost();
        
        $file = $this->params()->fromFiles('image');
        if(! empty($file['name']) && $file['name'] != "")
        {
            $data['image']  = '/img/studenti/'.$file['name'];
        }
        
        $form->setData($request->getPost());
        if(! $form->isValid())
        {
            return $viewModel;
        }
        
        if(! empty($file['name']) && $file['name'] != null) {
            copy($file['tmp_name'], $imgDir.$data['image']);
        }
        
        $studentModel->save();
        
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
    
    public function deleteWithModelAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if(0 == $id)
        {
            return $this->redirect()->toRoute('studenti');
        }
        
        $studentModel = $this->serviceManager->get(StudentModel::class);
        $studentModel->setId($id);
        $studentModel->delete();
        
        return $this->redirect()->toRoute('studenti');
    }
    
    public function addCourseAction()
    {
        
    }
}

