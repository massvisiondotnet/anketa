<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
 * Copyright 2003-2005 (C) Massvision\n
 * Definicija Mng klase za site-specific setup
 * @file    cSiteSpecificDBSetUpManager.php
 * @author  Nemanja Nikolic
 * @charset charset=utf-8
 */


/**
 * Mng klasa za kreiranje baze
 */
class cSiteSpecificDBSetUpManager extends cObjectDBManager {

    /**
    * Konstruktor
    *
    * @param array
    */
    public function __construct($params=array()) {
        global $rObjectManager;
        parent::initObjectManager();
        $this->oDBBase = &$rObjectManager->getUnRegistredObject('cObjectDBManager');
        $this->mDB = &$this->oDBBase->mDB;
        $this->mState = &$this->oDBBase->mState;
    }

    /**
    * Kreira site-specific tabele
    *
    * @return bool
    */
    public function createDB() {
        $dbType = defined('DB_TYPE') ? DB_TYPE : null;
        $name = $this->getComplexContainerTableName('userprefs');
        $sql = null;
        switch ($dbType) {
            case 'MySQLt':
            case 'MySQLi':
            case 'MySQL':
                $sql = "CREATE TABLE IF NOT EXISTS ".$name." ( "
                       ."fp_tid int(11) NOT NULL auto_increment, "
                       ."fp_oid int (11) NOT NULL, "
                       ."form_of_addressing varchar(200), "
                       ."first_name varchar(200), "
                       ."last_name varchar(200), "
//                     ."company varchar(200), "
//                     ."customer_nr varchar(200), "
                       ."street varchar(200), "
                       ."city varchar(200), "
                       ."land varchar(200), "
                       ."postal_code varchar(30), "
//                     ."gender varchar(30), "
                       ."tel varchar(200), "
//                     ."mobile varchar(200), "
                       ."fax varchar(200), "
                       ."email varchar(200), "
                       ."comment longtext, "
//                      ."lang varchar(30), "
                       ."PRIMARY KEY  (fp_tid), "
                       ."KEY ind_oid (fp_oid), "
                       ."KEY ind_form_of_addressing (form_of_addressing(5)), "
                       ."KEY ind_first_name (first_name(10)), "
                       ."KEY ind_last_name (last_name(10)), "
//                     ."KEY ind_company (company(10)), "
//                     ."KEY ind_customer_nr (customer_nr(10)), "
                       ."KEY ind_street (street(10)), "
                       ."KEY ind_city (city(10)), "
                       ."KEY ind_land (land(10)), "
                       ."KEY ind_postal_code (postal_code(5)), "
//                     ."KEY ind_gender (gender(5)), "
                       ."KEY ind_tel (tel(10)), "
//                     ."KEY ind_mobile (mobile(10)), "
                       ."KEY ind_fax (fax(10)), "
                       ."KEY ind_email (email(10)) "
//                     ."KEY ind_lang (lang(5)) "
                       .") ENGINE = InnoDB";
                break;
            case 'mssql': 
                return '';
                break;
            case 'oci8':
                $sql = array("CREATE TABLE ".$name."( "
                       ."fp_tid number(10) NOT NULL, "
                       ."fp_oid number(10) NOT NULL, "
                       ."form_of_addressing varchar2(200), "
                       ."first_name varchar2(200), "
                       ."last_name varchar2(200), "
                       ."street varchar2(200), "
                       ."city varchar2(200), "
                       ."land varchar2(200), "
                       ."postal_code varchar2(30), "
                       ."tel varchar2(200), "
                       ."fax varchar2(200), "
                       ."email varchar2(200), "
                       ."\"comment\" clob, "
                       ."PRIMARY KEY (fp_tid)"
                       .")", 
                        // Sequence
                        "CREATE SEQUENCE ".$name."_s START WITH 1 INCREMENT BY 1",
                        // Trigger
                        "CREATE OR REPLACE TRIGGER ".$name."_st
                        BEFORE INSERT ON ".$name." FOR EACH ROW
                        WHEN (NEW.fp_tid IS NULL)
                        BEGIN
                        SELECT ".$name."_s.NEXTVAL INTO :NEW.fp_tid FROM DUAL;
                        END;",
                    );
                break;
            default  : 
                return '';
        }

        // complex data container tabela: userprefs
        if (!$this->MultiExecute($sql)) {
            $this->raiseError(array( 'name'        => LANG_Error_database_access_error
                                 ,'location'    => get_class($this)
                                 ,'action'      => __FUNCTION__.'@'.__FILE__.'#'.__LINE__
                                 ,'description' => $this->mDB->ErrorMsg()
                                )
                      );
            $this->mState = $this->ms_ERROR;
            $this->addMessage(LANG_Couldnt_Created_Table.': '.$name.' - '.$this->mDB->ErrorMsg());
            return false;
        } else {
            $this->addMessage(LANG_Created_data_container_table_.$name);
        }

        return true;
    }

