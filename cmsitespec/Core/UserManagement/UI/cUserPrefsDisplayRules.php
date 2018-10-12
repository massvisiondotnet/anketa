<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
 * Copyright 2003-2005 (C) Massvision\n
 * Definicija UI klase za definisanje site-specific pravila za prikaz adrese korisnika
 * @file    cUserPrefsDisplayRules.php
 * @author  Nemanja Nikolic
 * @brief   Definicija UI klase za definisanje site-specific pravila za prikaz adrese korisnika
 * @note    Require-ovati gde je potrebno:
 * @code
   require_once(PATH_HOME."/Core/UserManagement/UI/cUserPrefsDisplayRules.php");
 * @endcode
 */

require_once(PATH_ENUM."/Manager/cEnumManager.php");

/**
 * UI klasa za definisanje site-specific pravila za prikaz adrese korisnika
 * @brief UI klasa za definisanje site-specific pravila za prikaz adrese korisnika
 */
class cUserPrefsDisplayRules
{
   var $mDisplayRules;   //< pravila za prikazivanje
   var $mEnumManager;    //< manager za rad sa enum-podacima

   function cUserPrefsDisplayRules()
   {
      global $rObjectManager;
      $this->mEnumManager          = &$rObjectManager->getUnRegistredObject('cEnumManager');

      $this->mDisplayRules = array();
   }

   /**
    * Vraca pravila
    * @brief Vraca pravila
    */
   function getDisplayRules()
   {
      return $this->mDisplayRules;
   }

