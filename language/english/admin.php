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

require_once __DIR__ . '/common.php';
require_once __DIR__ . '/main.php';

// ---------------- Admin Index ----------------
\define('_AM_WGTESTMB_STATISTICS', 'Statistics');
// There are
\define('_AM_WGTESTMB_THEREARE_TESTTABLE1', "There are <span class='bold'>%s</span> testtable1 in the database");
// ---------------- Admin Files ----------------
// There aren't
\define('_AM_WGTESTMB_THEREARENT_TESTTABLE1', "There aren't testtable1");
// Save/Delete
\define('_AM_WGTESTMB_FORM_OK', 'Successfully saved');
\define('_AM_WGTESTMB_FORM_DELETE_OK', 'Successfully deleted');
\define('_AM_WGTESTMB_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
\define('_AM_WGTESTMB_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
// Buttons
\define('_AM_WGTESTMB_ADD_TESTTABLE1', 'Add New Testtable1');
// Lists
\define('_AM_WGTESTMB_LIST_TESTTABLE1', 'List of Testtable1');
// ---------------- Admin Classes ----------------
// Testtable1 add/edit
\define('_AM_WGTESTMB_TESTTABLE1_ADD', 'Add Testtable1');
\define('_AM_WGTESTMB_TESTTABLE1_EDIT', 'Edit Testtable1');
// Elements of Testtable1
\define('_AM_WGTESTMB_TESTTABLE1_ID', 'Id');
\define('_AM_WGTESTMB_TESTTABLE1_NAME', 'Name');
\define('_AM_WGTESTMB_TESTTABLE1_DATE', 'Date');
\define('_AM_WGTESTMB_TESTTABLE1_STATUS', 'Status');
\define('_AM_WGTESTMB_TESTTABLE1_COMMENTS', 'Comments');
// General
\define('_AM_WGTESTMB_FORM_UPLOAD', 'Upload file');
\define('_AM_WGTESTMB_FORM_UPLOAD_NEW', 'Upload new file: ');
\define('_AM_WGTESTMB_FORM_UPLOAD_SIZE', 'Max file size: ');
\define('_AM_WGTESTMB_FORM_UPLOAD_SIZE_MB', 'MB');
\define('_AM_WGTESTMB_FORM_UPLOAD_IMG_WIDTH', 'Max image width: ');
\define('_AM_WGTESTMB_FORM_UPLOAD_IMG_HEIGHT', 'Max image height: ');
\define('_AM_WGTESTMB_FORM_IMAGE_PATH', 'Files in %s :');
\define('_AM_WGTESTMB_FORM_ACTION', 'Action');
\define('_AM_WGTESTMB_FORM_EDIT', 'Modification');
\define('_AM_WGTESTMB_FORM_DELETE', 'Clear');
// Status
\define('_AM_WGTESTMB_STATUS_NONE', 'No status');
\define('_AM_WGTESTMB_STATUS_OFFLINE', 'Offline');
\define('_AM_WGTESTMB_STATUS_SUBMITTED', 'Submitted');
\define('_AM_WGTESTMB_STATUS_APPROVED', 'Approved');
\define('_AM_WGTESTMB_STATUS_BROKEN', 'Broken');
// Clone feature
\define('_AM_WGTESTMB_CLONE', 'Clone');
\define('_AM_WGTESTMB_CLONE_DSC', 'Cloning a module has never been this easy! Just type in the name you want for it and hit submit button!');
\define('_AM_WGTESTMB_CLONE_TITLE', 'Clone %s');
\define('_AM_WGTESTMB_CLONE_NAME', 'Choose a name for the new module');
\define('_AM_WGTESTMB_CLONE_NAME_DSC', 'Do not use special characters! <br>Do not choose an existing module dirname or database table name!');
\define('_AM_WGTESTMB_CLONE_INVALIDNAME', 'ERROR: Invalid module name, please try another one!');
\define('_AM_WGTESTMB_CLONE_EXISTS', 'ERROR: Module name already taken, please try another one!');
\define('_AM_WGTESTMB_CLONE_CONGRAT', 'Congratulations! %s was sucessfully created!<br>You may want to make changes in language files.');
\define('_AM_WGTESTMB_CLONE_IMAGEFAIL', 'Attention, we failed creating the new module logo. Please consider modifying assets/images/logo_module.png manually!');
\define('_AM_WGTESTMB_CLONE_FAIL', 'Sorry, we failed in creating the new clone. Maybe you need to temporally set write permissions (CHMOD 777) to modules folder and try again.');
// ---------------- Admin Others ----------------
\define('_AM_WGTESTMB_ABOUT_MAKE_DONATION', 'Submit');
\define('_AM_WGTESTMB_SUPPORT_FORUM', 'Support Forum');
\define('_AM_WGTESTMB_DONATION_AMOUNT', 'Donation Amount');
\define('_AM_WGTESTMB_MAINTAINEDBY', ' is maintained by ');
// ---------------- End ----------------
