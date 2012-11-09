<?php

/*
 +--------------------------------------------------------------------+
 | CiviCRM version 3.3                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2010                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*/

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2010
 * $Id$
 *
 */

require_once 'CRM/Core/Page.php';

/**
 * This class provides the functionality to delete a group of
 * contacts. This class provides functionality for the actual
 * addition of contacts to groups.
 */

class CRM_EmailCampaign_Mapping_Page_EmailCampaignPage extends CRM_Core_Page{

  function preProcess( ){
      CRM_Utils_System::setTitle( ts('Group Mapping') );
      require_once 'api/v3/utils.php';
      require_once 'CRM/Core/OptionGroup.php';
      $activityTypes = CRM_Core_OptionGroup::values( 'activity_type' );  
      
      $select_sql = "SELECT * FROM  ".CIVICRM_MTL_ACTIVITY_MAPPING; 
      $select_dao = CRM_Core_DAO::executeQuery($select_sql);  
              
      while($select_dao->fetch()) {         
            $groups_sql = "SELECT * FROM civicrm_group WHERE id=".$select_dao->group_id;
            $groups_dao = CRM_Core_DAO::executeQuery($groups_sql);
           if($groups_dao->fetch())  
            $types = array("activity1"=>$select_dao->activity_type_1,"activity2"=>$select_dao->activity_type_2,"activity3"=>$select_dao->activity_type_3);                           
            $groupArray[$groups_dao->id] = $types;              
      }
      
      if(isset($groupArray)) {
          foreach($groupArray as $key => $value) {
            foreach($value as $k => $v) { 
               $activityTypesFlip = array_flip($activityTypes);         
               $value = array_search($v, $activityTypesFlip);
               $values = array(); 
               $values[] = $value; 
               $action_schedule_sql = "SELECT * FROM `civicrm_action_schedule` WHERE is_active=1 AND `entity_value`=".$v;
               $action_schedule_dao = CRM_Core_DAO::executeQuery($action_schedule_sql);
               if(!$action_schedule_dao->fetch()) {
                    $values[] = "Schedule Reminder has not been set/Inactive";
               }                            
               $groupArray[$key][$k]=$values;
               
            } 
          } 
      }
      if(!empty($groupArray))
        $this->assign( 'groupArray', $groupArray );       
        
     require_once 'CRM/Core/Config.php';
     $config = CRM_Core_Config::singleton();
     $this->assign( 'userFrameworkBaseURL', $config->userFrameworkBaseURL ); 
  }

  
   

    /** 
     * This function is the main function that is called when the page loads, 
     * it decides the which action has to be taken for the page. 
     *                                                          
     * return null        
     * @access public 
     */                                                          
    function run( ) { 
        $this->preProcess( );        
        return parent::run( );
    }


}  