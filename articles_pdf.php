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

require __DIR__ . '/header.php';
require_once \XOOPS_ROOT_PATH . '/header.php';
$tcpdf = \XOOPS_ROOT_PATH.'/Frameworks/tcpdf/';
if (\file_exists($tcpdf . 'tcpdf.php')) {
    require_once $tcpdf . 'tcpdf.php';
} else {
    \redirect_header('articles.php', 2, \_MA_WGTESTMB_NO_PDF_LIBRARY);
}
require_once $tcpdf . 'config/tcpdf_config.php';
// Get new template
require_once \XOOPS_ROOT_PATH . '/class/template.php';
$pdfTpl = new \XoopsTpl();

// Get requests
$artId = Request::getInt('art_id');
// Get Instance of Handler
$articlesHandler = $helper->getHandler('Articles');
$articlesObj = $articlesHandler->get($artId);
if (!\is_object($articlesObj)) {
    \redirect_header('articles.php', 3, \_MA_WGTESTMB_INVALID_PARAM);
}

$myts = MyTextSanitizer::getInstance();
$pdfTpl->assign('wgtestmb_upload_url', \WGTESTMB_UPLOAD_URL);

// Check permissions
$currentuid = 0;
if (isset($xoopsUser) && \is_object($xoopsUser)) {
    $currentuid = $xoopsUser->uid();
}
$grouppermHandler = \xoops_getHandler('groupperm');
$memberHandler = \xoops_getHandler('member');
if ($currentuid === 0) {
    $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
} else {
    $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
}
// Verify permissions
if (!$grouppermHandler->checkRight('wgtestmb_view_articles', $artId, $my_group_ids, $GLOBALS['xoopsModule']->getVar('mid'))) {
    \redirect_header(\WGTESTMB_URL . '/index.php', 3, \_NOPERM);
    exit();
}
// Set defaults
$pdfFilename = 'articles.pdf';
$content     = '';

// Read data from table and create pdfData
$pdfData['title']    = \strip_tags($articlesObj->getVar('art_title'));
$pdfData['subject']    = \strip_tags($articlesObj->getVar('art_title'));
$content .= \strip_tags($articlesObj->getVar('art_descr'));
$pdfData['date']     = \formatTimestamp($articlesObj->getVar('art_created'), 's');
$pdfData['author']   = \XoopsUser::getUnameFromId($articlesObj->getVar('art_submitter'));
$pdfData['content']  = $myts->undoHtmlSpecialChars($content);
$pdfData['fontname'] = PDF_FONT_NAME_MAIN;
$pdfData['fontsize'] = PDF_FONT_SIZE_MAIN;

// Get Config
$pdfData['creator']   = $GLOBALS['xoopsConfig']['sitename'];
$pdfData['subject']   = $GLOBALS['xoopsConfig']['slogan'];
$pdfData['keywords']  = $helper->getConfig('keywords');

// Defines
\define('WGTESTMB_CREATOR', $pdfData['creator']);
\define('WGTESTMB_AUTHOR', $pdfData['author']);
\define('WGTESTMB_HEADER_TITLE', $pdfData['title']);
\define('WGTESTMB_HEADER_STRING', $pdfData['subject']);
\define('WGTESTMB_HEADER_LOGO', 'logo.gif');
\define('WGTESTMB_IMAGES_PATH', \XOOPS_ROOT_PATH.'/images/');

// Assign customs tpl fields
$pdfTpl->assign('content_header', 'articles');
$article = $articlesObj->getValuesArticles();
$pdfTpl->assign('article', $article);

// Create pdf
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, _CHARSET, false);
// Remove/add default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);
// Set document information
$pdf->SetCreator($pdfData['creator']);
$pdf->SetAuthor($pdfData['author']);
$pdf->SetTitle($pdfData['title']);
$pdf->SetKeywords($pdfData['keywords']);
// Set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, WGTESTMB_HEADER_TITLE, WGTESTMB_HEADER_STRING);
// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 10, PDF_MARGIN_RIGHT);
// Set auto page breaks
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); //set image scale factor
// For chinese
if ('cn' == _LANGCODE) {
    $pdf->setHeaderFont(['gbsn00lp', '', $pdfData['fontsize']]);
    $pdf->SetFont('gbsn00lp', '', $pdfData['fontsize']);
    $pdf->setFooterFont(['gbsn00lp', '', $pdfData['fontsize']]);
} else {
    $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
    $pdf->SetFont($pdfData['fontname'], '', $pdfData['fontsize']);
    $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
}
// Set some language-dependent strings (optional)
$lang = \XOOPS_ROOT_PATH.'/Frameworks/tcpdf/lang/eng.php';
if (@\file_exists($lang)) {
    require_once $lang;
    $pdf->setLanguageArray($lang);
}
// Add Page document
$pdf->AddPage();
// Output
$template_path = \WGTESTMB_PATH . '/templates/wgtestmb_articles_pdf.tpl';
$content = $pdfTpl->fetch($template_path);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $content, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
$pdf->Output($pdfFilename, 'I');
