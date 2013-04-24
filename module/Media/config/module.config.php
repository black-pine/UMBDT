<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'Media\Controller\Media' => 'Media\Controller\MediaController',
		),
	),
	
	'router' => array(
		'routes' => array(
			'media' => array(
				'type'	  => 'Segment',
				'options' => array(
					'route' => '/media[/:controller][/:action]',
					'defaults' => array(
						'__NAMESPACE__' => 'Media\Controller',
						'controller' 	=> 'Media',
						'action'	 	=> 'photo-gallery',
					),
				),
			),
			'gallery' => array(
				'type'	  => 'Segment',
				'options' => array(
					'route' => '/media/media/display-gallery/:gallery',
					'defaults' => array(
						'controller' => 'Media\Controller\Media',
						'action'	 => 'display-gallery',
					),
				),
			),
		),
	),
	
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
);