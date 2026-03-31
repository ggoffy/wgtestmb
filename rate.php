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
            $redir = 'articles.php?op=show&amp;art_id=' . $itemid;
        }
        if (Constants::TABLE_TESTFIELDS === $source) {
            $itemid = Request::getInt('tf_id');
            $redir = 'testfields.php?op=show&amp;tf_id=' . $itemid;
        }

        // Check permissions
        $rate_allowed = false;
        $groups = (isset($GLOBALS['xoopsUser']) && \is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->getGroups() : \XOOPS_GROUP_ANONYMOUS;
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
                if ($rating > 1 || $rating < -1) {
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
            $nb_ratings     = 0;
            $avg_rate_value = 0;
            $current_rating = 0;
            $crRatings = new \CriteriaCompo();
            $crRatings->add(new \Criteria('rate_source', $source));
            $crRatings->add(new \Criteria('rate_itemid', $itemid));
            $ratingsCount = $ratingsHandler->getCount($crRatings);
            $ratingsAll = $ratingsHandler->getAll($crRatings);
            foreach (\array_keys($ratingsAll) as $i) {
                $current_rating += $ratingsAll[$i]->getVar('rate_value');
            }
            unset($ratingsAll);
            if ($ratingsCount > 0) {
                $avg_rate_value = number_format($current_rating / $ratingsCount, 2);
            }
            // Update related table
            if (Constants::TABLE_ARTICLES === $source) {
                $articlesObj = $articlesHandler->get($itemid);
                $articlesObj->setVar('art_ratings', $avg_rate_value);
                $articlesObj->setVar('art_votes', $ratingsCount);
                if ($articlesHandler->insert($articlesObj)) {
                    \redirect_header($redir, 2, \_MA_WGTESTMB_RATING_VOTE_THANKS);
                } else {
                    \redirect_header('articles.php', 3, \_MA_WGTESTMB_RATING_ERROR1);
                }
                unset($articlesObj);
            }
            if (Constants::TABLE_TESTFIELDS === $source) {
                $testfieldsObj = $testfieldsHandler->get($itemid);
                $testfieldsObj->setVar('tf_ratings', $avg_rate_value);
                $testfieldsObj->setVar('tf_votes', $ratingsCount);
                if ($testfieldsHandler->insert($testfieldsObj)) {
                    \redirect_header($redir, 2, \_MA_WGTESTMB_RATING_VOTE_THANKS);
                } else {
                    \redirect_header('testfields.php', 3, \_MA_WGTESTMB_RATING_ERROR1);
                }
                unset($testfieldsObj);
            }

            \redirect_header('index.php', 2, \_MA_WGTESTMB_RATING_VOTE_THANKS);
        }
        // Get Error
        echo 'Error: ' . $ratingsObj->getHtmlErrors();
        break;
}
require __DIR__ . '/footer.php';
