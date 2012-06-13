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
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'nlsh_easy_Piwik_Counter',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Elements
	'nlsh_easy_Piwik_Counter\ContentNlshEasyPiwikImpressum' => 'system/modules/nlsh_easy_Piwik_Counter/elements/ContentNlshEasyPiwikImpressum.php',

	// Modules
	'nlsh_easy_Piwik_Counter\ModuleNlshEasyPiwikCounter'    => 'system/modules/nlsh_easy_Piwik_Counter/modules/ModuleNlshEasyPiwikCounter.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'nlsh_easy_Piwik_Counter'   => 'system/modules/nlsh_easy_Piwik_Counter/templates',
	'nlsh_easy_Piwik_Impressum' => 'system/modules/nlsh_easy_Piwik_Counter/templates',
));
