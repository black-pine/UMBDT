<?php
namespace NovumWare;

use \ReflectionObject;

class Module
{

	public function getAutoloaderConfig() {
		$childClass = new ReflectionObject($this);
		$childClassPath = dirname($childClass->getFileName());
		$childClassNamespace = $childClass->getNamespaceName();

		$namespacesArray = array(
			$childClassNamespace  => "$childClassPath/src/$childClassNamespace"
		);

		if (getenv('APPLICATION_ENV') == 'testing') $namespacesArray[$childClassNamespace.'Test'] = $childClassPath."/test/$childClassNamespace".'Test';

		return array('Zend\Loader\StandardAutoloader'=>array('namespaces'=>$namespacesArray));
	}

	public function getConfig() {
		$childClass = new ReflectionObject($this);
		$childClassPath = dirname($childClass->getFileName());

		$configArray = include "$childClassPath/config/module.config.php";
		if (getenv('APPLICATION_ENV') == 'testing' && is_readable("$childClassPath/test/config/module.config.php")) $configArray = array_replace_recursive($configArray, include "$childClassPath/test/config/module.config.php");
		return $configArray;
	}

	public function getServiceConfig() {
		return array();
	}

}