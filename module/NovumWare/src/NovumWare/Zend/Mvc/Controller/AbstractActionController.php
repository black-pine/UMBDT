<?php
// TODO make sure no one can access files in the public directory
// TODO don't add nwFlashMessages during ajax context
namespace NovumWare\Zend\Mvc\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;

/**
 * @method \NovumWare\Zend\Mvc\Controller\Plugin\FlashMessenger nwFlashMessenger()
 * @method \Zend\Http\Request getRequest()
 */
abstract class AbstractActionController extends \Zend\Mvc\Controller\AbstractActionController
{
	/** @var \NovumWare\Zend\Authentication\Storage\Session */
	protected $authSession;


	// ========================================================================= PUBLIC METHODS =========================================================================


	// ========================================================================= OVERRIDES =========================================================================
	/**
	 * Override for injecting variables into the layout/view (after the action has run)
	 *
	 * @param  Zend\Mvc\MvcEvent $e
	 * @return mixed
	 */
	public function onDispatch(MvcEvent $e) {
		// TODO is there a better way to check the browser?
		$browserCheckResponse = $this->checkBrowser();
		if (isset($browserCheckResponse)) { $e->setResult($browserCheckResponse); return $browserCheckResponse; }


		$actionResponse = parent::onDispatch($e); /* @var $actionResponse \Zend\Http\Response */

		if ($actionResponse instanceof \Zend\Http\Response && $actionResponse->isRedirect()) return $actionResponse;
		if ($this->getRequest()->isXmlHttpRequest()) $actionResponse = $this->createJsonResponse($actionResponse);
		else $this->addVariablesToLayout();
		$e->setResult($actionResponse);
		return $actionResponse;
	}


	// ========================================================================= HELPER METHODS =========================================================================
	/**
	 * Inject variables into the layout (but not the action's view)
	 *
	 * @return void
	 */
	protected function addVariablesToLayout() {
		$layout = $this->layout();
		$layout->controller = $this->getEvent()->getRouteMatch()->getParam('controller');
		$layout->action = $this->getEvent()->getRouteMatch()->getParam('action');
		$layout->route = $this->getEvent()->getRouteMatch()->getMatchedRouteName();
		$layout->nwFlashMessages = $this->nwFlashMessenger()->getAllMessages();
	}

	/**
	 * Check the client's browser and possibly redirect to a warning page
	 *
	 * @return mixed
	 */
	protected function checkBrowser() {
		if ($this->getEvent()->getRouteMatch()->getParam('controller') == 'Application\Controller\Browser') return null; // to avoid redirect loops
		$userAgent = $this->getRequest()->getHeaders('useragent');
		if (!$userAgent) return;
		$userAgentString = strtolower($userAgent->getFieldValue());

		if (preg_match('/msie/i', $userAgentString)) $response = $this->redirect()->toUrl('/browser/ie');
		else if (preg_match('/chrome/i', $userAgentString)) $response = null;
		else if (preg_match('/firefox/i', $userAgentString)) $response = null;
		else if (preg_match('/safari/i', $userAgentString)) $response = null;

		return (isset($response)) ? $response : null;
	}

	/**
	 * Inject any nwFlashMessages into the JSON response
	 *
	 * @param mixed $actionResponse
	 * @return \Zend\View\Model\JsonModel
	 */
	protected function createJsonResponse($actionResponse) {
		$jsonActionResponse = new JsonModel($actionResponse);
		$jsonActionResponse->setVariables(array('nwFlashMessages'=>$this->nwFlashMessenger()->getAllMessages()));
		return $jsonActionResponse;
	}
}