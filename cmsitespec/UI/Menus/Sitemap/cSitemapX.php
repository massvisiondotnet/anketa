<?php

/**
 * Copyright 2003-2005 (C) Massvision\n
 * Definicija glavne izvrsne klase.
 * Ovaj modul je samo omotac za meni komponentu
 * @file    cSitemapX.php
 * @author  Dejan Petkovic
 * @brief   Definicija glavne izvrsne klase
 */

// Klasa koju obavija
require_once (PATH_CORE."Modules/MenuX/Sitemap/cSiteMap.php");

/**
 * Glavna izvrsna klasa
 * @brief Glavna izvrsna klasa
 */
class cSitemapX extends cSiteMap
{
   var $mStructureMngr;     // NewsPlus module manager

   /**
    * Konstruktor
    * @brief Konstruktor
    */
   /**/
   function cSitemapX()
   {
      parent::__construct();
   }

   /**
    *  Vraca listu stavki na osnovu kojese pravi meni
    *  @return Vraca listu stavki na osnovu kojese pravi meni
    */
   function getMenuDefinition()
   {
      return array
        ( 'type'           		=> 'vertical'
         ,'name'           		=> 'sitemap'
         ,'style_path' 				=> URL_HOME.'/UI/Menus/Sitemap/Style'
         ,'version'        		=> 'img_in_background' // Slike se prikazuju kao pozadina praznoj tacki
         ,'exclude_from_header'  => array('css'=>false,'js'=>true) // iskljucuje ubacivanje css odnosno js fajla
         ,'draw_separator' 		=> false
        );
   }

   /**
    *  Vraca listu stavki na osnovu kojese pravi meni
    *  @return Vraca listu stavki na osnovu kojese pravi meni
    */
   function getMenuItems()
   {
      $tmp = $this->mStructureMngr->getSitemapItems
         (
            array( 'path'        => PARMVAL_structure_location_home    // path trenutno aktivnog cvora (ako nije setovan, cita se iz opcija)
                  ,'version'     => 'active'  // verzija sajta (ako nije setovana, cita se iz opcija)
                  ,'start_level' => 1         // nivo od koga se konstruise menu
                  ,'depth'       => 4         // koliko nivoa se prikazuje u dubinu (default = 1)
						,'force_addons'   => true   // force adding mountpoints (e.g. gallery)
            )
           ,$this->whoAmI()
         );
      $home[0] = $this->mStructureMngr->getElementOfGivenLevel(0,PARMVAL_structure_location_home,'active',true);
      $home[0]['level'] = 0;
      $home[0]['children'] = $tmp;
      return $home;
   }

   /**
    * Funkcija za kreiranje menija
    * @brief Funkcija za kreiranje menija
    * @note Ovde se samo pozivaju run-ovi aktivnih Mngr-a
    */
   function createMenu()
   {
      $this->mMenu = new cSitemapMenuWithoutBorder($this->getMenuDefinition(), $this->getMenuItems());
      $this->mMenu->expandAll();                   // Ekspanduje stablo
   }

   /**
    * Vraca Putanju do modula
    * @brief Putanju do modula
    * @return string Putanju do modula
    */
   function whoAmI()
   {
      return '_HOME/::UI::Menus::Sitemap::cSitemapX';
   }

}  // class

?>
