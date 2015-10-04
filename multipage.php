<?php if(!defined('IN_GS')) { die(''); }
/****************************************************
*
* @File:		multipage.php
* @Package:		Multipage GetSimple
* @Action:		Multipage theme for GetSimple CMS
*
*****************************************************/

$currentPageUrl = (string)get_page_slug(false);
$childPages = multipageChildren($currentPageUrl);

require('template.inc.php');
?>
