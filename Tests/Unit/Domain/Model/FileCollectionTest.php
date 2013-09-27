<?php

namespace Webfox\MediaFrontend\Tests;
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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Webfox\MediaFrontend\Domain\Model\FileCollection.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Frontend Media
 *
 * @author Dirk Wenzel <wenzel@webfox01.de>
 */
class FileCollectionTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Webfox\MediaFrontend\Domain\Model\FileCollection
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \Webfox\MediaFrontend\Domain\Model\FileCollection();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getStatusReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getStatus()
		);
	}

	/**
	 * @test
	 */
	public function setStatusForIntegerSetsStatus() { 
		$this->fixture->setStatus(12);

		$this->assertSame(
			12,
			$this->fixture->getStatus()
		);
	}
	
	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setImageForStringSetsImage() { 
		$this->fixture->setImage('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getImage()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getFrontendUserReturnsInitialValueForFrontendUser() { }

	/**
	 * @test
	 */
	public function setFrontendUserForFrontendUserSetsFrontendUser() { }
	
	/**
	 * @test
	 */
	public function getAssetsReturnsInitialValueForAsset() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getAssets()
		);
	}

	/**
	 * @test
	 */
	public function setAssetsForObjectStorageContainingAssetSetsAssets() { 
		$asset = new \Webfox\MediaFrontend\Domain\Model\Asset();
		$objectStorageHoldingExactlyOneAssets = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneAssets->attach($asset);
		$this->fixture->setAssets($objectStorageHoldingExactlyOneAssets);

		$this->assertSame(
			$objectStorageHoldingExactlyOneAssets,
			$this->fixture->getAssets()
		);
	}
	
	/**
	 * @test
	 */
	public function addAssetToObjectStorageHoldingAssets() {
		$asset = new \Webfox\MediaFrontend\Domain\Model\Asset();
		$objectStorageHoldingExactlyOneAsset = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneAsset->attach($asset);
		$this->fixture->addAsset($asset);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneAsset,
			$this->fixture->getAssets()
		);
	}

	/**
	 * @test
	 */
	public function removeAssetFromObjectStorageHoldingAssets() {
		$asset = new \Webfox\MediaFrontend\Domain\Model\Asset();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($asset);
		$localObjectStorage->detach($asset);
		$this->fixture->addAsset($asset);
		$this->fixture->removeAsset($asset);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getAssets()
		);
	}
	
}
?>