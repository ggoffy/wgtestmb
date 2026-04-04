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
$catId = Request::getInt('cat_id');
$start = Request::getInt('start');
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'wgtestmb_admin_categories.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_ADD_CATEGORY, 'categories.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $categoriesCount = $categoriesHandler->getCountCategories();
        $categoriesAll = $categoriesHandler->getAllCategories($start, $limit);
        $GLOBALS['xoopsTpl']->assign('categories_count', $categoriesCount);
        $GLOBALS['xoopsTpl']->assign('wgtestmb_url', \WGTESTMB_URL);
        $GLOBALS['xoopsTpl']->assign('wgtestmb_upload_url', \WGTESTMB_UPLOAD_URL);
        // Table view categories
        if ($categoriesCount > 0) {
            foreach (\array_keys($categoriesAll) as $i) {
                $category = $categoriesAll[$i]->getValuesCategories();
                $GLOBALS['xoopsTpl']->append('categories_list', $category);
                unset($category);
            }
            // Display Navigation
            if ($categoriesCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($categoriesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGTESTMB_THEREARENO_CATEGORIES);
        }
        break;
    case 'new':
        $templateMain = 'wgtestmb_admin_categories.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_LIST_CATEGORIES, 'categories.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $categoriesObj = $categoriesHandler->create();
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'wgtestmb_admin_categories.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_LIST_CATEGORIES, 'categories.php', 'list');
        $adminObject->addItemButton(\_AM_WGTESTMB_ADD_CATEGORY, 'categories.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $catIdSource = Request::getInt('cat_id_source');
        // Check params
        if (0 === $catIdSource) {
            \redirect_header('categories.php?op=list', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        // Get Form
        $categoriesObjSource = $categoriesHandler->get($catIdSource);
        if (!\is_object($categoriesObjSource)) {
            \redirect_header('categories.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        $categoriesObj = $categoriesObjSource->xoopsClone();
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        $templateMain = 'wgtestmb_admin_categories.tpl';
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('categories.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($catId > 0) {
            $categoriesObj = $categoriesHandler->get($catId);
        } else {
            $categoriesObj = $categoriesHandler->create();
        }
        if (!\is_object($categoriesObj)) {
            \redirect_header('categories.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        // Set Vars
        $uploaderErrors = '';
        $categoriesObj->setVar('cat_name', Request::getString('cat_name'));
        // Set Var cat_logo
        $filename = $_FILES['cat_logo']['name'];
        if ('' !== (string)$filename) {
            require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
            $imgMimetype    = $_FILES['cat_logo']['type'];
            $imgNameDef     = Request::getString('cat_name');
            $uploader = new \XoopsMediaUploader(\WGTESTMB_UPLOAD_IMAGE_PATH . '/categories/', 
                                                    $helper->getConfig('mimetypes_image'), 
                                                    $helper->getConfig('maxsize_image'), null, null);
            if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
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
                        $imgHandler->sourceFile    = \WGTESTMB_UPLOAD_IMAGE_PATH . '/categories/' . $savedFilename;
                        $imgHandler->endFile       = \WGTESTMB_UPLOAD_IMAGE_PATH . '/categories/' . $savedFilename;
                        $imgHandler->imageMimetype = $imgMimetype;
                        $imgHandler->maxWidth      = $maxwidth;
                        $imgHandler->maxHeight     = $maxheight;
                        $result                    = $imgHandler->resizeImage();
                    }
                    $categoriesObj->setVar('cat_logo', $savedFilename);
                } else {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
            } else {
                if ($filename > '') {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
                $categoriesObj->setVar('cat_logo', Request::getString('cat_logo'));
            }
        } else {
            $categoriesObj->setVar('cat_logo', Request::getString('cat_logo'));
        }
        $categoryCreatedObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('cat_created'));
        if (false === $categoryCreatedObj) {
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGTESTMB_INVALID_DATE);
            $form = $categoriesObj->getFormCategories();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
            break;
        }
        $categoriesObj->setVar('cat_created', $categoryCreatedObj->getTimestamp());
        $categoriesObj->setVar('cat_submitter', Request::getInt('cat_submitter'));
        // Insert Data
        if ($categoriesHandler->insert($categoriesObj)) {
            $savedCatId = $catId > 0 ? $catId : $categoriesObj->getNewInsertedIdCategories();
            if ('' !== $uploaderErrors) {
                \redirect_header('categories.php?op=edit&cat_id=' . $savedCatId, 5, $uploaderErrors);
            } else {
                \redirect_header('categories.php?op=list&start=' . $start . '&limit=' . $limit, 2, \_AM_WGTESTMB_FORM_OK);
            }
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'wgtestmb_admin_categories.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $adminObject->addItemButton(\_AM_WGTESTMB_ADD_CATEGORY, 'categories.php?op=new');
        $adminObject->addItemButton(\_AM_WGTESTMB_LIST_CATEGORIES, 'categories.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $categoriesObj = $categoriesHandler->get($catId);
        if (!\is_object($categoriesObj)) {
            \redirect_header('categories.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        $categoriesObj->start = $start;
        $categoriesObj->limit = $limit;
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $templateMain = 'wgtestmb_admin_categories.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $categoriesObj = $categoriesHandler->get($catId);
        if (!\is_object($categoriesObj)) {
            \redirect_header('categories.php', 3, \_AM_WGTESTMB_INVALID_PARAM);
        }
        $catName = $categoriesObj->getVar('cat_name');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('categories.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($categoriesHandler->delete($categoriesObj)) {
                \redirect_header('categories.php', 3, \_AM_WGTESTMB_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'cat_id' => $catId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_WGTESTMB_FORM_SURE_DELETE, $catName));
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
}
require __DIR__ . '/footer.php';
