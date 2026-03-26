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

require_once __DIR__ . '/common.php';

// ---------------- Admin Main ----------------
\define('_MI_WGTESTMB_NAME', 'wgTestMB');
\define('_MI_WGTESTMB_DESC', 'This module is for doing following...');
// ---------------- Admin Menu ----------------
\define('_MI_WGTESTMB_ADMENU1', 'Dashboard');
\define('_MI_WGTESTMB_ADMENU2', 'Testtable1');
\define('_MI_WGTESTMB_ADMENU3', 'Clone');
\define('_MI_WGTESTMB_ADMENU4', 'Feedback');
\define('_MI_WGTESTMB_ABOUT', 'About');
// ---------------- Admin Nav ----------------
\define('_MI_WGTESTMB_ADMIN_PAGER', 'Admin pager');
\define('_MI_WGTESTMB_ADMIN_PAGER_DESC', 'Admin per page list');
// User
\define('_MI_WGTESTMB_USER_PAGER', 'User pager');
\define('_MI_WGTESTMB_USER_PAGER_DESC', 'User per page list');
// Submenu
\define('_MI_WGTESTMB_SMNAME1', 'Index page');
\define('_MI_WGTESTMB_SMNAME2', 'Testtable1');
\define('_MI_WGTESTMB_SMNAME3', 'Submit Testtable1');
// Blocks
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK', 'Testtable1 block');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_DESC', 'Testtable1 block description');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_TESTTABLE1', 'Testtable1 block  TESTTABLE1');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_TESTTABLE1_DESC', 'Testtable1 block  TESTTABLE1 description');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_LAST', 'Testtable1 block last');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_LAST_DESC', 'Testtable1 block last description');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_NEW', 'Testtable1 block new');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_NEW_DESC', 'Testtable1 block new description');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_HITS', 'Testtable1 block hits');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_HITS_DESC', 'Testtable1 block hits description');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_TOP', 'Testtable1 block top');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_TOP_DESC', 'Testtable1 block top description');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_RANDOM', 'Testtable1 block random');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_RANDOM_DESC', 'Testtable1 block random description');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_SPOTLIGHT', 'Testtable1 block spotlight');
\define('_MI_WGTESTMB_TESTTABLE1_BLOCK_SPOTLIGHT_DESC', 'Testtable1 block spotlight description');
// Config
\define('_MI_WGTESTMB_MDESC', 'Meta module description');
\define('_MI_WGTESTMB_MDESC_DESC', 'Insert here module description which should be shown in meta data description');
\define('_MI_WGTESTMB_KEYWORDS', 'Meta keywords');
\define('_MI_WGTESTMB_KEYWORDS_DESC', 'Insert here the keywords (separate by comma) which should be shown in meta data');
\define('_MI_WGTESTMB_NUMB_COL', 'Number Columns');
\define('_MI_WGTESTMB_NUMB_COL_DESC', 'Number Columns to View');
\define('_MI_WGTESTMB_DIVIDEBY', 'Divide By');
\define('_MI_WGTESTMB_DIVIDEBY_DESC', 'Divide by columns number');
\define('_MI_WGTESTMB_TABLE_TYPE', 'Table Type');
\define('_MI_WGTESTMB_TABLE_TYPE_DESC', 'Table Type is the bootstrap html table');
\define('_MI_WGTESTMB_PANEL_TYPE', 'Panel Type');
\define('_MI_WGTESTMB_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div');
\define('_MI_WGTESTMB_IDPAYPAL', 'Paypal ID');
\define('_MI_WGTESTMB_IDPAYPAL_DESC', 'Insert here your PayPal ID for donations');
\define('_MI_WGTESTMB_SHOW_BREADCRUMBS', 'Show breadcrumb navigation');
\define('_MI_WGTESTMB_SHOW_BREADCRUMBS_DESC', 'Show breadcrumb navigation which displays the current page in context within the site structure');
\define('_MI_WGTESTMB_ADVERTISE', 'Advertisement Code');
\define('_MI_WGTESTMB_ADVERTISE_DESC', 'Insert here the advertisement code');
\define('_MI_WGTESTMB_MAINTAINEDBY', 'Maintained By');
\define('_MI_WGTESTMB_MAINTAINEDBY_DESC', 'Allow url of support site or community');
\define('_MI_WGTESTMB_BOOKMARKS', 'Social Bookmarks');
\define('_MI_WGTESTMB_BOOKMARKS_DESC', 'Show Social Bookmarks in the single page');
// ---------------- End ----------------
