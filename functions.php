<?php if(!defined('IN_GS')) { die(''); }
/****************************************************
*
* @File:		functions.php
* @Package:		Multipage GetSimple
* @Action:		Multipage theme for GetSimple CMS
*
*****************************************************/

/**
 * Function getDefaultSettings
 *
 * Returns an array with default settings
 *
 * @return array An array with default settings
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
 * @param type $name Description
 * @return type Description
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

?>