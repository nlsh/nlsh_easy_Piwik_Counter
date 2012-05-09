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
 * Class nlsh_easy_Piwik_ContentImpressum
 *
 * @copyright  Nils Heinold
 * @author     Nils Heinold <http://www.nilsheinold.de>
 * @package Easy_Piwik_Counter
 */
class nlsh_easy_Piwik_ContentImpressum extends ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'nlsh_easy_Piwik_Impressum';


	/**
	 * Generate module
	 */
	protected function compile()
	{

    $easy_piwik_Impressum = '';

	// Abfrage der nlsh_easy_Piwik_Modules
	$nlsh_easy_Piwik_Modules = $this->Database->query("SELECT * FROM `tl_module` WHERE `nlsh_piwik_domain` != ''");

	// nur wenn ein Modul mit einer Piwik- Domaine vorhanden
  	if ($nlsh_easy_Piwik_Modules->numRows == true)
	{
        $urlcssOptOut = $this->Environment->url."/tl_files/nlsh_piwik_counter_".$nlsh_easy_Piwik_Modules->id.".css";

        $easy_piwik_Impressum['text'] = $nlsh_easy_Piwik_Modules->nlsh_piwik_impressum;

		// Anzahl der Piwik Module eintragen
        $easy_piwik_Impressum['countpiwikmodule'] = $nlsh_easy_Piwik_Modules->numRows;

		// Abschalten einbinden, falls erwünscht und URL vorhanden
    	if ( ($nlsh_easy_Piwik_Modules->nlsh_piwik_noscan == true) && ($nlsh_easy_Piwik_Modules->nlsh_piwik_domain == true))
        {
            $easy_piwik_Impressum['piwiknoscan'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_ContentImpressum']['piwik_noscan'];

			$easy_piwik_Impressum['piwiknoscan'] = str_replace("{piwik_host}",$nlsh_easy_Piwik_Modules->nlsh_piwik_domain , $easy_piwik_Impressum['piwiknoscan']);

			$easy_piwik_Impressum['piwiknoscan'] = str_replace("{piwik_lang}",$GLOBALS['TL_LANGUAGE'] , $easy_piwik_Impressum['piwiknoscan']);

            $easy_piwik_Impressum['piwiknoscan'] = str_replace("{piwik_css_optout}",$urlcssOptOut , $easy_piwik_Impressum['piwiknoscan']);
        }
	}
	else
	{
	        $easy_piwik_Impressum['nopiwikmodul'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_ContentImpressum']['nopiwikmodul'];
	}

	$this->Template->easy_piwik_Impressum = $easy_piwik_Impressum;
	}
}
?>