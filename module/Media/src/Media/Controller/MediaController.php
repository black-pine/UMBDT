<?php
namespace Media\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class MediaController extends AbstractActionController
{
    public function photoGalleryAction() {
		$galleriesPath = '/galleries/';
		$galleriesAbsolutePath = DOCUMENT_ROOT.DIR_IMAGES.$galleriesPath;

		$galleries = $this->createDirArray($galleriesAbsolutePath);

		$this->view->galleries = $galleries;
	}

	public function displayGalleryAction() {
		$galleryName = $this->_request->getParam('gallery');
		$galleriesPath = '/galleries/';

		if ($galleryName) {
			$galleryAbsolutePath = DOCUMENT_ROOT.DIR_IMAGES.$galleriesPath.$galleryName.'/';
			$dirHandle = openDir($galleryAbsolutePath);
			$images = array();
			while ($dirObject = readdir($dirHandle)) {
				if ($dirObject == '.' || $dirObject == '..' || $dirObject == '.DS_Store') continue;
				if (!is_dir($galleryAbsolutePath.$dirObject)) array_push($images, $dirObject);
			}
			$this->view->images = $images;
			$this->view->galleryName = $galleryName;
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
