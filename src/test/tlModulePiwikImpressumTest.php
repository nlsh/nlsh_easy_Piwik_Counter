<?php
/**
 * Namespace
 */
namespace PhpUnitTest\easyPiwikCounter;


 /** PHPUnit Test der Klasse tl_modulePiwikImpressum
 *
 * Dies ist eine Testklasse für die Funktionen
 * der Klasse tl_modulePiwikImpressum
 *
 * Beispielaufruf in der Konsole:
 *
 * phpunit tlModulePiwikImpressumTest
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
    TL_ROOT . '/system/modules/nlsh_easy_Piwik_Counter/classes/tl_modulePiwikImpressum.php'
);

$tempClass = str_replace('// PlatzhalterKontruktor', 'public function __construct(){}', $tempClass);

$handle    = fopen(TL_ROOT . '/system/tmp/tl_modulePiwikImpressum.php', 'w');

fwrite($handle, $tempClass);
fclose($handle);

require_once TL_ROOT . '/system/tmp/tl_modulePiwikImpressum.php';


/**
 * Sprache laden, da Modul sprachabhängig
 * ( Sprache hier: Deutsch)
 */
require_once TL_ROOT . '/system/modules/nlsh_easy_Piwik_Counter/languages/de/default.php';


/** PHPUnit- Testklasse der Klasse tl_modulePiwikImpressum
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
class tlModulePiwikImpressumTest extends \PHPUnit_Framework_TestCase
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
        $this->object = new \nlsh\easyPiwikCounter\tl_modulePiwikImpressum();

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
     * Methode checkIdSiteDuringLoad testen
     *
     * 1. Wenn Übergabe Wert 0, dann leerer String zurück
     * 2. Wenn Wert größer 0, dann gleichen Wert wieder zurück
     *
     * @return void
     */
     public function testCheckIdSiteDuringLoad() {
         // Übergabe Wert = 0
        $this->assertEmpty(
                $this->object->checkIdSiteDuringLoad(0),
                '@return must be empty or FALSE'
        );

         // Übergabe Wert = 58
        $field = 58;

        $this->assertEquals(
                $field,
                $this->object->checkIdSiteDuringLoad($field),
                '@return must be Equal'
        );
     }
}