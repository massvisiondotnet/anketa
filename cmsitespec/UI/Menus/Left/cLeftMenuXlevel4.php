<?php

/**
 * Copyright 2003-2008 (C) Massvision\n
 * Definicija glavne izvrsne klase.
 * @file    cMenuX.php
 * @author  Mladen Mijatov
 */

require_once (PATH_CORE."Modules/MenuX/cMenuX.php");
require_once (PATH_CORE."Core/Common/UI/Menus/OlLiMenu/cOlLiMenu.php");

class cLeftMenuXlevel4 extends cMenuX
{
   var $mStructureMngr;     // NewsPlus module manager

   function cLeftMenuXlevel4()
   {
      global $rObjectManager;

      // Inicijalizuje StructureTreeManager mora pre konstruktora roditelja
      $this->mStructureMngr = &$rObjectManager->getUnRegistredObject('cStructureTreeManager');

      parent::__construct();
   }

   /**
    *  Vraca listu stavki na osnovu kojese pravi meni
    *  @return Vraca listu stavki na osnovu kojese pravi meni
    */
   function getMenuDefinition()
   {
      return array
        ( 'type'                 => 'vertical'
         ,'name'                 => 'leftmenu'
         ,'id'                   => 'left_menu'
         ,'style_path' 				=> URL_HOME.'/UI/Menus/Common/Style'
         ,'has_own_js'           => false                   // Ako ima svoj javascript u suprotnom koristi 'menu.css' (podrazumevano je da ga ima)
         ,'exclude_from_header'  => array('css'=>false,'js'=>true) // iskljucuje ubacivanje css odnosno js fajla
         ,'version'              => 'img_in_background'     // Slike se prikazuju kao pozadina praznoj tacki
         ,'name_for_shared_dir'  =>'left'                   // Ime stylesheeta i javascripta za deljene direktorijume (opciono)
         ,'draw_separator'       => false
         ,'wrap_item'            => true
        );
   }

   /**
    * Funkcija za kreiranje menija
    * @brief Funkcija za kreiranje menija
    * @note Ovde se samo pozivaju run-ovi aktivnih Mngr-a
    */
   function createMenu() {
      $this->mMenu = new cOlLiMenu($this->getMenuDefinition(), $this->getMenuItems());
   }

   /**
    *  Vraca listu stavki na osnovu kojese pravi meni
    *  @return Vraca listu stavki na osnovu kojese pravi meni
    */
   function &getMenuItems()
   {
      $set_options = array(); $reset_options = array();
      $this->mOptionManager->getSystemSetResetOptions($set_options, $reset_options);

      $pages = $this->mStructureMngr->getMenuItems
         (
            array( 'version'        => 'active'  // verzija sajta (ako nije setovana, cita se iz opcija)
                  ,'start_level'    => 3         // nivo od koga se konstruise menu
                  ,'depth'          => 4         // koliko nivoa se prikazuje u dubinu (default = 1)
                  ,'set_options'    => $set_options   // Parametri koji se dodaju na link
                  ,'reset_options'  => array(PARM_all) // Parametri koji se oduzimaju sa linka
            )
           ,$this->whoAmI()
         );
      return $pages;
   }


   /**
    * Funkcija za ispis na ekran
    * @brief Funkcija za ispis na ekran
    */
   function callDraw()
   {
      $this->mMenu->draw();
   }


   /**
    * Vraca Putanju do modula
    * @brief Putanju do modula
    * @return string Putanju do modula
    */
   function whoAmI()
   {
      return '_HOME/UI::Menus::Left::cLeftMenuXlevel4';
   }

}  // class

?>
