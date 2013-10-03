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
class FileCollection extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var \string
	 */
	protected $title;

	/**
	 * status
	 *
	 * @var \integer
	 */
	protected $status;

	/**
	 * Image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $image;

	/**
	 * description
	 *
	 * @var \string
	 */
	protected $description;

	/**
	 * Frontend User who owns this collection
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 * @lazy
	 */
	protected $frontendUser;

	/**
	 * Assets
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Webfox\MediaFrontend\Domain\Model\Asset>
	 * @lazy
	 */
	protected $assets;

	/**
	 * __construct
	 *
	 * @return FileCollection
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->assets = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param \string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the status
	 *
	 * @return \integer $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Sets the status
	 *
	 * @param \integer $status
	 * @return void
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * Returns the image
	 *
	 * @return \string $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param \string $image
	 * @return void
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * Returns the description
	 *
	 * @return \string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param \string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

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
	 * Adds a Asset
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $asset
	 * @return void
	 */
	public function addAsset(\Webfox\MediaFrontend\Domain\Model\Asset $asset) {
		$this->assets->attach($asset);
	}

	/**
	 * Removes a Asset
	 *
	 * @param \Webfox\MediaFrontend\Domain\Model\Asset $assetToRemove The Asset to be removed
	 * @return void
	 */
	public function removeAsset(\Webfox\MediaFrontend\Domain\Model\Asset $assetToRemove) {
		$this->assets->detach($assetToRemove);
	}

	/**
	 * Returns the assets
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Webfox\MediaFrontend\Domain\Model\Asset> $assets
	 */
	public function getAssets() {
		return $this->assets;
	}

	/**
	 * Sets the assets
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Webfox\MediaFrontend\Domain\Model\Asset> $assets
	 * @return void
	 */
	public function setAssets(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $assets) {
		$this->assets = $assets;
	}

}
?>
