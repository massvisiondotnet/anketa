<?php
/**
 * @copyright Copyright 2003-2005 (C) Massvision\n
 * Setovanja i putanje koje se koriste u news modulu
 * @file    InstallationSpecific.inc.php
 * @author  Milos Veskovic
 * @brief   Setovanja i putanje koje se koriste u news modulu
 */

define('NEWS_ENABLED',true);
if (NEWS_ENABLED)
{
/** Direktorijum sa stilovima */
define('NEWSPLUS_VIEWALL_STYLE_PATH', URL_HOME.'/Modules/NewsPlus/UI/Style');
/** Direktorijum sa templejtima */
define('NEWSPLUS_VIEWALL_TEMPLATES_PATH', PATH_HOME.'/Modules/NewsPlus/UI/Templates');
/** Broj vesti koji se prikazuje u listi poslednjih vesti. Mora biti veci od 0 */
define('NEWSPLUS_RECENT_NEWS_CNT', 4);
/** Broj vesti koji se prikazuje u listi poslednjih vesti. Mora biti veci od 0 */
define('NEWSPLUS_ALL_NEWS_CNT', 50);
/** Broj vesti koji se prikazuje u listi svih vesti. Mora biti veci od 0 */
define('NEWSPLUS_LIST_NEWS_CNT', 20);
/** Broj celih vesti koji se prikazuju na jednoj strani (npr: ministarstvo pravde). Mora biti veci od 0 */
define('NEWSPLUS_LASTN_NEWS_CNT', 2);
/** Da li uz vest postoji i kompleksna strana */
if (!defined('NEWSPLUS_COMPLEX_PAGES'))
   define('NEWSPLUS_COMPLEX_PAGES', false);
/** Format datuma obicnih vesti */
define('NEWSPLUS_SHORT_DATE_FORMAT', "%d.%m.%Y");
/** Datum za poslednjih n vesti (onaj meni s desne strane) */
define('NEWSPLUS_LASTN_DATE_FORMAT', "%d.%m.%Y, %H:%M");
/** Datum za pojedinacne vesti */
define('NEWSPLUS_LONG_DATE_FORMAT', '%A, %d. %B  %Y.');
/** Da li se koriste teme */
define('NEWSPLUS_USE_TOPICS', false);
/** Broj karaktera u desnom meniju */
define('NEWSPLUS_MENU_MIN_CHR_CNT', 70);
define('NEWSPLUS_MENU_MAX_CHR_CNT', 125);
define('NEWSPLUS_MENU_MAX_WORD_CHR_CNT', 25);
/** Definicije sitespec lokacija cvorova */
define('NEWSPLUS_SISTESPEC_VIEWALL_LOCATION', 'home/newsplus/viewall');
define('NEWSPLUS_SISTESPEC_VIEWALL_VERSION', 'system');
define('NEWSPLUS_SISTESPEC_VIEWSINGLE_LOCATION', 'home/newsplus/viewsingle');
define('NEWSPLUS_SISTESPEC_VIEWSINGLE_VERSION', 'system');

// use different pages for different topics (auto-detect)
define('NEWSPLUS_USE_TOPIC_DEPENDENT_URLS', false);

// decide to show or not news by title presence (instead of linked multilang selector)
define('NEWSPLUS_MULTILANG_DECIDE_BY_TITLE', false);

//define('NEWS_PLUS_MOUNTPOINT', 'home/mountpoint_news');
//define('NEWSPLUS_USE_SLUGS', 'true');

// note: to override title in view all news when using mountpoint, define LANG_NewsPlusSiteSpec_NewsTitle

}

?>
