<?php
namespace NovumWare\Process;

class ProcessResult
{
    /**
     * @var bool
     */
	public $success;

	/**
	 * @var string
	 */
	public $message;

	/**
	 * @var mixed|array
	 */
	public $data;


	/**
	 * @param bool $success
	 * @param mixed|array $data
	 * @param string $message
	 */
	public function __construct($success, $data=null, $message=null) {
		$this->success = $success;
		$this->message = $message;
		$this->data = $data;
	}

}
