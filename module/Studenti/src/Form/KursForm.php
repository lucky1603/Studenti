<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Studenti\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

/**
 * Description of KursForm
 *
 * @author a
 */
class KursForm extends Form {
    //put your code here4
    private $serviceManager;
    
    public function __construct($name = null, $options = array()) {
        parent::__construct("KursForm");
        
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart-form/data');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('role', 'form');
        
        $this->serviceManager = $options['service_manager'];
        
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        
        /* Get all students from the students table */
        $studentsTable = $this->serviceManager->get(\Studenti\Model\StudentsTable::class);
        $students = $studentsTable->fetchAll();
        $studentOptions = [];
        foreach($students as $student)
        {
            $studentOptions[$student->id] = $student->ime . " " . $student->prezime;
        }
        
        /* Init 'select students' element */
        $selectStudent = new Select('student_id');
        $selectStudent->setLabel("Student");
        $selectStudent->setLabelAttributes([
            'class' => 'col-xs-2 control-label',
        ]);
        $selectStudent->setValueOptions($studentOptions);
        $selectStudent->setAttribute('class', 'form-control');
        $selectStudent->setAttribute('id', 'student_id');
        $this->add($selectStudent);
        
        /* Get all subjects from the subjects table */
        $subjectsTable = $this->serviceManager->get(\Studenti\Model\SubjectsTable::class);
        $subjects = $subjectsTable->fetchAll();
        $subjectOptions = [];
        foreach($subjects as $subject)
        {
            $subjectOptions[$subject->id] = $subject->ime;
        }
        
        /* Init 'select students' element */
        $selectSubject = new Select('subject_id');
        $selectSubject->setLabel("Subject");
        $selectSubject->setLabelAttributes([
            'class' => 'col-xs-2 control-label',
        ]);
        $selectSubject->setValueOptions($subjectOptions);
        $selectSubject->setAttribute('class', 'form-control');
        $selectSubject->setAttribute('id', 'subject_id');
        $this->add($selectSubject);
        
        /* Prisustvo */
        $this->add([
            'name' => 'prisustvo',
            'attributes' => [
                'type' => 'text',
                'required' => 'required',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Prisustvo',
                'label_attributes' => [
                    'class' => 'col-xs-2 control-label',
                ]
            ]
        ]);
        
        /* Broj časova */
        $this->add([
            'name' => 'broj_casova',
            'attributes' => [
                'type' => 'text',
                'required' => 'required',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Broj časova',
                'label_attributes' => [
                    'class' => 'col-xs-2 control-label',
                ]
            ]
        ]);
        
        /* Samostalni zadaci */
        $this->add([
            'name' => 'samostalni_zadaci',
            'attributes' => [
                'type' => 'text',
                'required' => 'required',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Prisustvo',
                'label_attributes' => [
                    'class' => 'col-xs-2 control-label',
                ]
            ]
        ]);
        
        /* Kolokvijum 1 poeni */
        $this->add([
            'name' => 'kolokvijum_1_poeni',
            'attributes' => [
                'type' => 'text',
                'required' => 'required',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Kolokvijum 1 (poeni)',
                'label_attributes' => [
                    'class' => 'col-xs-2 control-label',
                ]
            ]
        ]);
        
        /* Datum prvojg kolokvijuma */
        $kolokvijum1Date = new \Zend\Form\Element\Date('kolokvijum_1_datum');
        $kolokvijum1Date->setLabel("Kolokvijum 1 Datum");
        $kolokvijum1Date->setLabelAttributes([
            'class' => 'col-xs-2 control-label',
        ]);
        $kolokvijum1Date->setOptions([
            'min' => '2017-09-01',
            'max' => '2018-09-01',
            'step' => '1'
        ]);
        $kolokvijum1Date->setAttribute('id', 'kolokvijum_1_datum');
        $kolokvijum1Date->setAttribute('class', 'form-control');
        
        /* Kolokvijum 2 poeni */
        $this->add([
            'name' => 'kolokvijum_2_poeni',
            'attributes' => [
                'type' => 'text',
                'required' => 'required',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Kolokvijum 2 (poeni)',
                'label_attributes' => [
                    'class' => 'col-xs-2 control-label',
                ]
            ]
        ]);
        
        /* Datum drugog kolokvijuma */
        $kolokvijum2Date = new \Zend\Form\Element\Date('kolokvijum_2_datum');
        $kolokvijum2Date->setLabel("Kolokvijum 2 Datum");
        $kolokvijum2Date->setLabelAttributes([
            'class' => 'col-xs-2 control-label',
        ]);
        $kolokvijum2Date->setOptions([
            'min' => '2017-09-01',
            'max' => '2018-09-01',
            'step' => '1'
        ]);
        $kolokvijum2Date->setAttribute('id', 'kolokvijum_1_datum');
        $kolokvijum2Date->setAttribute('class', 'form-control');
        
        /* Datum pismenog ispita */
        $pismeniDatum = new \Zend\Form\Element\Date('pismeni_datum');
        $pismeniDatum->setLabel("Datum pismenog");
        $pismeniDatum->setLabelAttributes([
            'class' => 'col-xs-2 control-label',
        ]);
        $pismeniDatum->setOptions([
            'min' => '2017-09-01',
            'max' => '2018-09-01',
            'step' => '1'
        ]);
        $pismeniDatum->setAttribute('id', 'pismeni_datum');
        $pismeniDatum->setAttribute('class', 'form-control');
        
        /* Pismeni ispit poeni */
        $this->add([
            'name' => 'pismeni_poeni',
            'attributes' => [
                'type' => 'text',
                'required' => 'required',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Pismeni ispit (poeni)',
                'label_attributes' => [
                    'class' => 'col-xs-2 control-label',
                ]
            ]
        ]);
        
        /* Datum usmenog ispita */
        $usmeniDatum = new \Zend\Form\Element\Date('usmeni_datum');
        $usmeniDatum->setLabel("Datum usmenog");
        $usmeniDatum->setLabelAttributes([
            'class' => 'col-xs-2 control-label',
        ]);
        $usmeniDatum->setOptions([
            'min' => '2017-09-01',
            'max' => '2018-09-01',
            'step' => '1'
        ]);
        $usmeniDatum->setAttribute('id', 'usmeni_datum');
        $usmeniDatum->setAttribute('class', 'form-control');
        
        /* Usmeni ispit poeni */
        $this->add([
            'name' => 'usmeni_poeni',
            'attributes' => [
                'type' => 'text',
                'required' => 'required',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Usmeni ispit (poeni)',
                'label_attributes' => [
                    'class' => 'col-xs-2 control-label',
                ]
            ]
        ]);
        
        /* Poeni ukupno do usmenog */
        $this->add([
            'name' => 'Poeni do usmenog',
            'attributes' => [
                'type' => 'text',
                'required' => 'required',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Poeni do usmenog',
                'label_attributes' => [
                    'class' => 'col-xs-2 control-label',
                ]
            ]
        ]);
        
        /* Poeni zbir */
        $this->add([
            'name' => 'Zbir poena',
            'attributes' => [
                'type' => 'text',
                'required' => 'required',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Zbir poena',
                'label_attributes' => [
                    'class' => 'col-xs-2 control-label',
                ]
            ]
        ]);
        
        /* Ocena */
        $this->add([
            'name' => 'Ocena',
            'attributes' => [
                'type' => 'text',
                'required' => 'required',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Ocena',
                'label_attributes' => [
                    'class' => 'col-xs-2 control-label',
                ]
            ]
        ]);
        
    }
}
