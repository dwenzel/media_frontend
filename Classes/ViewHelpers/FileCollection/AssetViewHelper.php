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
 * View helper which allows accesing certain assets of a file collection
 *
 * @category    ViewHelpers
 * @package     media_frontend
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author      Dirk Wenzel <wenzel@webfox01.de>
 */
class AssetViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Initialize arguments
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('fileCollection', '\Webfox\MediaFrontend\Domain\Model\FileCollection', 'A File Collection. Required argument', TRUE);
		$this->registerArgument('random', 'boolean', 'Get a random asset. Optional argument.');
		$this->registerArgument('type', 'string', 'Select only assets of a given type. Optional argument. Allowed: image, video, audio, text, application.');
		$this->registerArgument('status', 'integer', 'Select only assets with a given status. Optional argument.');
		$this->registerArgument('first', 'boolean', 'Select the first matching asset. Optional argument. If a type is given only the first of this type will be returned');
	}

	/**
	 * Returns an Asset
	 *
	 * @return \Webfox\MediaFrontend\Domain\Model\Asset
	 */
	public function render() {
		$fileCollection = $this->arguments['fileCollection'];
		$asset = NULL;
		$type = $this->arguments['type'];
		$random = $this->arguments['random'];
		$status = $this->arguments['status'];

		//var_dump('type: ' . $type . ' random: ' . $random . ' status: ' . $status.  '<br />');
		if ($random OR $type) {
			$assetsArray = $fileCollection->getAssets()->toArray();
			$assetCount = count($assetsArray);
			//var_dump('assetCount: ' . $assetCount);
			if (!$assetCount) return NULL;
		}

		if($type) {
			$requestedType = -1;
			switch ($type) {
				case 'unknown':
					$requestedType = 0;
					break;
				case 'text':
					$requestedType = 1;
					break;
				case 'image':
					$requestedType = 2;
					break;
				case 'audio':
					$requestedType = 3;
					break;
				case 'video':
					$requestedType = 4;
					break;
				case 'application':
					$requestedType = 5;
					break;
			}
			
			if ($requestedType >= 0 AND $assetCount) {
				$tempArray = array();
				foreach ($assetsArray as $tmpAsset) {
					if ($tmpAsset->getFile() AND
									$tmpAsset->getFile()->getOriginalResource()->getType()
									== $requestedType) {
						$tempArray[] = $tmpAsset;
					}
				}
				$assetsArray = $tempArray;
				$assetCount = count($assetsArray);
			}
		}

		if ($status) {
				$tempArray = array();
				foreach ($assetsArray as $tmpAsset) {
					if ($tmpAsset->getStatus() == $status) {
						//echo('asset: ' . $tmpAsset->getUid() . ' Status: '. $tmpAsset->getStatus(). ' status: ' . $status);
						$tempArray[] = $tmpAsset;
					}
				}
				$assetsArray = $tempArray;
				$assetCount = count($assetsArray);
		}

		if ($assetCount == 1) return $assetsArray[0];
		
		if($this->arguments['random'] AND $assetCount > 1) {
		    $rand = mt_rand(0, $assetCount - 1);
		    $asset = $assetsArray[$rand];
		}
		if ($this->arguments['first'] AND $assetCount) {
		    $asset =$assetsArray[0];
		}
	    return $asset;
	}

}

?>

