<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
 * Copyright 2003-2005 (C) Massvision\n
 * Definicija UI klase za rad sa menijem
 * @file    cDropDownMenuUpX.php
 * @author  Milos Veskovic
 * @brief   Definicija UI klase za rad sa menijem
 */

require_once(PATH_CORE."Core/Common/UI/Menus/DropDownMenus/cDropDownMenu.php");

/**
 * Klasa za rad sa menijem
 * @brief Klasa za rad sa menijem
 */
class cDropDownMenuUpX extends cDropDownMenu
{
   var $mStructureMngr;     // NewsPlus module manager

   /**
    * Konstruktor
    * @brief Konstruktor
    */
   function cDropDownMenuUpX($headParams=array(), $bodyParams=array(), $mainParams=array(), $aditParams=array(), $specParams=array())
   {
      global $rObjectManager;
      $headParams = array( 'cssLink'               => URL_HOME.'/UI/Menus/DropDown/Style/dropDown.css' );
      $bodyParams = array( 'hideAllMenus'          => 'onclick' );
      $mainParams = array( 'DropDownMenuName'      => 'DropDownMenuUp' );
      $aditParams = array( 'MenuUpButtonCell'      => 'uppermenuItemX1Y'
//                          ,'TableDimensions'       => 'clientlogo'
                          ,'FixedTableWidth'       => '150'
                          ,'MenuTableDataWrap'     => 'wrap'
                          ,'TableDimensions'       => 'partTLLevelX0'
                          ,'StartTableX'           => 'partTLLevelX0'
                          ,'StartTableY'           => 'partTRLevelX1'
                          ,'AditionalStartX'       => 20
                          ,'TableFooterClassName'  => 'DropDownMenuFooter'
//                          ,'MenuUpSeparatorCellValue' => 2
                          );
      $specParams = array(  );

      parent::__construct($headParams, $bodyParams, $mainParams, $aditParams, $specParams);

      if($this->mOptionManager->getAnyOption(PARM_structure_location) != 'home/shop/viewsinglecategory')
         $this->mAditParams['CurrActivePage'] = $this->mOptionManager->getAnyOption(PARM_structure_location);

      $this->mStructureMngr = &$rObjectManager->getUnRegistredObject('cStructureTreeManager');

   }

   function createItems($menuNr, $item, $level=0, $parent="")
   {
      if(count($item))
      {
         foreach($item as $itemNr=>$params)
         {
            $this->addItemToSitemap(
                  array( 'menuNr'   => $menuNr //$key
                        ,'level'    => $level //dubina
                        ,'parent'   => $parent //
                        ,'itemNr'   => $itemNr //$link
                        ,'img'      => ""//$myimage->getTag() //slika
                        ,'desc'     => $params['desc'] //text
                        ,'url'      => $params['url'] //url
                        ,'target'   => $params['target'] //target
                        ,'haveSub'  => count($params['children']) ? 1 : 0  //havesub
                        ,'isActive' => isset($params['highlighted']) && $params['highlighted'] ? 1 : 0 //da li je aktivan
                        ,'activeURL'=> $params['activateon'][PARM_structure_location] //url ako je aktivan
                        )
                                                  );
            if(count($params['children']))
            {
               $this->createItems($menuNr, $params['children'], ($level+1), $itemNr);
            }
         }
      }
      else
      {
         $this->addItemToSitemap(
                  array( 'menuNr'   => $menuNr //$key
                        ,'level'    => $level //dubina
                        ,'parent'   => $parent //
                        ,'itemNr'   => ""//$itemNr //$link
                        ,'noMenu'   => true // ako je meni prazan
                        )
                                                  );
      }
   }
   /**
    * Glavna run funkcija
    * @brief Glavna run funkcija
    */
   function callRun()
   {
      $mItems = $this->getMenuItems();
      foreach($mItems as $menuNr=>$params)
      {
         if( isset($params['children']) )
         {
            $this->createItems($menuNr, $params['children']);
         }
      }
   }

   /**
    *  Vraca listu stavki na osnovu kojese pravi meni
    *  @return Vraca listu stavki na osnovu kojese pravi meni
    */
   function getMenuItems()
   {
      $set_options = array(); $reset_options = array();
      $this->mOptionManager->getSystemSetResetOptions($set_options, $reset_options);

      $tmp = $this->mStructureMngr->getMenuItems
         (
            array( 'path'        => PARMVAL_structure_location_home    // path trenutno aktivnog cvora (ako nije setovan, cita se iz opcija)
                  ,'version'     => 'active'  // verzija sajta (ako nije setovana, cita se iz opcija)
                  ,'start_level' => 1         // nivo od koga se konstruise menu
                  ,'depth'       => 3         // koliko nivoa se prikazuje u dubinu (default = 1)
                  ,'item_type'   => 'dropdown'// tip menija je DropDown
            )
           ,$this->whoAmI()
         );
      return $tmp;
   }

   /**
    * Vraca Putanju do modula
    * @brief Putanju do modula
    * @return string Putanju do modula
    */
   function whoAmI()
   {
      return 'UI::Menus::DropDown::cDropDownMenuUpX';
   }

}

?>