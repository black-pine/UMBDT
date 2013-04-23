<?php
return array(
	'controller_plugins' => array(
		'factories' => array(
			'nwFlashMessenger' => function(){ return \Mockery::mock('\NovumWare\Zend\Mvc\Controller\Plugin\FlashMessenger'); }
		)
	),
	'view_helpers' => array(
		'factories' => array(
			'url' => function(){
				$mockUrlHelper = \Mockery::mock('\Zend\View\Helper\Url');
				$mockUrlHelper->shouldIgnoreMissing()->shouldReceive('__invoke')->andReturn('http://zendbasic2.com/link');
				return $mockUrlHelper;
			}
		)
	),
	'service_manager' => array(
		'allow_override' => true,
		'factories' => array(
			'MockTableGateway' => function(){ return \Mockery::mock('\Zend\Db\TableGateway\AbstractTableGateway'); },
			'NovumWare\Process\EmailsProcess' => function(){ return \Mockery::mock('\NovumWare\Process\EmailsProcess'); }
		),
		'abstract_factories' => array(
			'NovumWare\Test\Db\Table\Mapper\AbstractMapperFactory',
			'NovumWare\Test\Process\AbstractProcessFactory'
		)
	)
);