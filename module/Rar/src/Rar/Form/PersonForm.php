<?php
namespace Rar\Form;

use Zend\Form\Element;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator;

class PersonForm extends \NovumWare\Zend\Form\Form
{

	public function __construct(array $initialFormValues=null) {
		parent::__construct($initialFormValues);

		$name = new Element\Text('name');

		$email = new Element\Email('email');

		$phone = new Element\Text('phone');

		$departure = new Element\Text('departure');

		$driver = new Element\Checkbox('driver');

		$capacity = new Element\Text('capacity');

		$preference1 = new Element\Text('preference1');

		$preference2 = new Element\Text('preference2');

		$antipreference1 = new Element\Text('antipreference1');

		$antipreference2 = new Element\Text('antipreference2');

		$this->add($name)
			 ->add($email)
			 ->add($phone)
			 ->add($departure)
			 ->add($driver)
			 ->add($capacity)
			 ->add($preference1)
			 ->add($preference2)
			 ->add($antipreference1)
			 ->add($antipreference2);
	}

	/**
	 * @return InputFilterInterface
	 */
	public function getInputFilter() {
		if (!$this->inputFilter) {

			$name = new Input('name');
			$name->setRequired(true);

			$email = new Input('email');
			$email->setRequired(true)
				  ->getValidatorChain()
				  ->addValidator(new Validator\EmailAddress());

			$phone = new Element\Text('phone');
			$phone->setRequired(true)
				  ->getFilterChain()
				  ->addFilter(new Filter\Int);

			$departure = new Element\Text('departure');
			$departure->setRequired(true);

			$driver = new Element\Checkbox('driver');
			$driver->setRequired(true);

			$capacity = new Element\Text('capacity');

			$preference1 = new Element\Text('preference1');

			$preference2 = new Element\Text('preference2');

			$antipreference1 = new Element\Text('antipreference1');

			$antipreference2 = new Element\Text('antipreference2');


			$inputFilter = new InputFilter();
			$inputFilter->add($name)
						->add($email)
						->add($phone)
						->add($departure)
						->add($driver)
						->add($capacity)
						->add($preference1)
						->add($preference2)
						->add($antipreference1)
						->add($antipreference2);

			$this->inputFilter = $inputFilter;
		}

		return $this->inputFilter;
	}

}