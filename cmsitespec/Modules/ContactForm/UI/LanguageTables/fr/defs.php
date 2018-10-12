<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
  * Tabela stringova
  * @file defs.php
  * @brief Tabela stringova
  */

/**
 * @def LANG_Encoding
 * @brief Kodiranje karaktera
 * Kodni raspored prikaza teksta
 */
if(!defined('LANG_Encoding'))
   define('LANG_Encoding', 'UTF-8');

define('LANG_contact_form_subject','WWW Contact form');
define('LANG_contact_form_success','Thank you for your feedback!');
define('LANG_contact_form_submit','Abschicken');
define('LANG_contact_form_reset','Zurück');

// --- Spoljne definicije ---------------------------------------------------------------
require_once(dirname(__FILE__).'/../common/defs.php');
?>
