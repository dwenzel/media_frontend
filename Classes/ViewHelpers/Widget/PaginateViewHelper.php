<?php
namespace Webfox\MediaFrontend\ViewHelpers\Widget;

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Georg Ringer <typo3@ringerge.org>
*  (c) 2013 Dirk Wenzel <wenzel@webfox01.de>
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
 * This ViewHelper renders a Pagination of objects.
 *
 * written by Georg Ringer and 
 * adapted for media_frontend by Dirk Wenzel
 * = Examples =
 *
 * <code title="required arguments">
 * <f:widget.paginate objects="{blogs}" as="paginatedBlogs">
 *   // use {paginatedBlogs} as you used {blogs} before, most certainly inside
 *   // a <f:for> loop.
 * </f:widget.paginate>
 * </code>
 *
 * @category ViewHelpers
 * @package media_frontend
 */
class PaginateViewHelper extends \TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetViewHelper {

	/**
	 * @var \Webfox\MediaFrontend\ViewHelpers\Widget\Controller\PaginateController
	 */
	protected $controller;

	/**
	 * Inject controller
	 *
	 * @param \Webfox\MediaFrontend\ViewHelpers\Widget\Controller\PaginateController $controller
	 * @return void
	 */
	public function injectController(\Webfox\MediaFrontend\ViewHelpers\Widget\Controller\PaginateController $controller) {
		$this->controller = $controller;
	}

	/**
	 * Initialize arguments
	 */
	public function initializeArguments() {
	    parent::initializeArguments();
	    $this->registerArgument('itemsPerPage', 'integer', 'Required', 'TRUE');
	    $this->registerArgument('insertAbove', 'boolean', 'Insert page browser above. Optional');
	}

	/**
	 * Override the default initialize functionality
	 * This function can be used to e.g. override the itemsPerPage by using
	 * $this->arguments['configuration']['itemsPerPage'] = 3;
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();
	}

	/**
	 * Render everything
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $objects
	 * @param string $as
	 * @param mixed $configuration
	 * @return string
	 */
	public function render(\TYPO3\CMS\Extbase\Persistence\QueryResultInterface $objects, $as, $configuration = array('itemsPerPage' => 10, 'insertAbove' => FALSE, 'insertBelow' => TRUE)) {
		return $this->initiateSubRequest();
	}
}

?>
