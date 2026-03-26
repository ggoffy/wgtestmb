<?php

declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgTestMB module for xoops
 *
 * @copyright    2026 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      wgtestmb
 * @author       TDM XOOPS - Email:info@email.com - Website:https://xoops.org
 */

// 
$moduleDirName      = \basename(__DIR__);
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

include \XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/preloads/autoloader.php';

// ------------------- Informations ------------------- //
$modversion = [
    'name'                => \_MI_WGTESTMB_NAME,
    'version'             => '1.0.0',
    'description'         => \_MI_WGTESTMB_DESC,
    'author'              => 'TDM XOOPS',
    'author_mail'         => 'info@email.com',
    'author_website_url'  => 'https://xoops.org',
    'author_website_name' => 'XOOPS Project',
    'credits'             => 'XOOPS Development Team',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'https://www.gnu.org/licenses/gpl-3.0.en.html',
    'help'                => 'page=help',
    'release_info'        => 'release_info',
    'release_file'        => \XOOPS_URL . '/modules/wgtestmb/docs/release_info file',
    'release_date'        => '2026/03/26',
    'manual'              => 'link to manual file',
    'manual_file'         => \XOOPS_URL . '/modules/wgtestmb/docs/install.txt',
    'min_php'             => '8,3',
    'min_xoops'           => '2.5.11',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.6', 'mysqli' => '5.6'],
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => \basename(__DIR__),
    'dirmoduleadmin'      => 'Frameworks/moduleclasses/moduleadmin',
    'sysicons16'          => '../../Frameworks/moduleclasses/icons/16',
    'sysicons32'          => '../../Frameworks/moduleclasses/icons/32',
    'modicons16'          => 'assets/icons/16',
    'modicons32'          => 'assets/icons/32',
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    'release'             => '2017-12-02',
    'module_status'       => 'Beta 1',
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'hasMain'             => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    'onInstall'           => 'include/install.php',
    'onUninstall'         => 'include/uninstall.php',
    'onUpdate'            => 'include/update.php',
];
// ------------------- Templates ------------------- //
$modversion['templates'] = [
    // Admin templates
    ['file' => 'wgtestmb_admin_about.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_header.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_index.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_testtable1.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_clone.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_footer.tpl', 'description' => '', 'type' => 'admin'],
    // User templates
    ['file' => 'wgtestmb_header.tpl', 'description' => ''],
    ['file' => 'wgtestmb_index.tpl', 'description' => ''],
    ['file' => 'wgtestmb_testtable1.tpl', 'description' => ''],
    ['file' => 'wgtestmb_testtable1_list.tpl', 'description' => ''],
    ['file' => 'wgtestmb_testtable1_item.tpl', 'description' => ''],
    ['file' => 'wgtestmb_breadcrumbs.tpl', 'description' => ''],
    ['file' => 'wgtestmb_footer.tpl', 'description' => ''],
];
// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'] = [
    'wgtestmb_testtable1',
];
// ------------------- Menu ------------------- //
$currdirname  = isset($GLOBALS['xoopsModule']) && \is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';
if ($currdirname == $moduleDirName) {
    $modversion['sub'][] = [
        'name' => \_MI_WGTESTMB_SMNAME1,
        'url'  => 'index.php',
    ];
    // Sub testtable1
    $modversion['sub'][] = [
        'name' => \_MI_WGTESTMB_SMNAME2,
        'url'  => 'testtable1.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_WGTESTMB_SMNAME3,
        'url'  => 'testtable1.php?op=new',
    ];
}
// ------------------- Default Blocks ------------------- //
// Testtable1 last
$modversion['blocks'][] = [
    'file'        => 'testtable1.php',
    'name'        => \_MI_WGTESTMB_TESTTABLE1_BLOCK_LAST,
    'description' => \_MI_WGTESTMB_TESTTABLE1_BLOCK_LAST_DESC,
    'show_func'   => 'b_wgtestmb_testtable1_show',
    'edit_func'   => 'b_wgtestmb_testtable1_edit',
    'template'    => 'wgtestmb_block_testtable1.tpl',
    'options'     => 'last|5|25|0',
];
// Testtable1 new
$modversion['blocks'][] = [
    'file'        => 'testtable1.php',
    'name'        => \_MI_WGTESTMB_TESTTABLE1_BLOCK_NEW,
    'description' => \_MI_WGTESTMB_TESTTABLE1_BLOCK_NEW_DESC,
    'show_func'   => 'b_wgtestmb_testtable1_show',
    'edit_func'   => 'b_wgtestmb_testtable1_edit',
    'template'    => 'wgtestmb_block_testtable1.tpl',
    'options'     => 'new|5|25|0',
];
// Testtable1 hits
$modversion['blocks'][] = [
    'file'        => 'testtable1.php',
    'name'        => \_MI_WGTESTMB_TESTTABLE1_BLOCK_HITS,
    'description' => \_MI_WGTESTMB_TESTTABLE1_BLOCK_HITS_DESC,
    'show_func'   => 'b_wgtestmb_testtable1_show',
    'edit_func'   => 'b_wgtestmb_testtable1_edit',
    'template'    => 'wgtestmb_block_testtable1.tpl',
    'options'     => 'hits|5|25|0',
];
// Testtable1 top
$modversion['blocks'][] = [
    'file'        => 'testtable1.php',
    'name'        => \_MI_WGTESTMB_TESTTABLE1_BLOCK_TOP,
    'description' => \_MI_WGTESTMB_TESTTABLE1_BLOCK_TOP_DESC,
    'show_func'   => 'b_wgtestmb_testtable1_show',
    'edit_func'   => 'b_wgtestmb_testtable1_edit',
    'template'    => 'wgtestmb_block_testtable1.tpl',
    'options'     => 'top|5|25|0',
];
// Testtable1 random
$modversion['blocks'][] = [
    'file'        => 'testtable1.php',
    'name'        => \_MI_WGTESTMB_TESTTABLE1_BLOCK_RANDOM,
    'description' => \_MI_WGTESTMB_TESTTABLE1_BLOCK_RANDOM_DESC,
    'show_func'   => 'b_wgtestmb_testtable1_show',
    'edit_func'   => 'b_wgtestmb_testtable1_edit',
    'template'    => 'wgtestmb_block_testtable1.tpl',
    'options'     => 'random|5|25|0',
];
// ------------------- Spotlight Blocks ------------------- //
// Testtable1 spotlight
$modversion['blocks'][] = [
    'file'        => 'testtable1_spotlight.php',
    'name'        => \_MI_WGTESTMB_TESTTABLE1_BLOCK_SPOTLIGHT,
    'description' => \_MI_WGTESTMB_TESTTABLE1_BLOCK_SPOTLIGHT_DESC,
    'show_func'   => 'b_wgtestmb_testtable1_spotlight_show',
    'edit_func'   => 'b_wgtestmb_testtable1_spotlight_edit',
    'template'    => 'wgtestmb_block_testtable1_spotlight.tpl',
    'options'     => 'spotlight|5|25|0',
];
// ------------------- Config ------------------- //
// Meta descrition
$modversion['config'][] = [
    'name'        => 'metadescription',
    'title'       => '\_MI_WGTESTMB_MDESC',
    'description' => '\_MI_WGTESTMB_MDESC_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => \_MI_WGTESTMB_DESC,
];
// Meta Keywords
$modversion['config'][] = [
    'name'        => 'keywords',
    'title'       => '\_MI_WGTESTMB_KEYWORDS',
    'description' => '\_MI_WGTESTMB_KEYWORDS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'wgtestmb, testtable1',
];
// Admin pager
$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => '\_MI_WGTESTMB_ADMIN_PAGER',
    'description' => '\_MI_WGTESTMB_ADMIN_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];
