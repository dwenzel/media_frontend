<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$tca = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:sys_file_collection.type.Tx_MediaFrontend_FileCollection',
		'searchFields' => 'title,frontend_user,',
		'typeicon_classes' => array(
			'default' => 'apps-filetree-folder-media',
			'static' => 'apps-clipboard-images',
			'folder' => 'apps-filetree-folder-media',
			'feStatic' => 'apps-clipboard-images',
		),
		
	),
	'palettes' => array (
		'1' => array('showitem' => 'hidden,
		    starttime,endtime'),
	),
	'columns' => array (
		'frontend_user' => Array(
			'exclude' => 1,
			'label' => 'Frontend User',
			'config' => Array(
			    'type' => 'select',
			    'foreign_table' => 'fe_users',
			    'min_items' => 0,
			    'max_items' => 1,
			    'default' => NULL,
			    'items' => array(
			    	array('', NULL),
			     ),
			),
		),
		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_file_collection.type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('Static selection of files', 'static'),
					array('Folder from Storage', 'folder'),
					array('Media Frontend: Static selection of files','feStatic'),
				)
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, title;;1, type, files'),
		'static' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, title;;1, type, files'),
		'folder' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, title;;1, type, storage, folder'),
		'feStatic' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, title;;1, type, frontend_user, files')
	),
	
);

return \TYPO3\CMS\Core\Utility\GeneralUtility::array_merge_recursive_overrule($GLOBALS['TCA']['sys_file_collection'], $tca);
?>
