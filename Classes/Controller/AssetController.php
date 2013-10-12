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
//class AssetController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
class AssetController extends AbstractController {

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
		// get frontend user
		$user = $GLOBALS['TSFE']->fe_user->user;
		$feUser = $this->frontendUserRepository->findByUid($user['uid']);
		if ($feUser){
		    $newAsset->setFrontendUser($feUser);
		}
		$storedFile = $this->uploadFile($newAsset->getFile());
		if ($storedFile) {
			$newAsset->setFile($storedFile);
			$newAsset->updateMetaData();
			$this->assetRepository->add($newAsset);
			$this->persistenceManager->persistAll();
			$this->assetRepository->createFileReferences($newAsset, $storedFile);
			
			$this->flashMessageContainer->add('Your new Asset was created.');
			$this->redirect('list');
		}
		//@todo return localized error messages (would be probably best
		//implemented in upload manager class
		
		$this->redirect('new');

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
		$storedFile = $this->uploadFile($asset->getFile());
	 	//\TYPO3\CMS\Core\Utility\DebugUtility::debugInPopupWindow($storedFile->toArray(), 'update:	storedFile');
		if($storedFile){
		    $asset->setFile($storedFile);
		    $this->assetRepository->createFileReferences($asset, $storedFile);
			//$this->assetRepository->updateFileReference($storedFile,'tx_mediafrontend_domain_model_asset', 'files', $asset->getUid());
		} else {
		    $asset->setFile(1);
		}
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

}
?>

