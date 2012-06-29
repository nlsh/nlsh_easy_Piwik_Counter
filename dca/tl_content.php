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
                                                                    {protected_legend:hide},protected;
                                                                    {expert_legend:hide},guests,cssID,space';
