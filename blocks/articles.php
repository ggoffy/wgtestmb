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

use XoopsModules\Wgtestmb;
use XoopsModules\Wgtestmb\Helper;
use XoopsModules\Wgtestmb\Constants;

require_once \XOOPS_ROOT_PATH . '/modules/wgtestmb/include/common.php';

/**
 * Function show block
 * @param  $options
 * @return array
 */
function b_wgtestmb_articles_show($options)
{
    $helper      = Helper::getInstance();
    $utility     = new \XoopsModules\Wgtestmb\Utility();
    $block       = [];
    $typeBlock   = $options[0];
    $limit       = $options[1];
    $lenghtTitle = $options[2];
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    $articlesHandler = $helper->getHandler('Articles');

    $crArticles = new \CriteriaCompo();
    // Criteria for status field
    $crArticles->add(new \Criteria('art_status', Constants::STATUS_OFFLINE, '>'));

    switch ($typeBlock) {
        case 'last':
        default:
            // For the block: articles last
            $crArticles->setSort('art_id');
            $crArticles->setOrder('DESC');
            break;
        case 'new':
            // For the block: articles new
            // New since last week: 7 * 24 * 60 * 60 = 604800
            $crArticles->add(new \Criteria('art_created', \time() - 604800, '>='));
            $crArticles->add(new \Criteria('art_created', \time(), '<='));
            $crArticles->setSort('art_created');
            $crArticles->setOrder('DESC');
            break;
        case 'hits':
            // For the block: articles hits
            // Table articles must have art_hits or you have to change into corresponding field name
            $crArticles->setSort('art_hits');
            $crArticles->setOrder('DESC');
            break;
        case 'top':
            // For the block: articles top
            $crArticles->setSort('art_votes');
            $crArticles->setOrder('DESC');
            break;
        case 'random':
            // For the block: articles random
            $crArticles->setSort('RAND()');
            break;
    }

    $crArticles->setLimit($limit);
    $articlesAll = $articlesHandler->getAll($crArticles);
    unset($crArticles);
    if (\count($articlesAll) > 0) {
        foreach (\array_keys($articlesAll) as $i) {
            $articles = $articlesAll[$i]->getValuesArticles();
            /**
             * If you want to use the parameter for limits you have to adapt the line where it should be applied
             * e.g. change
             *     $block[$i]['title'] = $articlesAll[$i]->getVar('art_title');
             * into
             *     $myTitle = $articlesAll[$i]->getVar('art_title');
             *     if ($limit > 0) {
             *         $myTitle = \substr($myTitle, 0, (int)$limit);
             *     }
             *     $block[$i]['title'] =  $myTitle;
             */
            $block[$i]['id']              = $articles['art_id'];
            $block[$i]['cat']             = $articles['cat'];
            $block[$i]['title']           = $articles['title'];
            $block[$i]['descr_text']      = $articles['descr_text'];
            $block[$i]['descr_short']     = $utility::truncateHtml($block[$i]['descr_text'], $lenghtTitle);
            $block[$i]['img']             = $articles['img'];
            $block[$i]['file']            = $articles['file'];
            $block[$i]['created_text']    = $articles['created_text'];
            $block[$i]['submitter_text']  = $articles['submitter_text'];
        }
    }

    $GLOBALS['xoopsTpl']->assign('wgtestmb_url', \WGTESTMB_URL);
    $GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));

    return $block;

}

/**
 * Function edit block
 * @param  $options
 * @return string
 */
function b_wgtestmb_articles_edit($options)
{
    $GLOBALS['xoopsTpl']->assign('wgtestmb_upload_url', \WGTESTMB_UPLOAD_URL);
    $form = \_MB_WGTESTMB_DISPLAY . ' : ';
    $form .= "<input type='hidden' name='options[0]' value='".$options[0]."' >";
    $form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' >&nbsp;<br>";
    $form .= \_MB_WGTESTMB_TITLE_LENGTH . " : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' ><br><br>";
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);


    /**
     * If you want to filter your results by e.g. a category used in yourarticles
     * then you can activate the following code, but you have to change it according your category
     */
    /*
    $helper = Helper::getInstance();
    $articlesHandler = $helper->getHandler('Articles');
    $crArticles = new \CriteriaCompo();
    $crArticles->add(new \Criteria('art_id', 0, '!='));
    $crArticles->setSort('art_id');
    $crArticles->setOrder('ASC');
    $articlesAll = $articlesHandler->getAll($crArticles);
    unset($crArticles);
    $form .= \_MB_WGTESTMB_ARTICLES_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (!\in_array(0, $options) && !\in_array('0', $options) ? '' : "selected='selected'") . '>' . \_MB_WGTESTMB_ALL_ARTICLES . '</option>';
    foreach (\array_keys($articlesAll) as $i) {
        $art_id = $articlesAll[$i]->getVar('art_id');
        $form .= "<option value='" . $art_id . "' " . (!\in_array($art_id, $options) ? '' : "selected='selected'") . '>' . $articlesAll[$i]->getVar('art_title') . '</option>';
    }
    $form .= '</select>';

    */
    return $form;

}
