<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'Competitions\Controller\Competitions' => 'Competitions\Controller\CompetitionsController',
		),
	),
	
	'router' => array(
		'routes' => array(
			'competitions' => array(
				'type'	  => 'Segment',
				'options' => array(
					'route' => '/competitions[/:controller][/:action]',
					'defaults' => array(
						'__NAMESPACE__' => 'Competitions\Controller',
						'controller' 	=> 'Competitions',
						'action'	 	=> 'mich-comp',
					),
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view'
		)
	),
);