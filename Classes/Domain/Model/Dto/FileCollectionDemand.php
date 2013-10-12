<?php
namespace Webfox\MediaFrontend\Domain\Model\Dto;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 <wenzel@webfox01.de>
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
 * File Collection Demand object which holds all information to get the correct
 * File Collection recored.
 *
 * @package media_frontend
 */
class FileCollectionDemand
	extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity implements DemandInterface {

	/**
	 * @var /string
	 */
	protected $categories;

	/**
	 * @var /string
	 */
	protected $categoryConjunction;

	/**
	 * @var boolean
	 */
	protected $includeSubCategories = FALSE;

	/**
	 * @var /string
	 */
	protected $archiveRestriction;

	/**
	 * @var /string
	 */
	protected $timeRestriction = NULL;

	/**
	 * @var /string
	 */
	protected $timeRestrictionHigh = NULL;

	protected $searchFields;
	protected $search;

	protected $order;

	/**
	 * @var /string
	 */
	protected $orderByAllowed;

	protected $storagePage;

	/**
	 * @var integer
	 */
	protected $limit;

	/**
	 * @var integer
	 */
	protected $offset;

	/**
	 * Set archive settings
	 *
	 * @param /string $archiveRestriction archive setting
	 * @return void
	 */
	public function setArchiveRestriction($archiveRestriction) {
		$this->archiveRestriction = $archiveRestriction;
	}

	/**
	 * Get archive setting
	 *
	 * @return /string
	 */
	public function getArchiveRestriction() {
		return $this->archiveRestriction;
	}

	/**
	 * List of allowed categories
	 *
	 * @param /string $categories categories
	 * @return void
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
	}

	/**
	 * Get allowed categories
	 *
	 * @return /string
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Set category mode
	 *
	 * @param /string $categoryConjunction
	 * @return void
	 */
	public function setCategoryConjunction($categoryConjunction) {
		$this->categoryConjunction = $categoryConjunction;
	}

	/**
	 * Get category mode
	 *
	 * @return /string
	 */
	public function getCategoryConjunction() {
		return $this->categoryConjunction;
	}

	/**
	 * Get include sub categories
	 * @return boolean
	 */
	public function getIncludeSubCategories() {
		return (boolean)$this->includeSubCategories;
	}

	/**
	 * @param boolean $includeSubCategories
	 * @return void
	 */
	public function setIncludeSubCategories($includeSubCategories) {
		$this->includeSubCategories = $includeSubCategories;
	}


	/**
	 * Set time limit low, either integer or /string
	 *
	 * @param mixed $timeRestriction
	 * @return void
	 */
	public function setTimeRestriction($timeRestriction) {
		$this->timeRestriction = $timeRestriction;
	}

	/**
	 * Get time limit low
	 *
	 * @return mixed
	 */
	public function getTimeRestriction() {
		return $this->timeRestriction;
	}

	/**
	 * Get time limit high
	 *
	 * @return mixed
	 */
	public function getTimeRestrictionHigh() {
		return $this->timeRestrictionHigh;
	}

	/**
	 * Set time limit high
	 *
	 * @param mixed $timeRestrictionHigh
	 * @return void
	 */
	public function setTimeRestrictionHigh($timeRestrictionHigh) {
		$this->timeRestrictionHigh = $timeRestrictionHigh;
	}


	/**
	 * Set order
	 *
	 * @param /string $order order
	 * @return void
	 */
	public function setOrder($order) {
		$this->order = $order;
	}

	/**
	 * Get order
	 *
	 * @return /string
	 */
	public function getOrder() {
		return $this->order;
	}

	/**
	 * Set order allowed
	 *
	 * @param /string $orderByAllowed allowed fields for ordering
	 * @return void
	 */
	public function setOrderByAllowed($orderByAllowed) {
		$this->orderByAllowed = $orderByAllowed;
	}

	/**
	 * Get allowed order fields
	 *
	 * @return /string
	 */
	public function getOrderByAllowed() {
		return $this->orderByAllowed;
	}

	/**
	 * Set search fields
	 *
	 * @param /string $searchFields search fields
	 * @return void
	 */
	public function setSearchFields($searchFields) {
		$this->searchFields = $searchFields;
	}

	/**
	 * Get search fields
	 *
	 * @return /string
	 */
	public function getSearchFields() {
		return $this->searchFields;
	}

	/**
	 * Set list of storage pages
	 *
	 * @param /string $storagePage storage page list
	 * @return void
	 */
	public function setStoragePage($storagePage) {
		$this->storagePage = $storagePage;
	}

	/**
	 * Get list of storage pages
	 *
	 * @return /string
	 */
	public function getStoragePage() {
		return $this->storagePage;
	}

	/**
	 * Set limit
	 *
	 * @param integer $limit limit
	 * @return void
	 */
	public function setLimit($limit) {
		$this->limit = (int)$limit;
	}

	/**
	 * Get limit
	 *
	 * @return integer
	 */
	public function getLimit() {
		return $this->limit;
	}

	/**
	 * Set offset
	 *
	 * @param integer $offset offset
	 * @return void
	 */
	public function setOffset($offset) {
		$this->offset = (int)$offset;
	}

	/**
	 * Get offset
	 *
	 * @return integer
	 */
	public function getOffset() {
		return $this->offset;
	}

	/**
	 * Get search object
	 *
	 * @return Webfox\MediaFrontend\Domain\Model\Dto\Search
	 */
	public function getSearch() {
		return $this->search;
	}

	/**
	 * Set search object
	 *
	 * @param Webfox\MediaFrontend\Domain\Model\Dto\Search $search search object
	 * @return void
	 */
	public function setSearch($search) {
		$this->search = $search;
	}

}

?>
