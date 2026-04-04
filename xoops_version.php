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
    'release_date'        => '2026/04/04',
    'manual'              => 'link to manual file',
    'manual_file'         => \XOOPS_URL . '/modules/wgtestmb/docs/install.txt',
    'min_php'             => '8.3',
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
    'module_website_url'  => 'https://www.xoops.org',
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
    ['file' => 'wgtestmb_admin_categories.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_articles.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_testfields.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_testtable1.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_broken.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_permissions.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_clone.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgtestmb_admin_footer.tpl', 'description' => '', 'type' => 'admin'],
    // User templates
    ['file' => 'wgtestmb_header.tpl', 'description' => ''],
    ['file' => 'wgtestmb_index.tpl', 'description' => ''],
    ['file' => 'wgtestmb_articles.tpl', 'description' => ''],
    ['file' => 'wgtestmb_articles_list.tpl', 'description' => ''],
    ['file' => 'wgtestmb_articles_item.tpl', 'description' => ''],
    ['file' => 'wgtestmb_testfields.tpl', 'description' => ''],
    ['file' => 'wgtestmb_testfields_list.tpl', 'description' => ''],
    ['file' => 'wgtestmb_testfields_item.tpl', 'description' => ''],
    ['file' => 'wgtestmb_testtable1.tpl', 'description' => ''],
    ['file' => 'wgtestmb_testtable1_list.tpl', 'description' => ''],
    ['file' => 'wgtestmb_testtable1_item.tpl', 'description' => ''],
    ['file' => 'wgtestmb_breadcrumbs.tpl', 'description' => ''],
    ['file' => 'wgtestmb_articles_pdf.tpl', 'description' => ''],
    ['file' => 'wgtestmb_testfields_pdf.tpl', 'description' => ''],
    ['file' => 'wgtestmb_articles_print.tpl', 'description' => ''],
    ['file' => 'wgtestmb_testfields_print.tpl', 'description' => ''],
    ['file' => 'wgtestmb_rate.tpl', 'description' => ''],
    ['file' => 'wgtestmb_rss.tpl', 'description' => ''],
    ['file' => 'wgtestmb_search.tpl', 'description' => ''],
    ['file' => 'wgtestmb_footer.tpl', 'description' => ''],
];
// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'] = [
    'wgtestmb_categories',
    'wgtestmb_articles',
    'wgtestmb_testfields',
    'wgtestmb_testtable1',
    'wgtestmb_ratings',
];
// ------------------- Search ------------------- //
$modversion['hasSearch'] = 1;
$modversion['search'] = [
    'file' => 'include/search.inc.php',
    'func' => 'wgtestmb_search',
];
// ------------------- Comments ------------------- //
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'testfields.php';
$modversion['comments']['itemName'] = 'tf_id';
// Comment callback functions
$modversion['comments']['callbackFile'] = 'include/comment_functions.php';
$modversion['comments']['callback'] = [
    'approve' => 'wgtestmbCommentsApprove',
    'update'  => 'wgtestmbCommentsUpdate',
];
// ------------------- Menu ------------------- //
$currdirname  = isset($GLOBALS['xoopsModule']) && \is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';
if ($currdirname == $moduleDirName) {
    $modversion['sub'][] = [
        'name' => \_MI_WGTESTMB_SMNAME1,
        'url'  => 'index.php',
    ];
    // Sub articles
    $modversion['sub'][] = [
        'name' => \_MI_WGTESTMB_SMNAME3,
        'url'  => 'articles.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_WGTESTMB_SMNAME4,
        'url'  => 'articles.php?op=new',
    ];
    // Sub testfields
    $modversion['sub'][] = [
        'name' => \_MI_WGTESTMB_SMNAME5,
        'url'  => 'testfields.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_WGTESTMB_SMNAME6,
        'url'  => 'testfields.php?op=new',
    ];
    // Sub testtable1
    $modversion['sub'][] = [
        'name' => \_MI_WGTESTMB_SMNAME7,
        'url'  => 'testtable1.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_WGTESTMB_SMNAME8,
        'url'  => 'testtable1.php?op=new',
    ];
}
// ------------------- Default Blocks ------------------- //
// Articles last
$modversion['blocks'][] = [
    'file'        => 'articles.php',
    'name'        => \_MI_WGTESTMB_ARTICLES_BLOCK_LAST,
    'description' => \_MI_WGTESTMB_ARTICLES_BLOCK_LAST_DESC,
    'show_func'   => 'b_wgtestmb_articles_show',
    'edit_func'   => 'b_wgtestmb_articles_edit',
    'template'    => 'wgtestmb_block_articles.tpl',
    'options'     => 'last|5|25|0',
];
// Articles new
$modversion['blocks'][] = [
    'file'        => 'articles.php',
    'name'        => \_MI_WGTESTMB_ARTICLES_BLOCK_NEW,
    'description' => \_MI_WGTESTMB_ARTICLES_BLOCK_NEW_DESC,
    'show_func'   => 'b_wgtestmb_articles_show',
    'edit_func'   => 'b_wgtestmb_articles_edit',
    'template'    => 'wgtestmb_block_articles.tpl',
    'options'     => 'new|5|25|0',
];
// Articles hits
$modversion['blocks'][] = [
    'file'        => 'articles.php',
    'name'        => \_MI_WGTESTMB_ARTICLES_BLOCK_HITS,
    'description' => \_MI_WGTESTMB_ARTICLES_BLOCK_HITS_DESC,
    'show_func'   => 'b_wgtestmb_articles_show',
    'edit_func'   => 'b_wgtestmb_articles_edit',
    'template'    => 'wgtestmb_block_articles.tpl',
    'options'     => 'hits|5|25|0',
];
// Articles top
$modversion['blocks'][] = [
    'file'        => 'articles.php',
    'name'        => \_MI_WGTESTMB_ARTICLES_BLOCK_TOP,
    'description' => \_MI_WGTESTMB_ARTICLES_BLOCK_TOP_DESC,
    'show_func'   => 'b_wgtestmb_articles_show',
    'edit_func'   => 'b_wgtestmb_articles_edit',
    'template'    => 'wgtestmb_block_articles.tpl',
    'options'     => 'top|5|25|0',
];
// Articles random
$modversion['blocks'][] = [
    'file'        => 'articles.php',
    'name'        => \_MI_WGTESTMB_ARTICLES_BLOCK_RANDOM,
    'description' => \_MI_WGTESTMB_ARTICLES_BLOCK_RANDOM_DESC,
    'show_func'   => 'b_wgtestmb_articles_show',
    'edit_func'   => 'b_wgtestmb_articles_edit',
    'template'    => 'wgtestmb_block_articles.tpl',
    'options'     => 'random|5|25|0',
];
// Testfields last
$modversion['blocks'][] = [
    'file'        => 'testfields.php',
    'name'        => \_MI_WGTESTMB_TESTFIELDS_BLOCK_LAST,
    'description' => \_MI_WGTESTMB_TESTFIELDS_BLOCK_LAST_DESC,
    'show_func'   => 'b_wgtestmb_testfields_show',
    'edit_func'   => 'b_wgtestmb_testfields_edit',
    'template'    => 'wgtestmb_block_testfields.tpl',
    'options'     => 'last|5|25|0',
];
// Testfields new
$modversion['blocks'][] = [
    'file'        => 'testfields.php',
    'name'        => \_MI_WGTESTMB_TESTFIELDS_BLOCK_NEW,
    'description' => \_MI_WGTESTMB_TESTFIELDS_BLOCK_NEW_DESC,
    'show_func'   => 'b_wgtestmb_testfields_show',
    'edit_func'   => 'b_wgtestmb_testfields_edit',
    'template'    => 'wgtestmb_block_testfields.tpl',
    'options'     => 'new|5|25|0',
];
// Testfields hits
$modversion['blocks'][] = [
    'file'        => 'testfields.php',
    'name'        => \_MI_WGTESTMB_TESTFIELDS_BLOCK_HITS,
    'description' => \_MI_WGTESTMB_TESTFIELDS_BLOCK_HITS_DESC,
    'show_func'   => 'b_wgtestmb_testfields_show',
    'edit_func'   => 'b_wgtestmb_testfields_edit',
    'template'    => 'wgtestmb_block_testfields.tpl',
    'options'     => 'hits|5|25|0',
];
// Testfields top
$modversion['blocks'][] = [
    'file'        => 'testfields.php',
    'name'        => \_MI_WGTESTMB_TESTFIELDS_BLOCK_TOP,
    'description' => \_MI_WGTESTMB_TESTFIELDS_BLOCK_TOP_DESC,
    'show_func'   => 'b_wgtestmb_testfields_show',
    'edit_func'   => 'b_wgtestmb_testfields_edit',
    'template'    => 'wgtestmb_block_testfields.tpl',
    'options'     => 'top|5|25|0',
];
// Testfields random
$modversion['blocks'][] = [
    'file'        => 'testfields.php',
    'name'        => \_MI_WGTESTMB_TESTFIELDS_BLOCK_RANDOM,
    'description' => \_MI_WGTESTMB_TESTFIELDS_BLOCK_RANDOM_DESC,
    'show_func'   => 'b_wgtestmb_testfields_show',
    'edit_func'   => 'b_wgtestmb_testfields_edit',
    'template'    => 'wgtestmb_block_testfields.tpl',
    'options'     => 'random|5|25|0',
];
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
// Articles spotlight
$modversion['blocks'][] = [
    'file'        => 'articles_spotlight.php',
    'name'        => \_MI_WGTESTMB_ARTICLES_BLOCK_SPOTLIGHT,
    'description' => \_MI_WGTESTMB_ARTICLES_BLOCK_SPOTLIGHT_DESC,
    'show_func'   => 'b_wgtestmb_articles_spotlight_show',
    'edit_func'   => 'b_wgtestmb_articles_spotlight_edit',
    'template'    => 'wgtestmb_block_articles_spotlight.tpl',
    'options'     => 'spotlight|5|25|0',
];
// Testfields spotlight
$modversion['blocks'][] = [
    'file'        => 'testfields_spotlight.php',
    'name'        => \_MI_WGTESTMB_TESTFIELDS_BLOCK_SPOTLIGHT,
    'description' => \_MI_WGTESTMB_TESTFIELDS_BLOCK_SPOTLIGHT_DESC,
    'show_func'   => 'b_wgtestmb_testfields_spotlight_show',
    'edit_func'   => 'b_wgtestmb_testfields_spotlight_edit',
    'template'    => 'wgtestmb_block_testfields_spotlight.tpl',
    'options'     => 'spotlight|5|25|0',
];
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
    'default'     => 'wgtestmb, categories, articles, testfields, testtable1',
];
// Editor Admin
\xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor_admin',
    'title'       => '\_MI_WGTESTMB_EDITOR_ADMIN',
    'description' => '\_MI_WGTESTMB_EDITOR_ADMIN_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => array_flip($editorHandler->getList()),
];
// Editor User
\xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor_user',
    'title'       => '\_MI_WGTESTMB_EDITOR_USER',
    'description' => '\_MI_WGTESTMB_EDITOR_USER_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => array_flip($editorHandler->getList()),
];
// Editor : max characters admin area
$modversion['config'][] = [
    'name'        => 'editor_maxchar',
    'title'       => '\_MI_WGTESTMB_EDITOR_MAXCHAR',
    'description' => '\_MI_WGTESTMB_EDITOR_MAXCHAR_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 50,
];
// Get groups
$memberHandler = \xoops_getHandler('member');
$xoopsGroups  = $memberHandler->getGroupList();
$groups = [];
foreach ($xoopsGroups as $key => $group) {
    $groups[$group]  = $key;
}
// General access groups
$modversion['config'][] = [
    'name'        => 'groups',
    'title'       => '\_MI_WGTESTMB_GROUPS',
    'description' => '\_MI_WGTESTMB_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => $groups,
    'options'     => $groups,
];
// Upload groups
$modversion['config'][] = [
    'name'        => 'upload_groups',
    'title'       => '\_MI_WGTESTMB_UPLOAD_GROUPS',
    'description' => '\_MI_WGTESTMB_UPLOAD_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => $groups,
    'options'     => $groups,
];
// Get Admin groups
$crGroups = new \CriteriaCompo();
$crGroups->add(new \Criteria('group_type', 'Admin'));
$memberHandler = \xoops_getHandler('member');
$adminXoopsGroups  = $memberHandler->getGroupList($crGroups);
$adminGroups = [];
foreach ($adminXoopsGroups as $key => $adminGroup) {
    $adminGroups[$adminGroup]  = $key;
}
$modversion['config'][] = [
    'name'        => 'admin_groups',
    'title'       => '\_MI_WGTESTMB_ADMIN_GROUPS',
    'description' => '\_MI_WGTESTMB_ADMIN_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => $adminGroups,
    'options'     => $adminGroups,
];
unset($crGroups);
// Get groups
$memberHandler = \xoops_getHandler('member');
$xoopsGroups  = $memberHandler->getGroupList();
$ratingbar_groups = [];
foreach ($xoopsGroups as $key => $group) {
    $ratingbar_groups[$group]  = $key;
}
// Rating: Groups with rating permissions
$modversion['config'][] = [
    'name'        => 'ratingbar_groups',
    'title'       => '\_MI_WGTESTMB_RATINGBAR_GROUPS',
    'description' => '\_MI_WGTESTMB_RATINGBAR_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => [1],
    'options'     => $ratingbar_groups,
];
// Rating : used ratingbar
$modversion['config'][] = [
    'name'        => 'ratingbars',
    'title'       => '\_MI_WGTESTMB_RATINGBARS',
    'description' => '\_MI_WGTESTMB_RATINGBARS_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 0,
    'options'     => ['\_MI_WGTESTMB_RATING_NONE' => 0, '\_MI_WGTESTMB_RATING_5STARS' => 1, '\_MI_WGTESTMB_RATING_10STARS' => 2, '\_MI_WGTESTMB_RATING_LIKES' => 3, '\_MI_WGTESTMB_RATING_10NUM' => 4],
];
// create increment steps for file size
require_once __DIR__ . '/include/xoops_version.inc.php';
$iniPostMaxSize       = wgtestmbReturnBytes(\ini_get('post_max_size'));
$iniUploadMaxFileSize = wgtestmbReturnBytes(\ini_get('upload_max_filesize'));
$maxSize              = min($iniPostMaxSize, $iniUploadMaxFileSize);
if ($maxSize > 10000 * 1048576) {
    $increment = 500;
}
if ($maxSize <= 10000 * 1048576) {
    $increment = 200;
}
if ($maxSize <= 5000 * 1048576) {
    $increment = 100;
}
if ($maxSize <= 2500 * 1048576) {
    $increment = 50;
}
if ($maxSize <= 1000 * 1048576) {
    $increment = 10;
}
if ($maxSize <= 500 * 1048576) {
    $increment = 5;
}
if ($maxSize <= 100 * 1048576) {
    $increment = 2;
}
if ($maxSize <= 50 * 1048576) {
    $increment = 1;
}
if ($maxSize <= 25 * 1048576) {
    $increment = 0.5;
}
$optionMaxsize = [];
$i = $increment;
while ($i * 1048576 <= $maxSize) {
    $optionMaxsize[$i . ' ' . _MI_WGTESTMB_SIZE_MB] = $i * 1048576;
    $i += $increment;
}
// Uploads : maxsize of image
$modversion['config'][] = [
    'name'        => 'maxsize_image',
    'title'       => '\_MI_WGTESTMB_MAXSIZE_IMAGE',
    'description' => '\_MI_WGTESTMB_MAXSIZE_IMAGE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 3145728,
    'options'     => $optionMaxsize,
];
// Uploads : mimetypes of image
$modversion['config'][] = [
    'name'        => 'mimetypes_image',
    'title'       => '\_MI_WGTESTMB_MIMETYPES_IMAGE',
    'description' => '\_MI_WGTESTMB_MIMETYPES_IMAGE_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['image/gif', 'image/jpeg', 'image/png'],
    'options'     => ['bmp' => 'image/bmp','gif' => 'image/gif','pjpeg' => 'image/pjpeg', 'jpeg' => 'image/jpeg','jpg' => 'image/jpg','jpe' => 'image/jpe', 'png' => 'image/png'],
];
$modversion['config'][] = [
    'name'        => 'maxwidth_image',
    'title'       => '\_MI_WGTESTMB_MAXWIDTH_IMAGE',
    'description' => '\_MI_WGTESTMB_MAXWIDTH_IMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 800,
];
$modversion['config'][] = [
    'name'        => 'maxheight_image',
    'title'       => '\_MI_WGTESTMB_MAXHEIGHT_IMAGE',
    'description' => '\_MI_WGTESTMB_MAXHEIGHT_IMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 800,
];
// Uploads : maxsize of file
$modversion['config'][] = [
    'name'        => 'maxsize_file',
    'title'       => '\_MI_WGTESTMB_MAXSIZE_FILE',
    'description' => '\_MI_WGTESTMB_MAXSIZE_FILE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 3145728,
    'options'     => $optionMaxsize,
];
// Uploads : mimetypes of file
$modversion['config'][] = [
    'name'        => 'mimetypes_file',
    'title'       => '\_MI_WGTESTMB_MIMETYPES_FILE',
    'description' => '\_MI_WGTESTMB_MIMETYPES_FILE_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['application/pdf', 'application/zip', 'text/comma-separated-values', 'text/plain', 'image/gif', 'image/jpeg', 'image/png'],
    'options'     => ['gif' => 'image/gif','pjpeg' => 'image/pjpeg', 'jpeg' => 'image/jpeg','jpg' => 'image/jpg','jpe' => 'image/jpe', 'png' => 'image/png', 'pdf' => 'application/pdf','zip' => 'application/zip','csv' => 'text/comma-separated-values', 'txt' => 'text/plain', 'xml' => 'application/xml', 'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
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
// Use tag
$modversion['config'][] = [
    'name'        => 'usetag',
    'title'       => '\_MI_WGTESTMB_USE_TAG',
    'description' => '\_MI_WGTESTMB_USE_TAG_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
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
    'valuetype'   => 'text',
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
    'valuetype'   => 'text',
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
// ------------------- Notifications ------------------- //
$modversion['hasNotification'] = 1;
$modversion['notification'] = [
    'lookup_file' => 'include/notification.inc.php',
    'lookup_func' => 'wgtestmb_notify_iteminfo',
];
// Categories of notification
// Global Notify
$modversion['notification']['category'][] = [
    'name'           => 'global',
    'title'          => \_MI_WGTESTMB_NOTIFY_GLOBAL,
    'description'    => '',
    'subscribe_from' => ['index.php', 'articles.php', 'testfields.php'],
];
// Article Notify
$modversion['notification']['category'][] = [
    'name'           => 'articles',
    'title'          => \_MI_WGTESTMB_NOTIFY_ARTICLE,
    'description'    => '',
    'subscribe_from' => 'articles.php',
    'item_name'      => 'art_id',
    'allow_bookmark' => 1,
];
// Testfield Notify
$modversion['notification']['category'][] = [
    'name'           => 'testfields',
    'title'          => \_MI_WGTESTMB_NOTIFY_TESTFIELD,
    'description'    => '',
    'subscribe_from' => 'testfields.php',
    'item_name'      => 'tf_id',
    'allow_bookmark' => 1,
];
// Global events notification
// GLOBAL_NEW Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_new',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_GLOBAL_NEW,
    'caption'       => \_MI_WGTESTMB_NOTIFY_GLOBAL_NEW_CAPTION,
    'description'   => '',
    'mail_template' => 'global_new_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_GLOBAL_NEW_SUBJECT,
];
// GLOBAL_MODIFY Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_modify',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_GLOBAL_MODIFY,
    'caption'       => \_MI_WGTESTMB_NOTIFY_GLOBAL_MODIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_modify_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_GLOBAL_MODIFY_SUBJECT,
];
// GLOBAL_DELETE Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_delete',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_GLOBAL_DELETE,
    'caption'       => \_MI_WGTESTMB_NOTIFY_GLOBAL_DELETE_CAPTION,
    'description'   => '',
    'mail_template' => 'global_delete_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_GLOBAL_DELETE_SUBJECT,
];
// GLOBAL_APPROVE Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_approve',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => \_MI_WGTESTMB_NOTIFY_GLOBAL_APPROVE,
    'caption'       => \_MI_WGTESTMB_NOTIFY_GLOBAL_APPROVE_CAPTION,
    'description'   => '',
    'mail_template' => 'global_approve_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_GLOBAL_APPROVE_SUBJECT,
];
// GLOBAL_BROKEN Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_broken',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => \_MI_WGTESTMB_NOTIFY_GLOBAL_BROKEN,
    'caption'       => \_MI_WGTESTMB_NOTIFY_GLOBAL_BROKEN_CAPTION,
    'description'   => '',
    'mail_template' => 'global_broken_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_GLOBAL_BROKEN_SUBJECT,
];
// GLOBAL_COMMENT Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_comment',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_GLOBAL_COMMENT,
    'caption'       => \_MI_WGTESTMB_NOTIFY_GLOBAL_COMMENT_CAPTION,
    'description'   => '',
    'mail_template' => 'global_comment_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_GLOBAL_COMMENT_SUBJECT,
];
// Event notifications for items
// ARTICLE_MODIFY Notify
$modversion['notification']['event'][] = [
    'name'          => 'article_modify',
    'category'      => 'articles',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_ARTICLE_MODIFY,
    'caption'       => \_MI_WGTESTMB_NOTIFY_ARTICLE_MODIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'article_modify_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_ARTICLE_MODIFY_SUBJECT,
];
// ARTICLE_DELETE Notify
$modversion['notification']['event'][] = [
    'name'          => 'article_delete',
    'category'      => 'articles',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_ARTICLE_DELETE,
    'caption'       => \_MI_WGTESTMB_NOTIFY_ARTICLE_DELETE_CAPTION,
    'description'   => '',
    'mail_template' => 'article_delete_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_ARTICLE_DELETE_SUBJECT,
];
// ARTICLE_APPROVE Notify
$modversion['notification']['event'][] = [
    'name'          => 'article_approve',
    'category'      => 'articles',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_ARTICLE_APPROVE,
    'caption'       => \_MI_WGTESTMB_NOTIFY_ARTICLE_APPROVE_CAPTION,
    'description'   => '',
    'mail_template' => 'article_approve_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_ARTICLE_APPROVE_SUBJECT,
];
// ARTICLE_BROKEN Notify
$modversion['notification']['event'][] = [
    'name'          => 'article_broken',
    'category'      => 'articles',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_ARTICLE_BROKEN,
    'caption'       => \_MI_WGTESTMB_NOTIFY_ARTICLE_BROKEN_CAPTION,
    'description'   => '',
    'mail_template' => 'article_broken_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_ARTICLE_BROKEN_SUBJECT,
];
// TESTFIELD_MODIFY Notify
$modversion['notification']['event'][] = [
    'name'          => 'testfield_modify',
    'category'      => 'testfields',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_TESTFIELD_MODIFY,
    'caption'       => \_MI_WGTESTMB_NOTIFY_TESTFIELD_MODIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'testfield_modify_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_TESTFIELD_MODIFY_SUBJECT,
];
// TESTFIELD_DELETE Notify
$modversion['notification']['event'][] = [
    'name'          => 'testfield_delete',
    'category'      => 'testfields',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_TESTFIELD_DELETE,
    'caption'       => \_MI_WGTESTMB_NOTIFY_TESTFIELD_DELETE_CAPTION,
    'description'   => '',
    'mail_template' => 'testfield_delete_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_TESTFIELD_DELETE_SUBJECT,
];
// TESTFIELD_APPROVE Notify
$modversion['notification']['event'][] = [
    'name'          => 'testfield_approve',
    'category'      => 'testfields',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_TESTFIELD_APPROVE,
    'caption'       => \_MI_WGTESTMB_NOTIFY_TESTFIELD_APPROVE_CAPTION,
    'description'   => '',
    'mail_template' => 'testfield_approve_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_TESTFIELD_APPROVE_SUBJECT,
];
// TESTFIELD_BROKEN Notify
$modversion['notification']['event'][] = [
    'name'          => 'testfield_broken',
    'category'      => 'testfields',
    'admin_only'    => 0,
    'title'         => \_MI_WGTESTMB_NOTIFY_TESTFIELD_BROKEN,
    'caption'       => \_MI_WGTESTMB_NOTIFY_TESTFIELD_BROKEN_CAPTION,
    'description'   => '',
    'mail_template' => 'testfield_broken_notify',
    'mail_subject'  => \_MI_WGTESTMB_NOTIFY_TESTFIELD_BROKEN_SUBJECT,
];
