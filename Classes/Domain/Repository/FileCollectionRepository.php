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
class FileCollectionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
 	* Create File References
 	* Manualy updating references for File Abstraction
 	* Layer.
 	* @param \Webfox\MediaFrontend\Domain\Model\FileCollection $fileCollection
 	* @param \array $tempFile An array containing values for newly uploaded file
 	*/
	public function createFileReferences($fileCollection, $tempFile){
		$newRefFields = array(
			'pid' => $fileCollection->getPid(),
			'tablenames' => 'tx_mediafrontend_domain_model_filecollection',
			'uid_foreign' => $fileCollection->getUid(),
			'uid_local' => $tempFile->getUid(),
			'table_local' => 'sys_file',
			'fieldname' => 'image',
			'crdate' => $GLOBALS['EXEC_TIME'],
			'tstamp' => $GLOBALS['EXEC_TIME']
		);
		$GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_file_reference', $newRefFields);
		//@todo validate new reference
		$fileCollection->setImage(1);
		$this->persistenceManager->update($fileCollection);
	}
}
?>
