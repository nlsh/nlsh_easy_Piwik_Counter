-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `nlsh_piwik_domain` varchar(255) NOT NULL default '',
  `nlsh_piwik_id_site` int(10) unsigned NOT NULL default '0',
  `nlsh_piwik_last_minutes` int(10) unsigned NOT NULL default '30',
  `nlsh_piwik_token_auth` varchar(255) NOT NULL default '',
  `nlsh_piwik_range_start` varchar(10) NOT NULL default '',
  `nlsh_piwik_visits_start` int(10) unsigned NULL default NULL,
  `nlsh_piwik_impressum` blob NULL,
  `nlsh_piwik_noscan` char(1) NOT NULL default '0',
  `nlsh_piwik_css_optout` text NULL,
  `nlsh_piwik_last_connect` mediumtext NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
