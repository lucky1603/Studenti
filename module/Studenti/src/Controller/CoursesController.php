<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Studenti\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceManager;

/**
 * Description of CoursesController
 *
 * @author a
 */
class CoursesController extends AbstractActionController {
    private $serviceManager;
    
    public function __construct(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
    }
    
    public function indexAction() {
        
        return [];
    }
}
