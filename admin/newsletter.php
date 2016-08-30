<?php
include("../includes/config.php");
include('head.php');
include("FCKeditor/fckeditor.php");
include('header.php');
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE signup SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:newsletter.php?msg=updated");
	}	
}
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE signup SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:newsletter.php?msg=updated");
	}	
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	$delete=mysql_query("delete from signup  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:newsletter.php?msg=deleted");
	}	
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{}
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
                   <h3 class="page-title">
                  Newsletter Signup
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="dashboard.php">Dashboard</a>
                           <span class="divider">/</span>
                       </li>
                        <li>
                           <a href="#"> Manage Newsletter</a>
                           <span class="divider">/</span>
                       </li>
                         <li>
                           <a href="#"> Newsletter Signup</a>
                           <span class="divider">/</span>
                       </li>
                   </ul>
                   <!-- END PAGE TITLE & BREADCRUMB-->
                    <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                            <!-- BEGIN FORM-->
                            <?php if(isset($_REQUEST['action']) and $_REQUEST['action']=='add') {?><div class="widget green">
                            <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Add</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Title " required name="title" id="title" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Content</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "newsletter.php"));
$oFCKeditor = new FCKeditor("content");
 $oFCKeditor->BasePath = $sBasePath.'FCKeditor/';
$oFCKeditor->Value="";
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '400px' ;
//$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                                <div class="form-actions">
                             <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                             <button type="button" class="btn" onClick="window.location='newsletter.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div></div>
                            <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
								 $select_edit=mysql_query("SELECT * FROM signup WHERE id='".$_REQUEST['edit_id']."'");
	  $data_edit=mysql_fetch_assoc($select_edit);
								?>
                                	<div class="widget purple">
                            <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Edit</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                            <div class="widget-body">
                            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                             <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"  class="span12"  />
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Title " required name="edittitle" id="edittitle" class="input-xxlarge" value="<?php echo stripslashes($data_edit['name']); ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                <label class="control-label">Content</label>
                                    <div class="controls">
                                        <?php
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "newsletter.php"));
$oFCKeditor = new FCKeditor("editcontent");
 $oFCKeditor->BasePath = $sBasePath.'FCKeditor/';
$oFCKeditor->Value=stripslashes($data_edit['content']);
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '400px' ;
//$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                                <div class="form-actions">
                          <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
                          <button type="button" class="btn" onClick="window.location='newsletter.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                            <?php } else {
								//echo "SELECT * FROM news_letter order by order_id";die;
								$list_pages=mysql_query("SELECT * FROM news_letter order by order_id");
                                 $count=mysql_num_rows($list_pages);
								?>
                            <!-- END FORM--><!--<div class="btn-group">
                                         <button  onClick="window.location='newsletter.php?action=add';" class="btn green" id="editable-sample_new">
                                             Add New <i class="icon-plus"></i>
                                         </button>
                                     </div>-->
                                     <p></p>
                                     <div class="widget red">
                                      <input type="hidden" name="tablename" id="tablename" value="news_Letter"/>
                            <div class="widget-title">
                            <h4><i class="icon-reorder"></i> List</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                           <?php if(isset($_REQUEST['msg']) and $_REQUEST['msg']=='Updated') {?> <span class="tools"> Updated Successfully <?php }
						   ?>
                           </span>
                        </div>
                      		     <div class="widget-body" id="draggable_portlets">
                        <table class="table table-striped table-bordered" id="sample_1"> 
                            <thead> 
							<?php if($count>0) {?>
                            <tr>
                              <th width="5%" >ID</th>
                              <th width="10%">
                              <input type="checkbox" name="select" id="selectall" align="middle"/>&nbsp;Select All</th>
                              <th width="25%">Name</th>
                              <th width="35%">Email</th>
                              <th width="10%">Status</th>
                              <th width="10%">Delete</th>
                            </tr>
                            </thead>
                            <div id="response" style="display:none"></div>
                           <tbody class="sortable">
                            <?php $ijij=1; 
while($data=mysql_fetch_object($list_pages))
{
 ?>                           <tr class="odd gradeX widget" id="arrayorder_<?php echo $data->id; ?>">
                                <td><?php echo $ijij ?></td>
                              <td><input type="checkbox" name="case" id="case" class="case" value="<?php echo  $data->email;?>"></td>
                               <td><?php echo stripslashes($data->name);?></td>
                               <td><?php echo stripslashes($data->email);?></td>
                                   <?php if($data->status==1)
		 {			?><td class="hidden-phone">
			<a class="btn btn-small btn-danger" href="javascript::">Unsubscribed</a></td><?php
		 }
		else
		 {
			?><td class="hidden-phone" >
			<a class="btn btn-small  btn-success" href="javascript::">Subscribed</a></td><?php
		 }?>
                   <td class="hidden-phone"><a href="javascript:;" class="btn btn-small btn-danger dell" id="<?php echo $data->id; ?>"><i class="icon-remove icon-white"></i> Delete</a></td>
                            </tr>
                              <?php	$ijij++; } ?>
                             <input type="button" id="sendmail" value="Send Mail" align="middle"/>
                            </tbody>
                            <?php } ?>
                        </table>
                        </div></div>
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
	  window.location.href='newsletter.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
	});
</script>
<SCRIPT language="javascript">
$(function(){
// add multiple select / deselect functionality
$("#selectall").click(function () {
$('.case').attr('checked', this.checked);
});
// if all checkbox are selected, check the selectall checkbox
// and viceversa
$(".case").click(function(){
if($(".case").length == $(".case:checked").length) {
$("#selectall").attr("checked", "checked");
} else {
$("#selectall").removeAttr("checked");
}
});
});
$(document).ready(function(){
	 $("#sendmail").live('click',function(){
		 selected= [];
	    $("input:checkbox[name=case]:checked").each(function()
		  {
           selected.push($(this).val());
          });
		if(selected.length==0)
		  {
			apprise("You have not selected any item", {'verify': true, 'animate': true, 'textYes': 'Yes', 'textNo': 'No' })
			return false;
		  }
		else
		  {
		apprise("Are you sure you want to Send selected email?", {'verify': true, 'animate': true, 'textYes': 'Yes', 'textNo': 'No' },
    function (r) {
  if (r) {
	  $.ajax({
		     type: "post",
		     data:{daa:selected},
		     url:"send_mail.php",
		     dataType: 'html',
		     success:function(data)
		      {
			   //alert(data);
		      }
		     });
	  }
   else
   {
    return false;
   }
  })
		   }
   });
})
</SCRIPT>