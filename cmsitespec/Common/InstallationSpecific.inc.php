<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
 *
 *    Copyright (c) 2003.-2008. by MASSVision
 *
 *    @author  Dejan Petkovic, Mladen Mijatov
 *    @brief   Osnovna podesavanja sajta
 *
 */
if (!defined('USE_ANVIL'))
    define('USE_ANVIL', true);

$SITESPEC_CONFIG = array();

define('SITE_SECRET_KEY', 'massvisionkixarses');

/**
 * Podrazumevani tip HTML-a koji se koristi.
 * @see http://www.w3schools.com/tags/tag_doctype.asp
 */
define('PARM_HTML_TYPE', 'HTML 5');

define('INCLUDE_SYSTEM_CSS', false);

/**
 * Automatsko ukljucivanje browser specific
 * CSS fajlova za IE. Fajlovi se nalaze u UI/Styles
 * i imaju ime cond_ie6.css, cond_ie7.css i slicno.
 *
 * Ukoliko ne postoji potreba za ovim fajlovima
 * ostaviti definiciju praznu!
 */
define('IE_CONDITIONAL_CSS', '6,7');

/**
 * Na koji nacin se IE prilagodjava standardima.
 * Moguce opcije su 'css' i 'js'.
 *
 * CSS metod probleme resava putem behavior fajlova
 * dok JS resava probleme manuelno.
 *
 * Preferirani metod je JS. Sa njime veliki broj CSS2 i CSS3
 * selektora i metoda je omogucen. Postoji i automatska
 * podrska i za PNG slike sa alpha kanalom ali je bitno
 * da se imena fajlova zavrsavaju sa -trans.png.
 *
 * Ukoliko ne postoji potreba za ispravljanjem
 * explorerovih nakaradnih shvatanja standarda dovoljno
 * je ostaviti praznu definiciju!
 */
define('IE_FIX_TYPE', 'js');

// ako je IE_FIX_TYPE == 'string' dodaje se eksplicitno zadat string:
//define('IE_FIX_STRING',
//<<<IEFIXSTRING
//<!--[if lt IE 9]>
//    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
//    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
//<![endif]-->
//
//IEFIXSTRING
//);

//define('IE_FIX_VERSION', '2.1(beta2)');
define('IE_FIX_VERSION', '2.1(beta4)');
define('IE_FIX_FILE', 'IE9.js');

// Verzija kora
define('CORE_VERSION', 'v5.2.66');

// Definicija setupa parametara
require_once (dirname(__FILE__)."/../setup.inc.php");

// Putanja do definicije putanja
require_once (dirname(__FILE__)."/Paths.inc.php");

define('SITE_NAME','dm upitnik');
define(
    'PAGE_FOOTER',
    sprintf(
        '<b>© %s. dm drogerie markt doo Beograd</b> Moja prodavnica za lepotu, frizuru i kozmetiku, negu, bebe & decu, zdravu ishranu i još mnogo toga',
        date('Y')
    )
);

/** Direktorijum sa instalacijom */
//define('DB_SERVER_LOCATION', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', 'leaves');
//define('DB_NAME', 'anketa');

define('DB_SERVER_LOCATION', getenv('DATABASE_HOST'));
define('DB_USERNAME', getenv('DATABASE_USER'));
define('DB_PASSWORD', getenv('DATABASE_PASS'));
define('DB_NAME', getenv('DATABASE_NAME'));

define('DB_TRANSACTIONS_SUPPORTED', true);
define('DB_TYPE', 'MySQLt');
define('DB_TABLE_PREFIX', '');
define('DB_CHARACTER_SET', 'utf8'); // utf8, latin1

/** Da li se greske loguju u bazu */
define('LOG_ERRORS_DB', false);

/* Naziv korena foldera */
define('SITE_IN_USE_VERSION',CORE_VERSION);
define('SITE_IN_USE_DATE',('2008-05-18 00:00:00'));
define('SITE_REQUIRED_PHP_VERSION_','4.2.2<*<5.1.0');
define('HOME_REQUIRED_MYSQL_VERSION','3.23.55<*<5.0.0');

