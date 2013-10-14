<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_mediafrontend_domain_model_filecollection'] = array(
	'ctrl' => $TCA['tx_mediafrontend_domain_model_filecollection']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, status, image, description, frontend_user, assets',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, status, image, description, frontend_user, assets,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_mediafrontend_domain_model_filecollection',
				'foreign_table_where' => 'AND tx_mediafrontend_domain_model_filecollection.pid=###CURRENT_PID### AND tx_mediafrontend_domain_model_filecollection.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_filecollection.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'status' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_filecollection.status',
			'config' => array(
				'type' => 'select',
				'items' => array (
						array( 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_status.0',0), 
						array( 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_status.1',1), 
						array( 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_status.2',2), 
						array( 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_status.3',3),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'image' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_filecollection.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image', array(
				'appearance' => array (
				    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				    ),
				'minitems' => 0,
				'maxitems' => 1,
				), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_filecollection.description',
			'config' => array(
				'type' => 'text',
				'columns' => 30,
				'rows' => 15,
				'size' => 30,
				'eval' => 'trim',
			),
		),
		'frontend_user' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_filecollection.frontend_user',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
				'default' => NULL,
				'items' => array(array('',NULL)),
			),
		),
		'assets' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:media_frontend/Resources/Private/Language/locallang_db.xlf:tx_mediafrontend_domain_model_filecollection.assets',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_mediafrontend_domain_model_asset',
				'MM' => 'tx_mediafrontend_filecollection_asset_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_mediafrontend_domain_model_asset',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
	),
);

?>
