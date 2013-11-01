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
class FileCollectionController extends AbstractController {

	/**
	 * fileCollectionRepository
	 *
	 * @var \Webfox\MediaFrontend\Domain\Repository\FileCollectionRepository
	 * @inject
	 */
	protected $fileCollectionRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$status = $this->settings['fileCollections']['status']['public'];
		if($status) {
			$fileCollections = $this->fileCollectionRepository->findByStatus($status);
		} else {
			$fileCollections = $this->fileCollectionRepository->findAll();
		}
		$this->view->assign('fileCollections', $fileCollections);
	}

	/**
	 * List File Collections of current Frontend user
	 *
	 * @return void
	 */
	public function listFeUserAction() {
		if($this->frontendUser) {
			// show only first collection if configured
			if($this->settings['listFeUser']['firstOnly']){
				$fileCollections= array(
					'fileCollection' => $this->fileCollectionRepository->findOneByFrontendUser($this->frontendUser),
				);
				if($this->settings['listFeUser']['redirectFirst']) {
					if ($fileCollections['fileCollection']) {
						//$this->forward('show', NULL, NULL, $fileCollections);
						$this->forward('edit', NULL, NULL, $fileCollections);
					} else {
						// redirect to create if no file collection found
						$this->forward('new');
					}
				}
			} else {		
				// find all collections of current user and show them
				$fileCollections = $this->fileCollectionRepository->findByFrontendUser($this->frontendUser);
			}
				$this->view->assign('fileCollections', $fileCollections);
		} else {
			// no frontend user found: display error message
			$this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_mediafrontend_controller_filecollection.message_log_in_to_see_collections', 'media_frontend'));
		}
	}


	/**
	 * action show
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $newAsset
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $selectedAsset
	 * @return void
	 * @dontvalidate $newAsset
	 */
	public function showAction(\Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection, \Webfox\MediaFrontend\Domain\Model\Asset $newAsset = NULL, \Webfox\MediaFrontend\Domain\Model\Asset $selectedAsset = NULL) {
		if ($selectedAsset == NULL) {
			if($this->settings['detail']['selectRandomAsset']) {
				// select random asset from file collection
			} else {
				foreach($fileCollection->getAssets() as $asset) {
					if($asset->getStatus() ==
									$this->settings['assets']['status']['public']) {
						$selectedAsset = $asset;
						break;
					}
				}
			}
		}
		$this->view->assign('requestArguments', $this->requestArguments);
		$this->view->assign('frontendUser', $this->frontendUser);
		$this->view->assign('fileCollection', $fileCollection);
		$this->view->assign('newAsset', $newAsset);
		$this->view->assign('selectedAsset', $selectedAsset);
	}

	/**
	 * action new
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\FileCollection $newFileCollection
	 * @dontvalidate $newFileCollection
	 * @return void
	 */
	public function newAction(\Webfox\MediaFrontend\Domain\Model\FileCollection $newFileCollection = NULL) {
		$this->view->assign('newFileCollection', $newFileCollection);
	}

	/**
	 * action create
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\FileCollection $newFileCollection
	 * @return void
	 */
	public function createAction(\Webfox\MediaFrontend\Domain\Model\FileCollection $newFileCollection) {
	    if ($this->frontendUser) {
		$newFileCollection->setFrontendUser($this->frontendUser);
	    }
	    if (is_array($newFileCollection->getImage())) {
			$storedFile = $this->uploadFile($newFileCollection->getImage());
		}
	    if ($storedFile) {
			$newFileCollection->setImage($storedFile);
			$this->fileCollectionRepository->add($newFileCollection);
			$this->persistenceManager->persistAll();
			$this->fileCollectionRepository->createFileReferences($newFileCollection, $storedFile);
	    } else {
			$newFileCollection->setImage(NULL);
			$this->fileCollectionRepository->add($newFileCollection);
	    }
		$this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_mediafrontend_controller_filecollection.message_new_collection_created', 'media_frontend'));
	    $this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $selectedAsset
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $newAsset
	 * @return void
	 */
	public function editAction(\Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection, \Webfox\MediaFrontend\Domain\Model\Asset $newAsset = NULL,  \Webfox\MediaFrontend\Domain\Model\Asset $selectedAsset = NULL) {
	    if ($selectedAsset == NULL) {
		if($this->settings['detail']['selectRandomAsset']) {
		    // select random asset from file collection
		} else {
		    foreach($fileCollection->getAssets() as $asset) {
			if($asset->getFile()) {
			    $selectedAsset = $asset;
			    break;
			}
		    }
		}
	    }
	    $this->view->assign('frontendUser', $this->frontendUser);
	    $this->view->assign('selectedAsset', $selectedAsset);
	    $this->view->assign('fileCollection', $fileCollection);
	    $this->view->assign('newAsset', $newAsset);
	}

	/**
	 * action update
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection
	 */
	public function updateAction(\Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection) {
	    if (is_array($fileCollection->getImage())) {
			$storedFile = $this->uploadFile($fileCollection->getImage());
		}
	    if ($storedFile) {
		$fileCollection->setImage($storedFile);
	    }
	    $this->fileCollectionRepository->update($fileCollection);
		$this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_mediafrontend_controller_filecollection.message_collection_updated', 'media_frontend'));
	    if($this->settings['listFeUser']['firstOnly'] AND $this->settings['listFeUser']['redirectFirst']) {
		$this->forward('edit', NULL, NULL, array('fileCollection'=>$fileCollection));
	    }	
	    $this->redirect('list');
	}

	/**
	 * action new asset
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $newAsset
	 * @dontvalidate $newAsset
	 * @return void
	 */
	public function newAssetAction(\Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection, \Webfox\MediaFrontend\Domain\Model\Asset $newAsset = NULL) {
		$this->view->assign('fileCollection', $fileCollection);
		$this->view->assign('newAsset', $newAsset);
	}
	
	/**
	 * action create asset
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $newAsset
	 * @return void
	 */
	public function createAssetAction(\Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection, \Webfox\MediaFrontend\Domain\Model\Asset $newAsset = NULL) {
	    if($newAsset) {
		if ($this->frontendUser) $newAsset->setFrontendUser($this->frontendUser);
		$errors = $this->validateFileUpload($newAsset->getFile());
		if (count($errors)) {
		    foreach($errors as $error) {
			$this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_mediafrontend_controller_filecollection.' . $error, 'media_frontend'));
			$this->redirect('newAsset', NULL, NULL, array('fileCollection' => $fileCollection));
		    }
		} else {
		    $storedFile = $this->uploadFile($newAsset->getFile());
		}
		if ($storedFile) {
		    $newAsset->setFile($storedFile);
		    $newAsset->setStatus($this->settings['assets']['status']['default']);
		    $newAsset->updateMetaData();
		    $this->assetRepository->add($newAsset);
		    $this->persistenceManager->persistAll();
		    $this->assetRepository->createFileReferences($newAsset, $storedFile);
		    $fileCollection->addAsset($newAsset);
		    $this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_mediafrontend_controller_filecollection.message_asset_added', 'media_frontend'));
		}
	    } else {
		$this->flashMessageContainer->add('unknown_error');
	    }
	    
	    $this->fileCollectionRepository->update($fileCollection);
	    $this->persistenceManager->persistAll();
	    $pageUid = ($this->settings['detailPid'])? $this->settings['detailPid'] : NULL;
	    if($this->settings['listFeUser']['firstOnly'] AND $this->settings['listFeUser']['redirectFirst']) {
		$this->redirect('edit', NULL, NULL, array('fileCollection'=>$fileCollection));
	    }
	    $this->redirect('show', NULL, NULL, array('fileCollection'=>$fileCollection), $pageUid);
	}

	/**
	 * action delete
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection
	 * @return void
	 */
	public function deleteAction(\Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection) {
		$this->fileCollectionRepository->remove($fileCollection);
		$this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_mediafrontend_controller_filecollection.message_filecollection_removed', 'media_frontend'));
		$this->redirect('list');
	}

	/**
	* Display the search form
	* 
	* @param \Webfox\MediaFrontend\Domain\Model\Dto\Search $search
	* return void
	*/
	public function searchFormAction(\Webfox\MediaFrontend\Domain\Model\Dto\Search
		    $search = NULL ) {
		if(is_null($search)) {
			$search =
			    $this->objectManager->get('Webfox\\MediaFrontend\\Domain\\Model\\Dto\\Search');
		}

		$this->view->assign('search', $search);
	}


	/**
	* Display the search result
	*
	* @param \Webfox\MediaFrontend\Domain\Model\Dto\Search $search 
	* @return void
	*/
	public function searchResultAction(\Webfox\MediaFrontend\Domain\Model\Dto\Search
		    $search = NULL) {
		//@todo create demand object from settings
		$demand =
		    $this->objectManager->get('Webfox\\MediaFrontend\\Domain\\Model\\Dto\\FileCollectionDemand');
		if(!is_null($search)) {
		    $search->setFields($this->settings['search']['fileCollections']['fields']);
		}
		$demand->setSearch($search);
		$this->view->assignMultiple(array(
			'fileCollections' => $this->fileCollectionRepository->findDemanded($demand),
			'search' => $search,
			'demand' => $demand,
		));
	}

	/**
	* validate file function
	* @param \array $file An array containing values of an upload file
	* return \array An array containing error messages
	*/
	protected function validateFileUpload($file) {
	    $errors = array();
	    if (is_array($file)) {
		if ($file['name'] == '') {
		    $errors[] = 'error_empty_filename';
		} elseif ($file['size'] == 0) {
		    $errors[] = 'error_file_size_zero';
		} elseif ($file['size'] > $this->settings['assets']['maxFileSize'] ) {
		    $errors[] = 'error_file_too_big';
		} elseif ($file['error'] != 0) {
		    $errors[] = 'errors_errors';
		} 	
	    } 
	    return $errors;
	}

}
?>