/* DB CACHE */
define('USE_DB_CACHE',true);
define('OBJECT_CACHE_TYPE', 'infinite_w_mem');     // 'infinite', 'infinite_w_mem', 'lru', 'fifo'...
define('OBJECT_CACHE_SIZE', 4000000);              // Velicina u bajtovima
define('OBJECT_CACHE_MAX_OBJ_SIZE', 399999);       // Velicina u bajtovima
define('USE_DB_AO_CACHE', false);
define('USE_VIEW_CACHE', false);
define('USE_IMS_CACHE_CONTROL', false);

// Gde se smestaju opcije
define('SITE_SPECIFIC_SESSION', false);

// Test performansi
define('PERFORMANCE_TEST_ACTIVE',false);

/** Provera dozvole pisanja na disku */
define('UPLOAD_PREMISSION', true);

/** Parametri uploada fajlova */
define('UPLOAD_IMAGES_TO_DB', false);
define('UPLOAD_FILES_TO_DB', false);

/** lokacija 404 cvora */
define('_LOCATION_404','home/page_not_found');
/** verzija 404 cvora */
define('_VERSION_404','system');

/** Podrazumevan jezik */
define('LANG_DEFAULT', 'sr-latin');
define('LANG_PRIORITY', 'sr-latin sr-cyrillic en ge fr ru nl he');
define('USE_ISO_LANG_CODES', true);

define('USER_EMAIL_AS_USERNAME',false);     // email se koristi kao username
define('USER_SHARE_PREFERENCES',true);      // -> da ne ponavlja iste adrese

/** Direktorijum sa InstalationSetupSpecifics.inc.php fajlom*/
define('PATH_SETUP_SPECIFICS', dirname(__FILE__));
/** Direktorijum sa stilovima */
define('LIST_STYLE_PATH', URL_CORE.'Core/SearchManagement/UI/Style');

/** Da li se prikazuje strana za editovanje template-a */
define('EDIT_TEMPLATE',false);

/** Da li uz vest postoji i kompleksna strana */
define('NEWSPLUS_COMPLEX_PAGES', true);

// Za sada se koristi kod Modules::InfoBlocks, trebalo bi primeniti i na druge delove:
// ukoliko se boja transparentnih kontrola poklapa sa pozadinom, stavlja background (odgovarajuci, npr. beli) da bi se videle
define('USE_BACKGROUND_FOR_CONTROLS',false);

// fixiranje doctype-a na XHTML
define('XHTML_Fixed',false);

// definisanje lepih linkova
define('USE_FAKE_ADDRESSES',true);                                       // Ako je false ili nedefinisano - podrska je iskljucena
define('FAKE_ADDRESS_PATTERN','st_version/lang/st_location');             // samo "pocetak"
define('FAKE_ADDRESS_PATTERN_DEFAULTS','active/'.LANG_DEFAULT.'/home');   // podrazumevana grana/jezik
define('FAKE_ADDRESS_SKIP_VERSION', true);								  // ne pisi "active" u url
define('FAKE_ADDRESS_SKIP_LANG', true);                                  // ne pisi default lang u url
define('FAKE_ADDRESS_OMIT_HTML', false);                                   // ne pisi .html
define('FAKE_ADDRESSES_OMIT_HOME', false);                                // ne pisi home
define('FAKE_ADDRESS_ALLOWED_LANGS', "sr-latin");                      // "sr-latin,en,ge" - dozvoljeni jezici
define('USE_URL_I18N_SLUG', false);
define('USE_URL_I18N_SLUG_SHORT', false);

// Specificnosti pojedinih modula
$SITESPEC_CONFIG['modules'] = array
(
    "Search"         	=> false
,"NewsPlus"       	=> false
,"Rklm"           	=> false
,"Login"          	=> false
,"Shop"           	=> false
,"Register"       	=> false
,"ContactForm"    	=> false
,"Survey"         	=> false
,"GuestBook"      	=> false
,"Seminars"       	=> false
,"SendToFriend"   	=> false
,"Blog"	         	=> false
,"Comments"       	=> false
,"Tags"           	=> false
,"BannerSys"      	=> false
,"EventCalendar"	=> false
,"Gallery2"			=> false
,"LastUpdate"		=> false
,"ReadBlock"		=> false
,"AjaxComboBoxes"	=> false
,"Newsletter2"		=> false
,"GMapLocations"	=> false
,"UserRegistration" => false
,"SurveyNew"        => true
);

foreach($SITESPEC_CONFIG['modules'] as $modul => $included)
    if($included) require_once (PATH_HOME."/Modules/{$modul}/Common/InstallationSpecific.inc.php");

