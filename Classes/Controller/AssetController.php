<?php
namespace Webfox\MediaFrontend\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Dirk Wenzel <wenzel@webfox01.de>, Agentur Webfox
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package media_frontend
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AssetController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * assetRepository
	 *
	 * @var \Webfox\MediaFrontend\Domain\Repository\AssetRepository
	 * @inject
	 */
	protected $assetRepository;

	/**
	 * Persistence Manager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager 
	 */
	protected $persitenceManager;

	/**
	 * initialize
	 */
	public function initializeCreateAction() {
		$this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
		if ($this->arguments->hasArgument('newAsset')) {
		    $this->arguments->getArgument('newAsset')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('file',
			    'array');
		}
	}
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$assets = $this->assetRepository->findAll();
		$this->view->assign('assets', $assets);
	}

	/**
	 * action show
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $asset
	 * @return void
	 */
	public function showAction(\Webfox\MediaFrontend\Domain\Model\Asset $asset) {
		$this->view->assign('asset', $asset);
	}

	/**
	 * action new
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $newAsset
	 * @dontvalidate $newAsset
	 * @return void
	 */
	public function newAction(\Webfox\MediaFrontend\Domain\Model\Asset $newAsset = NULL) {
		$this->view->assign('newAsset', $newAsset);
	}

	/**
	 * action create
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $newAsset
	 * @return void
	 */
	public function createAction(\Webfox\MediaFrontend\Domain\Model\Asset $newAsset) {
		$tempFile = $newAsset->getFile();
		//\TYPO3\CMS\Core\Utility\DebugUtility::debug($tempFile, 'create: tempFile');
		
		// set the number of files to 1
		$newAsset->setFile(1);
		$this->assetRepository->add($newAsset);
		//\TYPO3\CMS\Core\Utility\DebugUtility::debug($newAsset, 'create: newAsset');
		$this->persistenceManager->persistAll();
		$uidNew = $newAsset->getUid();
		
		if (is_array($tempFile) AND $tempFile['error'] == 0) {
			$uploadedFile = $this->uploadFile($tempFile['name'], $tempFile['type'], $tempFile['tmp_name'], $tempFile['size']);
			//\TYPO3\CMS\Core\Utility\DebugUtility::debug($uploadedFile, 'create: uploadedFile');
			$sysFileCreate = $this->assetRepository->myFileOperationsFal($uploadedFile, $tempFile['type'], $tempFile['size'], $uidNew);
			//\TYPO3\CMS\Core\Utility\DebugUtility::debug($sysFileCreate, 'create: sysFileCreate');
		}
		
		$this->flashMessageContainer->add('Your new Asset was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $asset
	 * @return void
	 */
	public function editAction(\Webfox\MediaFrontend\Domain\Model\Asset $asset) {
		$this->view->assign('asset', $asset);
	}

	/**
	 * action update
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $asset
	 * @return void
	 */
	public function updateAction(\Webfox\MediaFrontend\Domain\Model\Asset $asset) {
		$this->assetRepository->update($asset);
		$this->flashMessageContainer->add('Your Asset was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $asset
	 * @return void
	 */
	public function deleteAction(\Webfox\MediaFrontend\Domain\Model\Asset $asset) {
		$this->assetRepository->remove($asset);
		$this->flashMessageContainer->add('Your Asset was removed.');
		$this->redirect('list');
	}

	/**
	 * action upload
	 *
	 * @return void
	 */
	public function uploadAction() {

	}

	/**
	 * action download
	 *
	 * @return void
	 */
	public function downloadAction() {

	}

	/**
 	 * upload function
 	 * 
 	 * @param \string $name file name
 	 * @param \int $type file type
 	 * @param \string $temp temp file name
 	 * @param \int $size file size
 	 */  
	protected function uploadFile($name, $type, $temp, $size) {
		if($size > 0) {
			$basicFileFunctions = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_basicFileFunctions');

			$name = $basicFileFunctions->cleanFileName($name);
			$uploadPath = $basicFileFunctions->cleanDirectoryName('fileadmin/user_upload/');
			$uniqueFileName = $basicFileFunctions->getUniqueName($name, $uploadPath);
			$fileStored = move_uploaded_file($temp, $uniqueFileName);

			$returnValue = basename($uniqueFileName);
		}
		return $returnValue;
	}

}
?>

