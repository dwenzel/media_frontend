<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_mediafrontend_domain_model_asset'] = array(
	'ctrl' => $TCA['tx_mediafrontend_domain_model_asset']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, status, file, description, extension, caption, width, height, duration, download_name, frontend_user',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, status, file, description, extension, caption, width, height, duration, download_name, frontend_user,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_mediafrontend_domain_model_asset',
				'foreign_table_where' => 'AND tx_mediafrontend_domain_model_asset.pid=###CURRENT_PID### AND tx_mediafrontend_domain_model_asset.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_asset.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'status' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_asset.status',
			'config' => array(
				'type' => 'select',
				'items' => array (
						array( 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_status.0',0), 
						array( 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_status.1',1), 
						array( 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_status.2',2), 
						array( 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_status.3',3),
				),
			),
		),
		#
		'file' => array(
		    'exclude' => 0,
		    'label'	=> 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_asset.file',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('files', array( 	
					'appearance' => array(
						'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:multimedia_formlabel'																			 	),
					'minitems' => 1,
					'maxitems' => 1,
				),'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai,mov,mp4,wmv,mp3,mpg,mpeg,avi'
			),
		),
		#
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_asset.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'extension' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_asset.extension',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'caption' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_asset.caption',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'width' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_asset.width',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'height' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_asset.height',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'duration' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_asset.duration',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'download_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_asset.download_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'frontend_user' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_asset.frontend_user',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
				'default' => NULL,
				'items' => array(array('',NULL)),
			),
		),
	),
);

?>
