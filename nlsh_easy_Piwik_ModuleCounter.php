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
 * Class nlsh_easy_Piwik_ModuleCounter 
 *
 * @copyright  Nils Heinold 
 * @author     Nils Heinold 
 * @package    Controller
 */
class nlsh_easy_Piwik_ModuleCounter extends Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'nlsh_easy_Piwik_Counter';


	/**
	 * Generate module
	 */
	protected function compile()
	{

        //Vorgabe durch Benutzereingabe
        $piwik_Domain           = $this->nlsh_piwik_domain;
        $piwik_Id_Site          = $this->nlsh_piwik_id_site;
        $piwik_LastMinutes      = $this->nlsh_piwik_last_minutes;
        $piwik_Token_auth       = $this->nlsh_piwik_token_auth;
        $piwik_Range_Start      = $this->nlsh_piwik_range_start;
        $piwik_visits_start     = $this->nlsh_piwik_visits_start;

        $piwik_Range_Start    = date("Y-m-d", $piwik_Range_Start);

        // Kontrolle, ob korrekte Adresse ins Netz
        $parseUrl = (parse_url($piwik_Domain));

        if (!$parseUrl['scheme'])
        {
            $piwik_Domain = "http://" . $piwik_Domain;
        }

        // Vorgaben per Modul
        $piwik_Module     	= 'API';
        $piwik_date   	        = date ("Y-m-d", mktime(0, 0, 0, date("m"), date("d")  , date("Y")));
        $piwik_date_yesterday   = date ("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1  , date("Y")));
        $piwik_Range_End        = $piwik_date;


        // Besucher auslesen
        $piwik_Method 	  = 'VisitsSummary.get';

        // gesamte Besucher auslesen
        $piwik_Period 	          = 'range';
        $piwik_file_get_contents  = "$piwik_Domain/index.php";
        $piwik_file_get_contents .= "?module=$piwik_Module";
        $piwik_file_get_contents .= "&method=$piwik_Method";
        $piwik_file_get_contents .= "&idSite=$piwik_Id_Site";
        $piwik_file_get_contents .= "&period=$piwik_Period";
        $piwik_file_get_contents .= "&date=$piwik_Range_Start,$piwik_Range_End";
        $piwik_file_get_contents .= "&format=php";
        $piwik_file_get_contents .= "&token_auth=$piwik_Token_auth";

        $piwik_visits_all                 = file_get_contents($piwik_file_get_contents);
        $piwik_visits_all                 = unserialize($piwik_visits_all);
        $easy_piwik_counter['visits_all'] = $piwik_visits_all['nb_visits'];

        $easy_piwik_counter['visits_all'] 	= $easy_piwik_counter['visits_all'] + $piwik_visits_start;
        $easy_piwik_counter['visits_all_title'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_all_title'];

        // Monatsbesucher auslesen
        $piwik_Period 	          = 'month';
        $piwik_file_get_contents  = "$piwik_Domain/index.php";
        $piwik_file_get_contents .= "?module=$piwik_Module";
        $piwik_file_get_contents .= "&method=$piwik_Method";
        $piwik_file_get_contents .= "&idSite=$piwik_Id_Site";
        $piwik_file_get_contents .= "&period=$piwik_Period";
        $piwik_file_get_contents .= "&date=$piwik_date";
        $piwik_file_get_contents .= "&format=php";
        $piwik_file_get_contents .= "&token_auth=$piwik_Token_auth";

        $piwik_visits_month = file_get_contents($piwik_file_get_contents);
        $piwik_visits_month = unserialize($piwik_visits_month);

        $easy_piwik_counter['visits_month']       = $piwik_visits_month['nb_visits'];
        $easy_piwik_counter['visits_month_title'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_month_title'];


        // Tagesbesucher auslesen
        $piwik_Period 	          = 'day';
        $piwik_file_get_contents  = "$piwik_Domain/index.php";
        $piwik_file_get_contents .= "?module=$piwik_Module";
        $piwik_file_get_contents .= "&date=$piwik_date";
        $piwik_file_get_contents .= "&method=$piwik_Method";
        $piwik_file_get_contents .= "&idSite=$piwik_Id_Site";
        $piwik_file_get_contents .= "&period=$piwik_Period";
        $piwik_file_get_contents .= "&format=php";
        $piwik_file_get_contents .= "&token_auth=$piwik_Token_auth";

        $piwik_visits_today = file_get_contents($piwik_file_get_contents);
        $piwik_visits_today = unserialize($piwik_visits_today);

        $easy_piwik_counter['visits_today']       = $piwik_visits_today['nb_visits'];
        $easy_piwik_counter['visits_today_title'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_today_title'];

        // Tagesbesucher von Gestern auslesen
        $piwik_Period 	          = 'day';
        $piwik_file_get_contents  = "$piwik_Domain/index.php";
        $piwik_file_get_contents .= "?module=$piwik_Module";
        $piwik_file_get_contents .= "&date=$piwik_date_yesterday";
        $piwik_file_get_contents .= "&method=$piwik_Method";
        $piwik_file_get_contents .= "&idSite=$piwik_Id_Site";
        $piwik_file_get_contents .= "&period=$piwik_Period";
        $piwik_file_get_contents .= "&format=php";
        $piwik_file_get_contents .= "&token_auth=$piwik_Token_auth";

        $piwik_visits_yesterday = file_get_contents($piwik_file_get_contents);
        $piwik_visits_yesterday = unserialize($piwik_visits_yesterday);

        $easy_piwik_counter['visits_yesterday']       = $piwik_visits_yesterday['nb_visits'];
        $easy_piwik_counter['visits_yesterday_title'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_yesterday_title'];

        // aktuell Besucher online
        $piwik_Method 	          = 'Live.getCounters';
        $piwik_file_get_contents  = "$piwik_Domain/index.php";
        $piwik_file_get_contents .= "?module=$piwik_Module";
        $piwik_file_get_contents .= "&method=$piwik_Method";
        $piwik_file_get_contents .= "&idSite=$piwik_Id_Site";
        $piwik_file_get_contents .= "&lastMinutes=$piwik_LastMinutes";
        $piwik_file_get_contents .= "&format=php";
        $piwik_file_get_contents .= "&token_auth=$piwik_Token_auth";

        $piwik_visits_online = file_get_contents($piwik_file_get_contents);
        $piwik_visits_online = unserialize($piwik_visits_online);
        $piwik_visits_online = $piwik_visits_online[0]['visits'];

        // der piwik- Code zum Auswerten der Website sollte am Ende der html- Seite stehen
        // der Counter steht dadurch in der Reihenfolge vor dessen Aufruf
        // d.h. beim ersten Abfragen der API ist der eigene erste Aufruf der Seite noch gar nicht
        // vom Piwik- Server registriert, so dass eine um 1 falsche Ausgabe erzeugt wird.
        // dies wird hier korrigiert, anhand der gerade vorhandenen online Besucher
        // ist zwar auch nicht richtig, dafür verwirrt aber ein online- Counter von 0 nicht mehr

        if ($piwik_visits_online == false )
        {
                $piwik_visits_online = 1;
	        $easy_piwik_counter['visits_today'] = ($easy_piwik_counter['visits_today'] + 1);
	        $easy_piwik_counter['visits_month'] = ($easy_piwik_counter['visits_month'] + 1);
	        $easy_piwik_counter['visits_all']   = ($easy_piwik_counter['visits_all'] + 1);

        }

        $easy_piwik_counter['visits_online']       = $piwik_visits_online;
        $easy_piwik_counter['visits_online_title'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_online_title'];

	$this->Template->easy_piwik_counter = $easy_piwik_counter;
	}
}

?>