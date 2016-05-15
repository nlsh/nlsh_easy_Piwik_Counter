<?php
/**
 * Namespace der Erweiterung.
 */
namespace nlsh\easyPiwikCounter;


/**
 * Übergibt die per API abgefragten Werte eines PIWIK- Servers an das Template
 *
 * @copyright  Nils Heinold (c) 2012
 * @author     Nils Heinold
 * @package    nlshEasyPiwikCounter
 * @link       http://github.com/nlsh/nlsh_easy_Piwik_Counter
 * @license    LGPL
 * @todo       Fehlermeldung vom PIWIK- Server im Log eintragen
 */
class ModuleNlshEasyPiwikCounter extends \Module
{


    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'nlsh_easy_Piwik_Counter';


    /**
     * PIWIK Server korrekt abgefragt
     *
     * War Abfrage des PIWIK- Servers korrekt?
     *
     * @var boolean
     */
    protected $bolConnectCorrectlyPiwikServer = FALSE;


    /**
     * Fehlermeldung vom PIWIK Server
     *
     * false: kein Fehler bei PIWIK- Server Abfrage
     *
     * array: Fehlermeldung des PIWIK- Servers
     *
     * @var false|array false: kein Fehler bei PIWIK- Server Abfrage
     *                  array: Fehlermeldung des PIWIK- Servers
     */
    protected $arrErrorResultPiwikServer = FALSE;


