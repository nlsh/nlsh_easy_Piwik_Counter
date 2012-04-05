<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Leo Feyer 2005
 * @author     Leo Feyer <leo@typolight.org>
 * @package    News
 * @license    LGPL
 * @filesource
 */

/**
 * Add  config to tl_module
*/

$GLOBALS['TL_DCA']['tl_module']['config']['onload_callback'] = array
                                                                (
								        array('tl_module_piwik_impressum', 'checkImpressum')
								);

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
    								'eval'               => array('tl_class' => 'w50', 'mandatory' => true, 'maxlength' => 255,'rgxp' => 'url' )
                                                                );
$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_id_site'] = array
                                                                (
    								'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_id_site'],
    								'exclude'            => true,
    								'inputType'          => 'text',
    								'eval'               => array('tl_class' => 'w50' ,'mandatory' => true, 'maxlength' => 10,'rgxp' => 'digit')
                                                                );
$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_last_minutes'] = array
                                                                (
    								'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_last_minutes'],
    								'exclude'            => true,
    								'inputType'          => 'text',
    								'eval'               => array('tl_class' => 'w50' ,'mandatory' => true, 'maxlength' => 10,'rgxp' => 'digit')
                                                                );
$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_token_auth'] = array
                                                                (
    								'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_token_auth'],
    								'exclude'            => true,
    								'inputType'          => 'text',
    								'eval'               => array('tl_class' => 'w50' ,'mandatory' => true, 'maxlength' => 255,'rgxp' => 'alnum')
                                                                );
$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_range_start'] = array
                                                                (
    								'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_range_start'],
    								'exclude'            => true,
    								'inputType'          => 'text',
    								'eval'               => array('rgxp'=>'date', 'datepicker'=>$this->getDatePickerString(),'tl_class'=>'w50 wizard','mandatory'=>true, 'maxlength'=>20)
                                                                );
$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_visits_start'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_visits_start'],
                                    'exclude'            => true,
                                    'inputType'          => 'text',
                                    'eval'               => array('tl_class' => 'w50' , 'maxlength' => 10,'rgxp' => 'digit')
                                                                );
$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_impressum'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_impressum'],
                                    'exclude'            => true,
                                    'inputType'          => 'textarea',
                                    'save_callback'	     => array(array('tl_module_piwik_impressum','checkSaveImpressum')),
                                    'eval'               => array('tl_class' => 'long' , 'allowHtml' =>true, 'preserveTags' => true, 'decodeEntities' => true, 'doNotSaveEmpty' => true)
                                                                );
$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_noscan'] = array
                                                                (
                                    'label'              => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_noscan'],
                                    'inputType'          => 'checkbox',
                                    'exclude'            => true,
                                    'eval'         	     => array('tl_class'=>'long', 'submitOnChange' => true)
                                                                );
$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_css_optout'] = array
		                                                            (
                                    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_css_optout'],
			                        'inputType'               => 'textarea',
                                    'save_callback'           => array(array('tl_module_piwik_impressum','saveOptOut')),
			                        'eval'                    => array('decodeEntities'=>true, 'style'=>'height:120px;')
		                                                            );

class tl_module_piwik_impressum extends Backend
{
        // Wenn kein Impressumstext vorhanden, dann vorbelegen
        public function checkImpressum(DataContainer $dc)
        {
                // Feld mit dem Impressumtext heraussuchen
                $nlsh_piwik_impressum =  $this->Database->prepare("SELECT * FROM `tl_module` WHERE `id` =?")
                                        ->execute($dc->id);

                // wenn nicht gefüllt, dann vorbelegen
                if ($nlsh_piwik_impressum->nlsh_piwik_impressum == false)
                {
	                $this->Database->prepare("UPDATE `tl_module` SET `nlsh_piwik_impressum` = ? WHERE `id` =?")
	                        -> execute ($GLOBALS['TL_LANG']['tl_module']['piwik_Impressum'],$dc->id);
                }

        }

	// Sollte das Feld Impressum leer sein ( für Rücksetzung auf default Text), dann Default- Text einfügen
	public function checkSaveImpressum($Field,Datacontainer $dc)
	{

		if ($Field == false)
		{
			$Field = $GLOBALS['TL_LANG']['MSC']['piwik_Impressum'];
		}

		return $Field;
	}
    // CSS- Code in Template- Ordner speichern
	public function saveOptOut($Field,Datacontainer $dc)
	{
	    $cssdatei = fopen("../tl_files/nlsh_piwik_counter_".$dc->activeRecord->id.".css","w");
        fwrite($cssdatei, $Field);
        fclose($cssdatei);

		return $Field;
	}

}
?>
