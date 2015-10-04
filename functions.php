<?php if(!defined('IN_GS')) { die(''); }
/****************************************************
*
* @File:		functions.php
* @Package:		Multipage GetSimple
* @Action:		Multipage theme for GetSimple CMS
*
*****************************************************/

if (file_exists(GSTHEMESPATH.'/'.$TEMPLATE.'/functions_custom.php')) {
	include_once(GSTHEMESPATH.'/'.$TEMPLATE.'/functions_custom.php');
}


/**
 * Function getDefaultSettings
 *
 * Returns an array with default settings
 *
 * @return object An object with default settings
 */
function getDefaultSettings() {
	return (object) [
		'copyright_name' => get_site_name(false),
		'first_year' => date('Y'),
		'ga' => ''
	];
}


/**
 * Function getSettings
 *
 * Returns an array with settings from the settings file if it exists, otherwise creates it with default settings
 *
 * @return object An object with settings
 */
function getSettings() {
	$fileSettings = GSDATAOTHERPATH . 'settings_multipage.xml';
	if (file_exists($fileSettings)) {
		$settings = getXML($fileSettings);
	} else {
		$settings = getDefaultSettings();
		$xml = @new SimpleXMLElement('<item></item>');
		foreach ($settings as $key => $value) {
			$xml->addChild($key, $value);
		}
		try { $xml->asXML($fileSettings); } catch (Exception $e) {};
	}
	return $settings;
}


/**
 * Function multipageChildren
 *
 * Returns the array with the page and its children information if the page uses the multipage template,
 * or the empty array otherwise
 *
 * @param string $pageUrl The url of the page
 * @return array The array with the page and children information
 */
function multipageChildren($pageUrl) {
	global $USR;
	if (empty($pageUrl) || returnPageField($pageUrl, 'template') !== 'multipage.php') {
		return array();
	}
	$result = getChildrenMulti($pageUrl, array( 'title', 'menuOrder', 'meta', 'private' ));
	if (empty($result)) {
		$result = array(); # getChildrenMulti() returns NULL if there are no children
	}
	else {
		$result = subval_sort($result, 'menuOrder');
		if (!isset($USR) || $USR !== get_cookie('GS_ADMIN_USERNAME')) {
			$result = array_filter($result, function ($childPage) { return $childPage['private'] != 'Y'; });
		}
	}
	array_unshift($result, array('url' => $pageUrl,
								 'title' => returnPageField($pageUrl, 'title'),
								 'menuOrder' => returnPageField($pageUrl, 'menuOrder'),
								 'meta' => returnPageField($pageUrl, 'meta'),
								 'private' => returnPageField($pageUrl, 'private')));
	return $result;
}


/**
 * Function doShortcodes
 *
 * Parses the content and searches for shortcodes, replacing them by the results of corresponding functions
 *
 * @param string $content The content to be parsed
 * @return string The content with shortcodes replaced by the results of corresponding functions
 */
function doShortcodes($content) {
	$scs = [];
	$n = preg_match_all('/\[[a-z_]+\]/', $content, $scs, PREG_SET_ORDER | PREG_OFFSET_CAPTURE);
	while ($n--) {
		$sc = $scs[$n][0][0];
		$scf = 'shortcode_'.substr($sc, 1, strlen($sc)-2);
		if (function_exists($scf)) {
			$sco = $scs[$n][0][1];
			$scl = strlen($sc);
			$scfr = new ReflectionFunction($scf);
			if (!$scfr->getNumberOfParameters()) {
				$content_new = (string)($scf());
			}
			else {
				$content_ = substr($content, $sco + $scl);
				$length = strpos($content_, substr_replace($sc, '/', 1, 0));
				if ($length !== false) {
					$content_new = (string)($scf(substr($content_, 0, $length)));
					$scl += $length + $scl + 1;
				}
				else {
					$scl = 0;
				}
			}
			if ($scl) {
				$content = substr_replace($content, doShortcodes($content_new), $sco, $scl);
			}
		} // if (function_exists($scf))
	} // while ($n--)
	return $content;
}

?>
