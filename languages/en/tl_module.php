<?php
if (!defined('TL_ROOT'))
		die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package Easy Piwik Counter
 * @link https://github.com/nlsh/nlsh_easy_Piwik_Counter
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
* Fields
*/
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_domain']       = array('URL to the Piwik- Server', 'Here you can enter the URL to your Piwik- Server !');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_id_site']      = array('ID- of the website in Piwik', 'Enter here the ID of your webseite in Piwik!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_last_minutes'] = array('Death line for online visitors in minutes', 'Enter the death line for online- visitors!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_token_auth']   = array('Enter Piwik token_auth', 'Enter here the Piwik token_auth!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_range_start']  = array('Enter Piwik- start time', 'Enter here the date, since Piwik- analytics start on your website!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_visits_start'] = array('Beginn of count', 'Enter here the count to beginn the count!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_impressum']    = array('HTML- text Privacy Policy', 'Enter the HTML- text Privacy Policy!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_noscan']       = array('Choose to prevent PIWIK?', 'If you wont prevent PIWIK, click here');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_css_optout']   = array('Own CSS- Data','Enter here your own CSS- Code for styling the iframe for optOut. Show the manual!');

/**
* Reference
*/
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_legend']              = 'Peference for easy Piwik Counter';
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_Impressum_legend']    = 'Privacy Policy -text for Piwik- analytics';
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_Piwik_noscan_legend'] = 'Prevent Piwik- analytics';

/**
* Buttons
*/
$GLOBALS['TL_LANG']['tl_module']['new']    = array('', '');
$GLOBALS['TL_LANG']['tl_module']['edit']   = array('', '');
$GLOBALS['TL_LANG']['tl_module']['copy']   = array('', '');
$GLOBALS['TL_LANG']['tl_module']['delete'] = array('', '');
$GLOBALS['TL_LANG']['tl_module']['show']   = array('', '');
?>