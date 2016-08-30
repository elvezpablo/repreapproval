<?php
include("../includes/config.php");
 include('head.php');
 include("FCKeditor/fckeditor.php");
 include('header.php');
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE home_slider SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:home-slider.php?msg=updated");
	}	
}

 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE home_slider SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:home-slider.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	//echo "delete from faq where where id='".$_REQUEST['dlt_id']."'";die;
	$delete=mysql_query("delete from home_slider  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:home-slider.php?msg=deleted");
	}	
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
	if(!empty($_FILES['backimg']['name']))
	{
		$backimg=$_FILES['backimg']['name'];
		move_uploaded_file($_FILES['backimg']['tmp_name'],"../userfiles/".$_FILES['backimg']['name']);
	}
	else {$backimg='';}
	if(!empty($_FILES['thumbnail_1']['name']))
	{
		$thumbnail_1=$_FILES['thumbnail_1']['name'];
		move_uploaded_file($_FILES['thumbnail_1']['tmp_name'],"../userfiles/".$_FILES['thumbnail_1']['name']);
	}
	else {$thumbnail_1='';}

	if(!empty($_FILES['thumbnail_2']['name']))
	{
		$thumbnail_2=$_FILES['thumbnail_2']['name'];
		move_uploaded_file($_FILES['thumbnail_2']['tmp_name'],"../userfiles/".$_FILES['thumbnail_2']['name']);
	}
	else {$thumbnail_2='';}
	
	if(!empty($_FILES['thumbnail_3']['name']))
	{
		$thumbnail_3=$_FILES['thumbnail_3']['name'];
		move_uploaded_file($_FILES['thumbnail_3']['tmp_name'],"../userfiles/".$_FILES['thumbnail_3']['name']);
	}
	else {$thumbnail_3='';}
	$insert_pages=mysql_query("INSERT INTO home_slider set title='".addslashes($_REQUEST['text1'])."',subtitle='".addslashes($_REQUEST['text2'])."',background_img='".$backimg."',thumbnail1='".$thumbnail_1."',thumbnail2='".$thumbnail_2."',thumbnail3='".$thumbnail_3."'");
		if($insert_pages)
		{
			header("LOCATION:home-slider.php?msg=Added");
		}
		
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{
	if(!empty($_FILES['backimg']['name']))
	{
		$backimg=$_FILES['backimg']['name'];
		move_uploaded_file($_FILES['backimg']['tmp_name'],"../userfiles/".$_FILES['backimg']['name']);
	}
	else {$backimg=$_REQUEST['hid_backimg'];}

	if(!empty($_FILES['thumbnail_1']['name']))
	{
		$thumbnail_1=$_FILES['thumbnail_1']['name'];
		move_uploaded_file($_FILES['thumbnail_1']['tmp_name'],"../userfiles/".$_FILES['thumbnail_1']['name']);
	}
	else {$thumbnail_1=$_REQUEST['hid_thumbnail_1'];}
	if(!empty($_FILES['thumbnail_2']['name']))
	{
		$thumbnail_2=$_FILES['thumbnail_2']['name'];
		move_uploaded_file($_FILES['thumbnail_2']['tmp_name'],"../userfiles/".$_FILES['thumbnail_2']['name']);
	}
	else {$thumbnail_2=$_REQUEST['hid_thumbnail_2'];}
	
	if(!empty($_FILES['thumbnail_3']['name']))
	{
		$thumbnail_3=$_FILES['thumbnail_3']['name'];
		move_uploaded_file($_FILES['thumbnail_3']['tmp_name'],"../userfiles/".$_FILES['thumbnail_3']['name']);
	}
	else {$thumbnail_3=$_REQUEST['hid_thumbnail_3'];}
	$insert_pages=mysql_query("update home_slider set title='".addslashes($_REQUEST['text1'])."',subtitle='".addslashes($_REQUEST['text2'])."',background_img='".$backimg."',thumbnail1='".$thumbnail_1."',thumbnail2='".$thumbnail_2."',thumbnail3='".$thumbnail_3."' where id='".$_REQUEST['edit_id']."'");
		if($insert_pages)
		{
			header("LOCATION:home-slider.php?msg=updated");
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
                     Manage Home slider
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
                         Slider
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
                                    <label class="control-label">Slider Title</label>
                                    <div class="controls">
                                        <textarea required name="text1" id="text1" class="input-xxlarge" value="" placeholder="Text"  ></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Slider Subtitle</label>
                                    <div class="controls">
                                        <textarea required name="text2" id="text2" class="input-xxlarge" value="" placeholder="Text"/></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Background Image</label>
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="icon-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                               <span class="btn btn-file">
                                               <span class="fileupload-new">Select file</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="backimg" id="backimg">
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">First Thumbnail</label>
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="icon-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                               <span class="btn btn-file">
                                               <span class="fileupload-new">Select file</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="thumbnail_1" id="thumbnail_1">
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Second Thumbnail</label>
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="icon-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                               <span class="btn btn-file">
                                               <span class="fileupload-new">Select file</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="thumbnail_2" id="thumbnail_2">
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Third Thumbnail</label>
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="icon-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                               <span class="btn btn-file">
                                               <span class="fileupload-new">Select file</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="thumbnail_3" id="thumbnail_3">
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                             <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                             <button type="button" class="btn" onClick="window.location='home-slider.php';"><i class=" icon-remove"></i>Cancel</button>                                </div>
                            </form>
                            </div></div>
                            <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
								 $select_edit=mysql_query("SELECT * FROM home_slider WHERE id='".$_REQUEST['edit_id']."'");
	  $data_edit=mysql_fetch_assoc($select_edit);
								?>
                                	<div class="widget purple">
                            <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Edit Menu</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                            <div class="widget-body">
                            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label">Slider Title</label>
                                    <div class="controls">
                                        <textarea placeholder="Text" required name="text1" id="text1" class="input-xxlarge" ><?php echo stripslashes($data_edit['title']); ?></textarea></div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Slider Subtitle</label>
                                    <div class="controls">
                                        <textarea placeholder="Text" required name="text2" id="text2" class="input-xxlarge"  ><?php echo stripslashes($data_edit['subtitle']); ?></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Background Image</label>
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="icon-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                               <span class="btn btn-file">
                                               <span class="fileupload-new">Select file</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="backimg" id="backimg">
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                             <img src="../userfiles/<?php echo $data_edit['background_img']; ?>" width="150" height="100"/>
                                        </div>
                                        <input type="hidden" name="hid_backimg" value="<?php echo  $data_edit['background_img']; ?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">First Thumbnail</label>
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="icon-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                               <span class="btn btn-file">
                                               <span class="fileupload-new">Select file</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="thumbnail_1" id="thumbnail_1">
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                             <img src="../userfiles/<?php echo $data_edit['thumbnail1']; ?>"  width="150" height="100"/>
                                        </div>
                                        <input type="hidden" name="hid_thumbnail_1" value="<?php echo  $data_edit['thumbnail1']; ?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Second Thumbnail</label>
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="icon-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                               <span class="btn btn-file">
                                               <span class="fileupload-new">Select file</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="thumbnail_2" id="thumbnail_2">
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                             <img src="../userfiles/<?php echo $data_edit['thumbnail2']; ?>" width="150" height="100"/>
                                        </div>
                                        <input type="hidden" name="hid_thumbnail_2" value="<?php echo  $data_edit['thumbnail2']; ?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Third Thumbnail</label>
                                    <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="icon-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                               <span class="btn btn-file">
                                               <span class="fileupload-new">Select file</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="thumbnail_3" id="thumbnail_3">
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                             <img src="../userfiles/<?php echo $data_edit['thumbnail3']; ?>" width="150" height="100"/>
                                        </div>
                                       <input type="hidden" name="hid_thumbnail_3" value="<?php echo  $data_edit['thumbnail3']; ?>"/>
                                    </div>
                                </div>
                                <div class="form-actions">
                           <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
                            <button type="button" class="btn" onClick="window.location='home-slider.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                            <?php } else {
								$list_pages=mysql_query("SELECT * FROM home_slider order by order_id");
                                 $count=mysql_num_rows($list_pages);
								?>
                            <!-- END FORM--><div class="btn-group">
                                         <button  onClick="window.location='home-slider.php?action=add';" class="btn green" id="editable-sample_new">
                                             Add New <i class="icon-plus"></i>
                                         </button>
                                     </div>
                                     <p></p>
                                     <div class="widget red">
                                       <input type="hidden" name="tablename" id="tablename" value="home_slider"/>
                            <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Sliders</h4>
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
                                <th width="">Title</th>
                                <th width="">Sub Title</th>
                                <th width="">Backgrount Image</th>
                              <th class="hidden-phone" width="100px">Status</th>
                                <th class="hidden-phone" width="100px">Edit</th>
                                <th class="hidden-phone" width="100px">Delete</th>
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
                                <td><?php echo stripslashes($data->title);?></td>
                                 <td><?php echo stripslashes($data->subtitle);?></td>
                                  <td><img src="../userfiles/<?php echo$data->background_img; ?>" width="100" height="100" /></td>
                                <?php if($data->status==1)
		 {
			?><td class="hidden-phone">
			<a class="btn btn-small btn-success" href="home-slider.php?action=update_green&upd_id=<?php echo $data->id?>">Active</a></td><?php
		 }
		else
		 {
			?><td class="hidden-phone" >
			<a class="btn btn-small btn-danger" href="home-slider.php?action=update_red&update_id=<?php echo $data->id?>">Deactive</a></td><?php
		 }?>
    
                                <td class="hidden-phone"><a class="btn btn-small btn-primary" href="home-slider.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
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
	  window.location.href='home-slider.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
	});
</script>