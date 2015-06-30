<?php if(!defined('IN_GS')) { die(''); }
/****************************************************
*
* @File:		multipage.php
* @Package:		Multipage GetSimple
* @Action:		Multipage theme for GetSimple CMS
*
*****************************************************/

$currentPageUrl = (string)get_page_slug(false);
$childPages = array();

$currentPageContent = '';
if ($currentPageUrl != '') {
	$currentPageContent = returnPageContent($currentPageUrl);
	$childPages = getChildrenMulti($currentPageUrl, array( 'title', 'menuOrder', 'meta', 'private' ));
	if (empty($childPages)) {
		$childPages = array(); # getChildrenMulti() returns NULL if there are no children.
	}
	else {
		$childPages = subval_sort($childPages, 'menuOrder');
		if (!isset($USR) || $USR !== get_cookie('GS_ADMIN_USERNAME')) {
			$childPages = array_filter($childPages, function ($childPage) { return $childPage['private'] != 'Y'; });
		}
	}
}

require('template.inc.php');
?>
