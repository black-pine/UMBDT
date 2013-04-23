<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'Members\Controller\Members' => 'Members\Controller\MembersController',
		),
	),
	
	'router' => array(
		'routes' => array(
			'members' => array(
				'type'	  => 'Segment',
				'options' => array(
					'route' => '/members[/:controller][/:action]',
					'defaults' => array(
						'__NAMESPACE__' => 'Members\Controller',
						'controller' => 'Members',
						'action'	 => 'new-member-faq',
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