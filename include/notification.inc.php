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
 * comment callback functions
 *
 * @param  $category
 * @param  $item_id
 * @return array item|null
 */
function wgtestmb_notify_iteminfo($category, $item_id)
{
    global $xoopsDB;

    if (!\defined('WGTESTMB_URL')) {
        \define('WGTESTMB_URL', \XOOPS_URL . '/modules/wgtestmb');
    }

    $itemId = (int)$item_id;
    switch ($category) {
        case 'global':
            $item['name'] = '';
            $item['url']  = '';
            return $item;
        case 'articles':
            $sql    = 'SELECT art_title FROM ' . $xoopsDB->prefix('wgtestmb_articles') . ' WHERE art_id = '. $itemId;
            $result = $xoopsDB->query($sql);
            if (!$result) {
                return [];
            }
            $result_array = $xoopsDB->fetchArray($result);
            if (!$result_array) {
                return [];
            }
            $item['name'] = $result_array['art_title'];
            $item['url']  = \WGTESTMB_URL . '/articles.php?art_id=' . $itemId;
            return $item;
        case 'testfields':
            $sql    = 'SELECT tf_text FROM ' . $xoopsDB->prefix('wgtestmb_testfields') . ' WHERE tf_id = '. $itemId;
            $result = $xoopsDB->query($sql);
            if (!$result) {
                return [];
            }
            $result_array = $xoopsDB->fetchArray($result);
            if (!$result_array) {
                return [];
            }
            $item['name'] = $result_array['tf_text'];
            $item['url']  = \WGTESTMB_URL . '/testfields.php?tf_id=' . $itemId;
            return $item;
    }
    return null;
}
