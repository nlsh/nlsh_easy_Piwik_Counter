<?php
/**
 * Easy Piwik Counter
 *
 * PHPUnit Test der Klasse ModuleNlshEasyPiwikCounter
 *
 * Beispielaufruf in der Konsole:
 *
 * cd C:\xampp\htdocs\Entwicklungen\nlsh_easy_Piwik_Counter\system\modules\nlsh_easy_Piwik_Counter\test
 *
 * phpunit ModuleNlshEasyPiwikCounterTest
 *
 */


/**
 * Namespace
 */
namespace PhpUnitTest\easyPiwikCounter;


/**
 * Das Contao- System für den PHPUnit- Test initialisieren.
 */
define('TL_MODE', 'FE');
require(dirname(dirname(dirname(dirname(__FILE__)))).'/initialize.php');


/**
 * PHPUnit laden
 */
require_once 'PHPUnit/Autoload.php';


/**
 * Die zu testende Klasse laden
 *
 * Da die zu testende Klasse keinen Konstruktor besitzt, dieser aber für den Test benötigt wird,
 * lesen wir die Datei der Klasse ein, erweitern sie um den Konstruktor, speichern sie im Temp- Systemordner
 * und includen diese danach.
 * Gelöscht kann diese dort dann per Systemwartung
 */
$tempClass = file_get_contents(TL_ROOT . '/system/modules/nlsh_easy_Piwik_Counter/modules/ModuleNlshEasyPiwikCounter.php');
$tempClass = str_replace('//PlatzhalterKontruktor', 'public function __construct(){}', $tempClass);
$handle    = fopen(TL_ROOT . '/system/tmp/ModuleNlshEasyPiwikCounter.php','w');

fwrite($handle, $tempClass);
fclose($handle);

require_once TL_ROOT . '/system/tmp/ModuleNlshEasyPiwikCounter.php';


/**
 * Sprache laden, da Modul sprachabhängig
 * ( Sprache hier: Deutsch)
 */
require_once TL_ROOT . '/system/modules/nlsh_easy_Piwik_Counter/languages/de/default.php';


/** Klasse ModuleNlshEasyPiwikCounterTest
 *
 * Testklasse der Klasse ModuleNlshEasyPiwikCounter
 *
 * PHPUnit version 3.7.8 or greater
 *
 * PHP version 5.3.2 or greater
 *
 * @copyright  Nils Heinold (c) 2012
 * @author     Nils Heinold
 * @package    nlshEasyPiwikCounter
 * @link       http://github.com/nlsh/nlsh_easy_Piwik_Counter
 * @license    LGPL
 */
class ModuleNlshEasyPiwikCounterTest extends \PHPUnit_Framework_TestCase
{


    /**
     * Übernimmt die zu testende Klasse
     * @var object
     */
    protected $object;


    /**
     * Ein Objekt aus der Klasse ModuleNlshEasyPiwikCounter in $this->object anlegen
     *
     * Bei jedem Aufruf der Funktion test...() wird ein neues Objekt hinterlegt
     */
    protected function setUp()
    {
        $this->object = new \nlsh\easyPiwikCounter\ModuleNlshEasyPiwikCounter();

        $this->object->bolPhpUnitTest = true;
    }


    /**
     * Das Objekt in $this->object wieder löschen
     *
     * Nach jedem Aufruf der Funktion test...() wird das Objekt wieder gelöscht!
     */
    protected function tearDown()
    {
        $this->object = false;
    }


    /**
     * Eigenschaften des initialisierten Objektes testen
     *
     * Die Eigenschaften des initialisierten Objektes müssen sein:
     *
     *  1. protected $strTemplate muss ein String sein!
     *  2. protected $bolConnectCorrectlyPiwikServer muss false sein!
     *  3. protected $arrErrorResultPiwikServer muss false sein!
     */
    public function testInitializedObject()
    {
        $this->assertAttributeInternalType ('string', 'strTemplate', $this->object, 'protected $strTemplate must be a string!');
        $this->assertAttributeEquals       (false, 'bolConnectCorrectlyPiwikServer', $this->object, 'protected $bolConnectCorrectlyPiwikServer must be false!');
        $this->assertAttributeEquals       (false, 'arrErrorResultPiwikServer', $this->object, 'protected $arrErrorResultPiwikServer must be false!');
    }


    /**
     * Methode formatNumber() testen
     *
     *  Test muss aus dem vorgegeben Wert '1000.4' den Wert '1.000' erzeugen!
     */
    public function testFormatNumber()
    {
        //Vorbelegung ist englisch, darum mit deutsch überschreiben und testen
        $GLOBALS['TL_LANG']['MSC']['decimalSeparator'] = ',';
        $GLOBALS['TL_LANG']['MSC']['thousandsSeparator'] = '.';

        $this->assertEquals('1.000', $this->object->formatNumber(1000.4), 'The number is formatted incorrectly!');
    }


