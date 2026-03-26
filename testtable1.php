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
use XoopsModules\Wgtestmb\Common;

require __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wgtestmb_testtable1.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$tt1Id = Request::getInt('tt1_id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('userpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
// Keywords
$keywords = [];
// Breadcrumbs
$xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_INDEX, 'link' => 'index.php'];
// Permissions
$GLOBALS['xoopsTpl']->assign('showItem', $tt1Id > 0);

switch ($op) {
    case 'show':
    case 'list':
    default:
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_TESTTABLE1_LIST];
        $crTesttable1 = new \CriteriaCompo();
        if ($tt1Id > 0) {
            $crTesttable1->add(new \Criteria('tt1_id', $tt1Id));
        }
        $testtable1Count = $testtable1Handler->getCount($crTesttable1);
        $GLOBALS['xoopsTpl']->assign('testtable1Count', $testtable1Count);
        if (0 === $tt1Id) {
            $crTesttable1->setStart($start);
            $crTesttable1->setLimit($limit);
        }
        $testtable1All = $testtable1Handler->getAll($crTesttable1);
        if ($testtable1Count > 0) {
            $testtable1List = [];
            $tt1Name = '';
            // Get All Testtable1
            foreach (\array_keys($testtable1All) as $i) {
                $testtable1List[$i] = $testtable1All[$i]->getValuesTesttable1();
                $tt1Name = $testtable1All[$i]->getVar('tt1_name');
                $keywords[$i] = $tt1Name;
            }
            $GLOBALS['xoopsTpl']->assign('testtable1_list', $testtable1List);
            unset($testtable1List);
            // Display Navigation
            if ($testtable1Count > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($testtable1Count, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
            $GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
            $GLOBALS['xoopsTpl']->assign('panel_type', $helper->getConfig('panel_type'));
            $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
            $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
            if ('show' == $op && '' != $tt1Name) {
                $GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($tt1Name . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));
            }
        }
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('testtable1.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($tt1Id > 0) {
            $testtable1Obj = $testtable1Handler->get($tt1Id);
        } else {
            $testtable1Obj = $testtable1Handler->create();
        }
        $testtable1Obj->setVar('tt1_name', Request::getString('tt1_name'));
        $testtable1DateObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('tt1_date'));
        $testtable1Obj->setVar('tt1_date', $testtable1DateObj->getTimestamp());
        $testtable1Obj->setVar('tt1_status', Request::getInt('tt1_status'));
        $testtable1Obj->setVar('tt1_comments', Request::getInt('tt1_comments'));
        // Insert Data
        if ($testtable1Handler->insert($testtable1Obj)) {
            // redirect after insert
                \redirect_header('testtable1.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_MA_WGTESTMB_FORM_OK);
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $testtable1Obj->getHtmlErrors());
        $form = $testtable1Obj->getFormTesttable1();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_TESTTABLE1_ADD];
        // Form Create
        $testtable1Obj = $testtable1Handler->create();
        $form = $testtable1Obj->getFormTesttable1();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_TESTTABLE1_EDIT];
        // Check params
        if (0 == $tt1Id) {
            \redirect_header('testtable1.php?op=list', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
        // Get Form
        $testtable1Obj = $testtable1Handler->get($tt1Id);
        $testtable1Obj->start = $start;
        $testtable1Obj->limit = $limit;
        $form = $testtable1Obj->getFormTesttable1();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_TESTTABLE1_CLONE];
        // Request source
        $tt1IdSource = Request::getInt('tt1_id_source');
        // Check params
        if (0 == $tt1IdSource) {
            \redirect_header('testtable1.php?op=list', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
        // Get Form
        $testtable1ObjSource = $testtable1Handler->get($tt1IdSource);
        $testtable1Obj = $testtable1ObjSource->xoopsClone();
        $form = $testtable1Obj->getFormTesttable1();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_TESTTABLE1_DELETE];
        // Check params
        if (0 == $tt1Id) {
            \redirect_header('testtable1.php?op=list', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
        $testtable1Obj = $testtable1Handler->get($tt1Id);
        $tt1Name = $testtable1Obj->getVar('tt1_name');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('testtable1.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($testtable1Handler->delete($testtable1Obj)) {
                \redirect_header('testtable1.php', 3, \_MA_WGTESTMB_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $testtable1Obj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'tt1_id' => $tt1Id, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_WGTESTMB_FORM_SURE_DELETE, $tt1Name));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}

// Meta keywords
wgtestmbMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

require __DIR__ . '/footer.php';
