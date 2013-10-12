<?php
namespace Webfox\MediaFrontend\Domain\Repository;

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
class AssetRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
	
	/**
 	* Create File References
 	* Manualy updating references for File Abstraction
 	* Layer.
 	* @param \Webfox\MediaFrontend\Domain\Model\Asset $asset
 	* @param \array $tempFile An array containing values for newly uploaded file
 	*/
    public function createFileReferences($asset, $tempFile){
	$newRefFields = array(
		'pid' => $asset->getPid(),
		'tablenames' => 'tx_mediafrontend_domain_model_asset',
		'uid_foreign' => $asset->getUid(),
		'uid_local' => $tempFile->getUid(),
		'table_local' => 'sys_file',
		'fieldname' => 'files',
		'crdate' => $GLOBALS['EXEC_TIME'],
		'tstamp' => $GLOBALS['EXEC_TIME']
	);

	$GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_file_reference', $newRefFields);
	//@todo validate new reference
	$asset->setFile(1);
	$this->persistenceManager->update($asset);
    }

	/**
	 * Update File Reference
	 *
	 * @param \TYPO3\CMS\Core\Resource\File $file
	 * @param \string $tableName
	 * @param \string $fieldName
	 * @param \integer $recordUid
	 */
	public function updateFileReference($file, $tableName, $fieldName,
					$recordUid) {
		$fileRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
		$fileObjects = $fileRepository->findByRelation($tableName, $fieldName,
						$recordUid);
		//$fileObjects = $fileRepository->findAll();
		// get Imageobject information
		$files = array();	
		foreach ($fileObjects as $key => $value) {
			$files[$key]['reference'] = $value->getReferenceProperties();
			$files[$key]['original'] = $value->getOriginalFile()->getProperties();
		}
	 	//\TYPO3\CMS\Core\Utility\DebugUtility::debug($files, 'updateFileReference:');
	}
}
?>

