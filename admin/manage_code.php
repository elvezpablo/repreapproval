<?php include("config.php");
include('head.php');
include("FCKeditor/fckeditor.php");
include('header.php');
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE  code SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:manage_code.php?msg=updated");
	}	
}
 
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE  code SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:manage_code.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	$delete=mysql_query("delete from  code  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:manage_code.php?msg=deleted");
	}	
}


if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
	if($_REQUEST['yes']=='Yes')
	{
		$applies_to='Y';
	}
	else
	{
		 $applies_to=implode("," , $_REQUEST['yes1']);
	}
	
	 $dina= strtotime($_REQUEST['firstinput']);
	$dinaqwe= strtotime($_REQUEST['secondinput']);
		
	$insert_pages=mysql_query("insert into code set `applies_to`='".$applies_to."',`discount`='".$_REQUEST['off']."',`p_code`='".$_REQUEST['creat_code']."',`start_date`='". $dina."',`end_date`='".$dinaqwe."'");
	
		if($insert_pages)
		{
			header("LOCATION:manage_code.php?msg=Added");
		}
		else
		{
			echo "ERROR";
		}
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{
	if($_REQUEST['yes']=='Yes')
	{
		$applies_to='Y';
	}
	else
	{
		 $applies_to=implode("," , $_REQUEST['yes1']);
	}
	
	 $dina= strtotime($_REQUEST['firstinput']);
	$dinaqwe= strtotime($_REQUEST['secondinput']);
$insert_pages=mysql_query("update  code set `applies_to`='".$applies_to."',`discount`='".$_REQUEST['off']."',`p_code`='".$_REQUEST['creat_code']."',`start_date`='". $dina."',`end_date`='".$dinaqwe."' where id='".$_REQUEST['edit_id']."'");
		if($insert_pages)
		{
			header("LOCATION:manage_code.php?msg=updated");
		}
		else
		{
			echo "ERROR";
		}
}
  ?>
<!-- BEGIN CONTAINER -->

