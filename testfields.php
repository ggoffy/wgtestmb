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
$GLOBALS['xoopsOption']['template_main'] = 'wgtestmb_testfields.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$tfId  = Request::getInt('tf_id');
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
$permEdit = $permissionsHandler->getPermGlobalSubmit();
$GLOBALS['xoopsTpl']->assign('permEdit', $permEdit);
$GLOBALS['xoopsTpl']->assign('showItem', $tfId > 0);

switch ($op) {
    case 'show':
    case 'list':
    default:
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_TESTFIELDS_LIST];
        $ratingbars = (int)$helper->getConfig('ratingbars');
        if ($ratingbars > 0) {
            $GLOBALS['xoTheme']->addStylesheet(\WGTESTMB_URL . '/assets/css/rating.css', null);
            $GLOBALS['xoopsTpl']->assign('rating', $ratingbars);
            $GLOBALS['xoopsTpl']->assign('rating_5stars', (Constants::RATING_5STARS === $ratingbars));
            $GLOBALS['xoopsTpl']->assign('rating_10stars', (Constants::RATING_10STARS === $ratingbars));
            $GLOBALS['xoopsTpl']->assign('rating_10num', (Constants::RATING_10NUM === $ratingbars));
            $GLOBALS['xoopsTpl']->assign('rating_likes', (Constants::RATING_LIKES === $ratingbars));
            $GLOBALS['xoopsTpl']->assign('itemid', 'tf_id');
            $GLOBALS['xoopsTpl']->assign('wgtestmb_icon_url_16', \WGTESTMB_URL . '/' . $modPathIcon16);
        }
        $crTestfields = new \CriteriaCompo();
        if ($tfId > 0) {
            $crTestfields->add(new \Criteria('tf_id', $tfId));
        }
        $testfieldsCount = $testfieldsHandler->getCount($crTestfields);
        $GLOBALS['xoopsTpl']->assign('testfieldsCount', $testfieldsCount);
        if (0 === $tfId) {
            $crTestfields->setStart($start);
            $crTestfields->setLimit($limit);
        }
        $testfieldsAll = $testfieldsHandler->getAll($crTestfields);
        if ($testfieldsCount > 0) {
            $testfieldsList = [];
            $tfText = '';
            // Get All Testfields
            foreach (\array_keys($testfieldsAll) as $i) {
                $testfieldsList[$i] = $testfieldsAll[$i]->getValuesTestfields();
                $tfText = $testfieldsAll[$i]->getVar('tf_text');
                $keywords[$i] = $tfText;
                $testfieldsList[$i]['rating'] = $ratingsHandler->getItemRating($testfieldsAll[$i]->getVar('tf_id'), Constants::TABLE_TESTFIELDS);
                $testfieldsList[$i]['rating_source'] = Constants::TABLE_TESTFIELDS;
                $token = $GLOBALS['xoopsSecurity']->createToken();
                $GLOBALS['xoopsTpl']->assign('xoops_token', $token);
            }
            $GLOBALS['xoopsTpl']->assign('testfields_list', $testfieldsList);
            unset($testfieldsList);
            // Display Navigation
            if ($testfieldsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($testfieldsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
            $GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
            $GLOBALS['xoopsTpl']->assign('panel_type', $helper->getConfig('panel_type'));
            $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
            $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
            if ('show' == $op && '' != $tfText) {
                $GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($tfText . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));
            }
            if ('show' == $op) {
                $testfieldsObj = $testfieldsHandler->get($tfId);
                $tfReads = (int)$testfieldsObj->getVar('tf_reads') + 1;
                $testfieldsObj->setVar('tf_reads', $tfReads);
                // Insert Data
                $testfieldsHandler->insert($testfieldsObj);
            }
        }
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('testfields.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('testfields.php?op=list', 3, \_NOPERM);
        }
        if ($tfId > 0) {
            $testfieldsObj = $testfieldsHandler->get($tfId);
        } else {
            $testfieldsObj = $testfieldsHandler->create();
        }
        if (!\is_object($testfieldsObj)) {
            \redirect_header('testfields.php', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
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
            $GLOBALS['xoopsTpl']->assign('error', \_MA_WGTESTMB_INVALID_DATE);
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
            $GLOBALS['xoopsTpl']->assign('error', \_MA_WGTESTMB_INVALID_DATE);
            $form = $testfieldsObj->getFormTestfields();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
            break;
        }
        $testfieldDatetimeObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $testfieldDatetimeArr['date']);
        if (false === $testfieldDatetimeObj) {
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', \_MA_WGTESTMB_INVALID_DATE);
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
            $newTfId = $tfId > 0 ? $tfId : $testfieldsObj->getNewInsertedIdTestfields();
            $grouppermHandler = \xoops_getHandler('groupperm');
            $mid = $GLOBALS['xoopsModule']->getVar('mid');
            // Permission to view_testfields
            $grouppermHandler->deleteByModule($mid, 'wgtestmb_view_testfields', $newTfId);
            if (isset($_POST['groups_view_testfields'])) {
                foreach ($_POST['groups_view_testfields'] as $onegroupId) {
                    $grouppermHandler->addRight('wgtestmb_view_testfields', $newTfId, $onegroupId, $mid);
                }
            }
            // Permission to submit_testfields
            $grouppermHandler->deleteByModule($mid, 'wgtestmb_submit_testfields', $newTfId);
            if (isset($_POST['groups_submit_testfields'])) {
                foreach ($_POST['groups_submit_testfields'] as $onegroupId) {
                    $grouppermHandler->addRight('wgtestmb_submit_testfields', $newTfId, $onegroupId, $mid);
                }
            }
            // Permission to approve_testfields
            $grouppermHandler->deleteByModule($mid, 'wgtestmb_approve_testfields', $newTfId);
            if (isset($_POST['groups_approve_testfields'])) {
                foreach ($_POST['groups_approve_testfields'] as $onegroupId) {
                    $grouppermHandler->addRight('wgtestmb_approve_testfields', $newTfId, $onegroupId, $mid);
                }
            }
            // Handle notification
            $tfText = $testfieldsObj->getVar('tf_text');
            $tfStatus = $testfieldsObj->getVar('tf_status');
            $tags = [];
            $tags['ITEM_NAME'] = $tfText;
            $tags['ITEM_URL']  = \XOOPS_URL . '/modules/wgtestmb/testfields.php?op=show&tf_id=' . $newTfId;
            $notificationHandler = \xoops_getHandler('notification');
            if (Constants::STATUS_APPROVED == $tfStatus) {
                // Event approve notification
                $notificationHandler->triggerEvent('global', 0, 'global_approve', $tags);
                $notificationHandler->triggerEvent('testfields', $newTfId, 'testfield_approve', $tags);
            } else {
                if ($tfId > 0) {
                    // Event modify notification
                    $notificationHandler->triggerEvent('global', 0, 'global_modify', $tags);
                    $notificationHandler->triggerEvent('testfields', $newTfId, 'testfield_modify', $tags);
                } else {
                    // Event new notification
                    $notificationHandler->triggerEvent('global', 0, 'global_new', $tags);
                }
            }
            // redirect after insert
            if ('' !== $uploaderErrors) {
                \redirect_header('testfields.php?op=edit&tf_id=' . $newTfId, 5, $uploaderErrors);
            } else {
                \redirect_header('testfields.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_MA_WGTESTMB_FORM_OK);
            }
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $testfieldsObj->getHtmlErrors());
        $form = $testfieldsObj->getFormTestfields();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_TESTFIELD_ADD];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('testfields.php?op=list', 3, \_NOPERM);
        }
        // Form Create
        $testfieldsObj = $testfieldsHandler->create();
        $form = $testfieldsObj->getFormTestfields();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_TESTFIELD_EDIT];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('testfields.php?op=list', 3, \_NOPERM);
        }
        // Check params
        if (0 == $tfId) {
            \redirect_header('testfields.php?op=list', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
        // Get Form
        $testfieldsObj = $testfieldsHandler->get($tfId);
        if (!\is_object($testfieldsObj)) {
            \redirect_header('testfields.php', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
        $testfieldsObj->start = $start;
        $testfieldsObj->limit = $limit;
        $form = $testfieldsObj->getFormTestfields();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_TESTFIELD_CLONE];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('testfields.php?op=list', 3, \_NOPERM);
        }
        // Request source
        $tfIdSource = Request::getInt('tf_id_source');
        // Check params
        if (0 == $tfIdSource) {
            \redirect_header('testfields.php?op=list', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
        // Get Form
        $testfieldsObjSource = $testfieldsHandler->get($tfIdSource);
        if (!\is_object($testfieldsObjSource)) {
            \redirect_header('testfields.php', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
        $testfieldsObj = $testfieldsObjSource->xoopsClone();
        $form = $testfieldsObj->getFormTestfields();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_TESTFIELD_DELETE];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('testfields.php?op=list', 3, \_NOPERM);
        }
        // Check params
        if (0 == $tfId) {
            \redirect_header('testfields.php?op=list', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
        $testfieldsObj = $testfieldsHandler->get($tfId);
        if (!\is_object($testfieldsObj)) {
            \redirect_header('testfields.php', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
        $tfText = $testfieldsObj->getVar('tf_text');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('testfields.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($testfieldsHandler->delete($testfieldsObj)) {
                // Event delete notification
                $tags = [];
                $tags['ITEM_NAME'] = $tfText;
                $notificationHandler = \xoops_getHandler('notification');
                $notificationHandler->triggerEvent('global', 0, 'global_delete', $tags);
                $notificationHandler->triggerEvent('testfields', $tfId, 'testfield_delete', $tags);
                \redirect_header('testfields.php', 3, \_MA_WGTESTMB_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $testfieldsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'tf_id' => $tfId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_WGTESTMB_FORM_SURE_DELETE, $tfText));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
    case 'broken':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGTESTMB_BROKEN];
        // Check params
        if (0 == $tfId) {
            \redirect_header('testfields.php?op=list', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
        $testfieldsObj = $testfieldsHandler->get($tfId);
        if (!\is_object($testfieldsObj)) {
            \redirect_header('testfields.php', 3, \_MA_WGTESTMB_INVALID_PARAM);
        }
        $tfText = $testfieldsObj->getVar('tf_text');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('testfields.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $testfieldsObj->setVar('tf_status', Constants::STATUS_BROKEN);
            if ($testfieldsHandler->insert($testfieldsObj)) {
                // Event broken notification
                $tags = [];
                $tags['ITEM_NAME'] = $tfText;
                $tags['ITEM_URL']  = \XOOPS_URL . '/modules/wgtestmb/testfields.php?op=show&tf_id=' . $tfId;
                $notificationHandler = \xoops_getHandler('notification');
                $notificationHandler->triggerEvent('global', 0, 'global_broken', $tags);
                $notificationHandler->triggerEvent('testfields', $tfId, 'testfield_broken', $tags);
                \redirect_header('testfields.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_MA_WGTESTMB_FORM_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $testfieldsObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'tf_id' => $tfId, 'start' => $start, 'limit' => $limit, 'op' => 'broken'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_WGTESTMB_FORM_SURE_BROKEN, $tfText));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}

// Meta keywords
wgtestmbMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// View comments
require_once \XOOPS_ROOT_PATH . '/include/comment_view.php';

require __DIR__ . '/footer.php';
