<?php
namespace Webfox\MediaFrontend\ViewHelpers\Format;

/***************************************************************
*  Copyright notice
*
*  (c) 2013 Dirk Wenzel <wenzel@webfox01.de>, Agentur Webfox
*  Michael Kasten <kasten@webfox01.de>, Agentur Webfox
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
 * Formats a given value as file size.
 *
 * The ViewHelper will determine the appropriate unit if only a value is given. A distinct unit can be forced by setting
 * the unit argument.
 *
 * @category    ViewHelpers
 * @package     media_frontend
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author      Dirk Wenzel <wenzel@webfox01.de>
 */
class FileSizeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	const FACTOR_K = 1024;
	const FACTOR_M = 1048576;
	const FACTOR_G = 1073741824;
	const FACTOR_T = 1099511627776;

	/**
	 * Initialize arguments
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('value', 'integer', 'Value (integer), Required argument', TRUE);
		$this->registerArgument('unit', 'string', 'Force a unit. Optional argument. Allowed: KB, MB, GB, TB, PB, EB, ZB');
	}

	/**
	 * Returns value formated as file size
	 *
	 * @return \Webfox\MediaFrontend\Domain\Model\Asset
	 */
	public function render() {
		
	    return $asset;
	}

}

?>

