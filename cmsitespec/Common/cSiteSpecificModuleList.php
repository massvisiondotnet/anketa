<?php

/**
 * Copyright 2004 (C) Massvision \n
 * Lista raspolozivih site-specific modula
 * @file    cSiteSpecificModuleList.php
 * @author  Nemanja Nikolic
 * @code
   require_once(PATH_CORE.'Common/cSiteSpecificModuleList.php');
 * @endcode
 */

if (!defined('STARTS_FROM_ROOT')) die;

/**
 * Klasa koja sadrzi raspolozivih listu site-specific modula
 * @brief Klasa koja sadrzi listu raspolozivih site-specific modula
 */
class cSiteSpecificModuleList {
   var $mModules = array(
/*
                          array( 'path'         => '_HOME/Modules::'
                                ,'owner_group'  => PARMVAL_group_name_Ticketing_admin
                                ,'target_group' => NULL
                                ,'const_name'   => NULL
                                ,'setup_menu'   => true
                                ,'page_menu'    => false
                               ),
*/
                        );

   /**
    * Konstruktor
    * @brief Konstruktor
    */
   function cSiteSpecificModuleList() {
   }

   /**
    * Vraca listu dostupnih modula
    * @brief Vraca listu dostupnih modula
    * @return $list array lista dostupnih modula:
    * @code
      $modules = array( array( 'path'         => 'Modules::Shop::cShop'           // path do modula
                              ,'owner_group'  => PARMVAL_group_name_productadmin  // access rights za setup
                              ,'target_group' => PARMVAL_group_name_orderadmin    // access rights za setup
                              ,'const_name'   => 'SHOP_ENABLED'                   // konstanta kojom se definise da li se modul koristi
                              ,'setup_menu'   => true                             // da li se pojavljuje u setup-meniju
                              ,'page_menu'    => false                            // da li se pojavljuje u page edit meniju
                             )
                       ,array(...
                             )
                      );
    * @endcode
    */
   function &getModulesAvailable() {
      return $this->mModules;
   }

} // class
?>
