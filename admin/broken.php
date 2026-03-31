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

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
$templateMain = 'wgtestmb_admin_broken.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('broken.php'));

// Check table articles
$start = Request::getInt('startArticles');
$limit = Request::getInt('limitArticles', $helper->getConfig('adminpager'));
$crArticles = new \CriteriaCompo();
$crArticles->add(new \Criteria('art_status', Constants::STATUS_BROKEN));
$articlesCount = $articlesHandler->getCount($crArticles);
$GLOBALS['xoopsTpl']->assign('articles_count', $articlesCount);
$GLOBALS['xoopsTpl']->assign('articles_result', \sprintf(\_AM_WGTESTMB_BROKEN_RESULT, 'Articles'));
$crArticles->setStart($start);
$crArticles->setLimit($limit);
if ($articlesCount > 0) {
    $articlesAll = $articlesHandler->getAll($crArticles);
    foreach (\array_keys($articlesAll) as $i) {
        $article['table'] = 'Articles';
        $article['key'] = 'art_id';
        $article['keyval'] = $articlesAll[$i]->getVar('art_id');
        $article['main'] = $articlesAll[$i]->getVar('art_title');
        $GLOBALS['xoopsTpl']->append('articles_list', $article);
    }
    // Display Navigation
    if ($articlesCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($articlesCount, $limit, $start, 'startArticles', 'op=list&limitArticles=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav_articles', $pagenav->renderNav());
    }
} else {
    $GLOBALS['xoopsTpl']->assign('nodataArticles', \sprintf(\_AM_WGTESTMB_BROKEN_NODATA, 'Articles'));
}
unset($crArticles);

// Check table testfields
$start = Request::getInt('startTestfields');
$limit = Request::getInt('limitTestfields', $helper->getConfig('adminpager'));
$crTestfields = new \CriteriaCompo();
$crTestfields->add(new \Criteria('tf_status', Constants::STATUS_BROKEN));
$testfieldsCount = $testfieldsHandler->getCount($crTestfields);
$GLOBALS['xoopsTpl']->assign('testfields_count', $testfieldsCount);
$GLOBALS['xoopsTpl']->assign('testfields_result', \sprintf(\_AM_WGTESTMB_BROKEN_RESULT, 'Testfields'));
$crTestfields->setStart($start);
$crTestfields->setLimit($limit);
if ($testfieldsCount > 0) {
    $testfieldsAll = $testfieldsHandler->getAll($crTestfields);
    foreach (\array_keys($testfieldsAll) as $i) {
        $testfield['table'] = 'Testfields';
        $testfield['key'] = 'tf_id';
        $testfield['keyval'] = $testfieldsAll[$i]->getVar('tf_id');
        $testfield['main'] = $testfieldsAll[$i]->getVar('tf_text');
        $GLOBALS['xoopsTpl']->append('testfields_list', $testfield);
    }
    // Display Navigation
    if ($testfieldsCount > $limit) {
        require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($testfieldsCount, $limit, $start, 'startTestfields', 'op=list&limitTestfields=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav_testfields', $pagenav->renderNav());
    }
} else {
    $GLOBALS['xoopsTpl']->assign('nodataTestfields', \sprintf(\_AM_WGTESTMB_BROKEN_NODATA, 'Testfields'));
}
unset($crTestfields);

require __DIR__ . '/footer.php';
