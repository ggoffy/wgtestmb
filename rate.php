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
$op = Request::getCmd('op', 'list');
$source = Request::getInt('source');
switch ($op) {
    case 'list':
    default:
        // default should not happen
        \redirect_header('index.php', 3, \_NOPERM);
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('index.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $rating = Request::getInt('rating');
        $itemid = 0;
        $redir  = \Xmf\Request::getString('HTTP_REFERER', '', 'SERVER');
        if (Constants::TABLE_ARTICLES === $source) {
            $itemid = Request::getInt('art_id');
            $redir = 'articles.php?op=show&art_id=' . $itemid;
        }
        if (Constants::TABLE_TESTFIELDS === $source) {
            $itemid = Request::getInt('tf_id');
            $redir = 'testfields.php?op=show&tf_id=' . $itemid;
        }
        if (0 === (int)$itemid) {
            \redirect_header($redir, 3, \_MA_WGTESTMB_INVALID_PARAM);
        }

        // Check permissions
        $rate_allowed = false;
        $groups = (isset($GLOBALS['xoopsUser']) && \is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->getGroups() : [\XOOPS_GROUP_ANONYMOUS];
        foreach ($groups as $group) {
            if (\XOOPS_GROUP_ADMIN == $group || \in_array($group, $helper->getConfig('ratingbar_groups'))) {
                $rate_allowed = true;
                break;
            }
        }
        if (!$rate_allowed) {
            \redirect_header('index.php', 3, \_MA_WGTESTMB_RATING_NOPERM);
        }

        // Check rating value
        switch ((int)$helper->getConfig('ratingbars')) {
            case Constants::RATING_NONE:
            default:
                \redirect_header('index.php', 3, \_MA_WGTESTMB_RATING_VOTE_BAD);
                exit;
                break;
            case Constants::RATING_LIKES:
                if (!\in_array($rating, [-1, 1], true)) {
                    \redirect_header('index.php', 3, \_MA_WGTESTMB_RATING_VOTE_BAD);
                    exit;
                }
                break;
            case Constants::RATING_5STARS:
                if ($rating > 5 || $rating < 1) {
                    \redirect_header('index.php', 3, \_MA_WGTESTMB_RATING_VOTE_BAD);
                    exit;
                }
                break;
            case Constants::RATING_10STARS:
            case Constants::RATING_10NUM:
                if ($rating > 10 || $rating < 1) {
                    \redirect_header('index.php', 3, \_MA_WGTESTMB_RATING_VOTE_BAD);
                    exit;
                }
                break;
        }

        // Get existing rating
        $itemrating = $ratingsHandler->getItemRating($itemid, $source);

        // Set data rating
        if ($itemrating['voted']) {
            // If yo want to avoid revoting then activate next line
            //\redirect_header('index.php', 3, \_MA_WGTESTMB_RATING_VOTE_BAD);
            $ratingsObj = $ratingsHandler->get($itemrating['id']);
        } else {
            $ratingsObj = $ratingsHandler->create();
        }
        $ratingsObj->setVar('rate_source', $source);
        $ratingsObj->setVar('rate_itemid', $itemid);
        $ratingsObj->setVar('rate_value', $rating);
        $ratingsObj->setVar('rate_uid', $itemrating['uid']);
        $ratingsObj->setVar('rate_ip', $itemrating['ip']);
        $ratingsObj->setVar('rate_date', \time());
        // Insert Data
        if ($ratingsHandler->insert($ratingsObj)) {
            unset($ratingsObj);
            // Calc average rating value
            if (Constants::TABLE_ARTICLES === $source) {
                $sql = '
                    UPDATE ' . $GLOBALS['xoopsDB']->prefix('articles') . ' t
                    LEFT JOIN (
                        SELECT
                            rate_itemid, rate_source, COUNT(*) AS votes, ROUND(AVG(rate_value), 2) AS avg_rating
                        FROM ' . $GLOBALS['xoopsDB']->prefix('ratings') . '
                        GROUP BY rate_itemid, rate_source
                    ) r ON r.rate_itemid = t.art_id and r.rate_source = ' . $source . '
                    SET
                        t.art_votes = COALESCE(r.votes, 0),
                        t.art_ratings = COALESCE(r.avg_rating, 0),
                    WHERE t.art_id = ' . $itemid;
                if ($GLOBALS['xoopsDB']->queryF($sql)) {
                    \redirect_header($redir, 2, \_MA_WGTESTMB_RATING_VOTE_THANKS);
                } else {
                    \redirect_header('articles.php', 3, \_MA_WGTESTMB_RATING_ERROR1);
                }
                unset($articlesObj);
            }
            if (Constants::TABLE_TESTFIELDS === $source) {
                $sql = '
                    UPDATE ' . $GLOBALS['xoopsDB']->prefix('testfields') . ' t
                    LEFT JOIN (
                        SELECT
                            rate_itemid, rate_source, COUNT(*) AS votes, ROUND(AVG(rate_value), 2) AS avg_rating
                        FROM ' . $GLOBALS['xoopsDB']->prefix('ratings') . '
                        GROUP BY rate_itemid, rate_source
                    ) r ON r.rate_itemid = t.tf_id and r.rate_source = ' . $source . '
                    SET
                        t.tf_votes = COALESCE(r.votes, 0),
                        t.tf_ratings = COALESCE(r.avg_rating, 0),
                    WHERE t.tf_id = ' . $itemid;
                if ($GLOBALS['xoopsDB']->queryF($sql)) {
                    \redirect_header($redir, 2, \_MA_WGTESTMB_RATING_VOTE_THANKS);
                } else {
                    \redirect_header('testfields.php', 3, \_MA_WGTESTMB_RATING_ERROR1);
                }
                unset($testfieldsObj);
            }

            \redirect_header('index.php', 2, \_MA_WGTESTMB_INVALID_PARAM);
        }
        // Get Error
        echo 'Error: ' . $ratingsObj->getHtmlErrors();
        break;
}
require __DIR__ . '/footer.php';
