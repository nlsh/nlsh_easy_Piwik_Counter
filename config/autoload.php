<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package nlshEasyPiwikCounter
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
	'nlsh\easyPiwikCounter\ContentNlshEasyPiwikImpressum'  => 'system/modules/nlsh_easy_Piwik_Counter/elements/ContentNlshEasyPiwikImpressum.php',

	// Modules
	'nlsh\easyPiwikCounter\ModuleNlshEasyPiwikCounter'     => 'system/modules/nlsh_easy_Piwik_Counter/modules/ModuleNlshEasyPiwikCounter.php',

	// Test
	'nlsh\easyPiwikCounter\ModuleNlshEasyPiwikCounterTest' => 'system/modules/nlsh_easy_Piwik_Counter/test/ModuleNlshEasyPiwikCounterTest.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'nlsh_easy_Piwik_Counter'   => 'system/modules/nlsh_easy_Piwik_Counter/templates',
	'nlsh_easy_Piwik_Impressum' => 'system/modules/nlsh_easy_Piwik_Counter/templates',
));
