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
<div class="crm-block crm-form-block crm-export-form-block">  

{if $action eq '1' OR $action eq '2'}
<div class="help">
<p>{ts}Use this form to add/edit mappings here to create 3 activities (in week interval time) of specified type, when a contact is added to a group.<br />{/ts}</p>
</div>
<table class="form-layout">
     <tr>
		<td>
			<table class="form-layout">				
				<tr><td class="label">{$form.groups.label}</td><td>{$form.groups.html}</td></tr>
				<tr><td class="label">{$form.activitytype_1.label}</td><td>{$form.activitytype_1.html}</td></tr> 
                <tr><td class="label">{$form.activitytype_2.label}</td><td>{$form.activitytype_2.html}</td></tr> 
                <tr><td class="label">{$form.activitytype_3.label}</td><td>{$form.activitytype_3.html}</td></tr> 
			</table>
		</td>
     </tr>
</table>

<div class="crm-submit-buttons">
  {include file="CRM/common/formButtons.tpl" location="top"}
  &nbsp;&nbsp;&nbsp;<a class="button" href="{crmURL p='civicrm/emailCampaign-mapping' q='reset=1'}"><span>{ts}Cancel{/ts}</span></a>
</div>
</div>
{else if $action eq '8'} 
    <!--<h3>Publication: {$publicationName}</h3>-->
		<div class="crm-participant-form-block-delete messages status">
        <div class="crm-content">             
            {ts}WARNING: This operation cannot be undone.{/ts} {ts}Do you want to continue?{/ts}
        </div>
    </div>
  
    <div class="crm-submit-buttons">            
       <a class="button" href="{crmURL p='civicrm/emailCampaign-mapping/add' q="action=force_delete&id=$id&reset=1"}"><span><div class="icon delete-icon"></div>{ts}Delete{/ts}</span></a>        
        <a class="button" href="{crmURL p='civicrm/emailCampaign-mapping' q='reset=1'}"><span>{ts}Cancel{/ts}</span></a>
    </div>    
    
{/if}


