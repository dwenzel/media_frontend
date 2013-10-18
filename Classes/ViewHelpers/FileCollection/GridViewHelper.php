<?php
namespace Webfox\MediaFrontend\ViewHelpers\FileCollection;

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
 * View helper which allows rendering a grid
 *
 * @category    ViewHelpers
 * @package     media_frontend
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author      Dirk Wenzel <wenzel@webfox01.de>
 */
class GridViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Initialize arguments
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('items', 'TYPO3\CMS\Extbase\Persistence\Generic\QueryResult', 'Items to populate the grid with. Required argument', TRUE);
		$this->registerArgument('rows', 'integer', 'Row count of grid. Required argument.', TRUE);
		$this->registerArgument('columns', 'integer', 'Column count of grid. Required argument.', TRUE);
		$this->registerArgument('fillUp', 'boolean', 'Fill the grid if less items are given then necessary to fill the matrix. Given items will be repeated. Optional argument.');
		$this->registerArgument('shuffle', 'boolean', 'Shuffle grid items. Optional argument.');
	}

	/**
	 * Returns an Asset
	 *
	 * @return \array
	 */
	public function render() {
		$items = $this->arguments['items']->toArray();
		$itemsCount = count($items);
		$rows = $this->arguments['rows'];
		$columns = $this->arguments['columns'];
		$gridItemsCount = $rows * $columns;
		
		// fill up items array
		if($itemsCount AND ($itemsCount < $gridItemsCount) AND $this->arguments['fillUp']) {
			$tempArray = array();
			$count = 0;
			$repeat = floor($gridItemsCount / $itemsCount);
			$remainder = $gridItemsCount % $itemsCount;
			//echo('repeat: ' . $repeat . ' remainder: ' . $remainder . '<br />');
			while($count < $repeat) {
			    $tempArray = array_merge($tempArray, $items);
				//echo('count: ' . $count . ' tempArryCount: ' . count($tempArray) );
			    $count++;
			}
			if($remainder) {
			    $i = 0;
			    while($i < $remainder) {
						$tempArray[] = $items[$i];
						$i++;
			    }
			}
			$items = $tempArray;
		}
	
		// build empty grid
		$grid = $this->buildGrid($rows, $columns);

		// fill grid with content of items array and shuffle if required
		$grid = $this->fillGrid($grid, $items, $this->arguments['shuffle']);

		return $grid;
	}

	/** Build an empty grid with given dimensions
	 *
	 * @var \integer $rows number of rows in grid
	 * @var \integer $columns number of columns in grid
	 * @return \array A two dimensional array
	 */
	private function buildGrid($rows, $columns) {
			$gridRows = array();
			$rowCount = 0;
			$iteration = 0;
			while($rowCount < $rows) {
					$columnCount = 0;
					$gridColumns = array();
					while($columnCount < $columns) {
							$gridColumns[]= NULL;
							$columnCount++;
							$iteration++;
					}
					$gridRows[] = $gridColumns;
					$rowCount++;
			}
			return $gridRows;
	}

	/** Fill Grid
	 *
	 * Fills a two dimensional array with the items 
	 * of a one dimensional array. Optionally the items can be shuffled. I.e. 
	 * they are placed at a random position in the grid.
	 *
	 * @var \array $grid A two dimensional array with no content (i.e. NULL)
	 * @var \array $items a one dimensional array
	 * @var \boolean $shuffle
	 * @return \array A two dimensional grid
	 */
	private function fillGrid($grid, $items, $shuffle = FALSE) {
		$rowCount = count($grid);
		$columnCount = count($grid[0]);
		$itemsCount = count($items);
		$gridItemsCount = ($rowCount * $columnCount);
		$limit = ($itemsCount <= $gridItemsCount)? $itemsCount : $gridItemsCount;
		$count = 0;

		if($shuffle) {
			//scatter items
			while($count < $limit) {
				$rndRow = mt_rand(0, $rowCount-1);
				$rndColumn = mt_rand(0, $columnCount-1);
				if(! $grid[$rndRow][$rndColumn] AND $count < $limit) {
						$grid[$rndRow][$rndColumn] = $items[$count];
						$count++;
				}		
			}
		}else {
			$currRow = 0;
			$currColumn = 0;
			foreach ($grid as $row) {
				foreach($row as $column) {
					if($count < $limit) {
						$grid[$currRow][$currColumn] = $items[$count];
						$currColumn++;
						$count++;
					} else {
						break;
					}
				}
				$currColumn = 0;
				$currRow++;
			}
		}		
		return $grid;
	}

}

?>

