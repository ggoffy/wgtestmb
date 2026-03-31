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
function b_wgtestmb_articles_spotlight_show($options)
{
    $block       = [];
//    $typeBlock   = $options[0];
    $limit       = $options[1];
//    $lenghtTitle   = $options[2];
    $helper      = Helper::getInstance();
    $utility       = new \XoopsModules\Wgtestmb\Utility();
    $editorMaxchar = $helper->getConfig('editor_maxchar');
    $articlesHandler = $helper->getHandler('Articles');
    $crArticles = new \CriteriaCompo();
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    // Criteria for status field
    $crArticles->add(new \Criteria('art_status', Constants::STATUS_OFFLINE, '>'));

    if (\count($options) > 0 && (int)$options[0] > 0) {
        $crArticles->add(new \Criteria('art_id', '(' . \implode(',', $options) . ')', 'IN'));
        $limit = 0;
    }

    $crArticles->setSort('art_id');
    $crArticles->setOrder('DESC');
    $crArticles->setLimit($limit);
    $articlesAll = $articlesHandler->getAll($crArticles);
    unset($crArticles);
    if (\count($articlesAll) > 0) {
        foreach (\array_keys($articlesAll) as $i) {
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
            $block[$i]['id'] = $articlesAll[$i]->getVar('art_id');
            $block[$i]['cat'] = $articlesAll[$i]->getVar('art_cat');
            $block[$i]['title'] = \htmlspecialchars($articlesAll[$i]->getVar('art_title'), ENT_QUOTES | ENT_HTML5);
            $block[$i]['descr_text'] = $articlesAll[$i]->getVar('art_descr', 'e');
            $block[$i]['descr_short'] = $utility::truncateHtml($articlesAll[$i]->getVar('art_descr', 'e'), $editorMaxchar);
            $block[$i]['img'] = $articlesAll[$i]->getVar('art_img');
            $block[$i]['file'] = $articlesAll[$i]->getVar('art_file');
            $block[$i]['created_text'] = \formatTimestamp($articlesAll[$i]->getVar('art_created'));
            $block[$i]['submitter_text'] = \XoopsUser::getUnameFromId($articlesAll[$i]->getVar('art_submitter'));
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
function b_wgtestmb_articles_spotlight_edit($options)
{
    $helper = Helper::getInstance();
    $articlesHandler = $helper->getHandler('Articles');
    $GLOBALS['xoopsTpl']->assign('wgtestmb_upload_url', \WGTESTMB_UPLOAD_URL);
    $form = \_MB_WGTESTMB_DISPLAY_SPOTLIGHT . ' : ';
    $form .= "<input type='hidden' name='options[0]' value='".$options[0]."' >";
    $form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' >&nbsp;<br>";
    $form .= \_MB_WGTESTMB_TITLE_LENGTH . " : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' ><br><br>";
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

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
        $art_title = \htmlspecialchars((string)$articlesAll[$i]->getVar('art_title'), ENT_QUOTES | ENT_HTML5);
        $form .= "<option value='" . $art_id . "' " . (!\in_array($art_id, $options) ? '' : "selected='selected'") . '>' . $art_title . '</option>';
    }
    $form .= '</select>';

    return $form;

}
