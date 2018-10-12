<?php
/**
 * Copyright 2003-2005 (C) Massvision\n
 * Setovanja i putanje koje se koriste u search modulu
 * @file    InstallationSpecific.inc.php
 * @author  Milos Veskovic
 * @brief   Setovanja i putanje koje se koriste u search modulu
 */

define('SEARCH_ENABLED',true);
if (SEARCH_ENABLED)
{
   /** Direktorijum sa stilovima za Search komponentu */
   define('SEARCH_LIST_STYLE_PATH', 'Modules/Search/UI/Style');
   /** Direktorijum sa sablonima za Search komponentu */
   define('SEARCH_LIST_TEMPLATE_PATH', PATH_HOME.'/Modules/Search/UI/Templates');
   /** Broj stavki u rezultatima pretrage */
   define('SEARCH_LIST_MAX_ROWS', 10);
   /** min duzina search reci */
   define('SEARCH_WORD_MIN_LEN',3);
   // fixnuta search tabela (advanced search)
   define('ADVANCED_SEARCH_FIXED',true);

   define('SEARCH_RESULTS_LOCATION', 'home/search');
   define('SEARCH_RESULTS_VERSION', 'active');

   define('SEARCH_MAX_OBJECTS_PER_ENTRY', 3);
   define('SEARCH_LIST_MAX_MATCHES', 2);

   define('SEARCH_SKIP_NORMALIZATION', true); // relevancy normalization was a bad idea; skip it for new sites.
}

?>
