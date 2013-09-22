<?php
if (!defined('TYPO3_MODE')) die ('Access denied.');

$tca = array(
	'ctrl' => array(
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'hideTable' => FALSE,
		'tstamp' => 'tstamp',
		//'default_sortby' => 'ORDER BY is_variant ASC, uid DESC',
		'crdate' => 'crdate',
		'searchFields' => 'uid,title,extension,name',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime'
		),
	),
	'types' => array(
		TYPO3\CMS\Core\Resource\File::FILETYPE_UNKNOWN => array('showitem' => '
								fileinfo, sys_language_uid,title, description, caption, download_name,

								--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:visibility;10;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:publish-dates;20;; ,

									--palette--;;50;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:metrics;70;; ,
	'),

		TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array('showitem' => '
								fileinfo, sys_language_uid, title, description, caption, download_name,

								--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:visibility;10;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:publish-dates;20;; ,
									creator,--palette--;;30;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:geo-location;40;; ,
									--palette--;;50;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:temporal-info;60;; ,

								--div--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:variants, variants,'),

		TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array('showitem' => '
								fileinfo, sys_language_uid, title, description, caption, download_name,

								--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:visibility;10;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:publish-dates;20;; ,
									fe_groups, be_groups,

								--div--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:metadata,
									creator,--palette--;;30;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:geo-location;40;; ,
									--palette--;;50;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:temporal-info;60;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:metrics;70;; ,

								--div--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:variants, variants,'),

		TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array('showitem' => '

								fileinfo, sys_language_uid, title, description, caption, download_name,

								--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:visibility;10;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:publish-dates;20;; ,
									fe_groups, be_groups,

								--div--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:metadata,
									duration,
									creator,--palette--;;30;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:geo-location;40;; ,
									--palette--;;50;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:temporal-info;60;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:metrics;70;; ,

								--div--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:variants, variants,'),

		TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array('showitem' => '
								fileinfo, sys_language_uid, title, description, caption, download_name,

								--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:visibility;10;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:publish-dates;20;; ,
									fe_groups, be_groups,

								--div--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:metadata,
									duration,
									creator,--palette--;;30;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:geo-location;40;; ,
									--palette--;;50;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:temporal-info;60;; ,

								--div--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:variants, variants,'),

		TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array('showitem' => '
								fileinfo, sys_language_uid, title, description, caption, download_name,

								--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:visibility;10;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:publish-dates;20;; ,
									fe_groups, be_groups,

								--div--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:metadata,
									creator,--palette--;;30;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:geo-location;40;; ,
									--palette--;;50;; ,
									--palette--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:temporal-info;60;; ,

								--div--;LLL:EXT:media_frontend/Resources/Private/Language/locallang.xlf:variants, variants,'),
	),
	'palettes' => array(
		'10' => array('showitem' => 'hidden, sorting', 'canNotCollapse' => '1'),
		'20' => array('showitem' => 'starttime, endtime,', 'canNotCollapse' => '1'),
		'70' => array('showitem' => 'width, height, unit, color_space', 'canNotCollapse' => '1'),
	),
	'columns' => array(
		'sys_language_uid' => Array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => Array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => Array(
					Array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					Array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => Array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => Array(
				'type' => 'select',
				'items' => Array(
					Array('', 0),
				),
				'foreign_table' => 'sys_file',
				'foreign_table_where' => 'AND sys_file.pid=###REC_FIELD_pid### AND sys_file.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => Array(
			'config' => array(
				'type' => 'passthrough'
			)
		),
		'starttime' => Array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.starttime',
			'config' => Array(
				'type' => 'input',
				'size' => '10',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
				'default' => '0'
			)
		),
		'endtime' => Array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.endtime',
			'config' => Array(
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
				'default' => '0',
				'range' => Array(
					'upper' => mktime(0, 0, 0, 12, 31, 2020),
					'lower' => mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'))
				)
			)
		),
		'hidden' => Array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
			'config' => Array(
				'type' => 'check',
				'default' => '1'
			)
		),
		'title' => array(
			'exclude' => 0,
			'l10n_mode' => 'prefixLangTitle',
			'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_file.title',
			'config' => array(
				'type' => 'input',
				'size' => 255,
				'eval' => 'trim'
			)
		),
		'description' => array(
			'exclude' => 0,
			'l10n_mode' => 'prefixLangTitle',
			'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_file.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 5,
				'eval' => 'trim'
			),
		),
		'extension' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:sys_file.extension',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'creation_date' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'l10n_display' => 'defaultAsReadonly',
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:sys_file.creation_date',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'modification_date' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'l10n_display' => 'defaultAsReadonly',
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:sys_file.modification_date',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'download_name' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'l10n_display' => 'defaultAsReadonly',
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:sys_file.download_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'caption' => array(
			'exclude' => 1,
			'l10n_mode' => 'prefixLangTitle',
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:sys_file.caption',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		/*
		 * METRICS ###########################################
		 */
		'duration' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'l10n_display' => 'defaultAsReadonly',
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:sys_file.duration',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'max' => '20',
				'eval' => 'int',
				'default' => '0'
			)
		),
		'width' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'l10n_display' => 'defaultAsReadonly',
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:sys_file.width',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'max' => '20',
				'eval' => 'int',
				'default' => '0',
				'readOnly' => TRUE,
			),
		),
		'height' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'l10n_display' => 'defaultAsReadonly',
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:sys_file.height',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'max' => '20',
				'eval' => 'int',
				'default' => '0',
				'readOnly' => TRUE,
			),
		),
	),
);

return \TYPO3\CMS\Core\Utility\GeneralUtility::array_merge_recursive_overrule($GLOBALS['TCA']['sys_file'], $tca);
?>
