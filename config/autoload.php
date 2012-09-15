<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Nlsh_easy_Piwik_Counter
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'nlsh',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Elements
	'nlsh\nlsh_easy_Piwik_Counter\ContentNlshEasyPiwikImpressum' => 'system/modules/nlsh_easy_Piwik_Counter/elements/ContentNlshEasyPiwikImpressum.php',

	// Modules
	'nlsh\nlsh_easy_Piwik_Counter\ModuleNlshEasyPiwikCounter'    => 'system/modules/nlsh_easy_Piwik_Counter/modules/ModuleNlshEasyPiwikCounter.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'nlsh_easy_Piwik_Counter'   => 'system/modules/nlsh_easy_Piwik_Counter/templates',
	'nlsh_easy_Piwik_Impressum' => 'system/modules/nlsh_easy_Piwik_Counter/templates',
));
