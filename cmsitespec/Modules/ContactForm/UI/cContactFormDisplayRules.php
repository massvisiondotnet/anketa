<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
 * Copyright 2003 (C) Massvision \n
 * Definicija UI klase za definisanje site-specific pravila za prikaz kontakt-formulara
 * @file    cContactFormDisplayRules.php
 * @author  Nemanja Nikolic
 * @brief   Definicija UI klase za definisanje site-specific pravila za prikaz kontakt-formulara
 * @note    Require-ovati gde je potrebno:
 * @code
   require_once(PATH_HOME."/Modules/ContactForm/UI/cContactFormDisplayRules.php");
 * @endcode
 */

require_once(PATH_ENUM."/Manager/cEnumManager.php");
require_once(PATH_UI_CORE."/HTMLElements/cHTMLSelectionFieldWithExternalSource.php");
require_once(PATH_HOME."/Modules/ContactForm/UI/cContactFormButtons.php");
require_once(PATH_UI_CORE."/cUIContainer.php");
require_once(PATH_UI_CORE."/HTMLElements/cHTMLCode.php");
require_once(PATH_UI_CORE."/HTMLElements/cHTMLTextAreaFieldWithOptions.php");

/**
 * UI klasa za definisanje site-specific pravila za prikaz kontakt-formulara
 * @brief UI klasa za definisanje site-specific pravila za prikaz kontakt-formulara
 */
class cContactFormDisplayRules
{
   var $mDisplayRules;   //< pravila za prikazivanje
   var $mEnumManager;    //< manager za rad sa enum-podacima
   var $mButtonManager;  //< manager za rad sa site-specific buttons

