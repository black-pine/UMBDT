<?php
namespace NovumWare\Process;

use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class EmailsProcess extends \NovumWare\Process\AbstractProcess
{

	/**
	 * @param string $recipient
	 * @param string $subject
	 * @param string $templatePath
	 * @param array $templateParams
	 */
	public function sendEmailFromTemplate($recipient, $subject, $templatePath, array $templateParams=null) {
		$htmlContent = $this->serviceManager->get('SmartyViewRenderer')->render($templatePath, $templateParams);
		$this->sendEmail($recipient, $subject, $htmlContent);
	}

	/**
	 * Send an email via php mail()
	 *
	 * @param string $recipient Recipient email address
	 * @param string $subject Subject of the email
	 * @param string $htmlContent HTML content of the email
	 * @return void
	 */
	public function sendEmail($recipient, $subject, $htmlContent) {
		$html = new MimePart($htmlContent);
		$html->type = 'text/html';

		$body = new MimeMessage;
		$body->setParts(array($html));

		$mail = new Message;
		$mail->setEncoding('UTF-8');
		$mail->addTo($recipient);
		$mail->setSubject($subject);
		$mail->setBody($body);

		$transport = new Sendmail;
		$transport->send($mail);
	}

}
