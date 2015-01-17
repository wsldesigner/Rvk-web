<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuario;

return array(
    'router' => array(
        'routes' => array(
            'tipo' => array(
                'type' => 'segment',
                'options' => array(
                    'route'     => '/usuario/tipo[/][:action][/:id]',
                    'defaults'  => array(
                        'controller' => 'Usuario\Controller\Tipo',
                        'action'     => 'index',
                    ),
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]*',
                    ),
                ),
            ),

            'usuario' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/usuario/usuario[/][:action][/:codigo][/]',
                    'defaults' => array(
                        //'__NAMESPACE__' => 'Usuario\Controller',
                        'controller'    => 'Usuario\Controller\Index',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'codigo' => '[0-9]*',
                    ),
                ),
               'may_terminate' => false,
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Usuario\Controller\Index' => 'Usuario\Controller\IndexController',
            'Usuario\Controller\Tipo' => 'Usuario\Controller\TipoController'
        ),
    ),
    'view_helper' => array(
        'invokables' => array(

        ),
    ),

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'usuario/index/index'     => __DIR__ . '/../view/usuario/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
           'Usuario' => __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),

	'doctrine' => array(
		'driver' => array(
			__NAMESPACE__ . '_driver' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
			),
			'orm_default' => array(
				'drivers' => array(
						__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
				)
			)
		),
        'configuration' => array(
            'orm_default' => array(
                //'metadata_cache'     => 'array',
                //'driver'             => 'orm_default',
                //'generate_proxies'   => true,
                //'proxy_dir'          => 'data/DoctrineORMModule/Proxy',
                //'proxy_namespace'    => 'DoctrineORMModule\Proxy',
                //'generate_hydrators' => false,
                //'hydrator_dir'       => 'data/DoctrineORMModule/Hydrator',
                //'hydrator_namespace' => 'DoctrineORMModule\Hydrator',
                //'default_db'         => 'rvk',
                //'filters'            => array()
            )
        ),
	)
);
