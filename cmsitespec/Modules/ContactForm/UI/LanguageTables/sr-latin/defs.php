<?php
$charset = "charset=utf-8";
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

define('LANG_contact_form_subject','Prijava za takmičenja');
define('LANG_contact_form_success','Hvala Vam na interesovanju!');
define('LANG_contact_form_submit','Pošalji');
define('LANG_contact_form_reset','Poništi');

// --- Spoljne definicije ---------------------------------------------------------------
require_once(dirname(__FILE__).'/../common/defs.php');
?>
