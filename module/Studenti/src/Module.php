<?php

namespace Studenti;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Studenti\Model\SubjectsTable;
use Studenti\Model\Subject;
use Studenti\Controller\SubjectsController;
use Studenti\Model\Student;
use Studenti\Model\StudentsTable;
use Studenti\Controller\StudentsController;
use Studenti\Model\Kurs;
use Studenti\Model\KursTabela;
use Studenti\Model\StudentModel;
use Studenti\Form\KursForm;
use Studenti\Controller\AjaxController;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\SubjectsTableGateway::class => function($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Subject());
                    return new TableGateway('predmeti', $dbAdapter, null, $resultSetPrototype);
                },
                SubjectsTable::class => function($sm) {
                    $tableGateway = $sm->get(Model\SubjectsTableGateway::class);
                    return new SubjectsTable($tableGateway);
                },
                Model\StudentsTableGateway::class => function($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Student());
                    return new TableGateway('studenti', $dbAdapter, null, $resultSetPrototype);
                },
                Model\KursTableGateway::class => function($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Kurs());
                    return new TableGateway('kursevi', $dbAdapter, null, $resultSetPrototype);
                },
                StudentsTable::class => function($sm) {
                    $tableGateway = $sm->get(Model\StudentsTableGateway::class);
                    return new StudentsTable($tableGateway);
                },
                KursTabela::class => function($sm) {
                    $tableGateway = $sm->get(Model\KursTableGateway::class);
                    return new KursTabela($tableGateway);
                }, 
                StudentModel::class => function($sm) {
                    return new StudentModel($sm);
                },
                /* Forme */
                KursForm::class => function($sm) {
                    return new KursForm("KursForm", ['service_manager' => $sm]);
                }
                
            ]  
        ];
    }
    
    public function getControllerConfig()
    {
        return [
            'factories' => [
                SubjectsController::class => function($container) {
                    return new SubjectsController($container);
                },
                StudentsController::class => function($container) {
                    return new StudentsController($container);
                },
                Controller\CoursesController::class => function($container) {
                    return new Controller\CoursesController($container);
                },
                AjaxController::class => function($container) {
                    return new AjaxController($container);
                }, 
             ],
        ];
    }
}

