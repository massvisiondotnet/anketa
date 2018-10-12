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

define('LANG_contact_form_subject','Waldbronn WWW - Kontaktformular');
define('LANG_contact_form_success','Ihre Nachricht wurde erfolgreich abgesandt. Danke.');
define('LANG_contact_form_submit','Abschicken');
define('LANG_contact_form_reset','Zurücksetzen');

// --- Spoljne definicije ---------------------------------------------------------------
require_once(dirname(__FILE__).'/../common/defs.php');
?>
