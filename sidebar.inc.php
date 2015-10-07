<?php if(!defined('IN_GS')) { die(''); }
/****************************************************
*
* @File:		sidebar.inc.php
* @Package:		Multipage GetSimple
* @Action:		Multipage theme for GetSimple CMS
*
*****************************************************/
?>
<div class="logo text-center">
	<a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a>
</div>
<?php
$parentUrl = ($tabindex ? returnPageField($childPages[0]['url'], 'parent') : $parent);
if ($parentUrl != '' && $parentUrl != 'index') {
?>
<div class="section parent">
	<b>Parent Topic:</b>
	<a href="<?php echo find_url($parentUrl, ''); ?>"><?php echoPageField($parentUrl, 'title'); ?></a>
</div>
<?php
}
if ($components) { // $components should already be initialized at this point by calling get_component() in the header
	$sidebarcomponents = array();
	foreach ($components as $component) {
		if (preg_match('/^sidebar-pre-[0-9]+$/', $component->slug)) {
			$sidebarcomponents[(string)$component->slug] = $component->value;
		}
	}
	ksort($sidebarcomponents, SORT_NATURAL);
	foreach ($sidebarcomponents as $value) {
		eval('?><div class="section pre-children">'.strip_decode($value).'</div><?php ');
	}
}
if (!empty($childPages) && count($childPages) > 1) {
?>
<div class="section children">
	<h2 class="highlight">Subpages</h2>
	<ul>
<?php
	foreach ($childPages as $index => $childPage) {
		$childUrl = $childPage['url'];
		$childPrivate = ($childPage['private'] != 'Y' ? '' : ' private');
		$childActive = ($childUrl === $currentPageUrl ? ' active' : '');
		echo "\t\t".'<li class="'.$childPrivate.$childActive.'">'
				   .'<a href="'.find_url($childUrl, '').'">'.$childPage['title'].'</a></li>'.PHP_EOL;
	}
?>
	</ul>
</div>
<?php
}
if ($components) { // $components should already be initialized at this point by calling get_component() in the header
	$sidebarcomponents = array();
	foreach ($components as $component) {
		if (preg_match('/^sidebar-post-[0-9]+$/', $component->slug)) {
			$sidebarcomponents[(string)$component->slug] = $component->value;
		}
	}
	ksort($sidebarcomponents, SORT_NATURAL);
	foreach ($sidebarcomponents as $value) {
		eval('?><div class="section post-children">'.strip_decode($value).'</div><?php ');
	}
}
?>
