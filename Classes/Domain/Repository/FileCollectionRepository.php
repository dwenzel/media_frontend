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
class FileCollectionRepository extends \TYPO3\CMS\Core\Resource\FileCollectionRepository {
	/**
	 * Create domain object
	 * We overwrite parent's method because the types (static, folder) are hard coded there.
	 *
	 * @param array $record An array containing record data from DB.
	 * @return \TYPO3\CMS\Core\Resource\Collection|\Webfox\MediaFrontend\Domain\Model\FileCollection
	 */
	protected function createDomainObject(array $record) {
		$domainObject = NULL;
		if ($record['type'] == 'feStatic') {
			$domainObject = \Webfox\MediaFrontend\Domain\Model\FileCollection::create($record);
		} else {
			$domainObject = parent::createDomainObject($record);
		}
		return $domainObject;
	}

	/**
	 * Finds an object matching the given identifier.
	 *
	 * @todo replace core exeptions with own
 	 * @param int $uid The identifier of the  object to find
 	 * @throws \RuntimeException
	 * @throws \InvalidArgumentException						 	 
	 * @return object The matching object
 	 */
	public function findByUid($uid) {
	    if (!\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($uid)) {
		throw new \InvalidArgumentException('uid has to be integer.', 1316779798);
	    }
	    $row = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow('*', $this->table, 'uid=' . intval($uid) . ' AND deleted=0 AND hidden=0');
	    if (empty($row) || !is_array($row)) {
		return NULL;
		//throw new \RuntimeException('Could not find row with uid "' . $uid . '" in table ' . $this->table, 1314354065);
	    }
	    return $this->createDomainObject($row);
	}

}
?>