require_once (PATH_HOME."/Common/Parameters.inc.php");

// Privremeno
define('DATE_FORMAT', '%A, %d. %B %Y.');
define('LONG_DATE_FORMAT', '%A, %d. %B  %Y.');
define('SHORT_DATE_FORMAT', ' %d.%m.%Y.');
define('TIME_FORMAT', '%H:%m');
define('SHORT_TIME_FORMAT', '%H:%M');
define('LONG_TIME_FORMAT', '%H:%M:%S');

$lProtocol = 'http';

if(isset($_SERVER['SCRIPT_URI'])) {
    // Ako je http postoji $_SERVER['SCRIPT_URI'] a ne $_SERVER['HTTPS']
    $lProtocol = substr($_SERVER['SCRIPT_URI'], 0, strpos($_SERVER['SCRIPT_URI'], "://"));

} else if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']!="off" /*&& $_SERVER['HTTPS']!=0*/)
    // Ako je https postoji $_SERVER['HTTPS'] a ne $_SERVER['SCRIPT_URI']
    $lProtocol = 'https';

if($lProtocol == 'https') define('LOGIN_USING_SSL', true);

define('ENABLE_AJAX', false);

/**
 * jQuery
 */
define('USE_JQUERY', true);
define('JQUERY_VERSION', '1.11.2');

/**
 * Google Analytics
 */
//define('GOOGLE_ANALYTICS_SNIPPET', "<!-- enter snippet here -->");

/**
 * if site has huge sitemap, and you're using IE, this might help
 */
//define('SKIP_BACKEND_DROPDOWN_STRUCTURE', true);

define('SKIP_TEMPLATE_TABLES', true);
define('USE_TINYMCE', true);

define('SKIP_BACKEND_DROPDOWN_STRUCTURE', false);
define('MULTILANG_MENUS_DECIDE_BY_TITLE', false);
define('MULTILANG_FILE_DONWLOAD_DECIDE_BY_TITLE', false);

// reCAPTCHA
//define('RECAPTCHA_PUBLIC_KEY', 'TBD');
//define('RECAPTCHA_PRIVATE_KEY', 'TBD');



define('SEARCH_INDEX_WORDS', true);

// display clean div for info boxes
define('INFO_BLOCKS_CLEAN_DISPLAY', true);
// info blocks with own templates must USE_ANVIL and INFO_BLOCKS_CLEAN_DISPLAY
define('INFO_BLOCKS_TEMPLATE', false);

define('SOCIAL_NETWORKS_USE_CUSTOM_BUTTONS', false);

// don't pack params
// e.g. www.exaple.com/somepage/_param_/foo/bar
// use classic approach instead
// www.example.com/somepage?foo=bar
define('FAKE_URLS_DONT_PACK_PARAMS', true);

// puts site name in page title
define('USE_SITE_NAME_FOR_PAGE_TITLE', true);


// use site versions (e.g. en-us)
define('USE_SITE_VERSIONS', false);
// set language cookie
define('SET_LANG_COOKIE', true);
// auto-generate open graph url
define('META_TAG_AUTOGENERATE_OG_URL', true);

// log internal 404 errors
define('LOG_404_ERRORS', false);

// cookie setting options
define('COOKIE_DOMAIN_SKIP_WWW', true);
define('COOKIE_HTTP_ONLY', true);

// external google fonts
/*
define('GOOGLE_FONTS', "
    'Open+Sans::latin,latin-ext'
");
*/

// use SWIFT mailer
define('USE_SWIFTMAILER', false); // use smtp transport of swift mailer (e.g. for sending mails through gmail, other smtp server, don't use internal php mail function)
define('SWIFT_MAILER_SMTP_HOST', 'mail.smtphost.com'); // smtp host/IP address of smtp mail server
define('SWIFT_MAILER_SMTP_PORT', 25); //smtp port, default 25
define('SWIFT_MAILER_SMTP_USERNAME', 'username'); //username to use with smtp server
define('SWIFT_MAILER_SMTP_PASSWORD', 'password');  // password for this username 
define('SWIFT_MAILER_SMTP_ENCRYPTION', 'tls');  // '', 'ssl', 'tls' encryption on server

// disable caching of common.css (by adding timestamp)
define('DEVELOPER_MODE_SUPPRESS_MEDIA_CACHE', false);
