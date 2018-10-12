<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
 * @copyright Copyright 2003-2007 (C) Massvision\n
 * Putanje koje se koriste u kodu
 * @file    ./Paths.inc.php
 * @author  Dejan Petkovic
 * @brief   Putanje koje se koriste u kodu
 */


// Definicija putanja jezgra
if(!defined('ROOT_APPLICATION'))
	define('PATH_AUTODETECT', $_ENV['PATH_AUTODETECT']);
	//define('PATH_AUTODETECT', '/usr/share/cmass/');
	//define('PATH_AUTODETECT', '/Users/nemanja/Sites');

require_once(PATH_AUTODETECT.'/autodetect_core.php');

// Putanje do site-a
   define('PATH_ROOT', dirname(__FILE__).'/../../httpdocs');
   define('PATH_HOME', dirname(__FILE__).'/..');

/** Putanja do aplikacije koja se izvrsava */
define('PATH_APPLICATION', $_SERVER['SCRIPT_NAME']);

if(dirname($_SERVER['SCRIPT_NAME'])=='\\' || dirname($_SERVER['SCRIPT_NAME'])=='/')
{
   if(!defined('ROOT_APPLICATION'))
      define('ROOT_APPLICATION', '');
   if(!defined('URL_HOME'))
      define('URL_HOME', '');
}
else
{
   if(!defined('ROOT_APPLICATION'))
      define('ROOT_APPLICATION', dirname($_SERVER['SCRIPT_NAME']));
   if(!defined('URL_HOME'))
      define('URL_HOME', dirname($_SERVER['SCRIPT_NAME']));
   //define('ROOT_APPLICATION', dirname($_SERVER['PHP_SELF']));
   //define('URL_HOME', dirname($_SERVER['PHP_SELF']));
}

define('DATA_HOME_PATH', PATH_ROOT);
define('URL_DATA_HOME', URL_HOME);

/** Direktorijum sa instalacijom */
define('PATH_UPLOAD', '/Data');
define('PATH_DATA', '/Data');

/** Putanja do fajla za belezenje gresaka */
define('ERROR_LOG_PATH', PATH_HOME.'/Log/Error.log');

/** Direktorijum sa podrazumevanim sablonima */
define('PATH_DEFAULT_TEMPLATES', PATH_HOME.'/UI/Templates/');
/** Sablon koji se ucitava ako nije zadat drugi */
if(!defined('DEFAULT_PAGE_TEMPLATE'))
   define('DEFAULT_PAGE_TEMPLATE', PATH_HOME.'/UI/default.xml');

require_once(PATH_CORE.'Common/Paths.inc.php');
