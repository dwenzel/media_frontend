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
class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * Asset Repository
	 *
	 * @var \Webfox\MediaFrontend\Domain\Repository\AssetRepository
	 * @inject
	 */
	protected $assetRepository;

	/**
	 * Frontend User Repository
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
	 * @inject
	 */
	protected $frontendUserRepository;

	/**
	 * Frontend User
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 */
	protected $frontendUser;

	/**
	 * Persistence Manager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager 
	 */
	protected $persitenceManager;

	/**
	 * Initialize Action
	 */
	public function initializeAction() {
	    // get frontend user
	    $user = $GLOBALS['TSFE']->fe_user->user;
	    if ($user) {
		    $this->frontendUser = $this->frontendUserRepository->findByUid($user['uid']);
	    }
	    $this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
	    if ($this->arguments->hasArgument('newAsset')) {
		$this->arguments->getArgument('newAsset')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('file',
			'array');
	    }
	    if ($this->arguments->hasArgument('asset')) {
		//$this->arguments->getArgument('asset')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('file', 'array');
	    }
	    if ($this->arguments->hasArgument('newFileCollection')) {
		$this->arguments->getArgument('newFileCollection')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('image', 'array');
	    }
	    if ($this->arguments->hasArgument('fileCollection')) {
		$this->arguments->getArgument('fileCollection')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('image', 'array');
	    }
	}

	/**
	 * Initialize Update Action
	 */
	public function initializeUpdateAction() {
	    if ($this->arguments->hasArgument('asset')) {
		$this->arguments->getArgument('asset')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('file', 'array');
		$this->arguments->getArgument('asset')->getPropertyMappingConfiguration()->allowCreationForSubProperty('file');
		$this->arguments->getArgument('asset')->getPropertyMappingConfiguration()->allowModificationForSubProperty('file');
	    }
	    if ($this->arguments->hasArgument('fileCollection')) {
		$this->arguments->getArgument('fileCollection')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('image', 'array');
	    }
	}


	/**
	 * Initialize Edint Action
	 */
	public function initializeEditAction() {
	    if ($this->arguments->hasArgument('asset')) {
		$this->arguments->getArgument('asset')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('file', 'array');
	    }
	    if ($this->arguments->hasArgument('fileCollection')) {
		$this->arguments->getArgument('fileCollection')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('image', 'array');
	    }
	}
	/**
 	 * upload function
 	 * 
 	 * @param \array $file An array containing values for newly uploaded file
	 * @return \string File name
 	 */  
	protected function uploadFile($file) {
		$storageRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\StorageRepository');
		$storage = $storageRepository->findByUid($this->settings['storage']);
		if($file['size'] > 0 AND $file['error'] == 0) {
		    $storedFile = $storage->addUploadedFile($file, NULL, NULL, 'changeName');
		    $fileRepository =  \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
		    $fileRepository->add($storedFile);
		    return $storedFile;
		}
		return;
	}

}
?>

