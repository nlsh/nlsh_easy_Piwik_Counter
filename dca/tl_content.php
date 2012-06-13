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
 * Add palettes to tl_content
 */

$GLOBALS['TL_DCA']['tl_content']['palettes']['piwikImpressum']   = '{type_legend},type;
                                                                    {which_module_legend},which_module;
                                                                    {protected_legend:hide},protected;
                                                                    {expert_legend:hide},guests,cssID,space';

/**
 * Add fields to tl_content
 */

$GLOBALS['TL_DCA']['tl_content']['fields']['which_module'] = array
                                                            (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_content']['which_module'],
                                    'exclude'            => true,
                                    'inputType'          => 'select',
                                    'options_callback'   => array('tl_content_nlsh_piwik', 'getModules'),
                                    'eval'               => array('mandatory'=>true, 'chosen'=>false, 'submitOnChange'=>true),
                                    'wizard'             => array
                                                           (
                                                                array('tl_content_nlsh_piwik', 'editModule')
                                                           ),
                                    'sql'                => "int(10) unsigned NOT NULL default '0'"
                                                            );


/**
 * class tl_content_nlsh_piwik
 *
 * Enthält Funktionen einzelner Felder der Konfiguration
 * @package nlsh_easy_Piwik_Counter
 */
class tl_content_nlsh_piwik extends Backend
{

	/**
	* Holt alle Module und gibt diese in einem Array zurück
	* options_callback vom Feld which_module
	* @return array
	*/
	public function getModules()
	{
		$arrModules = array();
		$objModules = $this->Database->execute("SELECT m.id, m.name, t.name AS theme FROM tl_module m LEFT JOIN tl_theme t ON m.pid=t.id ORDER BY t.name, m.name");

		while ($objModules->next())
		{
			$arrModules[$objModules->theme][$objModules->id] = $objModules->name . ' (ID ' . $objModules->id . ')';
		}

		return $arrModules;
	}


	/**
	* Wizard zum editieren des gewählten Modules anzeigen (Stift)
	* vom wizard vom Feld which_module
	* @param \DataContainer
	* @return string
	*/
	public function editModule(DataContainer $dc)
	{
		return ($dc->value < 1) ? '' : ' <a href="contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $dc->value . '&amp;rt=' . REQUEST_TOKEN . '" title="'.sprintf(specialchars($GLOBALS['TL_LANG']['tl_content']['editalias'][1]), $dc->value).'" style="padding-left:3px">' . $this->generateImage('alias.gif', $GLOBALS['TL_LANG']['tl_content']['editalias'][0], 'style="vertical-align:top"') . '</a>';
	}
}