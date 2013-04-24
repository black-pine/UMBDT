<?php
namespace Media\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class MediaController extends \NovumWare\Zend\Mvc\Controller\AbstractActionController
{
    /**
     * Dispatch a request
     *
     * @events dispatch.pre, dispatch.post
     * @param  Request $request
     * @param  null|Response $response
     * @return Response|mixed
     */
    public function dispatch(\Zend\Stdlib\RequestInterface $request, \Zend\Stdlib\ResponseInterface $response = null) {
		define('DOCUMENT_ROOT', '/Users/Sumi/Sites/UMBDT');
		define('DIR_IMAGES', '/public/images');
		return parent::dispatch($request, $response);
	}

    public function photoGalleryAction() {
		$galleriesPath = '/galleries/';
		$galleriesAbsolutePath = DOCUMENT_ROOT.DIR_IMAGES.$galleriesPath;

		$galleries = $this->createDirArray($galleriesAbsolutePath);

		return array('galleries'=>$galleries);
	}

	public function displayGalleryAction() {
		$galleryName = $this->params('gallery');
		$galleriesPath = '/galleries/';

		if ($galleryName) {
			$galleryAbsolutePath = DOCUMENT_ROOT.DIR_IMAGES.$galleriesPath.$galleryName.'/';
			$dirHandle = openDir($galleryAbsolutePath);
			$images = array();
			while ($dirObject = readdir($dirHandle)) {
				if ($dirObject == '.' || $dirObject == '..' || $dirObject == '.DS_Store') continue;
				if (!is_dir($galleryAbsolutePath.$dirObject)) array_push($images, $dirObject);
			}
			return array('images' => $images,
						 'galleryName' => $galleryName);
		}

	}

	public function videoGalleryAction() {}

	public function createDirArray($galleriesAbsolutePath) {
		$galleriesArray = array();
		$galleryDirHandle = opendir($galleriesAbsolutePath);
		while ($gallery = readdir($galleryDirHandle)) {
			if ($gallery == '.' || $gallery == '..' || $gallery == 'originals') continue;
			if (!is_dir($galleriesAbsolutePath.$gallery)) continue;
			$galleriesArray[$gallery] = $this->createDirArray($galleriesAbsolutePath.$gallery.'/');
		}
		closedir($galleryDirHandle);
		return $galleriesArray;
	}
}
