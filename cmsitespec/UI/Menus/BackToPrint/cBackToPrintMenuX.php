<?php

/**
 * Copyright 2003-2005 (C) Massvision\n
 * Definicija glavne izvrsne klase.
 * Ovaj modul je samo omotac za meni komponentu
 * @file    cBackToPrintMenuX.php
 * @author  Dejan Petkovic
 * @brief   Definicija glavne izvrsne klase
 */

// Klasa koju obavija
require_once (PATH_CORE."Modules/MenuX/cMenuX.php");
require_once (PATH_UI_CORE."/HTMLElements/cHTMLStaticImageWithText.php");

/**
 * Glavna izvrsna klasa
 * @brief Glavna izvrsna klasa
 */
class cBackToPrintMenuX extends cMenuX
{
   var $mStylePath;

   /**
    * Konstruktor
    * @brief Konstruktor
    */
   function cBackToPrintMenuX()
   {
      $this->mStylePath = 'UI/Menus/BackToPrint/Style';
      parent::__construct();
   }

   /**
    *  Vraca listu stavki na osnovu kojese pravi meni
    *  @return Vraca listu stavki na osnovu kojese pravi meni
    */
   function getMenuDefinition()
   {
      return array
        ( 'type'                 => 'horizontal'
         ,'name'                 => 'backtoprint'
         ,'list_tag'			 => 'ol'
         ,'id'                   => 'back_to_print_menu'
         ,'style_path' 				=> URL_HOME.'/UI/Menus/Common/Style'
         ,'has_own_js'           => false // Ako ima svoj javascript u suprotnom koristi 'menu.css' (podrazumevano je da ga ima)
         ,'exclude_from_header'  => array('css'=>false,'js'=>true) // iskljucuje ubacivanje css odnosno js fajla
         ,'version'              => 'img_in_background' // Slike se prikazuju kao pozadina praznoj tacki
         ,'name_for_shared_dir'  => 'bactoprint' // Ime stylesheeta i javascripta za deljene direktorijume (opciono)
         ,'draw_separator'       => true
        );
   }

