<?php
/**
 * Copyright 2003-2005 (C) Massvision\n
 * Setovanja i putanje koje se koriste u login modulu
 * @file    InstallationSpecific.inc.php
 * @author  Milos Veskovic
 * @brief   Setovanja i putanje koje se koriste u login modulu
 */

define('LOGIN_ENABLED',true);
if (LOGIN_ENABLED)
{
   /** Direktorijum sa sablonima za Login komponentu*/
   define('LOGIN_LIST_TEMPLATE_PATH', PATH_HOME.'/Modules/Login/UI/Templates');
}

?>