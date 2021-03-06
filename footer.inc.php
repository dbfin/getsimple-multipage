<?php if(!defined('IN_GS')) { die(''); }
/****************************************************
*
* @File:		footer.inc.php
* @Package:		Multipage GetSimple
* @Action:		Multipage theme for GetSimple CMS
*
*****************************************************/
?>

<footer class="clearfix" >
	<div class="container-fluid">
		<div class="row">
			<div class="copyright col-xs-7 col-md-3"><?php
				$year = date('Y');
				if ($settings->first_year && $year != $settings->first_year) {
					$year = $settings->first_year.' - '.$year;
				}
				echo 'Copyright © '.$year.' '.$settings->copyright_name;
			?></div>
			<div class="credits-getsimple text-right col-xs-5 col-md-3 col-md-push-6">
				Powered by <a href="http://get-simple.info/" target="_blank">GetSimple</a>
			</div>
			<!--
				Theme Credits
				Please consider keeping the links to the developer and GetSimple if you use this theme
			-->
			<div class="credits-theme text-center col-md-6 col-md-pull-3">
				<a href="https://github.com/dbfin/getsimple-multipage" target="_blank">Multipage theme</a>
				by <a href="https://github.com/dbfin" target="_blank">Vadim @ dbFin</a>
				based on <a href="http://getbootstrap.com" target="_blank">Bootstrap</a>
			</div>
		</div>
		<?php get_footer(); ?>
	</div>
</footer>

<!-- Scripts -->
<!-- Javascript queue -->
<?php
	foreach($queueJavascript as $name => $script) {
		echo '<!-- '.$name.' -->'.PHP_EOL.$script.PHP_EOL;
	}
?>
<!-- Table of Content -->
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$divTOC = $('article .page-toc');
		if ($divTOC.length) {
			$hs = $('article .page-content');
			$hs = $hs.find('h1:visible,h2:visible,h3:visible,h4:visible');
			if ($hs.length) {
				$divHTML = '<h3>Content</h3>';
				$levelmin = 1000;
				$hs.each(function () {
					$htag = this.tagName;
					$level_ = parseInt($htag.substring(1));
					if ($level_ < $levelmin) $levelmin = $level_;
				});
				$level = --$levelmin;
				$hs.each(function ($index) {
					$h = $(this);
					$htag = this.tagName;
					$level_ = parseInt($htag.substring(1));
					while ($level < $level_) {
						$divHTML += '<div><ul><li>';
						$lifirst = true;
						++$level;
					}
					while ($level > $level_) {
						$divHTML += '</li></ul></div>';
						$lifirst = false;
						--$level;
					}
					$hname = $h.attr('id') || $h.attr('name') || '';
					if (!$hname) {
						$ha = $h.children('a:first-child');
						if ($ha.length && !$ha.attr('href')) {
							$hname = $ha.attr('id') || $ha.attr('name') || '';
						}
						if (!$hname) {
							$hname = 'toc_name_' + $index;
							while ($('#' + $hname + ',[name="' + $hname + '"]').length) $hname += '_';
							$h.prepend('<a name="' + $hname + '"></a>');
						}
					}
					$hclone = $h.clone().removeAttr('id name');
					$hclone.find('a').each(function () {
						$(this).replaceWith($(this).html());
					});
					$htext = $hclone.html();
					if (!$lifirst) $divHTML += '</li><li>';
					else $lifirst = false;
					$divHTML += '<a href="#' + $hname + '">' + $htext + '</a>';
				}); // $hs.each(function ($index) {})
				while ($level > $levelmin) {
					$divHTML += '</li></ul></div>';
					--$level;
				}
				$divTOC.html($divHTML).show();
			} // if ($hs.length)
		} // if ($divTOC.length)
	}); // jQuery(document).ready(function ($) {})
</script>
<?php if ($commentsShow && $settings->disqus) {
	$commentsSettings = $getCommentsSettings(); ?>
<!-- Comments -->
<script type="text/javascript">
	var disqus_shortname = '<?php echo $settings->disqus; ?>';
	var disqus_identifier = '<?php echo $commentsSettings['identifier']; ?>';
	var disqus_title = '<?php echo $commentsSettings['title']; ?>';
	jQuery(document).ready(function () {
		setTimeout(function () {
			jQuery('body').append('<script type="text/javascript" async src="//'
					+ disqus_shortname + '.disqus.com/embed.js"><\/script>');
		}, 2500);
	});
</script>
<?php } ?>
<!-- Component scripts -->
<?php get_component('footer-tags'); ?>

</body>
</html>
