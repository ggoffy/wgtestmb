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
function b_wgtestmb_testfields_show($options)
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

    $testfieldsHandler = $helper->getHandler('Testfields');

    $crTestfields = new \CriteriaCompo();
    // Criteria for status field
    $crTestfields->add(new \Criteria('tf_status', Constants::STATUS_OFFLINE, '>'));

    switch ($typeBlock) {
        case 'last':
        default:
            // For the block: testfields last
            $crTestfields->setSort('tf_id');
            $crTestfields->setOrder('DESC');
            break;
        case 'new':
            // For the block: testfields new
            // New since last week: 7 * 24 * 60 * 60 = 604800
            $crTestfields->add(new \Criteria('tf_datetime', \time() - 604800, '>='));
            $crTestfields->add(new \Criteria('tf_datetime', \time(), '<='));
            $crTestfields->setSort('tf_datetime');
            $crTestfields->setOrder('DESC');
            break;
        case 'hits':
            // For the block: testfields hits
            // Table testfields must have tf_hits or you have to change into corresponding field name
            $crTestfields->setSort('tf_hits');
            $crTestfields->setOrder('DESC');
            break;
        case 'top':
            // For the block: testfields top
            $crTestfields->setSort('tf_votes');
            $crTestfields->setOrder('DESC');
            break;
        case 'random':
            // For the block: testfields random
            $crTestfields->setSort('RAND()');
            break;
    }

    $crTestfields->setLimit($limit);
    $testfieldsAll = $testfieldsHandler->getAll($crTestfields);
    unset($crTestfields);
    if (\count($testfieldsAll) > 0) {
        foreach (\array_keys($testfieldsAll) as $i) {
            $testfields = $testfieldsAll[$i]->getValuesTestfields();
            /**
             * If you want to use the parameter for limits you have to adapt the line where it should be applied
             * e.g. change
             *     $block[$i]['title'] = $testfieldsAll[$i]->getVar('art_title');
             * into
             *     $myTitle = $testfieldsAll[$i]->getVar('art_title');
             *     if ($limit > 0) {
             *         $myTitle = \substr($myTitle, 0, (int)$limit);
             *     }
             *     $block[$i]['title'] =  $myTitle;
             */
            $block[$i]['id']    = $testfields['tf_id'];
            $block[$i]['text']  = $testfields['text'];
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
function b_wgtestmb_testfields_edit($options)
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
     * If you want to filter your results by e.g. a category used in yourtestfields
     * then you can activate the following code, but you have to change it according your category
     */
    /*
    $helper = Helper::getInstance();
    $testfieldsHandler = $helper->getHandler('Testfields');
    $crTestfields = new \CriteriaCompo();
    $crTestfields->add(new \Criteria('tf_id', 0, '!='));
    $crTestfields->setSort('tf_id');
    $crTestfields->setOrder('ASC');
    $testfieldsAll = $testfieldsHandler->getAll($crTestfields);
    unset($crTestfields);
    $form .= \_MB_WGTESTMB_TESTFIELDS_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (!\in_array(0, $options) && !\in_array('0', $options) ? '' : "selected='selected'") . '>' . \_MB_WGTESTMB_ALL_TESTFIELDS . '</option>';
    foreach (\array_keys($testfieldsAll) as $i) {
        $tf_id = $testfieldsAll[$i]->getVar('tf_id');
        $form .= "<option value='" . $tf_id . "' " . (!\in_array($tf_id, $options) ? '' : "selected='selected'") . '>' . $testfieldsAll[$i]->getVar('tf_text') . '</option>';
    }
    $form .= '</select>';

    */
    return $form;

}
