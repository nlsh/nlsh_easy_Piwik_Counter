<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Leo Feyer 2005-2012
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Registration
 * @license    LGPL
 * @filesource
 */


/**
* Fields
*/
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_domain']             = array('URL to the Piwik- Server', 'Here you can enter the URL to your Piwik- Server !');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_id_site']            = array('ID- of the website in Piwik', 'Enter here the ID of your webseite in Piwik!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_last_minutes']       = array('Death line for online visitors in minutes', 'Enter the death line for online- visitors!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_token_auth']         = array('Enter Piwik token_auth', 'Enter here the Piwik token_auth!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_range_start']        = array('Enter Piwik- start time', 'Enter here the date, since Piwik- analytics start on your website!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_visits_start']       = array('Beginn of count', 'Enter here the count to beginn the count!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_impressum']          = array('HTML- Text Privacy Policy', 'Enter the HTML- Text Privacy Policy! Delete all text for default text!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_noscan']             = array('Choose to prevent PIWIK?', 'If you wont prevent PIWIK, click here');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_css_optout']         = array('Own CSS- Data','Enter here your own CSS- Code for styling the iframe for optOut. Show the manual!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_id_site_not_null']   = 'The ID can not be 0!';
/**
* Reference
*/
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_legend']              = 'Peference for easy Piwik Counter';
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_Impressum_legend']    = 'Privacy Policy -Text for Piwik- Analytics';
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_Piwik_noscan_legend'] = 'Prevent Piwik- Analytics';

?>