<div id="container" class="row-fluid"> 
  <!-- BEGIN SIDEBAR -->
  <?php include('sidebar-left.php');?>
  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE -->
  <div id="main-content"> 
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid"> 
      <!-- BEGIN PAGE HEADER-->
      <div class="row-fluid">
        <div class="span12"> 
          
          <!-- BEGIN PAGE TITLE & BREADCRUMB-->
          <h3 class="page-title"> Manage Promo Codes</h3>
          <ul class="breadcrumb">
            <li> <a href="dashboard.php">Dashboard</a> </li>
          </ul>
          <!-- END PAGE TITLE & BREADCRUMB--> 
          <!-- BEGIN PAGE CONTENT-->
          <div class="row-fluid">
            <div class="span12"> 
              <!-- BEGIN SAMPLE FORMPORTLET--> 
              
              <!-- BEGIN FORM-->
              <?php if(isset($_REQUEST['action']) and $_REQUEST['action']=='add') {?>
              <div class="widget green">
                <div class="widget-title">
                  <h4><i class="icon-reorder"></i>Add</h4>
                  <span class="tools"> <a href="javascript:;" class="icon-chevron-down"></a> <a href="javascript:;" class="icon-remove"></a> </span> </div>
                <div class="widget-body">
                  <form action="manage_code.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="control-group">
                      <label class="control-label">Create Code Name</label>
                      <div class="controls">
                        <input type="text" placeholder="Create Code " required name="creat_code" id="creat_code" class="input-xxlarge" value=""/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Start Date</label>
                      <div class="controls">
                        <input type="text" name="firstinput"  id="p_st_date" value="" placeholder="Start Date " class="input-xxlarge datepicker" required/>
                        <!--<a href="javascript:showCal('Calendar1')">Select Date</a>--> </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">End Date <i>(will expire after this date)</i>
                    </label>
                      <div class="controls">
                        <input type="text" name="secondinput"  id="p_end_date" value="" placeholder="End Date " class="input-xxlarge datepicker" required/>
                        <!--<a href="javascript:showCal('Calendar2')">Select Date</a>--> </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">% Off <i>(no need to add % sign)</i>:</label>
                      <div class="controls">
                        <input name="off" type="text" id="off" size="45" value="" placeholder="% Off " required class="input-xxlarge"/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Apply to <i>(select an option)</i></label>
                      <div class="controls">
                        <input type="radio" name="yes" value="Yes" onclick="hiii();" checked="checked"/>
                        <strong>All products</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="yes" value="No" onclick="trew();" />
                        <strong>Select specific products or categories</strong> </div>
                      <div class="controls">
                        <div valign="middle" id="select12" style="display:none; margin-left:115px;margin-top:5px;">
                          <select name="yes1[]" id="applies_to" multiple="multiple" style="width:300px">
                            <option value=""> Please Select (multiple selections okay)</option>
                            <option value="silverPlan"> Sliver</option>
                            <option value="goldPlan"> Gold</option>
                            <option value="platinumPlan"> Platinum</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                      <button type="button" class="btn" onClick="window.location='manage_code.php';"><i class=" icon-remove"></i>Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
              <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
					$select_edit=mysql_query("SELECT * FROM  code WHERE id='".$_REQUEST['edit_id']."'");
	  				$data_edit=mysql_fetch_assoc($select_edit);?>
              <div class="widget purple">
                <div class="widget-title">
                  <h4><i class="icon-reorder"></i> Edit</h4>
                  <span class="tools"> <a href="javascript:;" class="icon-chevron-down"></a> <a href="javascript:;" class="icon-remove"></a> </span> </div>
                <div class="widget-body">
                  <form action="manage_code.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"  class="span12"  />
                    <div class="control-group">
                      <label class="control-label">Create Code:</label>
                      <div class="controls">
                        <input type="text" placeholder="Create Code " required name="creat_code" id="creat_code" class="input-xxlarge" value="<?php echo stripslashes($data_edit['p_code']);?>"/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Start Date:</label>
                      <div class="controls">
                        <input type="text" name="firstinput"  id="p_st_date" value="<?php echo date('m/d/Y',$data_edit['start_date']);?>" placeholder="Start Date " class="input-xxlarge datepicker" required/>
                        </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">End Date:</label>
                      <div class="controls">
                        <input type="text" name="secondinput"  id="p_end_date" value="<?php echo date('m/d/Y',$data_edit['end_date']);?>" placeholder="End Date " class="input-xxlarge datepicker" required/>
                        </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">% Off <i>(no need for the % sign)</i>:</label>
                      <div class="controls">
                        <input name="off" type="text" id="off" size="45" value="<?php echo stripslashes($data_edit['discount']);?>" placeholder="% Off " required class="input-xxlarge"/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Applies to <i>(select one option)</i>:</label>
                      <div class="controls">
                        <input type="radio" name="yes" value="Yes" onclick="hiii();" <?php if($data_edit['applies_to']=='Y') {?>checked="checked" <?php }?>/>
                        <strong>All products</strong>
                        <input type="radio" name="yes" value="No" onclick="trew();" <?php if($data_edit['applies_to']!='Y') {?>checked="checked" <?php }?>/>
                        <strong>Select specific products or categories</strong> </div>
                        <?php $arra=array();
						if($data_edit['applies_to']!='Y') {
							$arra=explode(',',$data_edit['applies_to']);
						}
						?>
                      <div class="controls">
                        <div valign="middle" id="select12" style="display:<?php if($data_edit['applies_to']=='Y') {?>none;<?php }?> margin-left:115px;margin-top:5px;">
                          <select name="yes1[]" id="applies_to" multiple="multiple">
                            <option value=""> Please Select</option>
                            <option value="silverPlan" <?php if(in_array('silverPlan',$arra)){?>selected="selected" <?php } ?>> Sliver</option>
                            <option value="goldPlan" <?php if(in_array('goldPlan',$arra)){?>selected="selected" <?php } ?>> Gold</option>
                            <option value="platinumPlan" <?php if(in_array('platinumPlan',$arra)){?>selected="selected" <?php } ?>> Premimum</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-actions">
                      <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
                      <button type="button" class="btn" onClick="window.location='manage_code.php';"><i class=" icon-remove"></i>Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
              <?php } else {
				  $list_pages=mysql_query("SELECT * FROM  code order by order_id");
                  $count=mysql_num_rows($list_pages);?>
              <!-- END FORM-->
              <div class="btn-group">
                <button  onClick="window.location='manage_code.php?action=add';" class="btn green" id="editable-sample_new"> Add New <i class="icon-plus"></i> </button>
              </div>
              <p></p>
              <div class="widget red">
                <input type="hidden" name="tablename" id="tablename" value="code"/>
                <div class="widget-title">
                  <h4><i class="icon-reorder"></i> List</h4>
                  <span class="tools"> <a href="javascript:;" class="icon-chevron-down"></a> <a href="javascript:;" class="icon-remove"></a> </span>
                  <?php if(isset($_REQUEST['msg']) and $_REQUEST['msg']=='Updated') {?>
                  <span class="tools"> Updated Successfully
                  <?php }?>
                  </span> </div>
                <div class="widget-body" id="draggable_portlets">
                  <table class="table table-striped table-bordered" id="sample_1">
                    <thead>
                      <?php if($count>0) {?>
                      <tr>
                        <th style="width:8px;">SN</th>
                        <th width="300px"><span class="text_white">% Off</span></th>
                        <th width="500px"><span class="text_white">Promo Code Name</span></th>
                        <th class="hidden-phone">Status</th>
                        <!--<th class="hidden-phone">Edit</th>-->
                        <th class="hidden-phone">Delete</th>
                      </tr>
                    <div id="response" style="display:none"></div>
                      </thead>
                    <tbody class="sortable">
                      <?php $ijij=1; 
while($data=mysql_fetch_object($list_pages)){?>
                      <tr class="odd gradeX widget" id="arrayorder_<?php echo $data->id; ?>" >
                        <td><?php echo $ijij ?></td>
                        <td><?php echo stripslashes($data->discount);?></td>
                        <td><?php echo stripslashes($data->p_code);?></td>
                        <?php if($data->status==1) {?>
                        <td class="hidden-phone"><a class="btn btn-small btn-success" href="manage_code.php?action=update_green&upd_id=<?php echo $data->id?>">Active</a></td>
                        <?php }else{?>
                        <td class="hidden-phone" ><a class="btn btn-small btn-danger" href="manage_code.php?action=update_red&update_id=<?php echo $data->id?>">Deactive</a></td>
                        <?php }?>
                        <td class="hidden-phone"><a class="btn btn-small btn-primary" href="manage_code.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
                        <td class="hidden-phone"><a href="javascript:;" class="btn btn-small btn-danger dell" id="<?php echo $data->id; ?>"><i class="icon-remove icon-white"></i> Delete</a></td>
                      </tr>
                      <?php	$ijij++;}?>
                    </tbody>
                    <?php } ?>
                  </table>
                </div>
              </div>
              <?php }?>
              
              <!-- END SAMPLE FORM PORTLET--> 
            </div>
          </div>
          <!-- END PAGE CONTENT--> 
          
        </div>
      </div>
      <!-- END PAGE HEADER--> 
    </div>
    <!-- END PAGE CONTAINER--> 
  </div>
  <!-- END PAGE --> 
