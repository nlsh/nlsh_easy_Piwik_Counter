<?php
/**
 * Erweiterung des tl_content DCA`s
 *
 * @copyright  Nils Heinold (c) 2012
 * @author     Nils Heinold
 * @package    nlshEasyPiwikCounter
 * @link       http://github.com/nlsh/nlsh_easy_Piwik_Counter
 * @license    LGPL
 */


/**
 * Add palettes to tl_content
 */

$GLOBALS['TL_DCA']['tl_content']['palettes']['piwikImpressum']   =  '{type_legend},
                                                                        type;
                                                                    {protected_legend:hide},
                                                                        protected;
                                                                    {expert_legend:hide},
                                                                        guests,cssID,space';