   function cContactFormDisplayRules()
   {
      global $rObjectManager;
      $this->mEnumManager          = &$rObjectManager->getUnRegistredObject('cEnumManager');
      $this->mButtonManager        = &$rObjectManager->getUnRegistredObject('cContactFormButtons');

      $this->mDisplayRules = array(
                             );
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
   function getFormRules()
   {
      return array( 'paramrules' => array ( 'NONEMPTY_first_name'  => array('key'=>'first_name',  'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_first_name)
                                           ,'NONEMPTY_last_name'   => array('key'=>'last_name',   'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_last_name)
                                           ,'NONEMPTY_email'       => array('key'=>'email',       'rule'=>REGEX_NOTEMPTY, 'field_name' => LANG_user_prefs_field_email)
                                           ,
                                            'ISEMAIL_email'        => array('key'=>'email',       'rule'=>REGEX_EMAIL,    'field_name' => LANG_user_prefs_field_email)
                                           ,'ISEMPTY_email'        => array('key'=>'email',       'rule'=>REGEX_EMPTY,    'field_name' => LANG_user_prefs_field_email)
                                          )
                   ,'formrule'   => array ( array( 'rule'           => 'NONEMPTY_first_name & NONEMPTY_last_name & NONEMPTY_email'
                                                  ,'errormsg'       => LANG_Error_following_fields_are_mandatory
                                                  ,'display_fields' => 'AFFECTED'
                                                 )
                                           ,array( 'rule'           => 'ISEMPTY_email | ISEMAIL_email'
                                                  ,'errormsg'       => LANG_Error_following_fields_should_be_email
                                                  ,'display_fields' => 'AFFECTED'
                                                 )
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
      // first_name
      $elements['first_name_title']          = new cHTMLStaticText( array('text' => LANG_user_prefs_field_first_name) );
      $elements['first_name']                = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_contact_form_Form.'first_name'
                                                                                    ,'size'           => 20
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'contactforminput'
                                                                                    ,'value'          => $object->getElement('first_name')
                                                                                    ,'_ignoreoptions' => true
                                                                                    ,'style'         => 'width:300px'
                                                                              )
                                                   );
      // last_name
      $elements['last_name_title']           = new cHTMLStaticText( array('text' => LANG_user_prefs_field_last_name) );
      $elements['last_name']                 = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_contact_form_Form.'last_name'
                                                                                    ,'size'           => 20
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'contactforminput'
                                                                                    ,'value'          => $object->getElement('last_name')
                                                                                    ,'_ignoreoptions' => true
                                                                                    ,'style'         => 'width:300px'
                                                                              )
                                                   );
      // company
      /*$elements['company_title']             = new cHTMLStaticText( array('text' => LANG_user_prefs_field_company) );
      $elements['company']                   = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_contact_form_Form.'company'
                                                                                    ,'size'           => 50
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'contactforminput'
                                                                                    ,'value'          => $object->getElement('company')
                                                                                    ,'_ignoreoptions' => true
                                                                                    ,'style'         => 'width:300px'
                                                                              )
                                                   );
      */
      // street
      $elements['street_title']              = new cHTMLStaticText( array('text' => LANG_user_prefs_field_street) );
      $elements['street']                    = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_contact_form_Form.'street'
                                                                                    ,'size'           => 50
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'contactforminput'
                                                                                    ,'value'          => $object->getElement('street')
                                                                                    ,'_ignoreoptions' => true
                                                                                    ,'style'         => 'width:300px'
                                                                              )
                                                   );
      // city
      $elements['city_title']                = new cHTMLStaticText( array('text' => LANG_user_prefs_field_city) );
      $elements['city']                      = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_contact_form_Form.'city'
                                                                                    ,'size'           => 15
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'contactforminput'
                                                                                    ,'value'          => $object->getElement('city')
                                                                                    ,'_ignoreoptions' => true
                                                                                    ,'style'         => 'width:242px'
                                                                              )
                                                   );
      // land
     /* $elements['land_title']                = new cHTMLStaticText( array('text' => LANG_user_prefs_field_land) );
      $elements['land']                      = new cHTMLSelectionFieldWithExternalSource( array ( 'manager'       => &$this->mEnumManager
                                                                                                 ,'function'      => 'getArrayForSelectBox'
                                                                                                 ,'function_param'=> array( 'sort'          => true
                                                                                                                           ,'type'          => PARMVAL_Enum_type_LAND
                                                                                                                     )
                                                                                                 ,'add_empty'     => true
                                                                                                 ,'value'         => $object->getElement('land')
                                                                                                 ,'class'         => 'contactforminput'
                                                                                                 ,'name'          => 'land'
                                                                                                 ,'prefix'        => PARM_contact_form_Form
                                                                                                 ,'style'         => 'width:300px'
                                                                                          )
                                                   );
      */
      // postal_code
      $elements['postal_code_title']         = new cHTMLStaticText( array('text' => LANG_user_prefs_field_postal_code) );
      $elements['postal_code']               = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_contact_form_Form.'postal_code'
                                                                                    ,'size'           => 10
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'contactforminput'
                                                                                    ,'value'          => $object->getElement('postal_code')
                                                                                    ,'_ignoreoptions' => true
                                                                                    ,'style'          => 'width:55px'
                                                                              )
                                                   );
      // tel
      $elements['tel_title']                 = new cHTMLStaticText( array('text' => LANG_user_prefs_field_tel) );
      $elements['tel']                       = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_contact_form_Form.'tel'
                                                                                    ,'size'           => 18
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'contactforminput'
                                                                                    ,'value'          => $object->getElement('tel')
                                                                                    ,'_ignoreoptions' => true
                                                                                    ,'style'          => 'width:300px'
                                                                              )
                                                   );
      // fax
    /*  $elements['fax_title']                 = new cHTMLStaticText( array('text' => LANG_user_prefs_field_fax) );
      $elements['fax']                       = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_contact_form_Form.'fax'
                                                                                     ,'size'           => 18
                                                                                     ,'maxlength'      => 200
                                                                                     ,'class'          => 'contactforminput'
                                                                                     ,'value'          => $object->getElement('fax')
                                                                                     ,'_ignoreoptions' => true
                                                                                     ,'style'          => 'width:300px'
                                                                               )
                                                    );
   */                                         
      // email
      $elements['email_title']               = new cHTMLStaticText( array('text' => LANG_user_prefs_field_email) );
      $elements['email']                     = new cHTMLTextFieldWithOptions( array( 'name'           => PARM_contact_form_Form.'email'
                                                                                    ,'size'           => 50
                                                                                    ,'maxlength'      => 200
                                                                                    ,'class'          => 'contactforminput'
                                                                                    ,'value'          => $object->getElement('email')
                                                                                    ,'_ignoreoptions' => true
                                                                                    ,'style'          => 'width:300px'
                                                                              )
                                                   );
      // comment
      //$elements['comment_title']             = new cHTMLStaticText( array('text' => LANG_user_prefs_field_comment) );
      $elements['comment']                   = new cHTMLTextAreaFieldWithOptions( array( 'name'           => PARM_contact_form_Form.'comment'
                                                                                        ,'cols'           => 58
                                                                                        ,'rows'           => 15
                                                                                        ,'class'          => 'contactforminput'
                                                                                        ,'_text'          => $object->getElement('comment')
                                                                                        ,'_ignoreoptions' => true
                                                                                        ,'style'          => 'width:300px'
                                                                                  )
                                                   );
      // submit
      $elements['submit']                   = new cUIContainer();
      $elements['submit']->addElement($this->mButtonManager->getResetButton());
      $elements['submit']->addElement(new cHTMLCode( "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n"
                                                    ."<tr><td height=\"5\"></td></tr>\n"
                                                    ."</table>\n"
                                                   )
                                     );
      $elements['submit']->addElement($this->mButtonManager->getSubmitButton());


   } // function getEditElements(&$object,&$elements)


   /**
    * Sastavlja i salje e-mail
    * @brief Sastavlja i salje e-mail
    * @param &$object podaci
    */
   function composeAndSendMail(&$object)
   {
      $to      = CONTACT_FORM_RECIPIENT;     // e.g. "Nemanja <nemanja@massvision.de>" or "s.seibold@waldbronn.de"
      $cc      = CONTACT_FORM_CC;            // t.merz@waldbronn.de
      $subject = LANG_contact_form_subject;  // e.g. "Website contact form"

      $message  = "<table cellspacing=\"0\" cellpadding=\"10\" border=\"0\" ><tr><td valign=\"left\" align=\"top\">\n";
      $message .= "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" ><tr><td valign=\"left\" align=\"top\">\n";

      if ($element = $object->getElement('form_of_addressing'))
         $message .= $element." ";
      if ($element = $object->getElement('first_name'))
         $message .= $element." ";
      if ($element = $object->getElement('last_name'))
         $message .= $element." ";
      $message .= "<br>\n";

      //if ($element = $object->getElement('company'))
      //   $message .= $element."<br>\n";


      if ($element = $object->getElement('street'))
         $message .= $element."<br>\n";

      $line = "";
      if ($element = $object->getElement('postal_code'))
         $line .= $element." ";
      if ($element = $object->getElement('city'))
         $line .= $element.", ";
      /*if ($element = $object->getElement('land'))
         $line .= $this->mEnumManager->getDescriptionFromCode( array( 'type' => PARMVAL_Enum_type_LAND
                                                                     ,'var'  => $element
                                                                    )
                                                             ); */
      if ($line)
         $message .= $line."<br>\n";

      $line = "";
      if ($element = $object->getElement('customer_nr'))
         $line .= "<tr><td align=\"left\" valign=\"middle\">".LANG_user_prefs_field_customer_nr.":&nbsp;</td><td align=\"left\" valign=\"middle\">".$element."</td></tr>\n";
      if ($element = $object->getElement('gender'))
         $line .= "<tr><td align=\"left\" valign=\"middle\">".LANG_user_prefs_field_gender.":&nbsp;</td><td align=\"left\" valign=\"middle\">".$element."</td></tr>\n";
      if ($element = $object->getElement('tel'))
         $line .= "<tr><td align=\"left\" valign=\"middle\">".LANG_user_prefs_field_tel.":&nbsp;</td><td align=\"left\" valign=\"middle\">".$element."</td></tr>\n";
      if ($element = $object->getElement('mobile'))
         $line .= "<tr><td align=\"left\" valign=\"middle\">".LANG_user_prefs_field_mobile.":&nbsp;</td><td align=\"left\" valign=\"middle\">".$element."</td></tr>\n";
      //if ($element = $object->getElement('fax'))
       //  $line .= "<tr><td align=\"left\" valign=\"middle\">".LANG_user_prefs_field_fax.":&nbsp;</td><td align=\"left\" valign=\"middle\">".$element."</td></tr>\n";
      if ($element = $object->getElement('email'))
         $line .= "<tr><td align=\"left\" valign=\"middle\">".LANG_user_prefs_field_email.":&nbsp;</td><td align=\"left\" valign=\"middle\">".$element."</td></tr>\n";
      if ($line)
         $message .= "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n".$line."</table>\n";


      if ($element = $object->getElement('comment'))
      {
         $element = preg_replace("/[\r\n]+/","<br>",$element);
         $message .= LANG_user_prefs_field_comment.":<br>\n".$element."  \n";
      }

      $message .= "</td></tr></table>\n";
      $message .= "</td></tr></table>\n";

      $headers  = '';
      if ($element = $object->getElement('email'))
         $headers .= "From: <".$element.">\n";
      $headers .= "X-Mailer: PHP\n"; //mailer
      $headers .= "Content-Type: text/html; charset=utf-8\n";
//      $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
//      $headers .= "Content-Transfer-Encoding: base64\n";
      $headers .= "Cc: ".$cc."\n";
      
      dprint("",$to."\n".$cc."\n".$subject);
      dprint("",$message."\n");
      Die;

//      $message = base64_encode($message);
      mail($to, $subject, $message, $headers);
   }



}  // class

?>