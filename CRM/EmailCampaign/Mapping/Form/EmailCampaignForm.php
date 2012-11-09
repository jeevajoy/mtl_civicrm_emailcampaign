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

require_once 'CRM/Core/Form.php';

require_once 'CRM/Core/Session.php';

/**
 * This class provides the functionality to delete a group of
 * contacts. This class provides functionality for the actual
 * addition of contacts to groups.
 */

class CRM_EmailCampaign_Mapping_Form_EmailCampaignForm extends CRM_Core_Form {

  function preProcess()   {	
    parent::preProcess( ); 		    
  }
    
  function buildQuickForm( ) {   
      $action = CRM_Utils_Array::value('action', $_REQUEST, '');
      $id = CRM_Utils_Request::retrieve( 'id', 'Integer', $this );
      $defaults = "";
      if ($action == 'update') {
          CRM_Utils_System::setTitle( 'Edit Activity Mapping' );
          $select_sql = "SELECT * FROM  ".CIVICRM_MTL_ACTIVITY_MAPPING." WHERE group_id = $id";           
          $select_dao = CRM_Core_DAO::executeQuery($select_sql);
         
              if($select_dao->fetch()) {                  
                  $defaults = array(
                              'groups'   => $select_dao->group_id,
                              'activitytype_1' => $select_dao->activity_type_1,
                              'activitytype_2' => $select_dao->activity_type_2,
                              'activitytype_3' => $select_dao->activity_type_3,                                                     
                              );
              }
      } elseif ($action == 'add') {
            CRM_Utils_System::setTitle( 'Add Activity Mapping' );    
      } elseif ($action == 'delete'){ 
            CRM_Utils_System::setTitle( 'Delete Activity Mapping' );    
            $this->assign('id', $id );       
      } elseif ($action == 'force_delete') {            
            $delete_sql = "DELETE FROM  ".CIVICRM_MTL_ACTIVITY_MAPPING." WHERE group_id = $id";            
		    CRM_Core_DAO::executeQuery($delete_sql);
            $session = CRM_Core_Session::singleton( );
            $status = ts('Activity Mapping deleted');
            CRM_Core_Session::setStatus( $status );
            drupal_goto( 'civicrm/emailCampaign-mapping' , array ('reset' => '1' ) );     
      }      
      $this->setDefaults( $defaults );            
       $activity_type_sql = "SELECT * FROM `civicrm_option_value` WHERE `option_group_id`=2 AND `component_id` IS NULL";
       $activity_type_dao = CRM_Core_DAO::executeQuery($activity_type_sql);
       $activity_type_array = array();
       $activity_type_array[''] = '-select-';
       while($activity_type_dao->fetch()) {        
            $activity_type_array[$activity_type_dao->value] = $activity_type_dao->label;   
       } 
       $groups_sql = "SELECT * FROM civicrm_group ";
       $groups_dao = CRM_Core_DAO::executeQuery($groups_sql);
       $GroupsArray = array();
       $GroupsArray[''] = '-select-';
       while($groups_dao->fetch()) {
            $GroupsArray[$groups_dao->id] = $groups_dao->title;   
       }        
       
      
       
       $this->add( 'select', 'groups', ts( 'Civi Group' ), $GroupsArray , true );  
       $this->add( 'select', 'activitytype_1', ts( 'Activity Type 1' ), $activity_type_array , true);
       $this->add( 'select', 'activitytype_2', ts( 'Activity Type 2' ), $activity_type_array , true);
       $this->add( 'select', 'activitytype_3', ts( 'Activity Type 3' ), $activity_type_array , true);
       //print_r($action);exit;
       $this->addElement('hidden', 'action', $action );
       $this->addElement('hidden', 'id', $id );
        
       $this->addButtons(array( 
                         array ( 'type'     => 'next', 
                                'name'      => ts('Save'), 
                                'spacing'   => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 
                                'isDefault' => false   ), 
                            ) 
                       );   
             
  }
  
  
    
  public  function postProcess() {
     $submitValues = $this->_submitValues;   
     $civiGroupID = $submitValues['groups'];
     $activityType1 = $submitValues['activitytype_1'];
     $activityType2 = $submitValues['activitytype_2'];
     $activityType3 = $submitValues['activitytype_3'];
   
     $sql = "REPLACE INTO ".CIVICRM_MTL_ACTIVITY_MAPPING." 
            SET `group_id`=$civiGroupID,`activity_type_1`=$activityType1,`activity_type_2`=$activityType2,`activity_type_3`=$activityType3";                     
     $dao = CRM_Core_DAO::executeQuery($sql); 
     $status = ts('Activity Mapping Added successfully');   
     CRM_Core_Session::setStatus( $status );   
     drupal_goto( 'civicrm/emailCampaign-mapping' , array ('reset' => '1' ) );   
}


}  