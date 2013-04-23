<?php
namespace NovumWare\Zend\Form;

class Form extends \Zend\Form\Form
{
	protected $inputFilter;


	public function __construct(array $initialFormValues=null) {
		parent::__construct();

		$this->setInputFilter($this->getInputFilter());

		if ($initialFormValues) $this->setData ($initialFormValues);
	}
}