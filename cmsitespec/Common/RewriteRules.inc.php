<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
 * @file Listener.ic.php
 * Definicija pravila lisenera
 * @date 15.11.2004.
 * @brief Definicija pravila lisenera
 */


//   return array( array( 'parm_name'  => 'PARM_Name'
//                       ,'parm_value' => '/dirname/regexp'
//                       ,'set_parms'  => array(
//                                             )
//                       ,'reset_parms'  => array(
//                                               )
//                      )
//               );
   return array( array( 'parm_name'    => PARM_structure_location
                       ,'parm_value'   => 'sdownload'
                       ,'set_parms'    => array( PARM_module => 'Core::FileManagement::cFileModul'
                                                ,PARM_file_command => PARMVAL_download
                                                ,PARM_file_type => PARMVAL_file_file
                                                ,PARM_download_command => PARMVAL_download_attachment
//                                                ,PARM_file_id => $fileObject->getElement('mId')
                                               )
                       ,'reset_parms'  => array( PARM_structure_location
                                               )
                      )
                ,array( 'parm_name'    => PARM_structure_location
                       ,'parm_value'   => 'ddownload'
                       ,'set_parms'    => array( PARM_module => 'Core::FileManagement::cFileModul'
                                                ,PARM_file_command => PARMVAL_download
                                                ,PARM_file_type => 'oFile'
                                                ,PARM_download_command => PARMVAL_download_attachment
//                                                ,PARM_file_id => $fileObject->getElement('mId')
                                               )
                       ,'reset_parms'  => array( PARM_structure_location
                                               )
                      )
                ,array( 'parm_name'    => PARM_structure_location
                       ,'parm_value'   => 'cntrlimage'
                       ,'set_parms'    => array( PARM_module => 'Core::Common::UI::InputControls::ConrolImage::cConrolImage'
                                               )
                       ,'reset_parms'  => array( PARM_structure_location
                                               )
                      )
                ,array( 'parm_name'    => PARM_structure_location
                       ,'parm_value'   => 'dicttooltip'
                       ,'set_parms'    => array( PARM_module					=> 'Modules::Dictionary::cDictionary'
		 						                        ,PARM_Dictionary_View		=> PARMVAL_Dictionary_View_Single
                                               )
                       ,'reset_parms'  => array( PARM_structure_location
                                               )
                      )
                ,array( 'parm_name'    => PARM_structure_location
                       ,'parm_value'   => 'ctbload'
                       ,'set_parms'    => array( PARM_module					=> 'Modules::TextBlockLoader::cTextBlockLoader'
//		 						                        ,PARM_Dictionary_View		=> PARMVAL_Dictionary_View_Single
                                               )
                       ,'reset_parms'  => array( PARM_structure_location
                                               )
                      )
               );

?>