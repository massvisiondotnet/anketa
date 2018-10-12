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

define('LANG_contact_form_subject','Prijava za takmicenja');
define('LANG_contact_form_success','Thank You for feadback.');
define('LANG_contact_form_submit','Send');
define('LANG_contact_form_reset','Reset');

// --- Spoljne definicije ---------------------------------------------------------------
require_once(dirname(__FILE__).'/../common/defs.php');
?>
