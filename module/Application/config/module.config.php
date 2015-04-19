<?php
return [
    'router' => [
        'routes' => [
            'task' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route'    => '/task/:id',
                    'defaults' => [
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'task',
                    ],
                    'constraints' => [
                      'id' => '[1-5]'
                    ],
                ],
            ],
            'home' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ],
        'aliases' => [
            'translator' => 'MvcTranslator',
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'application/index/task1' => __DIR__ . '/../view/application/index/task1.phtml',
            'application/index/task2' => __DIR__ . '/../view/application/index/task2.phtml',
            'application/index/task3' => __DIR__ . '/../view/application/index/task3.phtml',
            'application/index/task4' => __DIR__ . '/../view/application/index/task4.phtml',
            'application/index/task5' => __DIR__ . '/../view/application/index/task5.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
