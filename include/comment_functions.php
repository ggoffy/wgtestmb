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

/**
 * CommentsUpdate
 *
 * @param mixed  $itemId
 * @param mixed  $itemNumb
 * @return bool
 */
function wgtestmbCommentsUpdate($itemId, $itemNumb)
{
    // Get instance of module
    $helper = \XoopsModules\Wgtestmb\Helper::getInstance();
    $testfieldsHandler = $helper->getHandler('Testfields');
    $tfId = (int)$itemId;
    $testfieldsObj = $testfieldsHandler->get($tfId);
    if (!\is_object($testfieldsObj)) {
        \redirect_header('testfields.php', 3, \_MA_WGTESTMB_INVALID_PARAM);
    }
    $testfieldsObj->setVar('tf_comments', (int)$itemNumb);
    if ($testfieldsHandler->insert($testfieldsObj)) {
        return true;
    }
    return false;
}

/**
 * CommentsApprove
 *
 * @param mixed $comment
 * @return bool
 */
function wgtestmbCommentsApprove($comment)
{
    // Notification event
    // Get instance of module
    $helper = \XoopsModules\Wgtestmb\Helper::getInstance();
    $testfieldsHandler = $helper->getHandler('Testfields');
    $tfId = (int)$comment->getVar('com_itemid');
    $testfieldsObj = $testfieldsHandler->get($tfId);
    if (!\is_object($testfieldsObj)) {
        \redirect_header('testfields.php', 3, \_MA_WGTESTMB_INVALID_PARAM);
    }
    $tfText = $testfieldsObj->getVar('tf_text');

    $tags = [];
    $tags['ITEM_NAME'] = $tfText;
    $tags['ITEM_URL']  = \XOOPS_URL . '/modules/wgtestmb/testfields.php?op=show&tf_id=' . $tfId;
    $notificationHandler = \xoops_getHandler('notification');
    // Event modify notification
    $notificationHandler->triggerEvent('global', 0, 'global_comment', $tags);
    $notificationHandler->triggerEvent('testfields', $tfId, 'testfield_comment', $tags);
    return true;

}
