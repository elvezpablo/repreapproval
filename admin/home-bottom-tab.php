<?php include("config.php");
include('head.php');
include("FCKeditor/fckeditor.php");
include('header.php');
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE  home_bottom_tab SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:home-bottom-tab.php?msg=updated");
	}	
}
 
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE  home_bottom_tab SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:home-bottom-tab.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	$delete=mysql_query("delete from  home_bottom_tab  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:home-bottom-tab.php?msg=deleted");
	}	
}


if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
	$insert_pages=mysql_query("INSERT INTO  home_bottom_tab set title='".addslashes($_REQUEST['title'])."',content='".addslashes($_REQUEST['content'])."',tab='".addslashes($_REQUEST['tab'])."'");
		if($insert_pages)
		{
			header("LOCATION:home-bottom-tab.php?msg=Added");
		}
		else
		{
			echo "ERROR";
		}
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{
$insert_pages=mysql_query("update  home_bottom_tab set title='".addslashes($_REQUEST['edittitle'])."',content='".addslashes($_REQUEST['editcontent'])."',tab='".addslashes($_REQUEST['edittab'])."' where id='".$_REQUEST['edit_id']."'");
		if($insert_pages)
		{
			header("LOCATION:home-bottom-tab.php?msg=updated");
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
                     Manage Home Bottom Content
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="dashboard.php">Dashboard</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="javascript:;">Home</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                        <a href="javascript:;"> Bottom</a>
                         <span class="divider">/</span>
                       </li>
                       <li class="active">
                         TAb Content
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
                            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
                            
                            <div class="control-group">
                                    <label class="control-label">Tab Name</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text" required name="tab" id="tab" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text" required name="title" id="title" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Content</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "home-bottom-tab.php"));
$oFCKeditor = new FCKeditor("content");
 $oFCKeditor->BasePath = $sBasePath.'/FCKeditor/';
$oFCKeditor->Value="";
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '400px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='home-bottom-tab.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div></div>
                            <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
								 $select_edit=mysql_query("SELECT * FROM  home_bottom_tab WHERE id='".$_REQUEST['edit_id']."'");
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
                            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
                             <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"  class="span12"  />
                                <div class="control-group">
                                    <label class="control-label">Tab Name</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text" required name="edittab" id="edittab" class="input-xxlarge" value="<?php echo stripslashes($data_edit['tab']); ?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text" required name="edittitle" id="edittitle" class="input-xxlarge" value="<?php echo stripslashes($data_edit['title']); ?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                 
                                                                    <label class="control-label">Description</label>
                                    <div class="controls">
                              <?php
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "home-bottom-tab.php"));
$oFCKeditor = new FCKeditor("editcontent");
 $oFCKeditor->BasePath = $sBasePath.'/FCKeditor/';
$oFCKeditor->Value=stripslashes($data_edit['content']);
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '400px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                               
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='home-bottom-tab.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                                
                            <?php } else {
								
								$list_pages=mysql_query("SELECT * FROM  home_bottom_tab order by order_id");
                                 $count=mysql_num_rows($list_pages);
								?>
                            <!-- END FORM--><div class="btn-group">
                                         <button  onClick="window.location='home-bottom-tab.php?action=add';" class="btn green" id="editable-sample_new">
                                             Add New <i class="icon-plus"></i>
                                         </button>
                                     </div>
                                     <p></p>
                                     <div class="widget red">
                                      <input type="hidden" name="tablename" id="tablename" value="home_bottom_tab"/>
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
                                <th style="width:8px;">SN</th>
                                 <th class="hidden-phone" >Tab</th>
                                <th width="500px">Title</th>
                               
                              <th class="hidden-phone">Status</th>
                                <th class="hidden-phone">Edit</th>
                                <th class="hidden-phone">Delete</th>
                                
                            </tr>
                              <div id="response" style="display:none"></div>
                            </thead>
                            <tbody class="sortable">
                            <?php $ijij=1; 
while($data=mysql_fetch_object($list_pages))
{
 ?>
                            <tr class="odd gradeX widget" id="arrayorder_<?php echo $data->id; ?>">
                                <td><?php echo $ijij ?></td>
                                <td><?php echo stripslashes($data->tab);?></td>
                                <td><?php echo stripslashes($data->title);?></td>
                                 
                                <?php if($data->status==1)
		 {
			?><td class="hidden-phone">
			<a class="btn btn-small btn-success" href="home-bottom-tab.php?action=update_green&upd_id=<?php echo $data->id?>">Active</a></td><?php
		 }
		else
		 {
			?><td class="hidden-phone" >
			<a class="btn btn-small btn-danger" href="home-bottom-tab.php?action=update_red&update_id=<?php echo $data->id?>">Deactive</a></td><?php
		 }?>
    
                                <td class="hidden-phone"><a class="btn btn-small btn-primary" href="home-bottom-tab.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
                                <td class="hidden-phone"><a href="javascript:;" class="btn btn-small btn-danger dell" id="<?php echo $data->id; ?>"><i class="icon-remove icon-white"></i> Delete</a></td>
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
	  window.location.href='home-bottom-tab.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
	
	});
</script>