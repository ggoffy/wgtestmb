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
\define('_AM_WGTESTMB_THEREARE_CATEGORIES', "There are <span class='bold'>%s</span> categories in the database");
\define('_AM_WGTESTMB_THEREARE_ARTICLES', "There are <span class='bold'>%s</span> articles in the database");
\define('_AM_WGTESTMB_THEREARE_TESTFIELDS', "There are <span class='bold'>%s</span> testfields in the database");
\define('_AM_WGTESTMB_THEREARE_TESTTABLE1', "There are <span class='bold'>%s</span> testtable1 in the database");
// ---------------- Admin Files ----------------
// There aren't
\define('_AM_WGTESTMB_THEREARENT_CATEGORIES', "There aren't categories");
\define('_AM_WGTESTMB_THEREARENT_ARTICLES', "There aren't articles");
\define('_AM_WGTESTMB_THEREARENT_TESTFIELDS', "There aren't testfields");
\define('_AM_WGTESTMB_THEREARENT_TESTTABLE1', "There aren't testtable1");
// Save/Delete
\define('_AM_WGTESTMB_FORM_OK', 'Successfully saved');
\define('_AM_WGTESTMB_FORM_DELETE_OK', 'Successfully deleted');
\define('_AM_WGTESTMB_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
\define('_AM_WGTESTMB_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
// Buttons
\define('_AM_WGTESTMB_ADD_CATEGORY', 'Add New Category');
\define('_AM_WGTESTMB_ADD_ARTICLE', 'Add New Article');
\define('_AM_WGTESTMB_ADD_TESTFIELD', 'Add New Testfield');
\define('_AM_WGTESTMB_ADD_TESTTABLE1', 'Add New Testtable1');
// Lists
\define('_AM_WGTESTMB_LIST_CATEGORIES', 'List of Categories');
\define('_AM_WGTESTMB_LIST_ARTICLES', 'List of Articles');
\define('_AM_WGTESTMB_LIST_TESTFIELDS', 'List of Testfields');
\define('_AM_WGTESTMB_LIST_TESTTABLE1', 'List of Testtable1');
// ---------------- Admin Classes ----------------
// Category add/edit
\define('_AM_WGTESTMB_CATEGORY_ADD', 'Add Category');
\define('_AM_WGTESTMB_CATEGORY_EDIT', 'Edit Category');
// Elements of Category
\define('_AM_WGTESTMB_CATEGORY_ID', 'Id');
\define('_AM_WGTESTMB_CATEGORY_NAME', 'Name');
\define('_AM_WGTESTMB_CATEGORY_LOGO', 'Logo');
\define('_AM_WGTESTMB_CATEGORY_LOGO_UPLOADS', 'Logo in %s :');
\define('_AM_WGTESTMB_CATEGORY_CREATED', 'Created');
\define('_AM_WGTESTMB_CATEGORY_SUBMITTER', 'Submitter');
// Article add/edit
\define('_AM_WGTESTMB_ARTICLE_ADD', 'Add Article');
\define('_AM_WGTESTMB_ARTICLE_EDIT', 'Edit Article');
// Elements of Article
\define('_AM_WGTESTMB_ARTICLE_ID', 'Id');
\define('_AM_WGTESTMB_ARTICLE_CAT', 'Cat');
\define('_AM_WGTESTMB_ARTICLE_CAT_OFFLINE', 'Offline');
\define('_AM_WGTESTMB_ARTICLE_CAT_ONLINE', 'Online');
\define('_AM_WGTESTMB_ARTICLE_TITLE', 'Title');
\define('_AM_WGTESTMB_ARTICLE_DESCR', 'Descr');
\define('_AM_WGTESTMB_ARTICLE_IMG', 'Img');
\define('_AM_WGTESTMB_ARTICLE_IMG_UPLOADS', 'Img in %s :');
\define('_AM_WGTESTMB_ARTICLE_STATUS', 'Status');
\define('_AM_WGTESTMB_ARTICLE_FILE', 'File');
\define('_AM_WGTESTMB_ARTICLE_FILE_UPLOADS', 'File in %s :');
\define('_AM_WGTESTMB_ARTICLE_RATINGS', 'Ratings');
\define('_AM_WGTESTMB_ARTICLE_VOTES', 'Votes');
\define('_AM_WGTESTMB_ARTICLE_CREATED', 'Created');
\define('_AM_WGTESTMB_ARTICLE_SUBMITTER', 'Submitter');
// Testfield add/edit
\define('_AM_WGTESTMB_TESTFIELD_ADD', 'Add Testfield');
\define('_AM_WGTESTMB_TESTFIELD_EDIT', 'Edit Testfield');
// Elements of Testfield
\define('_AM_WGTESTMB_TESTFIELD_ID', 'Id');
\define('_AM_WGTESTMB_TESTFIELD_TEXT', 'Text');
\define('_AM_WGTESTMB_TESTFIELD_TEXTAREA', 'Textarea');
\define('_AM_WGTESTMB_TESTFIELD_DHTML', 'Dhtml');
\define('_AM_WGTESTMB_TESTFIELD_CHECKBOX', 'Checkbox');
\define('_AM_WGTESTMB_TESTFIELD_YESNO', 'Yesno');
\define('_AM_WGTESTMB_TESTFIELD_SELECTBOX', 'Selectbox');
\define('_AM_WGTESTMB_TESTFIELD_USER', 'User');
\define('_AM_WGTESTMB_TESTFIELD_COLOR', 'Color');
\define('_AM_WGTESTMB_TESTFIELD_IMAGELIST', 'Imagelist');
\define('_AM_WGTESTMB_TESTFIELD_IMAGELIST_UPLOADS', 'Imagelist in frameworks images: %s');
\define('_AM_WGTESTMB_TESTFIELD_URLFILE', 'Urlfile');
\define('_AM_WGTESTMB_TESTFIELD_URLFILE_UPLOADS', 'Urlfile in uploads');
\define('_AM_WGTESTMB_TESTFIELD_UPLIMAGE', 'Uplimage');
\define('_AM_WGTESTMB_TESTFIELD_UPLIMAGE_UPLOADS', 'Uplimage in %s :');
\define('_AM_WGTESTMB_TESTFIELD_UPLFILE', 'Uplfile');
\define('_AM_WGTESTMB_TESTFIELD_UPLFILE_UPLOADS', 'Uplfile in %s :');
\define('_AM_WGTESTMB_TESTFIELD_TEXTDATESELECT', 'Textdateselect');
\define('_AM_WGTESTMB_TESTFIELD_SELECTFILE', 'Selectfile');
\define('_AM_WGTESTMB_TESTFIELD_SELECTFILE_UPLOADS', 'Selectfile in %s :');
\define('_AM_WGTESTMB_TESTFIELD_PASSWORD', 'Password');
\define('_AM_WGTESTMB_TESTFIELD_COUNTRY_LIST', 'Country list');
\define('_AM_WGTESTMB_TESTFIELD_LANGUAGE', 'Language');
\define('_AM_WGTESTMB_TESTFIELD_RADIO', 'Radio');
\define('_AM_WGTESTMB_TESTFIELD_STATUS', 'Status');
\define('_AM_WGTESTMB_TESTFIELD_DATETIME', 'Datetime');
\define('_AM_WGTESTMB_TESTFIELD_COMBOBOX', 'Combobox');
\define('_AM_WGTESTMB_TESTFIELD_COMMENTS', 'Comments');
\define('_AM_WGTESTMB_TESTFIELD_RATINGS', 'Ratings');
\define('_AM_WGTESTMB_TESTFIELD_VOTES', 'Votes');
\define('_AM_WGTESTMB_TESTFIELD_UUID', 'Uuid');
\define('_AM_WGTESTMB_TESTFIELD_IP', 'Ip');
\define('_AM_WGTESTMB_TESTFIELD_READS', 'Reads');
// Testtable1 add/edit
\define('_AM_WGTESTMB_TESTTABLE1_ADD', 'Add Testtable1');
\define('_AM_WGTESTMB_TESTTABLE1_EDIT', 'Edit Testtable1');
// Elements of Testtable1
\define('_AM_WGTESTMB_TESTTABLE1_ID', 'Id');
\define('_AM_WGTESTMB_TESTTABLE1_NAME', 'Name');
\define('_AM_WGTESTMB_TESTTABLE1_DATE', 'Date');
\define('_AM_WGTESTMB_TESTTABLE1_STATUS', 'Status');
\define('_AM_WGTESTMB_TESTTABLE1_COMMENTS', 'Comments');
// Errors
\define('_AM_WGTESTMB_INVALID_DATE', 'Invalid date');
\define('_AM_WGTESTMB_INVALID_PARAM', 'Invalid parameter');
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
\define('_AM_WGTESTMB_STATUS_ONLINE', 'Online');
\define('_AM_WGTESTMB_STATUS_SUBMITTED', 'Submitted');
\define('_AM_WGTESTMB_STATUS_APPROVED', 'Approved');
\define('_AM_WGTESTMB_STATUS_BROKEN', 'Broken');
// Sample List Values
\define('_AM_WGTESTMB_LIST_1', 'Sample List Value 1');
\define('_AM_WGTESTMB_LIST_2', 'Sample List Value 2');
\define('_AM_WGTESTMB_LIST_3', 'Sample List Value 3');
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
// ---------------- Admin Permissions ----------------
// Permissions
\define('_AM_WGTESTMB_PERMISSIONS_GLOBAL', 'Permissions global');
\define('_AM_WGTESTMB_PERMISSIONS_GLOBAL_DESC', 'Permissions global to check type of.');
\define('_AM_WGTESTMB_PERMISSIONS_GLOBAL_4', 'Permissions global to approve');
\define('_AM_WGTESTMB_PERMISSIONS_GLOBAL_8', 'Permissions global to submit');
\define('_AM_WGTESTMB_PERMISSIONS_GLOBAL_16', 'Permissions global to view');
\define('_AM_WGTESTMB_PERMISSIONS_APPROVE', 'Permissions to approve');
\define('_AM_WGTESTMB_PERMISSIONS_APPROVE_DESC', 'Permissions to approve');
\define('_AM_WGTESTMB_PERMISSIONS_SUBMIT', 'Permissions to submit');
\define('_AM_WGTESTMB_PERMISSIONS_SUBMIT_DESC', 'Permissions to submit');
\define('_AM_WGTESTMB_PERMISSIONS_VIEW', 'Permissions to view');
\define('_AM_WGTESTMB_PERMISSIONS_VIEW_DESC', 'Permissions to view');
\define('_AM_WGTESTMB_NO_PERMISSIONS_SET', 'No permission set');
// ---------------- Admin Others ----------------
\define('_AM_WGTESTMB_ABOUT_MAKE_DONATION', 'Submit');
\define('_AM_WGTESTMB_SUPPORT_FORUM', 'Support Forum');
\define('_AM_WGTESTMB_DONATION_AMOUNT', 'Donation Amount');
\define('_AM_WGTESTMB_MAINTAINEDBY', ' is maintained by ');
// ---------------- End ----------------
