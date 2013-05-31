<?php
/**
 * Namespace der Erweiterung.
 */
namespace nlsh\easyPiwikCounter;


/**
 * Das PIWIK- Impressum an das Template übergeben.
 *
 * @copyright  Nils Heinold (c) 2012
 * @author     Nils Heinold 
 * @package    nlshEasyPiwikCounter
 * @link       http://github.com/nlsh/nlsh_easy_Piwik_Counter
 * @license    LGPL
 */
class ContentNlshEasyPiwikImpressum extends \ContentElement
{


    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'nlsh_easy_Piwik_Impressum';


    /**
     * Das Modul generieren.
     *
     * Werte für das Template bereitstellen.
     *
     * @return void
     */
    protected function compile() {
         // Suche nach einem Modul des Typs 'nlsh_easy_Piwik_Module'
        $objPiwikModule = \ModuleModel::findOneBy('type', 'nlsh_easy_Piwik_Counter');

        if ($objPiwikModule !== NULL) {
             // Impressumstext hinzufügen
            $arrEasyPiwikImpressum['impressumtext'] = $objPiwikModule->nlsh_piwik_impressum;

             // Abschalten einbinden, falls erwünscht und URL vorhanden
            if (($objPiwikModule->nlsh_piwik_noscan == TRUE)
                    && ($objPiwikModule->nlsh_piwik_domain == TRUE)) {
                         // Pfad zur Website mit scheme "http://" vorbelegen,
                         // falls scheme nicht vorhanden
                        $parseUrl = (parse_url($objPiwikModule->nlsh_piwik_domain));

                        if (!$parseUrl['scheme']) {
                            $objPiwikModule->nlsh_piwik_domain = 'http://' .
                                                            $objPiwikModule->nlsh_piwik_domain;
                        }

                         // Pfad zur CSS- Datei hinzufügen
                        $urlCssOptOut = $this->Environment->url .
                                                            $GLOBALS['TL_CONFIG']['websitePath'] .
                                                            '/files/nlsh_piwik_counter_' .
                                                            $objPiwikModule->id .
                                                            '.css';

                         // HTML- String für das iframe erzeugen und hinzufügen
                        $arrEasyPiwikImpressum['piwiknoscan'] = sprintf(
                                "<iframe class =\"piwikiframe\" frameborder=\"0\" src=\"%s/index.php?module=CoreAdminHome&amp;action=optOut&amp;language=%s&amp;css=%s\"></iframe>",
                                $objPiwikModule->nlsh_piwik_domain,
                                $GLOBALS['TL_LANGUAGE'],
                                $urlCssOptOut);
            }
        } else {
             // Fehlermeldung, wenn kein PIWIK- Modul vorhanden
            $arrEasyPiwikImpressum['nopiwikmodul'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_ContentImpressum']['nopiwikmodul'];
        }

         // und ab in das Template
        $this->Template->piwikimpressum = (object) $arrEasyPiwikImpressum;
    }
}