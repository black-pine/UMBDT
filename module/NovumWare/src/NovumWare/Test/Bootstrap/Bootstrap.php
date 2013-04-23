<?php
namespace NovumWare\Test\Bootstrap;

class Bootstrap
{

	static public function init() {
		require_once 'Hamcrest/Hamcrest.php';

		putenv('APPLICATION_ENV=testing');

		chdir(__DIR__.'/../../../../../..');
		require 'init_autoloader.php';

		$applicationConfigArray = include 'config/application.config.php';
		\Zend\Mvc\Application::init($applicationConfigArray);
	}

}

Bootstrap::init();