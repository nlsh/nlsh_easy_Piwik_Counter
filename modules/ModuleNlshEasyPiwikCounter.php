<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package   nlsh_easy_Piwik_Counter 
 * @author    Nils Heinold
 * @link      http://github.com/nlsh/nlsh_easy_Piwik_Counter
 * @license   LGPL 
 * @copyright Nils Heinold 
 */


/**
 * Namespace
 */
namespace nlsh_easy_Piwik_Counter;


/**
 * Class ModuleNlshEasyPiwikCounter
 *
 * @copyright  Nils Heinold 
 * @author     Nils Heinold 
 * @package    nlsh_easy_Piwik_Counter
 */
class ModuleNlshEasyPiwikCounter extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'nlsh_easy_Piwik_Counter';


	/**
	 * Kontakt zum PIWIK- Server
	 * @boolean
	 */
	 protected $booleanConnect;


	/**
	 * Generate module
	 */
	protected function compile()
	{
		//Vorgabe durch Benutzereingabe
		$piwik_Domain                  = $this->nlsh_piwik_domain;
		$piwik_Id_Site                 = $this->nlsh_piwik_id_site;
		$piwik_LastMinutes             = $this->nlsh_piwik_last_minutes;
		$piwik_Token_auth              = $this->nlsh_piwik_token_auth;
		$piwik_Range_Start             = $this->nlsh_piwik_range_start;
		$piwik_visits_start            = $this->nlsh_piwik_visits_start;

		$piwik_Range_Start    = date("Y-m-d", $piwik_Range_Start);

		// Kontrolle, ob korrekte Adresse ins www
		$parseUrl = (parse_url($piwik_Domain));

		if (!$parseUrl['scheme'])
		{
			$piwik_Domain = "http://" . $piwik_Domain;
		}

		// Vorgaben per Modul
		$piwik_Module           = 'API';
		$piwik_date             = date ("Y-m-d", mktime(0, 0, 0, date("m"), date("d")     , date("Y")));
		$piwik_date_yesterday   = date ("Y-m-d", mktime(0, 0, 0, date("m"), date("d") -1  , date("Y")));
		$piwik_Range_End        = $piwik_date;

		// Besucher auslesen
		$piwik_Method = 'VisitsSummary.get';

		// gesamte Besucher auslesen
		$piwik_Period             = 'range';
		$piwik_file_get_contents  = "$piwik_Domain/index.php";
		$piwik_file_get_contents .= "?module=$piwik_Module";
		$piwik_file_get_contents .= "&method=$piwik_Method";
		$piwik_file_get_contents .= "&idSite=$piwik_Id_Site";
		$piwik_file_get_contents .= "&period=$piwik_Period";
		$piwik_file_get_contents .= "&date=$piwik_Range_Start,$piwik_Range_End";
		$piwik_file_get_contents .= "&format=php";
		$piwik_file_get_contents .= "&token_auth=$piwik_Token_auth";

		$piwik_visits_all                 = $this->piwikFileGetContents($piwik_file_get_contents);
		$easy_piwik_counter['visits_all'] = $piwik_visits_all['nb_visits'];

		$easy_piwik_counter['visits_all'] = $easy_piwik_counter['visits_all'] + $piwik_visits_start;

		// Monatsbesucher auslesen
		$piwik_Period             = 'month';
		$piwik_file_get_contents  = "$piwik_Domain/index.php";
		$piwik_file_get_contents .= "?module=$piwik_Module";
		$piwik_file_get_contents .= "&method=$piwik_Method";
		$piwik_file_get_contents .= "&idSite=$piwik_Id_Site";
		$piwik_file_get_contents .= "&period=$piwik_Period";
		$piwik_file_get_contents .= "&date=$piwik_date";
		$piwik_file_get_contents .= "&format=php";
		$piwik_file_get_contents .= "&token_auth=$piwik_Token_auth";

		$piwik_visits_month = $this->piwikFileGetContents($piwik_file_get_contents);

		$easy_piwik_counter['visits_month']       = $piwik_visits_month['nb_visits'];

		// Tagesbesucher auslesen
		$piwik_Period             = 'day';
		$piwik_file_get_contents  = "$piwik_Domain/index.php";
		$piwik_file_get_contents .= "?module=$piwik_Module";
		$piwik_file_get_contents .= "&date=$piwik_date";
		$piwik_file_get_contents .= "&method=$piwik_Method";
		$piwik_file_get_contents .= "&idSite=$piwik_Id_Site";
		$piwik_file_get_contents .= "&period=$piwik_Period";
		$piwik_file_get_contents .= "&format=php";
		$piwik_file_get_contents .= "&token_auth=$piwik_Token_auth";

		$piwik_visits_today = $this->piwikFileGetContents($piwik_file_get_contents);

		$easy_piwik_counter['visits_today']       = $piwik_visits_today['nb_visits'];

		// Tagesbesucher von Gestern auslesen
		$piwik_Period             = 'day';
		$piwik_file_get_contents  = "$piwik_Domain/index.php";
		$piwik_file_get_contents .= "?module=$piwik_Module";
		$piwik_file_get_contents .= "&date=$piwik_date_yesterday";
		$piwik_file_get_contents .= "&method=$piwik_Method";
		$piwik_file_get_contents .= "&idSite=$piwik_Id_Site";
		$piwik_file_get_contents .= "&period=$piwik_Period";
		$piwik_file_get_contents .= "&format=php";
		$piwik_file_get_contents .= "&token_auth=$piwik_Token_auth";

		$piwik_visits_yesterday = $this->piwikFileGetContents($piwik_file_get_contents);

		$easy_piwik_counter['visits_yesterday'] = $piwik_visits_yesterday['nb_visits'];

		// aktuell Besucher online
		$piwik_Method 	          = 'Live.getCounters';
		$piwik_file_get_contents  = "$piwik_Domain/index.php";
		$piwik_file_get_contents .= "?module=$piwik_Module";
		$piwik_file_get_contents .= "&method=$piwik_Method";
		$piwik_file_get_contents .= "&idSite=$piwik_Id_Site";
		$piwik_file_get_contents .= "&lastMinutes=$piwik_LastMinutes";
		$piwik_file_get_contents .= "&format=php";
		$piwik_file_get_contents .= "&token_auth=$piwik_Token_auth";

		$piwik_visits_online = $this->piwikFileGetContents($piwik_file_get_contents);

		$easy_piwik_counter['visits_online'] = $piwik_visits_online[0]['visits'];

		// Wenn Verbindung vorhanden, dann neuen Eintrag in Datenbank -> nlsh_piwik_last_connect
		if ($this->booleanConnect)
		{
			$update = \ModuleModel::findByPk($this->id);
			$update->nlsh_piwik_last_connect = serialize($easy_piwik_counter);
			$update->save();
		}

		// Wenn keine Verbindung vorhanden, dann Eintrag aus Modul -> nlsh_piwik_last_connect
		if ($this->booleanConnect == false)
		{
			$easy_piwik_counter = unserialize($this->nlsh_piwik_last_connect);

			// bis auf Gesamtzähler überschreiben
			$easy_piwik_counter['visits_month']     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];
			$easy_piwik_counter['visits_today']     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];
			$easy_piwik_counter['visits_yesterday'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];
			$easy_piwik_counter['visits_online']    = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];
		}

		// der piwik- Code zum Auswerten der Website sollte am Ende der html- Seite stehen
		// der Counter steht dadurch in der Reihenfolge vor dessen Aufruf
		// d.h. beim ersten Abfragen der API ist der eigene erste Aufruf der Seite noch gar nicht
		// vom Piwik- Server registriert, so dass eine um 1 falsche Ausgabe erzeugt wird.
		// dies wird hier korrigiert, anhand der gerade vorhandenen online Besucher
		// ist zwar auch nicht richtig, dafür verwirrt aber ein online- Counter von 0 nicht mehr

		if ( $easy_piwik_counter['visits_online'] == false )
		{
			$easy_piwik_counter['visits_all']        = ($easy_piwik_counter['visits_all'] + 1);
			$easy_piwik_counter['visits_month']      = ($easy_piwik_counter['visits_month'] + 1);
			$easy_piwik_counter['visits_today']      = ($easy_piwik_counter['visits_today'] + 1);
			$easy_piwik_counter['visits_yesterday']  = ($easy_piwik_counter['visits_yesterday'] + 1);
			$easy_piwik_counter['visits_online']     = 1;
		}

		// Zahlen formatieren, Länder- Spezifikationen berücksichtigen
		$easy_piwik_counter['visits_all']           = number_format( $easy_piwik_counter['visits_all'],0,$GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);

		if ($this->booleanConnect)
		{
			$easy_piwik_counter['visits_month']     = number_format( $easy_piwik_counter['visits_month'],0,$GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);
			$easy_piwik_counter['visits_today']     = number_format( $easy_piwik_counter['visits_today'],0,$GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);
			$easy_piwik_counter['visits_yesterday'] = number_format( $easy_piwik_counter['visits_yesterday'],0,$GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);
			$easy_piwik_counter['visits_online']    = number_format( $easy_piwik_counter['visits_online'],0,$GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);
		}

		// Texte übernehmen
		$easy_piwik_counter['visits_all_title']       = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_all_title'];
		$easy_piwik_counter['visits_month_title']     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_month_title'];
		$easy_piwik_counter['visits_today_title']     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_today_title'];
		$easy_piwik_counter['visits_yesterday_title'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_yesterday_title'];
		$easy_piwik_counter['visits_online_title']    = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_online_title'];

		//Und rein in das Temlate
		$this->Template->easy_piwik_counter = $easy_piwik_counter;
	}


	/**
	* Abfrage des PIWIK- Servers
	* @param string  Url mit Abfrage zum PIWIK- Server
	* @return array  Array mit den abgefragten Werten
	**/
	protected function piwikFileGetContents($strUrl)
	{
		$arrResult = file_get_contents($strUrl);

		if($arrResult) $this->booleanConnect = true;

		$arrResult = unserialize($arrResult);

		return $arrResult;
	}
}