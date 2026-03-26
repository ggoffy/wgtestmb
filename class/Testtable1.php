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
 * Class Object Testtable1
 */
class Testtable1 extends \XoopsObject
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
     * @param null
     */
    public function __construct()
    {
        $this->initVar('tt1_id', \XOBJ_DTYPE_INT);
        $this->initVar('tt1_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('tt1_date', \XOBJ_DTYPE_INT);
        $this->initVar('tt1_status', \XOBJ_DTYPE_INT);
        $this->initVar('tt1_comments', \XOBJ_DTYPE_INT);
    }

    /**
     * @static function &getInstance
     *
     * @param null
     */
    public static function getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
    }

    /**
     * The new inserted $Id
     * @return inserted id
     */
    public function getNewInsertedIdTesttable1()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormTesttable1($action = false)
    {
        $helper = \XoopsModules\Wgtestmb\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $isAdmin = \is_object($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        // Title
        $title = $this->isNew() ? \_AM_WGTESTMB_TESTTABLE1_ADD : \_AM_WGTESTMB_TESTTABLE1_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text tt1Name
        $form->addElement(new \XoopsFormText(\_AM_WGTESTMB_TESTTABLE1_NAME, 'tt1_name', 50, 255, $this->getVar('tt1_name')), true);
        // Form Text Date Select tt1Date
        $tt1Date = $this->isNew() ? \time() : $this->getVar('tt1_date');
        $form->addElement(new \XoopsFormTextDateSelect(\_AM_WGTESTMB_TESTTABLE1_DATE, 'tt1_date', '', $tt1Date));
        // Form Select Status tt1Status
        $tt1StatusSelect = new \XoopsFormSelect(\_AM_WGTESTMB_TESTTABLE1_STATUS, 'tt1_status', $this->getVar('tt1_status'));
        $tt1StatusSelect->addOption(Constants::STATUS_NONE, \_AM_WGTESTMB_STATUS_NONE);
        $tt1StatusSelect->addOption(Constants::STATUS_OFFLINE, \_AM_WGTESTMB_STATUS_OFFLINE);
        $tt1StatusSelect->addOption(Constants::STATUS_SUBMITTED, \_AM_WGTESTMB_STATUS_SUBMITTED);
        $tt1StatusSelect->addOption(Constants::STATUS_BROKEN, \_AM_WGTESTMB_STATUS_BROKEN);
        $form->addElement($tt1StatusSelect);
        // Form Text tt1Comments
        $form->addElement(new \XoopsFormText(\_AM_WGTESTMB_TESTTABLE1_COMMENTS, 'tt1_comments', 50, 255, $this->getVar('tt1_comments')));
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
    public function getValuesTesttable1($keys = null, $format = null, $maxDepth = null)
    {
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']             = $this->getVar('tt1_id');
        $ret['name']           = $this->getVar('tt1_name');
        $ret['date_text']      = \formatTimestamp($this->getVar('tt1_date'), 's');
        $status                = $this->getVar('tt1_status');
        $ret['status']         = $status;
        switch ($status) {
            case Constants::STATUS_NONE:
            default:
                $status_text = \_AM_WGTESTMB_STATUS_NONE;
                break;
            case Constants::STATUS_OFFLINE:
                $status_text = \_AM_WGTESTMB_STATUS_OFFLINE;
                break;
            case Constants::STATUS_SUBMITTED:
                $status_text = \_AM_WGTESTMB_STATUS_SUBMITTED;
                break;
        }
        $ret['status_text']    = $status_text;
        $ret['comments']       = $this->getVar('tt1_comments');
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayTesttable1()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }
}
