<?php if(!defined('IN_GS')) { die(''); }
/****************************************************
*
* @File:		header.inc.php
* @Package:		Multipage GetSimple
* @Action:		Multipage theme for GetSimple CMS
*
*****************************************************/
?>
<!DOCTYPE html>
<!--[if lt IE 9]><html lang="en" class="ie"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>
	<!-- General HTML settings -->
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags must come first in the head -->
	<meta name="robots" content="index, follow" />

	<title><?php echo get_page_clean_title(false).' | '.get_site_name(false); ?></title>

	<!-- External styles -->
	<link rel="stylesheet" type="text/css"
		  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
	<!-- link rel="stylesheet" type="text/css"
		  href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" / -->

	<!-- Custom pre-theme tags -->
	<?php get_component('header-pre-tags'); ?>

	<!-- Theme -->
	<link rel="stylesheet" type="text/css" media="all"
		  href="<?php echo get_theme_url(false).'/css/style.css?v='
						   .filemtime(get_root_path().'theme/'.$TEMPLATE.'/css/style.css'); ?>" />

	<!-- Custom post-theme tags -->
	<?php get_component('header-post-tags'); ?>

	<!-- JS -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!--[if lt IE 7 ]>
		<script src="<?php get_theme_url(); ?>/js/dd_belatedpng.js"></script>
		<script>DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
	<!-- Google Analytics -->
	<?php if ($settings->ga) { ?><script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', '<?php echo $settings->ga; ?>', 'auto');
		ga('send', 'pageview');
	</script><?php } ?>

	<?php get_header(); ?>

</head>
<body class="<?php get_page_slug(); if ($parent != '') echo ' childof-'.$parent; ?>" >
