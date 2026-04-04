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
$tfId = Request::getInt('tf_id');
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
if (0 == $tfId) {
    \redirect_header(\WGTESTMB_URL . '/index.php', 2, \_MA_WGTESTMB_INVALID_PARAM);
}
// Get Instance of Handler
$testfieldsHandler = $helper->getHandler('Testfields');
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
$testfieldsObj = $testfieldsHandler->get($tfId);
if (!\is_object($testfieldsObj)) {
    \redirect_header('testfields.php', 3, \_MA_WGTESTMB_INVALID_PARAM);
}
// Verify permissions
if (!$grouppermHandler->checkRight('wgtestmb_view_testfields', $testfieldsObj->getVar('tf_id'), $my_group_ids, $GLOBALS['xoopsModule']->getVar('mid'))) {
    \redirect_header(\WGTESTMB_URL . '/index.php', 3, \_NOPERM);
    exit();
}
$testfieldList = $testfieldsObj->getValuesTestfields();
$GLOBALS['xoopsTpl']->append('testfields_list', $testfieldList);

$GLOBALS['xoopsTpl']->assign('xoops_sitename', $GLOBALS['xoopsConfig']['sitename']);
$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($testfieldsObj->getVar('tf_text') . ' - ' . \_MA_WGTESTMB_PRINT . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));
$GLOBALS['xoopsTpl']->display('db:wgtestmb_testfields_print.tpl');