// User pager
$modversion['config'][] = [
    'name'        => 'userpager',
    'title'       => '\_MI_WGTESTMB_USER_PAGER',
    'description' => '\_MI_WGTESTMB_USER_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];
// Number column
$modversion['config'][] = [
    'name'        => 'numb_col',
    'title'       => '\_MI_WGTESTMB_NUMB_COL',
    'description' => '\_MI_WGTESTMB_NUMB_COL_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 1,
    'options'     => [1 => '1', 2 => '2', 3 => '3', 4 => '4'],
];
// Divide by
$modversion['config'][] = [
    'name'        => 'divideby',
    'title'       => '\_MI_WGTESTMB_DIVIDEBY',
    'description' => '\_MI_WGTESTMB_DIVIDEBY_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 1,
    'options'     => [1 => '1', 2 => '2', 3 => '3', 4 => '4'],
];
// Table type
$modversion['config'][] = [
    'name'        => 'table_type',
    'title'       => '\_MI_WGTESTMB_TABLE_TYPE',
    'description' => '\_MI_WGTESTMB_DIVIDEBY_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 'bordered',
    'options'     => ['bordered' => 'bordered', 'striped' => 'striped', 'hover' => 'hover', 'condensed' => 'condensed'],
];
// Panel by
$modversion['config'][] = [
    'name'        => 'panel_type',
    'title'       => '\_MI_WGTESTMB_PANEL_TYPE',
    'description' => '\_MI_WGTESTMB_PANEL_TYPE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'default',
    'options'     => ['default' => 'default', 'primary' => 'primary', 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger'],
];
// Paypal ID
$modversion['config'][] = [
    'name'        => 'donations',
    'title'       => '\_MI_WGTESTMB_IDPAYPAL',
    'description' => '\_MI_WGTESTMB_IDPAYPAL_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'textbox',
    'default'     => 'XYZ123',
];
// Show Breadcrumbs
$modversion['config'][] = [
    'name'        => 'show_breadcrumbs',
    'title'       => '\_MI_WGTESTMB_SHOW_BREADCRUMBS',
    'description' => '\_MI_WGTESTMB_SHOW_BREADCRUMBS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Advertise
$modversion['config'][] = [
    'name'        => 'advertise',
    'title'       => '\_MI_WGTESTMB_ADVERTISE',
    'description' => '\_MI_WGTESTMB_ADVERTISE_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => '',
];
// Bookmarks
$modversion['config'][] = [
    'name'        => 'bookmarks',
    'title'       => '\_MI_WGTESTMB_BOOKMARKS',
    'description' => '\_MI_WGTESTMB_BOOKMARKS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];
// Make Sample button visible?
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Maintained by
$modversion['config'][] = [
    'name'        => 'maintainedby',
    'title'       => '\_MI_WGTESTMB_MAINTAINEDBY',
    'description' => '\_MI_WGTESTMB_MAINTAINEDBY_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'https://xoops.org/modules/newbb',
];
