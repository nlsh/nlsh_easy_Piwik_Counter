<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
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
 * @copyright  Nils Heinold 
 * @author     Nils Heinold 
 * @package    nlsh_easy_Piwik_Counter 
 * @license    LGPL 
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_domain']       = array('Domain vom Piwik- Server', 'Geben Sie hier bitte die Domaine zum Piwik- Server ein!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_id_site']      = array('ID- der Website bei Piwik', 'Geben Sie hier bitte die ID der Webseite bei Piwik ein!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_last_minutes'] = array('Zeitspanne für Online- Besucher in Minuten', 'Geben Sie hier bitte die Zeitspanne ein, die ein Besucher aktiv als online gezählt wird!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_token_auth']   = array('Piwik token_auth eingeben', 'Geben Sie hier bitte den Piwik token_auth Token ein!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_range_start']  = array('Piwik- Startzeit eingeben', 'Geben Sie hier bitte das Datum ein, seit dem Piwik Ihre Seite analysiert!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_visits_start'] = array('Vortrag Besucher gesamt', 'Geben Sie hier bitte die Anzahl der Besucher ein, die Ihre Website vor dem Start der Piwik- Analyse besuchten!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_impressum']    = array('HTML- Text Impressum', 'Geben Sie hier Ihren HTML- Text für das Impressum ein! Um den Standardtext dieser Extension wieder zu erhalten, löschen Sie einfach den gesamten Text!');
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_noscan']       = array('Möchten Sie die Möglichkeit zum Ausschalen von PIWIK gewähren?', 'WICHTIG Sie müssen den Tag &lt;iframe&gt; zu lassen !!!! Wenn Sie den Benutzern der Website die Möglichkeit geben wollen, die Verfolgung per PIWIK zu unterbinden, dann aktivieren Sie diese Auswahlbox.');

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_legend']              = 'Voreinstellungen des easy Piwik Counters';
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_Impressum_legend']    = 'Impressums-Text für Piwik- Analyse';
$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_Piwik_noscan_legend'] = 'Ausschalten der Piwik- Analyse erlauben';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_module']['new']    = array('', '');
$GLOBALS['TL_LANG']['tl_module']['edit']   = array('', '');
$GLOBALS['TL_LANG']['tl_module']['copy']   = array('', '');
$GLOBALS['TL_LANG']['tl_module']['delete'] = array('', '');
$GLOBALS['TL_LANG']['tl_module']['show']   = array('', '');

?>