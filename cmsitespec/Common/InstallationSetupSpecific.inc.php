<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
 * Copyright 2003-2005 (C) Massvision\n
 * Specificnosti instalacije koje su bitne samo prilikom setup-a
 * @file    Common/InstallationSetupSpecific.inc.php
 * @author  Nemanja Nikolic
 * @brief   Specificnosti instalacije koje su bitne samo prilikom setup-a
 */

/**  user (invoice) address fields **/
define( "SETUPDEF_user_address"
       ,"\$fieldDefs = array( 'form_of_addressing' => 'complex::userprefs::varchar(50)'
                             ,'first_name'         => 'complex::userprefs::varchar(200)'
                             ,'last_name'          => 'complex::userprefs::varchar(200)'
//                             ,'customer_no'        => 'complex::userprefs::varchar(200)'
//                             ,'company'            => 'complex::userprefs::varchar(200)'
//                             ,'department'         => 'complex::userprefs::varchar(200)'
//                             ,'position'           => 'complex::userprefs::varchar(200)'
                             ,'street'             => 'complex::userprefs::varchar(200)'
                             ,'city'               => 'complex::userprefs::varchar(200)'
                             ,'land'               => 'complex::userprefs::varchar(50)'
                             ,'postal_code'        => 'complex::userprefs::varchar(30)'
                             ,'tel'                => 'complex::userprefs::varchar(200)'
                             ,'fax'                => 'complex::userprefs::varchar(200)'
                             ,'email'              => 'complex::userprefs::varchar(200)'
                             ,'comment'            => 'complex::userprefs::text'
                       ); "
);

/**  shipping address fields **/
define( "SETUPDEF_shipping_address"
       ,"\$fieldDefs = array( 'form_of_addressing' => 'complex::userprefs::varchar(50)'
                             ,'first_name'         => 'complex::userprefs::varchar(200)'
                             ,'last_name'          => 'complex::userprefs::varchar(200)'
//                             ,'company'            => 'complex::userprefs::varchar(200)'
//                             ,'department'         => 'complex::userprefs::varchar(200)'
//                             ,'position'           => 'complex::userprefs::varchar(200)'
                             ,'street'             => 'complex::userprefs::varchar(200)'
                             ,'city'               => 'complex::userprefs::varchar(200)'
                             ,'land'               => 'complex::userprefs::varchar(50)'
                             ,'postal_code'        => 'complex::userprefs::varchar(30)'
                             ,'comment'            => 'complex::userprefs::text'
                       ); "

);

/**  contact form address fields **/
define( "SETUPDEF_contactform_address"
       ,"\$fieldDefs = array( 'form_of_addressing' => 'complex::userprefs::varchar(50)'
                             ,'first_name'         => 'complex::userprefs::varchar(200)'
                             ,'last_name'          => 'complex::userprefs::varchar(200)'
//                             ,'customer_no'        => 'complex::userprefs::varchar(200)'
//                             ,'company'            => 'complex::userprefs::varchar(200)'
//                             ,'department'         => 'complex::userprefs::varchar(200)'
//                             ,'position'           => 'complex::userprefs::varchar(200)'
                             ,'street'             => 'complex::userprefs::varchar(200)'
                             ,'city'               => 'complex::userprefs::varchar(200)'
                             ,'land'               => 'complex::userprefs::varchar(50)'
                             ,'postal_code'        => 'complex::userprefs::varchar(30)'
                             ,'tel'                => 'complex::userprefs::varchar(200)'
                             ,'fax'                => 'complex::userprefs::varchar(200)'
                             ,'email'              => 'complex::userprefs::varchar(200)'
                             ,'comment'            => 'complex::userprefs::text'
                       ); "
);


?>