    /**
    * Inicijalizuje bazu
    * 
    * @return $msg string poruka o statusu
    */
    function initDB()
    {
      return 'no sitespec init';
      // ===== DEFINICIJE Structure Treee Node Status-a
      $tEnumManager = new cEnumManager();
      $allStatuses = array();
      // FEMALE
      $allStatuses[] = array( 'code' => RCG_FEMALE
                             ,'type' => PARMVAL_Form_Of_Addressing
                             ,'description' =>
                                 array(   'en'          => "Ms"
                                         ,'ge'          => "Frau"
                                         ,'fr'          => "Madame"
                                         ,'sr-latin'    => "Ms"
                                         ,'sr-cyrillic' => "Ms"
                                      )
                            );
      // MALE
      $allStatuses[] = array( 'code' => RCG_MALE
                             ,'type' => PARMVAL_Form_Of_Addressing
                             ,'description' =>
                                 array(   'en'          => "Mr"
                                         ,'ge'          => "Herr"
                                         ,'fr'          => "Monsieur"
                                         ,'sr-latin'    => "Mr"
                                         ,'sr-cyrillic' => 'Mr'
                                      )
                            );


//      $allStatuses[] = array( 'code' => SALE_REGULAR
//                             ,'type' => PARMVAL_Sale
//                             ,'description' =>
//                                 array(   'en'          => "Regular"
//                                         ,'ge'          => "Standardpreis"
//                                         ,'fr'          => "Regular"
//                                         ,'sr-latin'    => "Normalno"
//                                         ,'sr-cyrillic' => 'Нормално'
//                                      )
//                            );
//
//      //
//      $allStatuses[] = array( 'code' => SALE_ON_SALE
//                             ,'type' => PARMVAL_Sale
//                             ,'description' =>
//                                 array(   'en'          => "On sale"
//                                         ,'ge'          => "Reduzierter Preis"
//                                         ,'fr'          => "Regular"
//                                         ,'sr-latin'    => "Snižena cena"
//                                         ,'sr-cyrillic' => 'Снижена цена'
//                                      )
//                            );
//
//      //
//      $allStatuses[] = array( 'code' => SOLD_ON_STOCK
//                             ,'type' => PARMVAL_Sold
//                             ,'description' =>
//                                 array(   'en'          => "On stock"
//                                         ,'ge'          => "Vorrätig"
//                                         ,'fr'          => "Regular"
//                                         ,'sr-latin'    => "Na lageru"
//                                         ,'sr-cyrillic' => 'На лагеру'
//                                      )
//                            );
//
//      //
//      $allStatuses[] = array( 'code' => SOLD_SOLD
//                             ,'type' => PARMVAL_Sold
//                             ,'description' =>
//                                 array(   'en'          => "Sold"
//                                         ,'ge'          => "Ausverkauft"
//                                         ,'fr'          => "Regular"
//                                         ,'sr-latin'    => "Rasprodato"
//                                         ,'sr-cyrillic' => 'Распродато'
//                                      )
//                            );
//
//      //
//      $allStatuses[] = array( 'code' => AGE_NEW
//                             ,'type' => PARMVAL_Age
//                             ,'description' =>
//                                 array(   'en'          => "New"
//                                         ,'ge'          => "Neu"
//                                         ,'fr'          => "Regular"
//                                         ,'sr-latin'    => "Novo"
//                                         ,'sr-cyrillic' => 'Ново'
//                                      )
//                            );
//
//      //
//      $allStatuses[] = array( 'code' => AGE_OLD
//                             ,'type' => PARMVAL_Age
//                             ,'description' =>
//                                 array(   'en'          => "Old"
//                                         ,'ge'          => "Alt"
//                                         ,'fr'          => "Regular"
//                                         ,'sr-latin'    => "Staro"
//                                         ,'sr-cyrillic' => 'Старо'
//                                      )
//                            );
//

//
//
      // Uvoz enuma
//      dprint('allStatuses', $allStatuses);die;
        $tEnumManager->importEnumDataFromArray($allStatuses);

        // OK zavrsena instalacija
        $this->addMessage(LANG_Custom_Init_completed_sucesfully);
        return $this->getMessage();
    }
}
