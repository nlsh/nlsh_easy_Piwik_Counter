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
 * Class ContentNlshEasyPiwikImpressum
 *
 * @copyright  Nils Heinold 
 * @author     Nils Heinold 
 * @package    nlsh_easy_Piwik_Counter
 */
class ContentNlshEasyPiwikImpressum extends \ContentElement
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
		$nlsh_easy_Piwik_Modules = \ModuleModel::findByPk($this->which_module);

		// nur wenn ein Modul mit einer Piwik- Domaine vorhanden
		if ($nlsh_easy_Piwik_Modules->type == 'nlsh_easy_Piwik_Counter')
		{

			// Pfad zur Website mit scheme "http://" vorbelegen
			$parseUrl = (parse_url($nlsh_easy_Piwik_Modules->nlsh_piwik_domain));

			if (!$parseUrl['scheme'])
				{
					$nlsh_easy_Piwik_Modules->nlsh_piwik_domain = "http://" . $nlsh_easy_Piwik_Modules->nlsh_piwik_domain;
				}

			$urlcssOptOut = $this->Environment->url . $GLOBALS['TL_CONFIG']['websitePath'] . "/files/nlsh_piwik_counter_".$nlsh_easy_Piwik_Modules->id.".css";

			$easy_piwik_Impressum['text'] = $nlsh_easy_Piwik_Modules->nlsh_piwik_impressum;

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
