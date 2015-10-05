<?php if(!defined('IN_GS')) { die(''); }
/****************************************************
*
* @File:		template.inc.php
* @Package:		Multipage GetSimple
* @Action:		Multipage theme for GetSimple CMS
*
*****************************************************/

$settings = getSettings();

$tabindex = -1;
foreach ($childPages as $index => $childPage) {
	if ($childPage['url'] === $currentPageUrl) {
		$tabindex = $index;
	}
	else {
		$metak .= ','.$childPage['meta'];
	}
}
$metak = implode(',', array_unique(explode(',', $metak)));

if ($tabindex < 0) {
	array_unshift($childPages, array('url' => $currentPageUrl, 'title' => get_page_title(false),
									 'menuOrder' => -1, 'private' => (string)$private ));
	$tabindex = 0;
}

require('header.inc.php');
?>

<nav>
	<div class="container-fluid">
		<ul>
			<?php get_navigation($currentPageUrl); ?>
		</ul>
	</div>
</nav>

<div class="logo text-center">
	<a href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a>
</div>

<div id="main-container" class="container-fluid">
	<div class="row"><div class="row-md-full-height">
		<input id="nav-toggle" type="checkbox" />
		<label id="nav-toggle-label" for="nav-toggle" title="Menu">
			<span class="sr-only">Menu</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</label>
		<div class="sidebar col-md-3 col-md-full-height">
			<?php include('sidebar.inc.php'); ?>
		</div>
		<div class="content col-md-9 col-md-full-height">
			<?php
			$childPage = $childPages[$tabindex];
			$childUrl = $childPage['url'];
			$childContent = returnPageField($childUrl, 'content');
			$childPrivate = ($childPage['private'] != 'Y' ? '' : ' private');
			$childContent = doShortcodes($childContent);
			?>
			<article class="<?php echo $childUrl.$childPrivate; ?>">
				<?php
					if (!empty($childPages) && count($childPages) > 1) {
						echo '<div class="post-navigation clearfix">';
						if ($tabindex > 0) {
							echo '<p class="post-previous"><a href="'.find_url($childPages[$tabindex - 1]['url'], '').'">« '
								 .$childPages[$tabindex - 1]['title'].'</a></p>';
						}
						if ($tabindex < count($childPages) - 1) {
							echo '<p class="post-next"><a href="'.find_url($childPages[$tabindex + 1]['url'], '').'">'
								 .$childPages[$tabindex + 1]['title'].' »</a></p>';
						}
						echo '</div>'."\n";
					}
				?>
				<div class="page-header"><h1><?php echo $childPage['title']; ?></h1></div>
				<?php if ($currentPageUrl != 'index') {
					echo '<div class="page-toc"></div>';
				} ?>
				<div class="page-content"><?php echo $childContent; ?></div>
			</article>
		</div>
	</div></div>
</div>

<?php
require('footer.inc.php');
?>