</div>
<!-- END CONTAINER -->

<?php include('footer.php');?>
<script type="text/javascript">
$(document).ready(function(){
	
$('.dell').live('click',function(){
  var DelId =this.id;
  apprise("Are you sure you want to delete?", {'verify': true, 'animate': true, 'textYes': 'Yes', 'textNo': 'No' },
    function (r) {
  if (r) {
	  window.location.href='manage_code.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
  
  
      var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var checkin = $('#p_st_date').datepicker({
    onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout.setValue(newDate);
    }
    checkin.hide();
    $('#p_end_date')[0].focus();
    }).data('datepicker');
    var checkout = $('#p_end_date').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout.hide();
    }).data('datepicker');
  
	
	//$( "#p_st_date" ).datepicker({ 
//	dateFormat: 'yy-mm-dd',
//    changeMonth: true,
//    minDate: new Date(),
//    maxDate: '+2y',
//    onSelect: function(date){
//        var selectedDate = new Date(date);
//        var msecsInADay = 86400000;
//        var endDate = new Date(selectedDate.getTime() + msecsInADay);
//        $("#p_end_date").datepicker( "option", "minDate", endDate );
//        $("#p_end_date").datepicker( "option", "maxDate", '+2y' );
//    }
//	 });
//	 $("#p_end_date").datepicker({ 
//    dateFormat: 'yy-mm-dd',
//    changeMonth: true});
	
	});
function hiii()
 {
	 $('#select12').hide();
 }
function trew()
 {
	 $('#select12').show();
 }
</script>