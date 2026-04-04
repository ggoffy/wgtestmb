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
function b_wgtestmb_testtable1_show($options)
{
    $helper      = Helper::getInstance();
    $block       = [];
    $typeBlock   = $options[0];
    $limit       = $options[1];
    $lenghtTitle = $options[2];
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    $testtable1Handler = $helper->getHandler('Testtable1');

    $crTesttable1 = new \CriteriaCompo();
    switch ($typeBlock) {
        case 'last':
        default:
            // For the block: testtable1 last
            $crTesttable1->setSort('tt1_id');
            $crTesttable1->setOrder('DESC');
            break;
        case 'new':
            // For the block: testtable1 new
            // New since last week: 7 * 24 * 60 * 60 = 604800
            $crTesttable1->add(new \Criteria('tt1_date', \time() - 604800, '>='));
            $crTesttable1->add(new \Criteria('tt1_date', \time(), '<='));
            $crTesttable1->setSort('tt1_date');
            $crTesttable1->setOrder('DESC');
            break;
        case 'hits':
            // For the block: testtable1 hits
            // Table testtable1 must have tt1_hits or you have to change into corresponding field name
            $crTesttable1->setSort('tt1_hits');
            $crTesttable1->setOrder('DESC');
            break;
        case 'top':
            // For the block: testtable1 top
            // Table testtable1 must have tt1_top or you have to change into corresponding field name
            $crTesttable1->setSort('tt1_top');
            $crTesttable1->setOrder('DESC');
            break;
        case 'random':
            // For the block: testtable1 random
            $crTesttable1->setSort('RAND()');
            break;
    }

    $crTesttable1->setLimit($limit);
    $testtable1All = $testtable1Handler->getAll($crTesttable1);
    unset($crTesttable1);
    if (\count($testtable1All) > 0) {
        foreach (\array_keys($testtable1All) as $i) {
            $testtable1 = $testtable1All[$i]->getValuesTesttable1();
            /**
             * If you want to use the parameter for limits you have to adapt the line where it should be applied
             * e.g. change
             *     $block[$i]['title'] = $testtable1All[$i]->getVar('art_title');
             * into
             *     $myTitle = $testtable1All[$i]->getVar('art_title');
             *     if ($limit > 0) {
             *         $myTitle = \substr($myTitle, 0, (int)$limit);
             *     }
             *     $block[$i]['title'] =  $myTitle;
             */
            $block[$i]['id']        = $testtable1['tt1_id'];
            $block[$i]['name']      = $testtable1['name'];
            $block[$i]['date_text'] = $testtable1['date_text'];
            $block[$i]['comments']  = $testtable1['comments'];
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
function b_wgtestmb_testtable1_edit($options)
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
     * If you want to filter your results by e.g. a category used in yourtesttable1
     * then you can activate the following code, but you have to change it according your category
     */
    /*
    $helper = Helper::getInstance();
    $testtable1Handler = $helper->getHandler('Testtable1');
    $crTesttable1 = new \CriteriaCompo();
    $crTesttable1->add(new \Criteria('tt1_id', 0, '!='));
    $crTesttable1->setSort('tt1_id');
    $crTesttable1->setOrder('ASC');
    $testtable1All = $testtable1Handler->getAll($crTesttable1);
    unset($crTesttable1);
    $form .= \_MB_WGTESTMB_TESTTABLE1_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (!\in_array(0, $options) && !\in_array('0', $options) ? '' : "selected='selected'") . '>' . \_MB_WGTESTMB_ALL_TESTTABLE1 . '</option>';
    foreach (\array_keys($testtable1All) as $i) {
        $tt1_id = $testtable1All[$i]->getVar('tt1_id');
        $form .= "<option value='" . $tt1_id . "' " . (!\in_array($tt1_id, $options) ? '' : "selected='selected'") . '>' . $testtable1All[$i]->getVar('tt1_name') . '</option>';
    }
    $form .= '</select>';

    */
    return $form;

}
