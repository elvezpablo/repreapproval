<?php include("config.php");
 include('head.php');
 include('header.php');
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE main_menu SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:menu.php?msg=updated");
	}	
}
 
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE main_menu SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:menu.php?msg=updated");
	}	
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
	$insert_pages=mysql_query("INSERT INTO main_menu set menu='".addslashes($_REQUEST['menu'])."',`link`='".addslashes($_REQUEST['url'])."'");
		if($insert_pages)
		{
			header("LOCATION:menu.php?msg=Added");
		}
		else
		{
			echo "ERROR";
		}
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{
	$update=mysql_query("UPDATE main_menu set menu='".addslashes($_REQUEST['menu'])."',`link`='".addslashes($_REQUEST['url'])."' WHERE id='".$_REQUEST['edit_id']."'");
	if($update)
	{
		header("LOCATION:menu.php?msg=updated");
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
                   <h3 class="page-title">
                     Manage Menu
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="dashboard.php">Dashboard</a>
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
                             <h4><i class="icon-reorder"></i> Add Menu</h4>
                            
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                           
                        </div>
                        <div class="widget-body">
                            <form action="" class="form-horizontal" method="post">
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Menu" class="input-xlarge" name="menu" id="menu" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Page URL</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Page name" name="url" id="url" class="input-xlarge" value="" />
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='menu.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div></div>
                            <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
								 $select_edit=mysql_query("SELECT * FROM main_menu WHERE id='".$_REQUEST['edit_id']."'");
	  $data_edit=mysql_fetch_object($select_edit);
								?><div class="span6">
                                	<div class="widget purple">
                            <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Edit Menu</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                            <div class="widget-body">
                            <form action="" class="form-horizontal" method="post">
                             <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"  class="span12" placeholder="Name" />
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Menu" class="input-xlarge" name="menu" id="menu" value="<?php echo stripslashes($data_edit->menu); ?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Page URL</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Page name" name="url" id="url" class="input-xlarge" value="<?php echo stripslashes($data_edit->link);?>" />
                                    </div>
                                </div>
                               
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='menu.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                                </div>
                            <?php } else {
								$list_pages=mysql_query("SELECT * FROM main_menu order by order_id");
                                 $count=mysql_num_rows($list_pages);
								?>
                            <!-- END FORM--><div class="btn-group">
                                         <button  onClick="window.location='menu.php?action=add';" class="btn green" id="editable-sample_new">
                                             Add New <i class="icon-plus"></i>
                                         </button>
                                     </div>
                                     <p></p>
                                     <div class="widget red">
                                      <input type="hidden" name="tablename" id="tablename" value="main_menu"/>
                            <div class="widget-title">
                            
                            <h4><i class="icon-reorder"></i> Menu List</h4>
                            
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
                                <th style="width:8px;">ID</th>
                                <th>Menu</th>
                                <th class="hidden-phone">Page Name</th>
                                <th class="hidden-phone">Current Status</th>
                                <th class="hidden-phone">Edit</th>
                                <th class="hidden-phone">Delete</th>
                                
                            </tr>
                            </thead>
                            <div id="response" style="display:none"></div>
                           <tbody class="sortable">
                            <?php $ijij=1; 
while($data=mysql_fetch_object($list_pages))
{
 ?>
                            <tr class="odd gradeX widget" id="arrayorder_<?php echo $data->id; ?>">
                                <td><?php echo $ijij ?></td>
                                <td><?php echo stripslashes($data->menu);?></td>
                                <td class="hidden-phone"><?php echo stripslashes($data->link);?></td>
                                
                                <?php if($data->status==1)
		 {
			?><td class="hidden-phone">
			<a class="btn btn-small btn-success" href="menu.php?action=update_green&upd_id=<?php echo $data->id?>">Active</a></td><?php
		 }
		else
		 {
			?><td class="hidden-phone" >
			<a class="btn btn-small btn-danger" href="menu.php?action=update_red&update_id=<?php echo $data->id?>">Deactive</a></td><?php
		 }?>
    
                                <td class="hidden-phone"><a class="btn btn-small btn-primary" href="menu.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i>&nbsp;Edit</a></td>
                                <td class="hidden-phone"><a href="javascript:;" class="btn btn-small btn-danger dell" id="<?php echo $data->id; ?>"><i class="icon-remove icon-white"></i>&nbsp;Delete</a></td>
                            </tr>
                              <?php
	$ijij++;
 }
 
 ?>
                            </tbody>
                            <?php } else {?>
                            <tbody>
                            <tr class="odd gradeX">
                                <td>No Record Found</td>
                                <td></td>
                                <td></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                            </tr>
                            
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
	 
  $.ajax({
         type:"POST",
   data:{DelId:DelId},
   url:'delete-menu.php',  
   success:function(msg){
   if(msg==10)
   {
   //apprise("Delated Succesfully")
   location.reload();
   }
   }
   });}
   else
   {
    return false;
   }
  })});
	
	});
</script>