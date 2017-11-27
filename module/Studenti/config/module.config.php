<?php
namespace Studenti;

use Zend\ServiceManager\Factory\InvokableFactory;
use Studenti\Controller\StudentsController;
use Zend\Router\Http\Segment;
use Studenti\Controller\SubjectsController;
use Studenti\Controller\AjaxController;

return [
    'controllers' => [
        'factories' => [
            
        ],
    ],
    'router' => [
        'routes' => [
            'studenti' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/students[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller' => StudentsController::class,
                        'action' => 'index',
                    ]
                ]
            ],
            'predmeti' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/subjects[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller' => SubjectsController::class,
                        'action' => 'index',
                    ]
                ]
            ],
            'kursevi' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/courses[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller' => CoursesController::class,
                        'action' => 'index',
                    ]
                ]
            ],
            'ajax' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/ajax[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller' => AjaxController::class,
                        'action' => 'some',
                    ]
                ],
            ],
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'studenti' => __DIR__ . '/../view',
        ],
    ],
];