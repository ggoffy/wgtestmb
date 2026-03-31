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

use Xmf\Request;
use XoopsModules\Wgtestmb;
use XoopsModules\Wgtestmb\Constants;

require __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wgtestmb_index.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
// Keywords
$keywords = [];
// Breadcrumbs
$xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_INDEX];
// Tables
$articlesCount = $articlesHandler->getCountArticles();
$GLOBALS['xoopsTpl']->assign('articlesCount', $articlesCount);
if ($articlesCount > 0) {
    $start = Request::getInt('start');
    $limit = Request::getInt('limit', $helper->getConfig('userpager'));
    $articlesAll = $articlesHandler->getAllArticles($start, $limit);
    // Get All Articles
    $articles_list = [];
    foreach (\array_keys($articlesAll) as $i) {
        $articles_list[] = $articlesAll[$i]->getValuesArticles();
        $keywords[] = $articlesAll[$i]->getVar('art_title');
    }
    $GLOBALS['xoopsTpl']->assign('articles_list', $articles_list);
    unset($articles);
    // Display Navigation
    if ($articlesCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($articlesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
    $GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(\_MA_WGTESTMB_INDEX_THEREARE, $articlesCount));
    $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
    $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Tables
$testfieldsCount = $testfieldsHandler->getCountTestfields();
$GLOBALS['xoopsTpl']->assign('testfieldsCount', $testfieldsCount);
if ($testfieldsCount > 0) {
    $start = Request::getInt('start');
    $limit = Request::getInt('limit', $helper->getConfig('userpager'));
    $testfieldsAll = $testfieldsHandler->getAllTestfields($start, $limit);
    // Get All Testfields
    $testfields_list = [];
    foreach (\array_keys($testfieldsAll) as $i) {
        $testfields_list[] = $testfieldsAll[$i]->getValuesTestfields();
        $keywords[] = $testfieldsAll[$i]->getVar('tf_text');
    }
    $GLOBALS['xoopsTpl']->assign('testfields_list', $testfields_list);
    unset($testfields);
    // Display Navigation
    if ($testfieldsCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($testfieldsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
    $GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(\_MA_WGTESTMB_INDEX_THEREARE, $testfieldsCount));
    $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
    $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Tables
$testtable1Count = $testtable1Handler->getCountTesttable1();
$GLOBALS['xoopsTpl']->assign('testtable1Count', $testtable1Count);
if ($testtable1Count > 0) {
    $start = Request::getInt('start');
    $limit = Request::getInt('limit', $helper->getConfig('userpager'));
    $testtable1All = $testtable1Handler->getAllTesttable1($start, $limit);
    // Get All Testtable1
    $testtable1_list = [];
    foreach (\array_keys($testtable1All) as $i) {
        $testtable1_list[] = $testtable1All[$i]->getValuesTesttable1();
        $keywords[] = $testtable1All[$i]->getVar('tt1_name');
    }
    $GLOBALS['xoopsTpl']->assign('testtable1_list', $testtable1_list);
    unset($testtable1);
    // Display Navigation
    if ($testtable1Count > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($testtable1Count, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
    $GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(\_MA_WGTESTMB_INDEX_THEREARE, $testtable1Count));
    $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
    $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Meta keywords
wgtestmbMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);
require __DIR__ . '/footer.php';
