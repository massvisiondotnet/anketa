<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
 * Copyright 2003 (C) Massvision \n
 * Definicija UI klase za kreiranje site-specific buttons za contact form
 * @file    cContactFormButtons.php
 * @author  Nemanja Nikolic
 * @brief   Definicija UI klase za kreiranje site-specific buttons za contact form
 * @note    Require-ovati gde je potrebno:
 * @code
   require_once(PATH_HOME."/Modules/Shop/UI/Checkout/cContactFormButtons.php");
 * @endcode
 */

require_once(PATH_ENUM."/Manager/cEnumManager.php");
require_once(PATH_UI_CORE."/HTMLElements/cHTMLCode.php");
require_once(PATH_UI_CORE."/HTMLElements/cHTMLButtonWithOptions.php");
require_once(PATH_UI_CORE."/cUIContainer.php");

/**
 * UI klasa za kreiranje site-specific buttons za contact form
 * @brief UI klasa za kreiranje site-specific buttons za contact form
 */
class cContactFormButtons
{
   var $mEnumManager;    ///< manager za rad sa enum-podacima

   /**
    * Konstruktor
    * @brief Konstruktor
    */
   function cContactFormButtons()
   {
      global $rObjectManager;
      $this->mEnumManager = &$rObjectManager->getUnRegistredObject('cEnumManager');
   }


   /**
    * Vraca button za submitovanje forma
    * @brief Vraca button za submitovanje forma
    * @return $button cUIManager trazeni button
    */
   function &getSubmitButton()
   {
      $button = new cHTMLSubmitFieldWithOptions( array( 'name'        => 'contactformsubmitbtn'
                                                       ,'id'          => 'contactformsubmitbtn'
                                                       ,'value'       => LANG_contact_form_submit
                                                       ,'class'       => 'normalButtonFixedSize'
                                                       ,'onmouseover' => "javascript:this.className='normalButtonFixedSizeOver'"
                                                       ,'onmouseout'  => "javascript:this.className='normalButtonFixedSize'"
                                                      )
                                               );
      return $button;
   }

   /**
    * Vraca button za resetovanje forma
    * @brief Vraca button za resetovanje forma
    * @return $button cUIManager trazeni button
    */
   function &getResetButton()
   {
      $button = new cHTMLButtonWithOptions( array( 'name'        => 'contactformresetbtn'
                                                  ,'type'        => 'reset'
                                                  ,'id'          => 'contactformresetbtn'
                                                  ,'value'       => LANG_contact_form_reset
                                                  ,'class'       => 'normalButtonFixedSize'
                                                  ,'onmouseover' => "javascript:this.className='normalButtonFixedSizeOver'"
                                                  ,'onmouseout'  => "javascript:this.className='normalButtonFixedSize'"
                                                  ,'onclick'     => "javascript:document.contact_form.reset()"
                                                 )
                                          );
      return $button;
   }



}  // class

?>