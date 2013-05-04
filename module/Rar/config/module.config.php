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
						'action'	 => 'index',
					),
				),
			),
			'rarCheckName' => array(
				'type'	  => 'Segment',
				'options' => array(
					'route' => '/rar/people/check-name-taken/:name',
					'defaults' => array(
						'controller' => 'Rar\Controller\People',
						'action'	 => 'check-name-taken',
					),
				),
			),
			'rarCheckEmail' => array(
				'type'	  => 'Segment',
				'options' => array(
					'route' => '/rar/people/check-email-taken/:email',
					'defaults' => array(
						'controller' => 'Rar\Controller\People',
						'action'	 => 'check-email-taken',
					),
				),
			),
			'rarCheckPhone' => array(
				'type'	  => 'Segment',
				'options' => array(
					'route' => '/rar/people/check-phone-taken/:phone',
					'defaults' => array(
						'controller' => 'Rar\Controller\People',
						'action'	 => 'check-phone-taken',
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

	'maxnufsmarty' => array(
		'plugins' => array(
			__DIR__ . '/../src/Smarty/plugins',
		),
	),
);