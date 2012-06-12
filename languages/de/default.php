<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Extension für CMS Contao http://www.contao.org
 *
 * @copyright (C) 2012 Nils Heinold
 *
 * @package Easy_Piwik_Counter
 * @link https://github.com/nlsh/nlsh_easy_Piwik_Counter
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
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

// Impressum- Modul Aufruf optOut
$GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_ContentImpressum']['piwik_noscan']     = "<iframe class =\"piwikiframe\" frameborder=\"no\" src=\"{piwik_host}/index.php?module=CoreAdminHome&amp;action=optOut&amp;language={piwik_lang}&amp;css={piwik_css_optout}\"></iframe>";

?>