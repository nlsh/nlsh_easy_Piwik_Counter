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
 * @package    Language
 * @license    LGPL 
 * @filesource
 */


/**
 * Miscellaneous
 */
// Counter
$GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_all_title']       = 'Besucher gesamt';
$GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_month_title']     = 'Besucher Monat';
$GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_today_title']     = 'Besucher heute';
$GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_yesterday_title'] = 'Besucher gestern';
$GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_online_title']    = 'Besucher online';

/**
 * Texte
 */
$GLOBALS['TL_LANG']['MSC']['piwik_Impressum']  = "<p><strong>Statistische Auswertungen mit PIWIK!<br /></strong>";
$GLOBALS['TL_LANG']['MSC']['piwik_Impressum'] .= "Diese Website benutzt Piwik, eine Open-Source-Software zur statistischen Auswertung der Besucherzugriffe. ";
$GLOBALS['TL_LANG']['MSC']['piwik_Impressum'] .= "Piwik verwendet sog. “Cookies”, Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website durch Sie ermöglichen. ";
$GLOBALS['TL_LANG']['MSC']['piwik_Impressum'] .= "Die durch den Cookie erzeugten Informationen über Ihre Benutzung dieses Internetangebotes werden auf dem Server des Anbieters in Deutschland gespeichert. ";
$GLOBALS['TL_LANG']['MSC']['piwik_Impressum'] .= "Die IP-Adresse wird sofort nach der Verarbeitung und vor deren Speicherung anonymisiert.<br /><br /> ";
$GLOBALS['TL_LANG']['MSC']['piwik_Impressum'] .= "Sie können die Installation der Cookies durch eine entsprechende Einstellung Ihrer Browser Software verhindern; ";
$GLOBALS['TL_LANG']['MSC']['piwik_Impressum'] .= "wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht sämtliche Funktionen dieser Website vollumfänglich nutzen können.</p>";


// Impressum- Modul Fehlermeldungen
$GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_ContentImpressum']['nopiwikmodul']     = 'Kein Piwik- Modul vorhanden!';
$GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_ContentImpressum']['piwik_noscan']     = "<iframe class =\"piwikiframe\" frameborder=\"no\" src=\"{piwik_host}/index.php?module=CoreAdminHome&amp;action=optOut&amp;language={piwik_lang}\"></iframe>";

?>