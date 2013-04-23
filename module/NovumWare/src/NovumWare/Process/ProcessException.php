<?php
namespace NovumWare\Process;

class ProcessException extends \Exception
{
    /**
     * @var string
     */
    private $errorMessage;


	/**
	 * @param string $errorMessage
	 */
    public function __construct($errorMessage) {
        parent::__construct();
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return string
     */
    public function getErrorMessage() {
        return $this->errorMessage;
    }
}