    /**
     * Im Backend eine wildcard anzeigen
     *
     * @return string HTML Ausgabe, getrennt für das Backend/ Frontend
     */
    public function generate() {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### NLSH EASY PIWIK- COUNTER ###';
            $objTemplate->title    = $this->headline;
            $objTemplate->id       = $this->id;
            $objTemplate->link     = $this->name;
            $objTemplate->href     = 'contao/main.php?do=modules&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }


    /**
     * Das Modul generieren.
     *
     * Werte für das Template bereitstellen
     *
     * @return void
     */
    public function compile() {
        $this->nlsh_piwik_range_start = date('Y-m-d', $this->nlsh_piwik_range_start);

        $dateToday     = date('Y-m-d', mktime( 0, 0, 0, date('m'), date('d'), date('Y')));
        $dateYesterday = date('Y-m-d', mktime( 0, 0, 0, date('m'), date('d') - 1, date('Y')));

         // Texte übernehmen
        $this->Template->description_visits_all       = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_all_title'];
        $this->Template->description_visits_month     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_month_title'];
        $this->Template->description_visits_today     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_today_title'];
        $this->Template->description_visits_yesterday = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_yesterday_title'];
        $this->Template->description_visits_online    = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_online_title'];

         // Gesamtzähler mit letzten abgerufenen Wert vorbelegen
        $this->Template->visits_all       = $this->formatNumber( $this->nlsh_piwik_last_connect);

         // Fehlerwerte vorbelegen
        $this->Template->visits_month     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];
        $this->Template->visits_today     = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];
        $this->Template->visits_yesterday = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];
        $this->Template->visits_online    = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_Counter']['visits_now_no_data'];

         // Kontrolle, ob korrekte Adresse mit scheme
        $parseUrl = (parse_url($this->nlsh_piwik_domain));

        if (!$parseUrl['scheme']) {
            $this->nlsh_piwik_domain = 'http://' . $this->nlsh_piwik_domain;
        }

         // Besucher auslesen
         // gesamte Besucher auslesen
        $urlFileGetContens = '&method=VisitsSummary.get' .
                             '&idSite=' . $this->nlsh_piwik_id_site .
                             '&period=range' .
                             '&date='   . $this->nlsh_piwik_range_start . ',' . $dateToday;

        $piwikVisitsAll = $this->askPiwikServer($urlFileGetContens);
        $piwikVisitsAll = $piwikVisitsAll['nb_visits'] + $this->nlsh_piwik_visits_start;

        if ($this->bolConnectCorrectlyPiwikServer == TRUE) {
            $this->Database
                ->prepare("
                    UPDATE      `tl_module`
                    SET         `nlsh_piwik_last_connect` = ?
                    WHERE       `tl_module`.`id` = ?"
            )
            ->execute($piwikVisitsAll, $this->id);

             // und rein ins Template
            $this->Template->visits_all = $this->formatNumber($piwikVisitsAll);

             // Monatsbesucher auslesen
            $urlFileGetContens = '&method=VisitsSummary.get' .
                                 '&idSite=' . $this->nlsh_piwik_id_site .
                                 '&period=month' .
                                 '&date=' . $dateToday;

            $piwikVisitsMonth             = $this->askPiwikServer($urlFileGetContens);
            $this->Template->visits_month = $this->formatNumber($piwikVisitsMonth['nb_visits']);

             // Tagesbesucher auslesen
            $urlFileGetContens = '&method=VisitsSummary.get' .
                                 '&idSite=' . $this->nlsh_piwik_id_site .
                                 '&period=day' .
                                 '&date=' . $dateToday;

            $piwikVisitsToday             = $this->askPiwikServer($urlFileGetContens);
            $this->Template->visits_today = $this->formatNumber($piwikVisitsToday['nb_visits']);

             // Tagesbesucher von Gestern auslesen
            $urlFileGetContens = '&method=VisitsSummary.get' .
                                 '&idSite=' . $this->nlsh_piwik_id_site .
                                 '&period=day' .
                                 '&date=' . $dateYesterday;

            $piwikVisitsYesterday             = $this->askPiwikServer($urlFileGetContens);
            $this->Template->visits_yesterday = $this->formatNumber($piwikVisitsYesterday['nb_visits']);

             // aktuell Besucher online
            $urlFileGetContens = '&method=Live.getCounters' .
                                 '&idSite=' . $this->nlsh_piwik_id_site .
                                 '&lastMinutes=' . $this->nlsh_piwik_last_minutes;

            $piwikVisitsOnline             = $this->askPiwikServer($urlFileGetContens);
            $this->Template->visits_online = $this->formatNumber($piwikVisitsOnline[0]['visits']);

             // Der Piwik- Code zum Auswerten der Website sollte am Ende der
             // HTML- Seite stehen. Der Counter steht dadurch in der
             // Reihenfolge vor dessen Aufruf, d.h. beim ersten Abfragen der
             // API ist der eigene, erste Aufruf der Seite noch gar nicht
             // vom Piwik- Server registriert, so dass eine um 1 falsche
             // Ausgabe erzeugt wird!
             // Dies wird hier korrigiert, anhand der gerade vorhandenen
             // online Besucher.
             // ist zwar auch nicht richtig, dafür verwirrt aber ein
             // online- Counter von 0 nicht mehr

            if (($this->Template->visits_online == 0)) {
                $this->Template->visits_all    = ($this->Template->visits_all   + 1);
                $this->Template->visits_month  = ($this->Template->visits_month + 1);
                $this->Template->visits_today  = ($this->Template->visits_today + 1);
                $this->Template->visits_online = 1;
            }
        }
    }


    /**
    * Abfrage des PIWIK- Servers
    *
    * @param   string       $strUrlFragment -> Url- Fragment zur Abfrage des
    *                       PIWIK- Servers
    * @return  array|false  Array mit den abgefragten Werten oder false
    */
    public function askPiwikServer($strUrlFragment) {
        $strUrl  = $this->nlsh_piwik_domain . '/index.php?module=API' . $strUrlFragment;
        $strUrl .= $strUrl . '&format=php&token_auth=' . $this->nlsh_piwik_token_auth;

         // Kontrolle ob Curl in php.ini aktiviert
        $curlActive = FALSE;

        if (in_array('curl', get_loaded_extensions())) {
            $curlActive = TRUE;
        };

        if (($curlActive === TRUE)) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $strUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                @$result = curl_exec($ch);
                curl_close($ch);
        };

        $result = unserialize($result);

        if ($result) {
            $this->bolConnectCorrectlyPiwikServer = TRUE;
        }

         // Kontrolle, ob Ergebnis nicht Fehlermeldung des PIWIK- Servers
        if ($result['result'] == TRUE) {
             // erst einmal speichern
            $this->arrErrorResultPiwikServer = $result;

             // danach den Connect auf falsch zurücksetzten
            $this->bolConnectCorrectlyPiwikServer = FALSE;

             // und Ergebnis wieder auf false setzen
            $result = FALSE;
        }

        return $result;
    }


    /**
     *  Zahl ohne Nachkommastellen formatieren
     *
     * Länder- Spezifikationen für Tausenderdarstellung werden berücksichtigt
     *
     * @param  int  $intNum zu formatierende Zahl
     * @return int  formatierte Zahl
     */
    public function formatNumber($intNum) {
        $return = number_format(
                            $intNum,
                            0,
                            $GLOBALS['TL_LANG']['MSC']['decimalSeparator'],
                            $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']
        );

        return $return;
    }
}