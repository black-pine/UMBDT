<?php
namespace NovumWare\Zend\View\Helper;

class FlashMessenger extends \Zend\View\Helper\AbstractHelper
{
	public function __invoke() {
		$output = '';

		$messages = $this->getView()->nwFlashMessages;

		if (!$messages) return $output;

		foreach ($messages as $alertType => $typeMessages) {
			$output .= "<div class='alert alert-$alertType'><ul>";
			foreach ($typeMessages as $message) {
				$output .= "<li>$message</li>";
			}
			$output .= "</ul></div>";
		}

		return $output;
	}
}