   /**
    *  Vraca listu stavki na osnovu kojese pravi meni
    *  @return Vraca listu stavki na osnovu kojese pravi meni
    */
   function getMenuItems()
   {
      global $rObjectManager;
      $langManager = &$rObjectManager->getUnRegistredObject('cLanguageManager');
      $langinuse = $langManager->getLanguageInUse();

      $set_options = array(); $reset_options = array();
      $this->mOptionManager->getSystemSetResetOptions($set_options, $reset_options);
      $set_home_options = $set_options;
      $reset_home_options = $reset_options;
      $set_home_options[PARM_structure_location] = FAKE_ADDRESSES_OMIT_HOME ? '/' : 'home';
      $set_home_options[PARM_structure_version] = 'active';
      $set_sitemap_options = $set_options;
      $reset_sitemap_options = $reset_options;
      $set_sitemap_options[PARM_structure_location] = 'home/Sitemap';
      $set_sitemap_options[PARM_structure_version] = 'system';

      // Kreira link za stampanje
      $printlink = new cHTMLAnchorWithOptions(
                       array( 'href'=>PATH_APPLICATION
                             ,'target'=>'_top'
                             ,'title'=>LANG_Print)
                      ,new cHTMLStaticText(array('text'=>LANG_Print))
                      ,array(PARM_StructureTree_TemplateType=>'print')
                      ,array(PARM_StructureTree_TemplateType)
                      );
      $printlink->run();

       return array
        (
         array   // HISTORY BACK
          (
            'link'         => new cHTMLAnchorWithOptions(
                                  array( 'href'=>'javascript:history.back()'
                                        ,'target'=>'_top')
                                 ,new cHTMLStaticImage(
                                      array( 'src'=>$this->mStylePath.'/down_menu_item_1.gif'
                                            ,'border'=>0
                                            ,'alt'=>LANG_Back
                                            ,'title'=>LANG_Back)
                                      )
//                                 ,new cHTMLStaticImageWithText(
//                                      array( 'src'=>$this->mStylePath.'/down_menu_item_1.gif'
//                                            ,'border'=>0
//                                            ,'alt'=>LANG_Back
//                                            ,'title'=>LANG_Back)
//                                     ,LANG_Back)
                                 ,array()
                                 ,array(PARM_all)
                                 )
           ,'activateon'   => array(PARM_fake=>PARMVAL_all)
           ,'activated'    => true
          )
         ,array   // SCROLL TOP
          (
            'link'         => new cHTMLAnchorWithOptions(
                                  array( 'href'=>'javascript:self.scroll(0,0)'
                                        ,'target'=>'_top')
                                 ,new cHTMLStaticImage(
                                      array( 'src'=>$this->mStylePath.'/down_menu_item_2.gif'
                                            ,'border'=>0
                                            ,'alt'=>LANG_Top
                                            ,'title'=>LANG_Top)
                                      )
                                 ,array()
                                 ,array(PARM_all)
                                 )
           ,'activateon'   => array(PARM_fake=>PARMVAL_all)
           ,'activated'    => true
          )
         ,array   // HOME
          (
            'link'         => new cHTMLAnchorWithOptions(
                                  array( 'href'=>PATH_APPLICATION
                                        ,'target'=>'_top')
                                 ,new cHTMLStaticImage(
                                      array( 'src'=>$this->mStylePath.'/down_menu_item_3.gif'
                                            ,'border'=>0
                                            ,'alt'=>LANG_Home
                                            ,'title'=>LANG_Home)
                                      )
                                 ,$set_home_options
                                 ,$reset_home_options
                                 )
           ,'activateon'   => array(PARM_fake=>PARMVAL_all)
           ,'activated'    => true
          )
         ,array   // PRINT
          (
            'link'         => new cHTMLAnchorWithOptions(
                                  array( 'href'=>'javascript:printOrder(\''.$printlink->getAbsoluteURL().'\')'
                                        ,'target'=>'_top')
                                 ,new cHTMLStaticImage(
                                      array( 'src'=>$this->mStylePath.'/down_menu_item_4.gif'
                                            ,'border'=>0
                                            ,'alt'=>LANG_Print
                                            ,'title'=>LANG_Print)
                                      )
                                 ,array()
                                 ,array(PARM_all)
                                 )
           ,'activateon'   => array(PARM_fake=>PARMVAL_all)
           ,'activated'    => true
          )
//         ,array   // Druga stavka u meniju
//          (
//            'link' => new cHTMLAnchorWithOptions(array('href'=>'javascript:mailpage(\''.LANG_Demo_Tell_to_friend_Message.'\')', 'target'=>'_top', 'title'=>LANG_Demo_Tell_to_friend), new cHTMLStaticImage(array('src'=>$this->mStylePath.'/down_menu_item_6.gif','border'=>0, 'alt'=>LANG_Demo_Tell_to_friend, 'title'=>LANG_Demo_Tell_to_friend)), array(), array(PARM_all))
//           ,'activateon' => array(PARM_fake=>PARMVAL_all)
//           ,'activated' => true
//          )
         ,array   // MAILTO
          (
            'link'         => new cHTMLAnchorWithOptions(
                                  array( 'href'=>'mailto:'.SITE_SPEC_CONTACT_EMAIL
                                        ,'target'=>'_top')
                                 ,new cHTMLStaticImage(
                                      array( 'src'=>$this->mStylePath.'/down_menu_item_6.gif'
                                            ,'border'=>0
                                            ,'alt'=>LANG_Email_us
                                            ,'title'=>LANG_Email_us)
                                      )
                                 ,array()
                                 ,array(PARM_all)
                                 )
           ,'activateon'   => array(PARM_fake=>PARMVAL_all)
           ,'activated'    => true
          )
         ,array   // SITEMAP
          (
            'link'         => new cHTMLAnchorWithOptions(
                                  array( 'href'=>PATH_APPLICATION
                                        ,'target'=>'_top')
                                 ,new cHTMLStaticImage(
                                      array( 'src'=>$this->mStylePath.'/down_menu_item_7.gif'
                                            ,'border'=>0
                                            ,'alt'=>LANG_Sitemap
                                            ,'title'=>LANG_Sitemap)
                                      )
                                 ,$set_sitemap_options
                                 ,$reset_sitemap_options
                                 )
           ,'activateon'   => array(PARM_fake=>PARMVAL_all)
           ,'activated'    => true
          )
        );

   }

   /**
    * Funkcija za izvrsavanje run procedura
    * @brief Funkcija za ispis na ekran
    * @note Ovde se samo pozivaju run-ovi aktivnih Mngr-a
    */
   function createMenu() {
      $this->mMenu = new cOlLiMenu($this->getMenuDefinition(), $this->getMenuItems());
   }

   /**
    * Vraca Putanju do modula
    * @brief Putanju do modula
    * @return string Putanju do modula
    */
   function whoAmI()
   {
      return '_HOME/UI::Menus::BackToPrint::cBackToPrintMenuX';
   }

}  // class

?>
