<?php


/**
 * Namespace
 */
namespace nlsh\easyPiwikCounter;


/**
* DCA- Klasse der Tabelle tl_modules erweitern
*
* @package easyPiwikCounter
*/


/**
 * Enthält Funktionen der Konfiguration einzelner Felder des DCA`s tl_module
 *
 * @copyright  Nils Heinold
 * @author     Nils Heinold
 * @package    nlshEasyPiwikCounter
 * @link       http://github.com/nlsh/nlsh_easy_Piwik_Counter
 * @license    LGPL
 */
class tl_modulePiwikImpressum extends \Backend
{
    /**
    * Korrektur der Anzeige der PIWIK- Seiten ID, wenn 0, dann leeres Feld anzeigen
    *
    * Vorbelegt durch die Datenbank ist ein Wert von 0,
    * da int- Felder wohl einen Wert haben müssen
    *
    * ein load/save_callback des Feldes nlsh_piwik_id_site
    *
    * @param   int          $field Feldwert
    * @return  int|string   entweder vorhandene ID, oder Leerstring
    */
    public function checkIdSiteDuringLoad($field) {
        $return = ($field == 0) ? '' : $field;

        return $return;
    }


    /**
    * Fehlermeldung erzeugen, falls die PIWIK- Seiten ID den Wert 0 hat
    *
    * ein save_callback des Feldes nlsh_piwik_id_site
    *
    * @param   int  $field Feldwert
    * @return  int  Feldwert
    */
    public function checkIdSiteDuringSave($field) {
        if ($field == 0) {
            throw new Exception($GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_id_site_not_null']);
        }

        return $field;
    }


    /**
    * Impressums- Text prüfen
    *
    * Sollte das Feld Impressum leer sein ( z.B für Rücksetzung auf Default Text),
    * dann Default- Text einfügen
    *
    * ein load/save_callback des Feldes nlsh_piwik_impressum
    *
    * @param   string  $field eingegebener oder nicht eingegebener Impressumstext
    * @return  string  Impressumstext
    */
    public function checkImpressum($field) {
        if ($field == FALSE) {
            $field = $GLOBALS['TL_LANG']['MSC']['piwik_Impressum'];
        }

        return $field;
    }


    /**
     * CSS- Code in Template- Ordner speichern
     *
     * save_callback des Feldes nlsh_piwik_css_optout
     *
     * @param   string          $field Feldwert
     * @param   \DataContainer  $dc DataContainer- Objekt
     * @return  string          Feldwert unverändert zurück
     */
    public function saveOptOut($field, \DataContainer $dc) {
        $cssdatei = fopen('../files/nlsh_piwik_counter_' . $dc->activeRecord->id . '.css', 'w');
        fwrite($cssdatei, $field);
        fclose($cssdatei);

        return $field;
    }
}