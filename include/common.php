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
if (!\defined('XOOPS_ICONS32_PATH')) {
    \define('XOOPS_ICONS32_PATH', \XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
}
if (!\defined('XOOPS_ICONS32_URL')) {
    \define('XOOPS_ICONS32_URL', \XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
}
\define('WGTESTMB_DIRNAME', 'wgtestmb');
\define('WGTESTMB_PATH', \XOOPS_ROOT_PATH . '/modules/' . \WGTESTMB_DIRNAME);
\define('WGTESTMB_URL', \XOOPS_URL . '/modules/' . \WGTESTMB_DIRNAME);
\define('WGTESTMB_ICONS_PATH', \WGTESTMB_PATH . '/assets/icons');
\define('WGTESTMB_ICONS_URL', \WGTESTMB_URL . '/assets/icons');
\define('WGTESTMB_IMAGE_PATH', \WGTESTMB_PATH . '/assets/images');
\define('WGTESTMB_IMAGE_URL', \WGTESTMB_URL . '/assets/images');
\define('WGTESTMB_UPLOAD_PATH', \XOOPS_UPLOAD_PATH . '/' . \WGTESTMB_DIRNAME);
\define('WGTESTMB_UPLOAD_URL', \XOOPS_UPLOAD_URL . '/' . \WGTESTMB_DIRNAME);
\define('WGTESTMB_UPLOAD_FILES_PATH', \WGTESTMB_UPLOAD_PATH . '/files');
\define('WGTESTMB_UPLOAD_FILES_URL', \WGTESTMB_UPLOAD_URL . '/files');
\define('WGTESTMB_UPLOAD_IMAGE_PATH', \WGTESTMB_UPLOAD_PATH . '/images');
\define('WGTESTMB_UPLOAD_IMAGE_URL', \WGTESTMB_UPLOAD_URL . '/images');
\define('WGTESTMB_UPLOAD_SHOTS_PATH', \WGTESTMB_UPLOAD_PATH . '/images/shots');
\define('WGTESTMB_UPLOAD_SHOTS_URL', \WGTESTMB_UPLOAD_URL . '/images/shots');
\define('WGTESTMB_ADMIN', \WGTESTMB_URL . '/admin/index.php');
$localLogo = \WGTESTMB_IMAGE_URL . '/tdmxoops_logo.png';
// Module Information
$copyright = "<a href='https://xoops.org' title='XOOPS Project' target='_blank'><img src='" . $localLogo . "' alt='XOOPS Project' ></a>";
require_once \XOOPS_ROOT_PATH . '/class/xoopsrequest.php';
require_once \WGTESTMB_PATH . '/include/functions.php';