   /**
    * Vraca pravila za form-a
    * @brief Vraca pravila za proveru form-a
    * @param $rules array() pravila
    */
   function getFormRules($version=NULL)
   {
      return array( 'paramrules' => array ( 'NONEMPTY_first_name'  => array('key'=>'first_name',  'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_first_name)
                                           ,'NONEMPTY_last_name'   => array('key'=>'last_name',   'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_last_name)
                                           ,'NONEMPTY_street'      => array('key'=>'street',      'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_street)
                                           ,'NONEMPTY_postal_code' => array('key'=>'postal_code', 'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_postal_code)
                                           ,'NONEMPTY_city'        => array('key'=>'city',        'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_city)
                                           ,'NONEMPTY_land'        => array('key'=>'land',        'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_land)
                                           ,'NONEMPTY_tel'         => array('key'=>'tel',         'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_tel)
                                           ,'NONEMPTY_mobile'      => array('key'=>'mobile',      'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_mobile)
                                           ,'NONEMPTY_fax'         => array('key'=>'fax',         'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_fax)
                                           ,'NONEMPTY_email'       => array('key'=>'email',       'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_email)
                                           ,'ISEMAIL_email'        => array('key'=>'email',       'rule'=>REGEX_EMAIL,    'field_name' => LANG_user_prefs_field_email)
                                           ,'ISEMPTY_email'        => array('key'=>'email',       'rule'=>REGEX_EMPTY,    'field_name' => LANG_user_prefs_field_email)
                                          )
                   ,'formrule'   => array ( array( 'rule'           => 'NONEMPTY_first_name & NONEMPTY_last_name'
//                                                                      .' & NONEMPTY_street & NONEMPTY_postal_code & NONEMPTY_city & NONEMPTY_land'
                                                  ,'errormsg'       => LANG_Error_following_fields_are_mandatory
                                                  ,'display_fields' => 'AFFECTED'
                                                 )
//                                           ,array( 'rule'           => 'NONEMPTY_tel | NONEMPTY_mobile | NONEMPTY_fax | NONEMPTY_email'
//                                                  ,'errormsg'       => LANG_Error_at_least_one_nonempty
//                                                  ,'display_fields' => 'ALL' // 'ALL','AFFECTED','NONE'
//                                                 )
//                                           ,array( 'rule'           => 'ISEMPTY_email | ISEMAIL_email'
//                                                  ,'errormsg'       => LANG_Error_following_fields_should_be_email
//                                                  ,'display_fields' => 'AFFECTED'
//                                                 )
                                          )
                  );
   }

   /**
    * Definise dodatne elemente za prikaz u edit-modu
    * @brief Definise dodatne elemente za prikaz u edit-modu
    * @param &$object oObject objekt koji se prikazuje
    * @param &$elements array() niz elemenata za prikaz
    */
   function getEditElements(&$object,&$elements)
   {
      require_once(PATH_UI_CORE."/HTMLElements/cHTMLSelectionFieldWithExternalSource.php");
      require_once(PATH_UI_CORE."/HTMLElements/cHTMLTextAreaFieldWithOptions.php");
      
      // form_of_addressing
      $elements['form_of_addressing_title']  = new cHTMLStaticText( array('text' => LANG_user_prefs_field_form_of_addressing) );
      $elements['form_of_addressing']        = new cHTMLSelectionFieldWithExternalSource( array ( 'manager'       => &$this->mEnumManager
                                                                                                 ,'function'      => 'getArrayForSelectBox'
                                                                                                 ,'function_param'=> array( 'sort'          => false
                                                                                                                           ,'type'          => PARMVAL_Form_Of_Addressing
                                                                                                                     )
                                                                                                 ,'add_empty'     => true
                                                                                                 ,'value'         => $object->getElement('form_of_addressing')
                                                                                                 ,'class'         => 'userforminput'
                                                                                                 ,'style'         => 'width:80px'
                                                                                                 ,'name'          => PARM_user_prefs_form_prefix.'form_of_addressing'
//                                                                                                 ,'prefix'        => PARM_contact_form_Form
                                                                                          )
                                                   );
      // first_name
      $elements['first_name_title']          = new cHTMLStaticText( array('text' => LANG_user_prefs_field_first_name) );
      $elements['first_name']                = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'first_name'
                                                                                    ,'size'           => 20
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'userforminput'
                                                                                    ,'value'          => $object->getElement('first_name')
                                                                                    ,'_ignoreoptions' => true
                                                                              )
                                                   );
      // last_name
      $elements['last_name_title']           = new cHTMLStaticText( array('text' => LANG_user_prefs_field_last_name) );
      $elements['last_name']                 = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'last_name'
                                                                                    ,'size'           => 20
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'userforminput'
                                                                                    ,'value'          => $object->getElement('last_name')
                                                                                    ,'_ignoreoptions' => true
                                                                              )
                                                   );
      // company
      $elements['company_title']             = new cHTMLStaticText( array('text' => LANG_user_prefs_field_company) );
      $elements['company']                   = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'company'
                                                                                    ,'size'           => 50
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'userforminput'
                                                                                    ,'value'          => $object->getElement('company')
                                                                                    ,'_ignoreoptions' => true
                                                                              )
                                                   );
      // customer_nr
      $elements['customer_nr_title']         = new cHTMLStaticText( array('text' => LANG_user_prefs_field_customer_nr) );
      $elements['customer_nr']               = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'customer_nr'
                                                                                    ,'size'           => 15
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'userforminput'
                                                                                    ,'value'          => $object->getElement('customer_nr')
                                                                                    ,'_ignoreoptions' => true
                                                                              )
                                            );
      // street
      $elements['street_title']              = new cHTMLStaticText( array('text' => LANG_user_prefs_field_street) );
      $elements['street']                    = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'street'
                                                                                    ,'size'           => 50
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'userforminput'
                                                                                    ,'value'          => $object->getElement('street')
                                                                                    ,'_ignoreoptions' => true
                                                                              )
                                                   );
      // city
      $elements['city_title']                = new cHTMLStaticText( array('text' => LANG_user_prefs_field_city) );
      $elements['city']                      = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'city'
                                                                                    ,'size'           => 15
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'userforminput'
                                                                                    ,'value'          => $object->getElement('city')
                                                                                    ,'_ignoreoptions' => true
                                                                              )
                                                   );
      // land
      $elements['land_title']                = new cHTMLStaticText( array('text' => LANG_user_prefs_field_land) );
      $elements['land']                      = new cHTMLSelectionFieldWithExternalSource( array ( 'manager'       => &$this->mEnumManager
                                                                                                 ,'function'      => 'getArrayForSelectBox'
                                                                                                 ,'function_param'=> array( 'sort'          => true
                                                                                                                           ,'type'          => PARMVAL_Enum_type_LAND
                                                                                                                     )
                                                                                                 ,'add_empty'     => true
                                                                                                 ,'value'         => $object->getElement('land')
                                                                                                 ,'class'         => 'userforminput'
                                                                                                 ,'name'          => 'land'
                                                                                                 ,'prefix'        => PARM_user_prefs_form_prefix
                                                                                          )
                                                   );
      // postal_code
      $elements['postal_code_title']         = new cHTMLStaticText( array('text' => LANG_user_prefs_field_postal_code) );
      $elements['postal_code']               = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'postal_code'
                                                                                    ,'size'           => 10
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'userforminput'
                                                                                    ,'value'          => $object->getElement('postal_code')
                                                                                    ,'_ignoreoptions' => true
                                                                              )
                                                   );
      // gender
      $elements['gender_title']              = new cHTMLStaticText( array('text' => LANG_user_prefs_field_gender) );
      $elements['gender']                    = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'gender'
                                                                                    ,'size'           => 10
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'userforminput'
                                                                                    ,'value'          => $object->getElement('gender')
                                                                                    ,'_ignoreoptions' => true
                                                                              )
                                                   );
      // tel
      $elements['tel_title']                 = new cHTMLStaticText( array('text' => LANG_user_prefs_field_tel) );
      $elements['tel']                       = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'tel'
                                                                                    ,'size'           => 18
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'userforminput'
                                                                                    ,'value'          => $object->getElement('tel')
                                                                                    ,'_ignoreoptions' => true
                                                                              )
                                                   );
      // mobile
      $elements['mobile_title']              = new cHTMLStaticText( array('text' => LANG_user_prefs_field_mobile) );
      $elements['mobile']                    = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'mobile'
                                                                                    ,'size'           => 18
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'userforminput'
                                                                                    ,'value'          => $object->getElement('mobile')
                                                                                    ,'_ignoreoptions' => true
                                                                              )
                                                   );
      // fax
      $elements['fax_title']                 = new cHTMLStaticText( array('text' => LANG_user_prefs_field_fax) );
      $elements['fax']                       = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'fax'
                                                                                     ,'size'           => 18
                                                                                     ,'maxlength'      => 200
                                                                                     ,'class'          => 'userforminput'
                                                                                     ,'value'          => $object->getElement('fax')
                                                                                     ,'_ignoreoptions' => true
                                                                               )
                                                    );
      // email
      $elements['email_title']               = new cHTMLStaticText( array('text' => LANG_user_prefs_field_email) );
      $elements['email']                     = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'email'
                                                                                    ,'size'           => 50
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'userforminput'
                                                                                    ,'value'          => $object->getElement('email')
                                                                                    ,'_ignoreoptions' => true
                                                                              )
                                                   );
      // comment
      $elements['comment_title']             = new cHTMLStaticText( array('text' => LANG_user_prefs_field_comment) );
      $elements['comment']                   = new cHTMLTextAreaFieldWithOptions( array( 'name'           => PARM_user_prefs_form_prefix.'comment'
                                                                                        ,'cols'           => 58
                                                                                        ,'rows'           => 4
                                                                                        ,'class'          => 'userforminput'
                                                                                        ,'_text'          => $object->getElement('comment')
                                                                                        ,'_ignoreoptions' => true
                                                                                  )
                                                   );
      // submit
      //$elements['submit']                   = $this->mButtonManager->getInvoiceAddressEditButton($submit=true);

   } // function getEditElements(&$object,&$elements)

}  // class

?>