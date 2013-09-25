<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Webfox.' . $_EXTKEY,
	'Collection',
	array(
	//	'Asset' => 'list, show, new, create, edit, update, delete, upload, download',
		'FileCollection' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
	//	'Asset' => 'create, update, delete, ',
		'FileCollection' => 'create, update, delete',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Webfox.' . $_EXTKEY,
	'Asset',
	array(
		'Asset' => 'list, show, new, create, edit, update, delete, upload, download',
		'FileCollection' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Asset' => 'create, update, delete, ',
		'FileCollection' => 'create, update, delete',
		
	)
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>
