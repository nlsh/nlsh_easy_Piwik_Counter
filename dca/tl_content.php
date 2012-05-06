<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package Easy Piwik Counter
 * @link https://github.com/nlsh/nlsh_easy_Piwik_Counter
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Add palettes to tl_content
 */

$GLOBALS['TL_DCA']['tl_content']['palettes']['piwikImpressum']   = '{type_legend},type;
                                                                    {protected_legend:hide},protected;
								    {expert_legend:hide},guests,cssID,space';

/**
 * Add fields to tl_module
 */


?>
