<?php
if (!defined('STARTS_FROM_ROOT')) die;
/**
 * Copyright 2003-2005 (C) Massvision\n
 * Definicija klase koja vraca info o aktivnim event-ima
 * @file    PATH_HOME.'/Core/StatisticsManagement/Manager/cStatisticsSiteSpecActiveEvents.php'
 * @author  Nemanja Nikolic
 * @brief   Definicija klase koja vraca info o aktivnim event-ima
 */

require_once(PATH_STATISTICS_MANAGEMENT.'/Manager/cStatisticsActiveEvents.php');

/**
 * Klasa koja vraca info o aktivnim event-ima
 * @brief Klasa koja vraca info o aktivnim event-ima
 */
class cStatisticsSiteSpecActiveEvents extends cStatisticsActiveEvents
{
   /**
    * Konstruktor
    * @brief Konstruktor
    */
   function cStatisticsSiteSpecActiveEvents($params=array())
   {
      parent::__construct();
   }


   /**
    * Vraca info o aktivnim event-ima
    * @brief  Vraca info o aktivnim event-ima
    * @return $rActiveEvents array:
    * @code
      $rActiveEvents = array( PARMVAL_Statistics_EventCode_SomeEvent => '_CORE/Core::SomeManager::Etc'
                            );
    * @endcode
    */
   function getActiveEvents()
   {  // za sada, hard-coded:
      return array( PARMVAL_StatisticsEvent_SiteEntry      => 'Core::StatisticsManagement::Manager::Events::cStatisticsEventSiteEntry'
                   ,PARMVAL_StatisticsEvent_SiteExit       => 'Core::StatisticsManagement::Manager::Events::cStatisticsEventSiteExit'
                   ,PARMVAL_StatisticsEvent_PageVisit      => 'Core::StatisticsManagement::Manager::Events::cStatisticsEventPageVisit'
//                   ,PARMVAL_StatisticsEvent_ShoppingAmount => 'Modules::Shop::Manager::Statistics::cStatisticsEventShoppingAmount'
                  );
   }

}  // class
?>