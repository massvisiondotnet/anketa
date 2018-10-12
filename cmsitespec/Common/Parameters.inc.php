<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
 * Copyright 2003-2005 (C) Massvision\n
 * Globalni parametri koji se koriste na sajtu
 * @file    Parameters.inc.php
 * @author  Milos Veskovic
 * @brief   Globalni parametri koji se koriste na sajtu
 */

define('SITE_SPEC_CONTACT_EMAIL',"webmaster@massvision.net");
define('URL_SITE_ICON','favicon'); // samo ime fajla (bez extenzije) - default = "favicon"

/* Predefinisani stilovi - CSS klase */
   define('CUSTOM_STYLES_ENABLED',false); // da li treba prikazivati custom klase ili ne (true/false)
      define('CUSTOM_STYLES','');         // (classTitle,classSubtitle,...)
      define('CUSTOM_STYLES_DESC','');         // (classTitle,classSubtitle,...)

/* Parametri za rad sa search modulom */
   if (defined("SEARCH_ENABLED") && SEARCH_ENABLED)
      require_once(PATH_HOME."/Modules/Search/Common/Parameters.inc.php");

/* Parametri za rad sa news modulom */
   if (defined("NEWS_ENABLED") && NEWS_ENABLED)
      require_once(PATH_HOME."/Modules/NewsPlus/Common/Parameters.inc.php");

/* Parametri za rad sa login modulom */
   if (defined("LOGIN_ENABLED") && LOGIN_ENABLED)
      require_once(PATH_HOME."/Modules/Login/Common/Parameters.inc.php");

/* Parametri za rad sa shop modulom */
   if (defined("SHOP_ENABLED") && SHOP_ENABLED)
      require_once(PATH_HOME."/Modules/Shop/Common/Parameters.inc.php");

/* Parametri za rad sa register modulom */
   if (defined("REGISTER_ENABLED") && REGISTER_ENABLED)
      require_once(PATH_HOME."/Modules/Register/Common/Parameters.inc.php");

/* Parametri za rad sa contact form modulom */
   if (defined("CONTACT_ENABLED") && CONTACT_ENABLED)
      require_once(PATH_HOME."/Modules/ContactForm/Common/Parameters.inc.php");

/* Parametri za rad sa guestbook modulom */
   if (defined("SURVEY_ENABLED") && SURVEY_ENABLED)
      require_once(PATH_HOME."/Modules/Survey/Common/Parameters.inc.php");

/* Parametri za rad sa guestbook modulom */
   if (defined("GUESTBOOK_ENABLED") && GUESTBOOK_ENABLED)
      require_once(PATH_HOME."/Modules/GuestBook/Common/Parameters.inc.php");

/* Parametri za rad sa Seminar modulom */
   if (defined("SEMINARS_ENABLED") && SEMINARS_ENABLED)
      require_once(PATH_HOME."/Modules/Seminars/Common/Parameters.inc.php");

/* Parametri za rad sa Send to friend modulom */
   if (defined("SEND_TO_FRIEND_ENABLED") && SEND_TO_FRIEND_ENABLED)
      require_once(PATH_HOME."/Modules/SendToFriend/Common/Parameters.inc.php");

   /* Parametri za rad sa ReadBlock modulom */
   if (defined("READ_BLOCK_ENABLED") && READ_BLOCK_ENABLED)
      require_once(PATH_HOME."/Modules/ReadBlock/Common/Parameters.inc.php");

