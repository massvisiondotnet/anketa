<?php

/**
 * Copyright 2003-2005 (C) Massvision\n
 * Definicija UI klase za pristupanje sistemu
 * @file    cSearchBox.php
 * @author  Dejan Petkovic
 * @brief   Definicija UI klase za pristupanje sistemu
 */

require_once (PATH_CORE."/Core/SearchManagement/UI/cCustomSearchInput.php");


class cSearchBox extends iUIManager {
   protected $mMenu;     

   public function __construct($params=array()) {
      parent::__construct($params);
   }

   /**
    * legacy
    */
   public function getMenuDefinition() {
      return array
        ( 'type'=>'search'
         ,'name'=>'searchbox'
         ,'title'=>LANG_Search
         //,'style_path' => URL_HOME.'/UI/Menus/Common/Style'
         //,'submit_button_type' => 'image'
        );
   }

   /**
    * Run
    */
   public function run() {
      $this->mMenu = new cCustomSearchInput($this->getMenuDefinition());
      $this->mMenu->run();
   }

   /**
    * Draw
    */
   public function draw() {
      $this->mMenu->draw();
   }

   /**
    * Vraca Putanju do modula
    * @return string 
    */
   public function whoAmI() {
      return '_HOME/UI::Menus::Search::cSearchBox';
   }

} 

?>
