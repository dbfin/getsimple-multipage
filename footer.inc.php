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
				Powered by <a href="http://get-simple.info/">GetSimple</a>
			</div>
			<!--
				Theme Credits
				Please consider keeping the links to the developer and GetSimple if you use this theme
			-->
			<div class="credits-theme text-center col-md-6 col-md-pull-3">
				Multipage theme by <a href="https://github.com/dbfin" target="_blank">Vadim @ dbFin</a>
				based on <a href="http://getbootstrap.com" target="_blank">Bootstrap</a>
			</div>
		</div>
		<?php get_footer(); ?>
	</div>
</footer>

	<!-- Libraries -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/js/ie10-viewport-bug-workaround.js"></script>

	<!-- Scripts -->
	<!-- Table of Content -->
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$divTOC = $('article .page-toc');
			if ($divTOC.length) {
				$hs = $('article h2,article h3,article h4');
				if ($hs.length) {
					$divHTML = '<h3>Content</h3>';
					$level_ = 1;
					$hs.each(function () {
						$h = $(this);
						$htag = this.tagName;
						$level = parseInt($htag.substring(1));
						while ($level_ < $level) { $divHTML += '<ul>'; ++$level_; }
						while ($level_ > $level) { $divHTML += '</ul>'; --$level_; }
						$hname = $h.attr('id') || $h.attr('name') || '';
						if (!$hname) {
							$ha = $h.children('a:first-child');
							if ($ha.length && !$ha.attr('href')) $hname = $ha.attr('id') || $ha.attr('name') || '';
						}
						$htext = $h.text();
						$divHTML += '<li>'
									+ ($hname ? '<a href="#' + $hname + '">' + $htext + '</a>' : $htext)
									+ '</li>';
					});
					while ($level_ > 1) { $divHTML += '</ul>'; --$level_; }
					$divTOC.html($divHTML).show();
				}
			}
		});
	</script>
	<!-- Google Analytics -->
	<?php if ($settings->ga) { ?><script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', <?php echo $settings->ga; ?>, 'auto');
		ga('send', 'pageview');
	</script><?php } ?>
	<!-- Component scripts -->
	<?php get_component('footer-tags'); ?>

</body>
</html>
