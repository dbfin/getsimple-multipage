<?php if(!defined('IN_GS')) { die(''); }
/****************************************************
*
* @File:		template.php
* @Package:		Multipage GetSimple
* @Action:		Multipage theme for GetSimple CMS
*
*****************************************************/

$currentPageUrl = (string)get_page_slug(false);
$childPages = multipageChildren($parent);

require('template.inc.php');
?>
