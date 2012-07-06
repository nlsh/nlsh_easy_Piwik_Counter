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
     * Generate module
     */
    protected function compile()
    {
        $this->nlsh_piwik_range_start = date('Y-m-d', $this->nlsh_piwik_range_start);
        $dateToday                    = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')    , date('Y') ));
        $dateYesterday                = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') -1 , date('Y') ));

        // Kontrolle, ob korrekte Adresse mit scheme
        $parseUrl = (parse_url($this->nlsh_piwik_domain));

        if (!$parseUrl['scheme'])
        {
            $this->nlsh_piwik_domain = "http://" . $this->nlsh_piwik_domain;
        }

        // Besucher auslesen
        // gesamte Besucher auslesen
        $urlFileGetContens = '&method=' . 'VisitsSummary.get'
                           . '&idSite=' . $this->nlsh_piwik_id_site
                           . '&period=' . 'range'
                           . '&date='   . $this->nlsh_piwik_range_start . ',' . $dateToday;

        $piwik_visits_all               = $this->piwikFileGetContents($urlFileGetContens);
        $easyPiwikCounter['visits_all'] = $piwik_visits_all['nb_visits'] + $this->nlsh_piwik_visits_start;

        // Monatsbesucher auslesen
        $urlFileGetContens = '&method=' . 'VisitsSummary.get'
                           . '&idSite=' . $this->nlsh_piwik_id_site
                           . '&period=' . 'month'
                           . '&date='   . $dateToday;

        $piwik_visits_month               = $this->piwikFileGetContents($urlFileGetContens);
        $easyPiwikCounter['visits_month'] = $piwik_visits_month['nb_visits'];

        // Tagesbesucher auslesen
        $urlFileGetContens = '&method=' . 'VisitsSummary.get'
                           . '&idSite=' . $this->nlsh_piwik_id_site
                           . '&period=' . 'day'
                           . '&date='   . $dateToday;

        $piwik_visits_today               = $this->piwikFileGetContents($urlFileGetContens);
        $easyPiwikCounter['visits_today'] = $piwik_visits_today['nb_visits'];

        // Tagesbesucher von Gestern auslesen
        $urlFileGetContens = '&method=' . 'VisitsSummary.get'
                           . '&idSite=' . $this->nlsh_piwik_id_site
                           . '&period=' . 'day'
                           . '&date='   . $dateYesterday;

        $piwik_visits_yesterday               = $this->piwikFileGetContents($urlFileGetContens);
        $easyPiwikCounter['visits_yesterday'] = $piwik_visits_yesterday['nb_visits'];

        // aktuell Besucher online
        $urlFileGetContens = '&method='      . 'Live.getCounters'
                           . '&idSite='      . $this->nlsh_piwik_id_site
                           . '&lastMinutes=' . $this->nlsh_piwik_last_minutes;

        $piwik_visits_online               = $this->piwikFileGetContents($urlFileGetContens);
        $easyPiwikCounter['visits_online'] = $piwik_visits_online[0]['visits'];

        // Wenn Verbindung vorhanden
        if ( ($easyPiwikCounter['visits_all'] - $this->nlsh_piwik_visits_start) != 0)
        {
            $this->Database->prepare("UPDATE `tl_module` SET `nlsh_piwik_last_connect` = ? WHERE `tl_module`.`id` = ?")
                        ->execute(serialize($easyPiwikCounter),$this->id);

            // der Piwik- Code zum Auswerten der Website sollte am Ende der html- Seite stehen
            // der Counter steht dadurch in der Reihenfolge vor dessen Aufruf
            // d.h. beim ersten Abfragen der API ist der eigene erste Aufruf der Seite noch gar nicht
            // vom Piwik- Server registriert, so dass eine um 1 falsche Ausgabe erzeugt wird.
            // dies wird hier korrigiert, anhand der gerade vorhandenen online Besucher
            // ist zwar auch nicht richtig, dafür verwirrt aber ein online- Counter von 0 nicht mehr

            if ( $easyPiwikCounter['visits_online'] == false )
            {
                $easyPiwikCounter['visits_all']        = ($easyPiwikCounter['visits_all'] + 1);
                $easyPiwikCounter['visits_month']      = ($easyPiwikCounter['visits_month'] + 1);
                $easyPiwikCounter['visits_today']      = ($easyPiwikCounter['visits_today'] + 1);
                $easyPiwikCounter['visits_online']     = 1;
            }

            // Zahlen formatieren, Länder- Spezifikationen berücksichtigen
            $easyPiwikCounter['visits_all']       = number_format( $easyPiwikCounter['visits_all'],0,$GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);
            $easyPiwikCounter['visits_month']     = number_format( $easyPiwikCounter['visits_month'],0,$GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);
            $easyPiwikCounter['visits_today']     = number_format( $easyPiwikCounter['visits_today'],0,$GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);
            $easyPiwikCounter['visits_yesterday'] = number_format( $easyPiwikCounter['visits_yesterday'],0,$GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);
            $easyPiwikCounter['visits_online']    = number_format( $easyPiwikCounter['visits_online'],0,$GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);

        }

        // Wenn keine Verbindung vorhanden, dann Eintrag aus Modul -> nlsh_piwik_last_connect
        else
        {
            $easyPiwikCounter = unserialize($this->nlsh_piwik_last_connect);

            // nur den Gesamtzähler übernehmen
            $easyPiwikCounter['visits_all']       = number_format( $easyPiwikCounter['visits_all'],0,$GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);

            // die anderen Zähler überschreiben
            $easyPiwikCounter['visits_month']     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];
            $easyPiwikCounter['visits_today']     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];
            $easyPiwikCounter['visits_yesterday'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];
            $easyPiwikCounter['visits_online']    = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];
        }

        // Texte übernehmen
        $easyPiwikCounter['visits_all_title']       = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_all_title'];
        $easyPiwikCounter['visits_month_title']     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_month_title'];
        $easyPiwikCounter['visits_today_title']     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_today_title'];
        $easyPiwikCounter['visits_yesterday_title'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_yesterday_title'];
        $easyPiwikCounter['visits_online_title']    = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_online_title'];

        //Und rein in das Temlate
        $this->Template->easyPiwikCounter = $easyPiwikCounter;
    }


    /**
    * Abfrage des PIWIK- Servers
    * @param string  Url- Fragment mit Abfrage zum PIWIK- Server
    * @return array  Array mit den abgefragten Werten
    **/
    protected function piwikFileGetContents($strUrl)
    {
        $strUrl = $this->nlsh_piwik_domain . '/index.php?module=API' . $strUrl . '&format=php&token_auth=' . $this->nlsh_piwik_token_auth;

        $arrResult = file_get_contents($strUrl);

        return unserialize($arrResult);
    }
}