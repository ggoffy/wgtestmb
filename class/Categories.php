<?php

declare(strict_types=1);


namespace XoopsModules\Wgtestmb;

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

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Categories
 */
class Categories extends \XoopsObject
{
    /**
     * @var int
     */
    public $start = 0;

    /**
     * @var int
     */
    public $limit = 0;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->initVar('cat_id', \XOBJ_DTYPE_INT);
        $this->initVar('cat_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_logo', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_created', \XOBJ_DTYPE_INT);
        $this->initVar('cat_submitter', \XOBJ_DTYPE_INT);
    }

    /**
     * @static function getInstance
     *
     */
    public static function getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
        return $instance;
    }

    /**
     * The new inserted $Id
     * @return int
     */
    public function getNewInsertedIdCategories()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormCategories($action = false)
    {
        $helper = \XoopsModules\Wgtestmb\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $isAdmin = \is_object($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        // Permissions for uploader
        $grouppermHandler = \xoops_getHandler('groupperm');
        $groups = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->getGroups() : [\XOOPS_GROUP_ANONYMOUS];
        $permissionUpload = $grouppermHandler->checkRight('upload_groups', 32, $groups, $GLOBALS['xoopsModule']->getVar('mid')) ? true : false;
        // Title
        $title = $this->isNew() ? \_AM_WGTESTMB_CATEGORY_ADD : \_AM_WGTESTMB_CATEGORY_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text catName
        $form->addElement(new \XoopsFormText(\_AM_WGTESTMB_CATEGORY_NAME, 'cat_name', 50, 255, $this->getVar('cat_name')), true);
        // Form Image catLogo
        // Form Image catLogo: Select Uploaded Image 
        $getCatLogo = $this->getVar('cat_logo');
        $catLogo = $getCatLogo ?: 'blank.gif';
        $imageDirectory = '/uploads/wgtestmb/images/categories';
        $imageTray = new \XoopsFormElementTray(\_AM_WGTESTMB_CATEGORY_LOGO, '<br>');
        $imageSelect = new \XoopsFormSelect(\sprintf(\_AM_WGTESTMB_CATEGORY_LOGO_UPLOADS, ".{$imageDirectory}/"), 'cat_logo', $catLogo, 5);
        $imageArray = \XoopsLists::getImgListAsArray( \XOOPS_ROOT_PATH . $imageDirectory );
        foreach ($imageArray as $image1) {
            $imageSelect->addOption(($image1), $image1);
        }
        $imageSelect->setExtra("onchange='showImgSelected(\"imglabel_cat_logo\", \"cat_logo\", \"" . $imageDirectory . '", "", "' . \XOOPS_URL . "\")'");
        $imageTray->addElement($imageSelect, false);
        $imageTray->addElement(new \XoopsFormLabel('', "<br><img src='" . \XOOPS_URL . '/' . $imageDirectory . '/' . $catLogo . "' id='imglabel_cat_logo' alt='' style='max-width:100px' >"));
        // Form Image catLogo: Upload new image
        if ($permissionUpload) {
            $maxsize = $helper->getConfig('maxsize_image');
            $imageTray->addElement(new \XoopsFormFile('<br>' . \_AM_WGTESTMB_FORM_UPLOAD_NEW, 'cat_logo', $maxsize));
            $imageTray->addElement(new \XoopsFormLabel(\_AM_WGTESTMB_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_WGTESTMB_FORM_UPLOAD_SIZE_MB));
            $imageTray->addElement(new \XoopsFormLabel(\_AM_WGTESTMB_FORM_UPLOAD_IMG_WIDTH, $helper->getConfig('maxwidth_image') . ' px'));
            $imageTray->addElement(new \XoopsFormLabel(\_AM_WGTESTMB_FORM_UPLOAD_IMG_HEIGHT, $helper->getConfig('maxheight_image') . ' px'));
        }
        $form->addElement($imageTray);
        // Form Text Date Select catCreated
        $catCreated = $this->isNew() ? \time() : $this->getVar('cat_created');
        $form->addElement(new \XoopsFormTextDateSelect(\_AM_WGTESTMB_CATEGORY_CREATED, 'cat_created', '', $catCreated), true);
        // Form Select User catSubmitter
        $uidCurrent = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->uid() : 0;
        $catSubmitter = $this->isNew() ? $uidCurrent : $this->getVar('cat_submitter');
        $form->addElement(new \XoopsFormSelectUser(\_AM_WGTESTMB_CATEGORY_SUBMITTER, 'cat_submitter', false, $catSubmitter));
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));
        return $form;
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
    public function getValuesCategories($keys = null, $format = null, $maxDepth = null)
    {
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']              = $this->getVar('cat_id');
        $ret['name']            = $this->getVar('cat_name');
        $ret['logo']            = $this->getVar('cat_logo');
        $ret['created_text']    = \formatTimestamp($this->getVar('cat_created'), 's');
        $ret['submitter_text']  = \XoopsUser::getUnameFromId($this->getVar('cat_submitter'));
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayCategories()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }
}
