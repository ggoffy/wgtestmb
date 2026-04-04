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
require_once \XOOPS_ROOT_PATH . '/header.php';
$artId = Request::getInt('art_id');
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
if (0 == $artId) {
    \redirect_header(\WGTESTMB_URL . '/index.php', 2, \_MA_WGTESTMB_INVALID_PARAM);
}
// Get Instance of Handler
$articlesHandler = $helper->getHandler('Articles');
$currentuid = 0;
if (isset($xoopsUser) && \is_object($xoopsUser)) {
    $currentuid = $xoopsUser->uid();
}
$grouppermHandler = \xoops_getHandler('groupperm');
$memberHandler = \xoops_getHandler('member');
if ($currentuid === 0) {
    $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
} else {
    $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
}
// Verify that the article is published
$articlesObj = $articlesHandler->get($artId);
if (!\is_object($articlesObj)) {
    \redirect_header('articles.php', 3, \_MA_WGTESTMB_INVALID_PARAM);
}
// Verify permissions
if (!$grouppermHandler->checkRight('wgtestmb_view_articles', $articlesObj->getVar('art_id'), $my_group_ids, $GLOBALS['xoopsModule']->getVar('mid'))) {
    \redirect_header(\WGTESTMB_URL . '/index.php', 3, \_NOPERM);
    exit();
}
$articleList = $articlesObj->getValuesArticles();
$GLOBALS['xoopsTpl']->append('articles_list', $articleList);

$GLOBALS['xoopsTpl']->assign('xoops_sitename', $GLOBALS['xoopsConfig']['sitename']);
$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($articlesObj->getVar('art_title') . ' - ' . \_MA_WGTESTMB_PRINT . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));
$GLOBALS['xoopsTpl']->display('db:wgtestmb_articles_print.tpl');
