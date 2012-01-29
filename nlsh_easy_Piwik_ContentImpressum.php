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
 * Class nlsh_easy_Piwik_ContentImpressum
 *
 * @copyright  Nils Heinold
 * @author     Nils Heinold
 * @package    Controller
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
	$nlsh_easy_Piwik_Modules = $this->Database->execute("SELECT * FROM `tl_module` WHERE `nlsh_piwik_domain` != ''");

	// nur wenn ein Modul mit einer Piwik- Domaine vorhanden
  	if ($nlsh_easy_Piwik_Modules->numRows == true)
		{
                        $easy_piwik_Impressum['text'] = $nlsh_easy_Piwik_Modules->nlsh_piwik_impressum;

			// Anzahl der Piwik Module eintragen
                        $easy_piwik_Impressum['countpiwikmodule'] = $nlsh_easy_Piwik_Modules->numRows;

			// Abschalten einbinden, falls erwünscht und URL vorhanden
    	                if ( ($nlsh_easy_Piwik_Modules->nlsh_piwik_noscan == true) && ($nlsh_easy_Piwik_Modules->nlsh_piwik_domain == true))
			{
                                $easy_piwik_Impressum['piwiknoscan'] = $GLOBALS['TL_LANG']['MSC']['nlsh_easy_Piwik_ContentImpressum']['piwik_noscan'];

				$easy_piwik_Impressum['piwiknoscan'] = str_replace("{piwik_host}",$nlsh_easy_Piwik_Modules->nlsh_piwik_domain , $easy_piwik_Impressum['piwiknoscan']);

				$easy_piwik_Impressum['piwiknoscan'] = str_replace("{piwik_lang}",$GLOBALS['TL_LANGUAGE'] , $easy_piwik_Impressum['piwiknoscan']);
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