{*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.x                                                |
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
*}
<div class="crm-form-block">      
<table class="display" >
<tr>
<td>
<div class="help">
<p>{ts}Displays the Group - Activity Types Mapping. Use can add/edit mappings here to create 3 activities (in week interval time) of specified type, when a contact is added to a group.
<br /><strong>IMPORTANT:</strong> Note that the Scheduled Reminder should be configured for the selected activity types, for the emails to be sent out when the activity time is reached. {/ts}</p>
</div>
<a class="button" href="{crmURL p="civicrm/emailCampaign-mapping/add" q="action=add&reset=1"}" accesskey='e'><span><div class="icon add-icon"></div>&nbsp;Add New</span></a>
</td>
</tr>
</table>

 <div class="form-layout" border=2px;>
    <table class="display" >
    <thead class="sticky">
    <tr >
     <th>Civi Group</th> 
     <th>Activity Type 1</th> 
     <th>Activity Type 2</th>
     <th>Activity Type 3</th> 
     <th></th>     
    </tr>  
    <thead> 
    <tbody border=2px;>
    {foreach from=$groupArray key=group_id item=groupValues}             
          <tr> 
          {crmAPI var="GroupS" entity="Group" action="get" sequential="1" id=$group_id}
          {foreach from=$GroupS.values item=Group}
          <td>{$Group.title} </td>
          {/foreach}                          
          <td >{$groupValues.activity1.0} <br><span style="color: #f00;">{$groupValues.activity1.1} </span> </td> 
          <td >{$groupValues.activity2.0} <br><span style="color: #f00;">{$groupValues.activity2.1} </span> </td>
          <td >{$groupValues.activity3.0} <br><span style="color: #f00;">{$groupValues.activity3.1} </span></td>                
          <td><a href="{crmURL p="civicrm/emailCampaign-mapping/add" q="action=update&id=$group_id&reset=1"}">Edit</a>
              <a href="{crmURL p="civicrm/emailCampaign-mapping/add" q="action=delete&id=$group_id&reset=1"}">Delete</a></td>          
          </tr>                    
    {/foreach}
    </tbody>
    </table>
  </div>    