    /**
     * Test 1 askPiwikServer() -> Alle Werte sind korrekt
     *
     * Ergebnis muss sein:
     *
     *  1. Der Rückgabewert darf nicht false oder leer sein!
     *  2. Der Rückgabewert muss ein Array sein!
     *  3. Der Rückgabewert muss im Array den Key ['nb_visits'] besitzen!
     *  4. Der Rückgabewert des Key`s ['nb_visits'] muss größer oder gleich null sein!
     *  5. protected $bolConnectCorrectlyPiwikServer muss true sein!
     *  6. protected $arrErrorResultPiwikServer muss false sein!
     */
    public function testAskPiwikServer1()
    {
        // Vorbelegung
        $this->object->nlsh_piwik_domain      = 'http://demo.piwik.org';    // existierender Piwik Server
        $this->object->nlsh_piwik_token_auth  = 'anonymous';                // Token Auth

        // Fragment der URL- Abfrage erstellen
        // als Beispiel die Jahresbesucher von piwik.org auslesen, die sollten nicht 0 sein
        $urlFileGetContens = '&method=' . 'VisitsSummary.get'
                           . '&idSite=' . 7
                           . '&period=' . 'year'
                           . '&date='   . 'today';

        $this->assertNotEmpty          ($this->object->askPiwikServer($urlFileGetContens), '@return must not be empty or false');
        $this->assertInternalType      ('array', $this->object->askPiwikServer($urlFileGetContens), '@return must be an array');
        $this->assertArrayHasKey       ('nb_visits', $this->object->askPiwikServer($urlFileGetContens), '@return array must has key [nb_visits]!');
        $this->assertGreaterThanOrEqual(0,$this->object->askPiwikServer($urlFileGetContens)['nb_visits'], '@return array[nb_visits] must greater than or equal zero!');
        $this->assertAttributeEquals   (true, 'bolConnectCorrectlyPiwikServer', $this->object, 'protected $bolConnectCorrectlyPiwikServer must be true!');
        $this->assertAttributeEquals   (false, 'arrErrorResultPiwikServer', $this->object, 'protected $arrErrorResultPiwikServer must be false!');
    }


    /**
     * Test 2 askPiwikServer() -> Adresse des Piwik- Server ist korrekt, aber der Aufruf des Selbigen ist falsch
     *
     * Ergebnis muss sein:
     *
     *  1. Der Rückgabewert muss false oder leer sein!
     *  2. protected $bolConnectCorrectlyPiwikServer muss false sein!
     *  3. protected $arrErrorResultPiwikServer muss ein Array sein!
     */
    public function testAskPiwikServer2()
    {
        // Vorbelegung
        $this->object->nlsh_piwik_domain      = 'http://demo.piwik.org';    // existierender Piwik Server
        $this->object->nlsh_piwik_token_auth  = 'anonymous';                // Token Auth

        // Fragment der URL- Abfrage erstellen
        // als Beispiel die Jahresbesucher von piwik.org auslesen, die sollten nicht 0 sein
        $urlFileGetContens = '';

        $this->assertEmpty                ($this->object->askPiwikServer($urlFileGetContens), '@return must be empty or false');
        $this->assertAttributeEquals      (false, 'bolConnectCorrectlyPiwikServer', $this->object, 'protected $bolConnectCorrectlyPiwikServer must be false!');
        $this->assertAttributeInternalType('array', 'arrErrorResultPiwikServer', $this->object, 'protected $arrErrorResultPiwikServer must be an array!');
    }


    /**
     * Test 3 askPiwikServer() -> Adresse des Piwik- Server ist falsch
     *
     * Ergebnis muss sein:
     *
     *  1. Der Rückgabewert muss false oder leer sein!
     *  2. protected $bolConnectCorrectlyPiwikServer muss false sein!
     *  3. protected $arrErrorResultPiwikServer muss false sein!
     */
    public function testAskPiwikServer3()
    {
        // Vorbelegung
        $this->object->nlsh_piwik_domain      = 'http://bild.de';    // kein Piwik Server

        // Fragment der URL- Abfrage erstellen
        // als Beispiel die Jahresbesucher von piwik.org auslesen, die sollten nicht 0 sein
        $urlFileGetContens = '&method=' . 'VisitsSummary.get'
                           . '&idSite=' . 7
                           . '&period=' . 'year'
                           . '&date='   . 'today';

        $this->assertEmpty($this->object->askPiwikServer($urlFileGetContens), '@return must be empty or false');
        $this->assertAttributeEquals(false, 'bolConnectCorrectlyPiwikServer', $this->object, 'protected $bolConnectCorrectlyPiwikServer must be false!');
        $this->assertAttributeEquals(false, 'arrErrorResultPiwikServer', $this->object, 'protected $arrErrorResultPiwikServer must be false!');
    }


    /**
     * Methode compile() testen
     *
     * diese Methode ist das eigentliche Programm des Moduls und wird durch den Core von Contao aufgerufen
     *
     * aber nicht direkt, sondern durch die Methode generate(), daher auch Aufruf über die Selbige!!
     *
     */


    /**
     *
     * Test 1 compile() -> Umwandlung der Adressierung zum PIWIK- Server
     *
     * Ergebnis muss sein
     *
     *  aus 'demo.piwik.org' muss 'http://demo.piwik.org' werden
     */
    public function testCompile()
    {
        $this->object->nlsh_piwik_domain      = 'demo.piwik.org';         // existierender Piwik Server
        $this->object->nlsh_piwik_token_auth  = 'anonymous';              // Token Auth
        $this->object->nlsh_piwik_id_site      = 7;                       // ID der Seite
        $this->object->nlsh_piwik_last_minutes = 20;                      // Zeitspanne online
        $this->object->nlsh_piwik_range_start = time() - ( 24 * 60 * 60); // einen Tag zurück

        $this->object->generate();

        $this->assertEquals('http://demo.piwik.org', $this->object->nlsh_piwik_domain);

    }

}
