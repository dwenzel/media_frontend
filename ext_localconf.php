<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Webfox.' . $_EXTKEY,
	'Media',
	array(
		'Asset' => 'list, show, new, create, edit, update',
		'FileCollection' => 'list, show, new, create, edit, update, delete, newAsset, createAsset, listFeUser, searchForm, searchResult',
		
	),
	// non-cacheable actions
	array(
		'Asset' => 'create, update, delete, ',
		'FileCollection' => 'create, update, delete, newAsset,
		createAsset, searchForm, searchResult',
		
	)
);

?>
