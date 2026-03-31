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
// Get all request values
$op    = Request::getCmd('op', 'list');
$tt1Id = Request::getInt('tt1_id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'wgtestmb_admin_testtable1.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testtable1.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_ADD_TESTTABLE1, 'testtable1.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $testtable1Count = $testtable1Handler->getCountTesttable1();
        $testtable1All = $testtable1Handler->getAllTesttable1($start, $limit);
        $GLOBALS['xoopsTpl']->assign('testtable1_count', $testtable1Count);
        $GLOBALS['xoopsTpl']->assign('wgtestmb_url', \WGTESTMB_URL);
        $GLOBALS['xoopsTpl']->assign('wgtestmb_upload_url', \WGTESTMB_UPLOAD_URL);
        // Table view testtable1
        if ($testtable1Count > 0) {
            foreach (\array_keys($testtable1All) as $i) {
                $testtable1 = $testtable1All[$i]->getValuesTesttable1();
                $GLOBALS['xoopsTpl']->append('testtable1_list', $testtable1);
                unset($testtable1);
            }
            // Display Navigation
            if ($testtable1Count > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($testtable1Count, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGTESTMB_THEREARENT_TESTTABLE1);
        }
        break;
    case 'new':
        $templateMain = 'wgtestmb_admin_testtable1.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testtable1.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_LIST_TESTTABLE1, 'testtable1.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $testtable1Obj = $testtable1Handler->create();
        $form = $testtable1Obj->getFormTesttable1();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'wgtestmb_admin_testtable1.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testtable1.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_LIST_TESTTABLE1, 'testtable1.php', 'list');
        $adminObject->addItemButton(\_AM_WGTESTMB_ADD_TESTTABLE1, 'testtable1.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $tt1IdSource = Request::getInt('tt1_id_source');
        // Check params
        if (0 === $tt1IdSource) {
            \redirect_header('testtable1.php?op=list', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        // Get Form
        $testtable1ObjSource = $testtable1Handler->get($tt1IdSource);
        if (!\is_object($testtable1ObjSource)) {
            \redirect_header('testtable1.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        $testtable1Obj = $testtable1ObjSource->xoopsClone();
        $form = $testtable1Obj->getFormTesttable1();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        $templateMain = 'wgtestmb_admin_testtable1.tpl';
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('testtable1.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($tt1Id > 0) {
            $testtable1Obj = $testtable1Handler->get($tt1Id);
        } else {
            $testtable1Obj = $testtable1Handler->create();
        }
        if (!\is_object($testtable1Obj)) {
            \redirect_header('testtable1.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        // Set Vars
        $testtable1Obj->setVar('tt1_name', Request::getString('tt1_name'));
        $testtable1DateObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('tt1_date'));
        if (false === $testtable1DateObj) {
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGTESTMB_INVALID_DATE);
            $form = $testtable1Obj->getFormTesttable1();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
            break;
        }
        $testtable1Obj->setVar('tt1_date', $testtable1DateObj->getTimestamp());
        $testtable1Obj->setVar('tt1_status', Request::getInt('tt1_status'));
        $testtable1Obj->setVar('tt1_comments', Request::getInt('tt1_comments'));
        // Insert Data
        if ($testtable1Handler->insert($testtable1Obj)) {
            $savedTt1Id = $tt1Id > 0 ? $tt1Id : $testtable1Obj->getNewInsertedIdTesttable1();
                \redirect_header('testtable1.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_WGTESTMB_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $testtable1Obj->getHtmlErrors());
        $form = $testtable1Obj->getFormTesttable1();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'wgtestmb_admin_testtable1.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testtable1.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_ADD_TESTTABLE1, 'testtable1.php?op=new');
        $adminObject->addItemButton(\_AM_WGTESTMB_LIST_TESTTABLE1, 'testtable1.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $testtable1Obj = $testtable1Handler->get($tt1Id);
        if (!\is_object($testtable1Obj)) {
            \redirect_header('testtable1.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        $testtable1Obj->start = $start;
        $testtable1Obj->limit = $limit;
        $form = $testtable1Obj->getFormTesttable1();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'wgtestmb_admin_testtable1.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testtable1.php'));
        $testtable1Obj = $testtable1Handler->get($tt1Id);
        if (!\is_object($testtable1Obj)) {
            \redirect_header('testtable1.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        $tt1Name = $testtable1Obj->getVar('tt1_name');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('testtable1.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($testtable1Handler->delete($testtable1Obj)) {
                \redirect_header('testtable1.php', 3, \_AM_WGTESTMB_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $testtable1Obj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'tt1_id' => $tt1Id, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_WGTESTMB_FORM_SURE_DELETE, $tt1Name));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}
require __DIR__ . '/footer.php';
