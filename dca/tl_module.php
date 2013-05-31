<?php
/**
 * Erweiterung des tl_Module DCA`s
 *
 * @copyright  Nils Heinold  (c) 2012
 * @author     Nils Heinold
 * @package    nlshEasyPiwikCounter
 * @link       http://github.com/nlsh/nlsh_easy_Piwik_Counter
 * @license    LGPL
 */


/**
 * Add palettes to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['nlsh_easy_Piwik_Counter']   =
                                                            '{title_legend},
                                                                name,headline,type;
                                                            {nlsh_piwik_legend},
                                                                nlsh_piwik_domain,
                                                                nlsh_piwik_id_site,
                                                                nlsh_piwik_last_minutes,
                                                                nlsh_piwik_token_auth,
                                                                nlsh_piwik_range_start,
                                                                nlsh_piwik_visits_start;
                                                            {nlsh_piwik_Impressum_legend:hide},
                                                                nlsh_piwik_impressum;
                                                            {nlsh_piwik_Piwik_noscan_legend},
                                                                nlsh_piwik_noscan,
                                                                nlsh_piwik_css_optout;
                                                            {protected_legend:hide},
                                                                protected;
                                                            {expert_legend:hide},
                                                                guests,
                                                                cssID,
                                                                space';


/**
 * Add fields to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_domain'] = array (
    'label'      => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_domain'],
    'exclude'    => TRUE,
    'inputType'  => 'text',
    'eval'       => array(
                        'tl_class'  => 'w50',
                        'mandatory' => TRUE,
                        'maxlength' => 255,
                        'rgxp'      => 'url'
    ),
    'sql'        => "varchar(255) NOT NULL default ''"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_id_site'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_id_site'],
    'exclude'       => TRUE,
    'inputType'     => 'text',
    'load_callback' => array(array(
                            '\nlsh\easyPiwikCounter\tl_modulePiwikImpressum',
                            'checkIdSiteDuringLoad'
                       )
    ),
    'save_callback' => array(array(
                            '\nlsh\easyPiwikCounter\tl_modulePiwikImpressum',
                            'checkIdSiteDuringSave'
                       )
    ),
    'eval'          => array(
                            'tl_class'  => 'w50',
                            'mandatory' => TRUE,
                            'maxlength' => 10,
                            'rgxp'      => 'digit'
    ),
    'sql'           => "int(10) unsigned NOT NULL"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_last_minutes'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_last_minutes'],
    'exclude'   => TRUE,
    'inputType' => 'text',
    'eval'      => array(
                        'tl_class'  => 'w50',
                        'mandatory' => TRUE,
                        'maxlength' => 10,
                        'rgxp'      => 'digit'
    ),
    'sql'       => "int(10) unsigned NOT NULL default '30'"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_token_auth'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_token_auth'],
    'exclude'   => TRUE,
    'inputType' => 'text',
    'eval'      => array(
                        'tl_class'  => 'w50',
                        'mandatory' => TRUE,
                        'maxlength' => 255,
                        'rgxp'      => 'alnum'
    ),
    'sql'       => "varchar(255) NOT NULL default ''"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_range_start'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_range_start'],
    'exclude'   => TRUE,
    'inputType' => 'text',
    'eval'      => array(
                        'rgxp'       => 'date',
                        'datepicker' => $this->getDatePickerString(),
                        'tl_class'   => 'w50 wizard',
                        'mandatory'  => TRUE,
                        'maxlength'  => 20
    ),
    'sql'       => "varchar(10) NOT NULL default ''"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_visits_start'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_visits_start'],
    'exclude'   => TRUE,
    'inputType' => 'text',
    'eval'      => array(
                        'tl_class'  => 'w50',
                        'maxlength' => 10,
                        'rgxp'      => 'digit'
    ),
    'sql'       => "int(10) unsigned NULL default '0'"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_impressum'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_impressum'],
    'exclude'       => TRUE,
    'inputType'     => 'textarea',
    'load_callback' => array(array(
                                '\nlsh\easyPiwikCounter\tl_modulePiwikImpressum',
                                'checkImpressum'
                       )
    ),
    'save_callback' => array(array(
                                '\nlsh\easyPiwikCounter\tl_modulePiwikImpressum',
                                'checkImpressum'
                       )
    ),
    'eval'          => array(
                        'tl_class'       => 'long',
                        'allowHtml'      => TRUE,
                        'preserveTags'   => TRUE,
                        'decodeEntities' => TRUE,
                        'doNotSaveEmpty' => TRUE
    ),
    'sql'           => "blob NULL"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_noscan'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_noscan'],
    'inputType' => 'checkbox',
    'exclude'   => TRUE,
    'eval'      => array(
                        'tl_class'       => 'long',
                        'submitOnChange' => TRUE
    ),
    'sql'       => "char(1) NOT NULL default '0'"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_css_optout'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_module']['nlsh_piwik_css_optout'],
    'inputType'     => 'textarea',
    'save_callback' => array(array(
                                '\nlsh\easyPiwikCounter\tl_modulePiwikImpressum',
                                'saveOptOut'
                       )
    ),
    'eval'          => array(
                            'decodeEntities' => TRUE,
                            'style'          => 'height:120px;'
    ),
    'sql'           => "text NULL"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['nlsh_piwik_last_connect'] = array(
    'sql' => "mediumtext NULL"
);