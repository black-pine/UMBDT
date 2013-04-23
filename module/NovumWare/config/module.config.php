<?php
return array(
	'maxnufsmarty' => array(
        'plugins' => array(
			__DIR__ . '/../src/NovumWare/Smarty/plugins'
        )
    ),
	'controller_plugins' => array(
		'factories' => array(
			'nwFlashMessenger' => function(){ return new \NovumWare\Zend\Mvc\Controller\Plugin\FlashMessenger; }
		)
	),
	'view_manager' => array(
	    'template_path_stack' => array(
	        __DIR__ . '/../view'
	    )
	),
	'view_helpers' => array(
		'invokables' => array(
			'nwFlashMessenger' => 'NovumWare\Zend\View\Helper\FlashMessenger'
		)
	),
	'service_manager' => array(
		'abstract_factories' => array(
			'NovumWare\Db\Table\Mapper\AbstractMapperFactory',
			'NovumWare\Db\Table\Mapper\NoDb\AbstractMapperFactory',
			'NovumWare\Process\AbstractProcessFactory'
		)
	)
);