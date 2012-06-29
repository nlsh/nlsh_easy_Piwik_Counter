<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

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
 * Add palettes to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['nlsh_easy_Piwik_Counter']   = '{title_legend},name,headline,type;
                                                                            {nlsh_piwik_legend},nlsh_piwik_domain,nlsh_piwik_id_site,nlsh_piwik_last_minutes,nlsh_piwik_token_auth,nlsh_piwik_range_start,nlsh_piwik_visits_start;
                                                                            {nlsh_piwik_Impressum_legend:hide},nlsh_piwik_impressum;
                                                                            {nlsh_piwik_Piwik_noscan_legend},nlsh_piwik_noscan, nlsh_piwik_css_optout;
                                                                            {protected_legend:hide},protected;
                                                                            {expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_domain'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_domain'],
                                    'exclude'            => true,
                                    'inputType'          => 'text',
                                    'eval'               => array('tl_class' => 'w50', 'mandatory' => true, 'maxlength' => 255,'rgxp' => 'url' ),
                                    'sql'                => "varchar(255) NOT NULL default ''"
                                                                );

$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_id_site'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_id_site'],
                                    'exclude'            => true,
                                    'inputType'          => 'text',
                                    'load_callback'      => array(array('tl_module_piwik_impressum','checkIdSite')),
                                    'save_callback'      => array(array('tl_module_piwik_impressum','checkIdSaveSite')),
                                    'eval'               => array('tl_class' => 'w50' ,'mandatory' => true, 'maxlength' => 10,'rgxp' => 'digit'),
                                    'sql'                => "int(10) unsigned NOT NULL"
                                                                );

$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_last_minutes'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_last_minutes'],
                                    'sql'                => "",
                                    'exclude'            => true,
                                    'inputType'          => 'text',
                                    'eval'               => array('tl_class' => 'w50' ,'mandatory' => true, 'maxlength' => 10,'rgxp' => 'digit'),
                                    'sql'                => "int(10) unsigned NOT NULL default '30'"
                                                                );

$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_token_auth'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_token_auth'],
                                    'exclude'            => true,
                                    'inputType'          => 'text',
                                    'eval'               => array('tl_class' => 'w50' ,'mandatory' => true, 'maxlength' => 255,'rgxp' => 'alnum'),
                                    'sql'                => "varchar(255) NOT NULL default ''"
                                                                );

$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_range_start'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_range_start'],
                                    'exclude'            => true,
                                    'inputType'          => 'text',
                                    'eval'               => array('rgxp'=>'date', 'datepicker'=>$this->getDatePickerString(),'tl_class'=>'w50 wizard','mandatory'=>true, 'maxlength'=>20),
                                    'sql'                => "varchar(10) NOT NULL default ''"
                                                                );

$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_visits_start'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_visits_start'],
                                    'exclude'            => true,
                                    'inputType'          => 'text',
                                    'eval'               => array('tl_class' => 'w50' , 'maxlength' => 10,'rgxp' => 'digit'),
                                    'sql'                => "int(10) unsigned NULL default '0'"
                                                                );

$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_impressum'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_impressum'],
                                    'exclude'            => true,
                                    'inputType'          => 'textarea',
                                    'load_callback'      => array(array('tl_module_piwik_impressum','checkImpressum')),
                                    'save_callback'      => array(array('tl_module_piwik_impressum','checkImpressum')),
                                    'eval'               => array('tl_class' => 'long' , 'allowHtml' =>true, 'preserveTags' => true, 'decodeEntities' => true, 'doNotSaveEmpty' => true),
                                    'sql'                => "blob NULL"
                                                                );

$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_noscan'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_noscan'],
                                    'inputType'          => 'checkbox',
                                    'exclude'            => true,
                                    'eval'               => array('tl_class'=>'long', 'submitOnChange' => true),
                                    'sql'                => "char(1) NOT NULL default '0'"
                                                                );


$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_css_optout'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_css_optout'],
                                    'inputType'          => 'textarea',
                                    'save_callback'      => array(array('tl_module_piwik_impressum','saveOptOut')),
                                    'eval'               => array('decodeEntities'=>true, 'style'=>'height:120px;'),
                                    'sql'                => "text NULL"
                                                                );


/**
 * class tl_module_piwik_impressum
 *
 * Enthält Funktionen einzelner Felder der Konfiguration
 * @package nlsh_easy_Piwik_Counter
 */
class tl_module_piwik_impressum extends Backend
{


	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	* Vorbelegung durch die Datenbank ist ein Wert 0, da int- Felder wohl einen Wert haben müssen
	*
	* ein load/save_callback des Feldes nlsh_piwik_id_site
	*
	* @param int
	* return int/false entweder Leer oder mit altem Wert, falls vorhanden
	*/
	public function checkIdSite($Field)
	{
		if ($Field == 0) return '';
		else return $Field;
	}


	 public function checkIdSaveSite($Field)
	{
		if ($Field == 0)
			throw new Exception($GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_id_site_not_null']);
		else
		return $Field;
	}


	/**
	* Sollte das Feld Impressum leer sein ( z.B. für Rücksetzung auf Default Text), dann Default- Text einfügen
	*
	* @param string
	* @return string Text für Impressum
	*/
	public function checkImpressum($Field)
	{

		if ($Field == false)
		{
			$Field = $GLOBALS['TL_LANG']['MSC']['piwik_Impressum'];
		}

		return $Field;
	}


	/**
	 * CSS- Code in Template- Ordner speichern
	 *
	 * @param string
	 * @param DataContainer
	 * @return string zurück mit übergebenem Text, ohne Änderung
	.*/
	public function saveOptOut($Field)
	{
		$cssdatei = fopen("../tl_files/nlsh_piwik_counter_".$dc->activeRecord->id.".css","w");
		fwrite($cssdatei, $Field);
		fclose($cssdatei);

		return $Field;
	}
}

?>