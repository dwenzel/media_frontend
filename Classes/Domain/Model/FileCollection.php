<?php
namespace Webfox\MediaFrontend\Domain\Model;

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
class FileCollection extends \TYPO3\CMS\Core\Resource\Collection\StaticFileCollection {

	/**
	 * type
	 *
	 * @static string
	 */
	static protected $type = 'feStatic';

	/**
	 * Frontend User who owns this collection
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 * @lazy
	 */
	protected $frontendUser;

	/**
	 * Returns the frontendUser
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $frontendUser
	 */
	public function getFrontendUser() {
		return $this->frontendUser;
	}

	/**
	 * Sets the frontendUser
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function setFrontendUser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $frontendUser) {
		$this->frontendUser = $frontendUser;
	}

	/**
	 * Returns the file collection as an array
	 * Overwrites parent's method in order to add custom fields.
	 *
	 * @return array
	 */
	public function toArray() {
		$itemArray = array();
		foreach ($this->storage as $item) {
			$itemArray[] = $item;
		}
		return array(
			'uid' => $this -> getIdentifier(), 
			'title' => $this -> getTitle(), 
			//'description' => $this -> getDescription(), 
			//'table_name' => $this -> getItemTableName(),
			'frontend_user' => $this -> getFrontendUser(), 
			'items' => $itemArray
		);
	}

	/**
	 * Initializes Object from array.
	 * Overwrites parent's method in oder to add custom fields.
	 *
	 * @param array $array Array containing record data.
	 * @return void
	 */
	public function fromArray($array) {
		$this->uid = $array['uid'];
		$this->title = $array['title'];
		//$this->description = $array['description'];
		//$this->itemTableName = $array['table_name'];
		$this->frontendUser = $array['frontend_user'];
	}

}

?>
