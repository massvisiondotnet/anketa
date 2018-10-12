<?php
/**
 * Copyright 2003-2005 (C) Massvision\n
 * Definicija glavne izvrsne klase
 * @file    index.php
 * @author  Dejan Petkovic
 * @brief   Definicija glavne izvrsne klase
 */
set_time_limit(0);
header("P3P: CP='ALL CUR ADMa OUR NOR PHY ONL OTC'");

//set_time_limit(0);
define('STARTS_FROM_ROOT',true);

// Parametri specificni za korisnicku instalaciju
   require_once (dirname(__FILE__)."/../cmsitespec/Common/InstallationSpecific.inc.php");
// Putanja do cRootModuleManager-a
   require_once(PATH_CORE.'Core/Common/Manager/cRootModuleManager.php');

/**
 * Glavna izvrsna klasa
 * @brief Glavna izvrsna klasa
 */
class cIndex extends cRootModuleManager
{
}  // class
///** Kreiranje instance aplikacije*/
$cIndex=new cIndex();
//$cIndex->run();

ob_clean();
require_once(PATH_NEWSLETTER2."/cNewsletter2.php");
require_once(PATH_NEWSLETTER2."/Manager/cNewsletter2NewsletterDataManager.php");
$module = new cNewsletter2;
$manager = new cNewsletter2NewsletterDataManager;

$ret = $manager->sendPackageIfAny();
echo "Sent: {$ret}";
exit(0);

?>
