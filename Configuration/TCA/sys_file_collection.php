<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$tca = array(
	'ctrl' => array(
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,frontend_user,',
	),
	'palettes' => array (
		'1' => array('showitem' => 'hidden,
		    starttime,endtime,frontend_user'),
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
	),
);

return \TYPO3\CMS\Core\Utility\GeneralUtility::array_merge_recursive_overrule($GLOBALS['TCA']['sys_file_collection'], $tca);
?>
