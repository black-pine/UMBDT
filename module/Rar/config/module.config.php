<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'Rar\Controller\People' => 'Rar\Controller\PeopleController',
			'Rar\Controller\Rides' => 'Rar\Controller\RidesController',
			'Rar\Controller\Rooms' => 'Rar\Controller\RoomsController',
		),
	),
	
	'router' => array(
		'routes' => array(
			'rar' => array(
				'type'	  => 'Segment',
				'options' => array(
					'route' => '/rar[/:controller][/:action]',
					'defaults' => array(
						'__NAMESPACE__' => 'Rar\Controller',
						'controller' => 'People',
						'action'	 => 'new',
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