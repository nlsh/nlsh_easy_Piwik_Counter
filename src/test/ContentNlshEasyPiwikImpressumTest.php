<?php
/**
 * Namespace
 */
namespace PhpUnitTest\easyPiwikCounter;


 /** PHPUnit Test der Klasse ContentNlshEasyPiwikImpressum
 *
 * Dies ist eine Testklasse für die Funktionen
 * der Klasse ContentNlshEasyPiwikImpressum
 *
 * Beispielaufruf in der Konsole:
 *
 * phpunit ContentNlshEasyPiwikImpressumTest
 *
 * Manual : http://phpunit.de/manual/2.3/de/
 *          http://phpunit.de/manual/3.6/en/index.html
 */


/**
 * Das Contao- System für den PHPUnit- Test  auf TL_MODE FRONTEND definieren.
 */
define('TL_MODE', 'FE');

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/initialize.php');


/**
 * PHPUnit laden
 */
require_once 'PHPUnit/Autoload.php';


/**
 * Die zu testende Klasse laden
 *
 * Da die zu testende Klasse keinen Konstruktor besitzt, dieser aber für den
 * Test benötigt wird, lesen wir die Datei der Klasse ein, erweitern sie um
 * den Konstruktor, speichern sie im Temp- Systemordner und includen diese
 * danach.
 * Gelöscht werden kann diese dann dort per Systemwartung
 */
$tempClass = file_get_contents(
    TL_ROOT . '/system/modules/nlsh_easy_Piwik_Counter/elements/ContentNlshEasyPiwikImpressum.php'
);

$tempClass = str_replace('// PlatzhalterKontruktor', 'public function __construct(){}', $tempClass);

$handle    = fopen(TL_ROOT . '/system/tmp/ContentNlshEasyPiwikImpressum.php', 'w');

fwrite($handle, $tempClass);
fclose($handle);

require_once TL_ROOT . '/system/tmp/ContentNlshEasyPiwikImpressum.php';


/**
 * Sprache laden, da Modul sprachabhängig
 * ( Sprache hier: Deutsch)
 */
require_once TL_ROOT . '/system/modules/nlsh_easy_Piwik_Counter/languages/de/default.php';


/** PHPUnit- Testklasse der Klasse ContentNlshEasyPiwikImpressum
 *
 * PHPUnit version 3.7.8 oder höher
 *
 * PHP version 5.3.2 oder höher
 *
 * @copyright  Nils Heinold (c) 2012
 * @author     Nils Heinold
 * @package    nlshEasyPiwikCounter
 * @link       http://github.com/nlsh/nlsh_easy_Piwik_Counter
 * @license    LGPL
 */
class ContentNlshEasyPiwikImpressumTest extends \PHPUnit_Framework_TestCase
{


    /**
     * Übernimmt das Objekt der zu testenden Klasse
     *
     * das zu testende Objekt
     *
     * @var object
     */
    protected $object;


    /**
     * Testobjekt erzeugen und
     * $this->object->bolPhpUnitTest = TRUE hinzufügen
     *
     * Für jeden Test wird ein neues Objekt aus der Klasse erzeugt.
     *
     * @return void
     */
    protected function setUp() {
        $this->object = new \nlsh\easyPiwikCounter\ContentNlshEasyPiwikImpressum();

        $this->object->bolPhpUnitTest = TRUE;
    }


    /**
     * Testobjekt wieder löschen!
     *
     * Nach jedem Durchlauf einer Test- Methode
     * wird das zu testende Objekt wieder gelöscht.
     *
     * @return void
     */
    protected function tearDown() {
        $this->object = FALSE;
    }


    /**
     * Eigenschaften des initialisierten Objektes testen
     *
     * Die Eigenschaften des initialisierten Objektes müssen sein:
     *
     *  1. protected $strTemplate muss ein String sein!
     *
     * @return void
     */
    public function testInitializedObject() {
        $this->assertAttributeInternalType (
                                        'string',
                                        'strTemplate',
                                        $this->object,
                                        'protected $strTemplate must be a string!'
        );
    }


    /**
     * Methode compile() testen
     *
     * diese Methode ist das eigentliche Programm des Moduls
     * und wird durch den Core von Contao aufgerufen
     *
     * aber nicht direkt, sondern durch
     * die Methode generate(), daher auch Aufruf über die Selbige!!
     */


    /**
     * Test 1 compile()
     *
     * Test auf Fehlerausgabe, wenn Impressum ausgegeben werden soll,
     * obwohl kein Modul vom Typ 'nlsh_easy_Piwik_Counter'angelegt worden ist
     *
     * 1. Ausgabe der Fehlermeldung
     *
     * @return void
     */
    public function testCompile1NoModulNlshEasyPiwikCounter() {
         // ausführen
        $this->object->generate();

        $this->assertEquals(
            $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_ContentImpressum']['nopiwikmodul'],
            $this->object->Template->piwikimpressum->nopiwikmodul,
            'false Error- message, if module not exist'
        );
    }


    /**
     * Test 2 compile()
     *
     * Test Umwandlung der Adressierung zum PIWIK- Server
     *
     * Ergebnis muss sein
     *
     *  aus 'demo.piwik.org' muss 'http://demo.piwik.org' werden
     *
     * @return void
     */
    public function testCompile() {
          // Vorbelegung $objPiwikModule
         $this->object->objPiwikModulePhpUnitTest = (object) array(
                                                'nlsh_piwik_noscan' => TRUE,
                                                'nlsh_piwik_domain' => 'demo.piwik.org',
         );

        $this->object->generate();

        $this->assertEquals(
            'http://demo.piwik.org',
            $this->object->Template->objPiwikModulePhpUnitTest->nlsh_piwik_domain,
            'The convert of URL is not right!'
        );
    }
}