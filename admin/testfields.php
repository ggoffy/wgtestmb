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
$tfId  = Request::getInt('tf_id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'wgtestmb_admin_testfields.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testfields.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_ADD_TESTFIELD, 'testfields.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $testfieldsCount = $testfieldsHandler->getCountTestfields();
        $testfieldsAll = $testfieldsHandler->getAllTestfields($start, $limit);
        $GLOBALS['xoopsTpl']->assign('testfields_count', $testfieldsCount);
        $GLOBALS['xoopsTpl']->assign('wgtestmb_url', \WGTESTMB_URL);
        $GLOBALS['xoopsTpl']->assign('wgtestmb_upload_url', \WGTESTMB_UPLOAD_URL);
        // Table view testfields
        if ($testfieldsCount > 0) {
            foreach (\array_keys($testfieldsAll) as $i) {
                $testfield = $testfieldsAll[$i]->getValuesTestfields();
                $GLOBALS['xoopsTpl']->append('testfields_list', $testfield);
                unset($testfield);
            }
            // Display Navigation
            if ($testfieldsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($testfieldsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGTESTMB_THEREARENO_TESTFIELDS);
        }
        break;
    case 'new':
        $templateMain = 'wgtestmb_admin_testfields.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testfields.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_LIST_TESTFIELDS, 'testfields.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $testfieldsObj = $testfieldsHandler->create();
        $form = $testfieldsObj->getFormTestfields();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'wgtestmb_admin_testfields.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testfields.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_LIST_TESTFIELDS, 'testfields.php', 'list');
        $adminObject->addItemButton(\_AM_WGTESTMB_ADD_TESTFIELD, 'testfields.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $tfIdSource = Request::getInt('tf_id_source');
        // Check params
        if (0 === $tfIdSource) {
            \redirect_header('testfields.php?op=list', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        // Get Form
        $testfieldsObjSource = $testfieldsHandler->get($tfIdSource);
        if (!\is_object($testfieldsObjSource)) {
            \redirect_header('testfields.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        $testfieldsObj = $testfieldsObjSource->xoopsClone();
        $form = $testfieldsObj->getFormTestfields();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        $templateMain = 'wgtestmb_admin_testfields.tpl';
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('testfields.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($tfId > 0) {
            $testfieldsObj = $testfieldsHandler->get($tfId);
        } else {
            $testfieldsObj = $testfieldsHandler->create();
        }
        if (!\is_object($testfieldsObj)) {
            \redirect_header('testfields.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        // Set Vars
        $uploaderErrors = '';
        $testfieldsObj->setVar('tf_text', Request::getString('tf_text'));
        $testfieldsObj->setVar('tf_textarea', Request::getString('tf_textarea'));
        $testfieldsObj->setVar('tf_dhtml', Request::getText('tf_dhtml'));
        $testfieldsObj->setVar('tf_checkbox', Request::getInt('tf_checkbox'));
        $testfieldsObj->setVar('tf_yesno', Request::getInt('tf_yesno'));
        $testfieldsObj->setVar('tf_selectbox', Request::getInt('tf_selectbox'));
        $testfieldsObj->setVar('tf_user', Request::getInt('tf_user'));
        $testfieldsObj->setVar('tf_color', Request::getString('tf_color'));
        // Set Var tf_imagelist
        require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploader = new \XoopsMediaUploader(\XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32', 
                                                    $helper->getConfig('mimetypes_image'), 
                                                    $helper->getConfig('maxsize_image'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
            //$uploader->setPrefix(tf_imagelist_);
            //$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
            if ($uploader->upload()) {
                $testfieldsObj->setVar('tf_imagelist', $uploader->getSavedFileName());
            } else {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
        } else {
            $testfieldsObj->setVar('tf_imagelist', Request::getString('tf_imagelist'));
        }
        $testfieldsObj->setVar('tf_urlfile', formatURL($_REQUEST['tf_urlfile']));
        // Set Var tf_urlfile
        $filename = $_FILES['tf_urlfile']['name'];
        if ('' !== (string)$filename) {
            require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
            $imgNameDef = Request::getString('tf_text');
            $uploader = new \XoopsMediaUploader(\WGTESTMB_UPLOAD_FILES_PATH . '/testfields/', 
                                                    $helper->getConfig('mimetypes_file'), 
                                                    $helper->getConfig('maxsize_file'), null, null);
            if ($uploader->fetchMedia($_POST['xoops_upload_file'][1])) {
                $extension = \pathinfo($filename, \PATHINFO_EXTENSION);
                $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
                $uploader->setPrefix($imgName);
                if ($uploader->upload()) {
                    $testfieldsObj->setVar('tf_urlfile', $uploader->getSavedFileName());
                } else {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
            } else {
                if ($filename > '') {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
                $testfieldsObj->setVar('tf_urlfile', Request::getString('tf_urlfile'));
            }
        } else {
            $testfieldsObj->setVar('tf_urlfile', Request::getString('tf_urlfile'));
        }
        // Set Var tf_uplimage
        $filename = $_FILES['tf_uplimage']['name'];
        if ('' !== (string)$filename) {
            require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
            $imgMimetype    = $_FILES['tf_uplimage']['type'];
            $imgNameDef     = Request::getString('tf_text');
            $uploader = new \XoopsMediaUploader(\WGTESTMB_UPLOAD_IMAGE_PATH . '/testfields/', 
                                                    $helper->getConfig('mimetypes_image'), 
                                                    $helper->getConfig('maxsize_image'), null, null);
            if ($uploader->fetchMedia($_POST['xoops_upload_file'][2])) {
                $extension = \pathinfo($filename, \PATHINFO_EXTENSION);
                $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
                $uploader->setPrefix($imgName);
                if ($uploader->upload()) {
                    $savedFilename = $uploader->getSavedFileName();
                    $maxwidth  = (int)$helper->getConfig('maxwidth_image');
                    $maxheight = (int)$helper->getConfig('maxheight_image');
                    if ($maxwidth > 0 && $maxheight > 0) {
                    // Resize image
                        $imgHandler                = new Common\Resizer();
                        $imgHandler->sourceFile    = \WGTESTMB_UPLOAD_IMAGE_PATH . '/testfields/' . $savedFilename;
                        $imgHandler->endFile       = \WGTESTMB_UPLOAD_IMAGE_PATH . '/testfields/' . $savedFilename;
                        $imgHandler->imageMimetype = $imgMimetype;
                        $imgHandler->maxWidth      = $maxwidth;
                        $imgHandler->maxHeight     = $maxheight;
                        $result                    = $imgHandler->resizeImage();
                    }
                    $testfieldsObj->setVar('tf_uplimage', $savedFilename);
                } else {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
            } else {
                if ($filename > '') {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
                $testfieldsObj->setVar('tf_uplimage', Request::getString('tf_uplimage'));
            }
        } else {
            $testfieldsObj->setVar('tf_uplimage', Request::getString('tf_uplimage'));
        }
        // Set Var tf_uplfile
        $filename = $_FILES['tf_uplfile']['name'];
        if ('' !== (string)$filename) {
            require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
            $imgNameDef = Request::getString('tf_text');
            $uploader = new \XoopsMediaUploader(\WGTESTMB_UPLOAD_FILES_PATH . '/testfields/', 
                                                    $helper->getConfig('mimetypes_file'), 
                                                    $helper->getConfig('maxsize_file'), null, null);
            if ($uploader->fetchMedia($_POST['xoops_upload_file'][3])) {
                $extension = \pathinfo($filename, \PATHINFO_EXTENSION);
                $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
                $uploader->setPrefix($imgName);
                if ($uploader->upload()) {
                    $testfieldsObj->setVar('tf_uplfile', $uploader->getSavedFileName());
                } else {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
            } else {
                if ($filename > '') {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
                $testfieldsObj->setVar('tf_uplfile', Request::getString('tf_uplfile'));
            }
        } else {
            $testfieldsObj->setVar('tf_uplfile', Request::getString('tf_uplfile'));
        }
        $testfieldTextdateselectObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('tf_textdateselect'));
        if (false === $testfieldTextdateselectObj) {
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGTESTMB_INVALID_DATE);
            $form = $testfieldsObj->getFormTestfields();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
            break;
        }
        $testfieldsObj->setVar('tf_textdateselect', $testfieldTextdateselectObj->getTimestamp());
        // Set Var tf_selectfile
        $filename = $_FILES['tf_selectfile']['name'];
        if ('' !== (string)$filename) {
            require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
            $imgNameDef = Request::getString('tf_text');
            $uploader = new \XoopsMediaUploader(\WGTESTMB_UPLOAD_FILES_PATH . '/testfields/', 
                                                    $helper->getConfig('mimetypes_file'), 
                                                    $helper->getConfig('maxsize_file'), null, null);
            if ($uploader->fetchMedia($_POST['xoops_upload_file'][4])) {
                $extension = \pathinfo($filename, \PATHINFO_EXTENSION);
                $imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
                $uploader->setPrefix($imgName);
                if ($uploader->upload()) {
                    $testfieldsObj->setVar('tf_selectfile', $uploader->getSavedFileName());
                } else {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
            } else {
                if ($filename > '') {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
                $testfieldsObj->setVar('tf_selectfile', Request::getString('tf_selectfile'));
            }
        } else {
            $testfieldsObj->setVar('tf_selectfile', Request::getString('tf_selectfile'));
        }
        $tfPassword = Request::getString('tf_password');
        if ('' !== $tfPassword) {
            $testfieldsObj->setVar('tf_password', password_hash($tfPassword, PASSWORD_DEFAULT));
        }
        $testfieldsObj->setVar('tf_country_list', Request::getString('tf_country_list'));
        $testfieldsObj->setVar('tf_language', Request::getString('tf_language'));
        $testfieldsObj->setVar('tf_radio', Request::getInt('tf_radio'));
        $testfieldsObj->setVar('tf_status', Request::getInt('tf_status'));
        $testfieldDatetimeArr = Request::getArray('tf_datetime');
        if (!isset($testfieldDatetimeArr['date']) || !isset($testfieldDatetimeArr['time'])) {
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGTESTMB_INVALID_DATE);
            $form = $testfieldsObj->getFormTestfields();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
            break;
        }
        $testfieldDatetimeObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $testfieldDatetimeArr['date']);
        if (false === $testfieldDatetimeObj) {
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGTESTMB_INVALID_DATE);
            $form = $testfieldsObj->getFormTestfields();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
            break;
        }
        $testfieldDatetimeObj->setTime(0, 0, 0);
        $testfieldDatetime = $testfieldDatetimeObj->getTimestamp() + (int)$testfieldDatetimeArr['time'];
        $testfieldsObj->setVar('tf_datetime', $testfieldDatetime);
        $testfieldsObj->setVar('tf_combobox', Request::getInt('tf_combobox'));
        $testfieldsObj->setVar('tf_comments', Request::getInt('tf_comments'));
        $testfieldsObj->setVar('tf_ratings', Request::getFloat('tf_ratings'));
        $testfieldsObj->setVar('tf_votes', Request::getInt('tf_votes'));
        $testfieldsObj->setVar('tf_uuid', Request::getString('tf_uuid'));
        $testfieldsObj->setVar('tf_ip', Request::getString('tf_ip'));
        $testfieldsObj->setVar('tf_reads', Request::getInt('tf_reads'));
        // Insert Data
        if ($testfieldsHandler->insert($testfieldsObj)) {
            $savedTfId = $tfId > 0 ? $tfId : $testfieldsObj->getNewInsertedIdTestfields();
            $permId = $savedTfId;
            $grouppermHandler = \xoops_getHandler('groupperm');
            $mid = $GLOBALS['xoopsModule']->getVar('mid');
            // Permission to view_testfields
            $grouppermHandler->deleteByModule($mid, 'wgtestmb_view_testfields', $permId);
            if (isset($_POST['groups_view_testfields'])) {
                foreach ($_POST['groups_view_testfields'] as $onegroupId) {
                    $grouppermHandler->addRight('wgtestmb_view_testfields', $permId, $onegroupId, $mid);
                }
            }
            // Permission to submit_testfields
            $grouppermHandler->deleteByModule($mid, 'wgtestmb_submit_testfields', $permId);
            if (isset($_POST['groups_submit_testfields'])) {
                foreach ($_POST['groups_submit_testfields'] as $onegroupId) {
                    $grouppermHandler->addRight('wgtestmb_submit_testfields', $permId, $onegroupId, $mid);
                }
            }
            // Permission to approve_testfields
            $grouppermHandler->deleteByModule($mid, 'wgtestmb_approve_testfields', $permId);
            if (isset($_POST['groups_approve_testfields'])) {
                foreach ($_POST['groups_approve_testfields'] as $onegroupId) {
                    $grouppermHandler->addRight('wgtestmb_approve_testfields', $permId, $onegroupId, $mid);
                }
            }
            if ('' !== $uploaderErrors) {
                \redirect_header('testfields.php?op=edit&tf_id=' . $savedTfId, 5, $uploaderErrors);
            } else {
                \redirect_header('testfields.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGTESTMB_FORM_OK);
            }
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $testfieldsObj->getHtmlErrors());
        $form = $testfieldsObj->getFormTestfields();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'wgtestmb_admin_testfields.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testfields.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_ADD_TESTFIELD, 'testfields.php?op=new');
        $adminObject->addItemButton(\_AM_WGTESTMB_LIST_TESTFIELDS, 'testfields.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $testfieldsObj = $testfieldsHandler->get($tfId);
        if (!\is_object($testfieldsObj)) {
            \redirect_header('testfields.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        $testfieldsObj->start = $start;
        $testfieldsObj->limit = $limit;
        $form = $testfieldsObj->getFormTestfields();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'wgtestmb_admin_testfields.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testfields.php'));
        $testfieldsObj = $testfieldsHandler->get($tfId);
        if (!\is_object($testfieldsObj)) {
            \redirect_header('testfields.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        $tfText = $testfieldsObj->getVar('tf_text');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('testfields.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($testfieldsHandler->delete($testfieldsObj)) {
                \redirect_header('testfields.php', 3, \_AM_WGTESTMB_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $testfieldsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'tf_id' => $tfId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_WGTESTMB_FORM_SURE_DELETE, $tfText));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}
require __DIR__ . '/footer.php';
