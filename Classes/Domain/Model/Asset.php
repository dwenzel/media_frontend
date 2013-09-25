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
class Asset extends \TYPO3\CMS\Core\Resource\File {

	/**
	 * objectManager
	 *
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager;

	/**
	 * title
	 *
	 * @var \string
	 */
	protected $title;

	/**
	 * description
	 *
	 * @var \string
	 */
	protected $description;

	/**
	 * extension
	 *
	 * @var \string
	 */
	protected $extension;

	/**
	 * caption
	 *
	 * @var \string
	 */
	protected $caption;

	/**
	 * width
	 *
	 * @var \string
	 */
	protected $width;

	/**
	 * height
	 *
	 * @var \string
	 */
	protected $height;

	/**
	 * duration
	 *
	 * @var \string
	 */
	protected $duration;

	/**
	 * downloadName
	 *
	 * @var \string
	 */
	protected $downloadName;

	/**
	 * Frontend User who owns this asset
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 * @lazy
	 */
	protected $frontendUser;

	/**
	 * Constructor
	 *
	 * @param array $assetData
	 * @param \TYPO3\CMS\Core\Resource\ResourceStorage $storage
	 * @return \TYPO3\CMS\Media\Domain\Model\Asset
	 */
	public function __construct(array $assetData = array(), $storage = NULL) {
			    parent::__construct($assetData, $storage);
		
			    // We are not in Extbase Context
			    $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
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
	 * Returns the extension
	 *
	 * @return \string $extension
	 */
	public function getExtension() {
		return $this->extension;
	}

	/**
	 * Sets the extension
	 *
	 * @param \string $extension
	 * @return void
	 */
	public function setExtension($extension) {
		$this->extension = $extension;
	}

	/**
	 * Returns the caption
	 *
	 * @return \string $caption
	 */
	public function getCaption() {
		return $this->caption;
	}

	/**
	 * Sets the caption
	 *
	 * @param \string $caption
	 * @return void
	 */
	public function setCaption($caption) {
		$this->caption = $caption;
	}

	/**
	 * Returns the width
	 *
	 * @return \string $width
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * Sets the width
	 *
	 * @param \string $width
	 * @return void
	 */
	public function setWidth($width) {
		$this->width = $width;
	}

	/**
	 * Returns the height
	 *
	 * @return \string $height
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * Sets the height
	 *
	 * @param \string $height
	 * @return void
	 */
	public function setHeight($height) {
		$this->height = $height;
	}

	/**
	 * Returns the duration
	 *
	 * @return \string $duration
	 */
	public function getDuration() {
		return $this->duration;
	}

	/**
	 * Sets the duration
	 *
	 * @param \string $duration
	 * @return void
	 */
	public function setDuration($duration) {
		$this->duration = $duration;
	}

	/**
	 * Returns the downloadName
	 *
	 * @return \string $downloadName
	 */
	public function getDownloadName() {
		return $this->downloadName;
	}

	/**
	 * Sets the downloadName
	 *
	 * @param \string $downloadName
	 * @return void
	 */
	public function setDownloadName($downloadName) {
		$this->downloadName = $downloadName;
	}

}

?>