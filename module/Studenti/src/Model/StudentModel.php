<?php
namespace Studenti\Model;

use Zend\ServiceManager\ServiceManager;
use Zend\Db\Adapter\Adapter;

class StudentModel
{
    public $student;
    public $kursevi;
    private $serviceManager;
    private $adapter;
    
    public function __construct(ServiceManager $manager)
    {
        $this->serviceManager = $manager;
        $this->adapter = $this->serviceManager->get(Adapter::class);
        $this->student = new Student();
        $this->kursevi = array();
    }
    
    public function exchangeArray($data)
    {
        $this->student->exchangeArray($data);
        $this->kursevi = [];
        if(isset($data['kursevi']))
        {
            foreach ($data['kursevi'] as $kursData)
            {
                $kurs = new Kurs();
                $kurs->exchangeArray($kursData);
                $this->kursevi[] = $kurs;
            }
        }
    }
    
    public function getArrayCopy() 
    {   
        $data = $this->student->getArrayCopy();
        foreach ($this->kursevi as $kurs)
        {
            $data['kursevi'][] = $kurs->getArrayCopy();
        }
    }
    
    public function setId($id)
    {
        $id = (int)$id;
        
        $studentsTable = $this->serviceManager->get(StudentsTable::class);
        $this->student = $studentsTable->getStudent($id);
        $kursTabela = $this->serviceManager->get(KursTabela::class);
        $this->kursevi = $kursTabela->fetchForStudent($id);
    }
    
    public function save()
    {
        $studentsTable = $this->serviceManager->get(StudentsTable::class);
        $student_id = $studentsTable->saveStudent($this->student);
        if(isset($this->kursevi) && count($this->kursevi) > 0)
        {
            $kurseviTabela = $this->serviceManager->get(KursTabela::class);
            $kursevi = $kurseviTabela->fetchForStudent($student_id);
            $kursevi = $kursevi->toArray();
            
            foreach($this->kursevi as $kurs)
            {
                
            }
        }
    }
}

