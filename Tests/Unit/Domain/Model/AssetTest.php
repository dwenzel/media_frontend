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
 * Test case for class \Webfox\MediaFrontend\Domain\Model\Asset.
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
class AssetTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Webfox\MediaFrontend\Domain\Model\Asset
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \Webfox\MediaFrontend\Domain\Model\Asset();
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
	public function getStatusReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setStatusForStringSetsStatus() { 
		$this->fixture->setStatus('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getStatus()
		);
	}
	
	/**
	 * @test
	 */
	public function getFileReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setFileForStringSetsFile() { 
		$this->fixture->setFile('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getFile()
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
	public function getExtensionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setExtensionForStringSetsExtension() { 
		$this->fixture->setExtension('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getExtension()
		);
	}
	
	/**
	 * @test
	 */
	public function getCaptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCaptionForStringSetsCaption() { 
		$this->fixture->setCaption('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCaption()
		);
	}
	
	/**
	 * @test
	 */
	public function getWidthReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setWidthForStringSetsWidth() { 
		$this->fixture->setWidth('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getWidth()
		);
	}
	
	/**
	 * @test
	 */
	public function getHeightReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setHeightForStringSetsHeight() { 
		$this->fixture->setHeight('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getHeight()
		);
	}
	
	/**
	 * @test
	 */
	public function getDurationReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDurationForStringSetsDuration() { 
		$this->fixture->setDuration('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDuration()
		);
	}
	
	/**
	 * @test
	 */
	public function getDownloadNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDownloadNameForStringSetsDownloadName() { 
		$this->fixture->setDownloadName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDownloadName()
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
	
}
?>