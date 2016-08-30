<?php include("config.php");
include('head.php');
include("FCKeditor/fckeditor.php");
include('header.php');
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE  new_page SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:new-pages.php?msg=updated");
	}	
}
 
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE  new_page SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:new-pages.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	$pageNameDel=mysql_fetch_assoc(mysql_query("select pagename from new_page where id='".$_REQUEST['dlt_id']."'"));
	unlink('../'.$pageNameDel['pagename']);
	$delete=mysql_query("delete from  new_page  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:new-pages.php?msg=deleted");
	}	
}


if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
	$check=mysql_fetch_assoc(mysql_query("select * from new_page where pagename='".$_REQUEST['pagename']."'"));
	if($check >0)
	{
		header("location:new-pages.php?msg=exist");
	}
	else
	{
	function clean_url($text)
	{
		$text=strtolower($text);
		$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
		$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','');
		$text = str_replace($code_entities_match, $code_entities_replace, $text);
		return $text;
	}
	  $page= str_replace(" ", "_",$_REQUEST['pagename']);
	  $pagename= clean_url($page); 
	  $pgname=$pagename.".php";
      $sel1 = mysql_query("select * from new_page where pagename='".$pgname."'"); 
	  $numrow1 = mysql_num_rows($sel1);
	  if($numrow1==0)
			{
				copy("../create_pages.php","../$pgname");
			}
			
		
	 $insert_sql=mysql_query("insert into new_page set pagename='".$pgname."',metatitle ='".addslashes($_REQUEST['metatitle'])."',metakeyword='".addslashes($_REQUEST['metakeyword'])."',metadescription ='".addslashes($_REQUEST['metadescription'])."',pagetitle='".addslashes($_REQUEST['pagetitle'])."',leftcontent='".addslashes($_REQUEST['leftcontent'])."', rightcontent='".addslashes($_REQUEST['rightcontent'])."'"); 
       if($insert_sql)
		   {
			   header("location:new-pages.php?msg=Added");
		   } 
}}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{
$insert_pages=mysql_query("update  new_page set metatitle='".addslashes($_REQUEST['metatitle'])."',metakeyword='".addslashes($_REQUEST['metakeyword'])."',metadescription='".addslashes($_REQUEST['metadescription'])."',pagetitle='".addslashes($_REQUEST['pagetitle'])."',leftcontent='".addslashes($_REQUEST['leftcontent'])."',rightcontent='".addslashes($_REQUEST['rightcontent'])."' where id='".$_REQUEST['edit_id']."'");
		if($insert_pages)
		{
			header("LOCATION:new-pages.php?msg=updated");
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
                            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data" id="myform">
                            
                            <div class="control-group">
                                    <label class="control-label">Page Name</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Page Name" required name="pagename"  class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Meta Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Meta Title" required name="metatitle" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Meta Keyword</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Meta Keyword" required name="metakeyword" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Description</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Meta Description" required name="metadescription" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Page Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Page Title" required name="pagetitle" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Left Content</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "new-pages.php"));
$oFCKeditor = new FCKeditor("leftcontent");
 $oFCKeditor->BasePath = $sBasePath.'/FCKeditor/';
$oFCKeditor->Value="";
$oFCKeditor->Width  = '800px' ;
$oFCKeditor->Height = '500px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                                <input type="hidden" name="tester" id="testeradd" value="" />
                                <div class="control-group">
                                    <label class="control-label">Right Content</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "new-pages.php"));
$oFCKeditor = new FCKeditor("rightcontent");
 $oFCKeditor->BasePath = $sBasePath.'/FCKeditor/';
$oFCKeditor->Value="";
$oFCKeditor->Width  = '800px' ;
$oFCKeditor->Height = '500px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                                 <input type="hidden" name="tester1" id="testeradd1" value="" />
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                                    
                                    <button type="button" class="btn preview_add" >Preview</button>
                                    
                                    <button type="button" class="btn" onClick="window.location='new-pages.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div></div>
                            <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
								 $select_edit=mysql_query("SELECT * FROM  new_page WHERE id='".$_REQUEST['edit_id']."'");
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
                            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data" id="myform">
                             <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"  class="span12"  />
                                <div class="control-group">
                                    <label class="control-label">Meta Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text" required name="metatitle" class="input-xxlarge" value="<?php echo stripslashes($data_edit['metatitle']);?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Meta Keyword</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text" required name="metakeyword" class="input-xxlarge" value="<?php echo stripslashes($data_edit['metakeyword']);?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Description</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text" required name="metadescription" class="input-xxlarge" value="<?php echo stripslashes($data_edit['metadescription']);?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Page Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text" required name="pagetitle" class="input-xxlarge" value="<?php echo stripslashes($data_edit['pagetitle']);?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Left Content</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "new-pages.php"));
$oFCKeditor = new FCKeditor("leftcontent");
 $oFCKeditor->BasePath = $sBasePath.'/FCKeditor/';
$oFCKeditor->Value= stripslashes($data_edit['leftcontent']);
$oFCKeditor->Width  = '600px' ;
$oFCKeditor->Height = '400px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                                  <input type="hidden" name="tester" id="testeradd" value="" />
                                <div class="control-group">
                                    <label class="control-label">Right Content</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "new-pages.php"));
$oFCKeditor = new FCKeditor("rightcontent");
 $oFCKeditor->BasePath = $sBasePath.'/FCKeditor/';
$oFCKeditor->Value=stripslashes($data_edit['rightcontent']);
$oFCKeditor->Width  = '600px' ;
$oFCKeditor->Height = '400px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                                  <input type="hidden" name="tester1" id="testeradd1" value="" />
                                <div class="form-actions">
          <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
          
           <button type="button" class="btn preview_add" >Preview</button>
                                    <button type="button" class="btn" onClick="window.location='new-pages.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                                
                            <?php } else {
								
								$list_pages=mysql_query("SELECT * FROM  new_page order by id");
                                 $count=mysql_num_rows($list_pages);
								?>
                            <!-- END FORM--><div class="btn-group">
                                         <button  onClick="window.location='new-pages.php?action=add';" class="btn green" id="editable-sample_new">
                                             Add New <i class="icon-plus"></i>
                                         </button>
                                     </div>
                                     <p></p>
                                     <div class="widget red">
                                      <input type="hidden" name="tablename" id="tablename" value="new_page"/>
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
                                 <th class="hidden-phone" >Page Name</th>
                                <th class="hidden-phone">Page Title</th>
                               <th class="hidden-phone">URL</th>
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
                                <td><?php echo stripslashes($data->pagename);?></td>
                                <td><?php echo stripslashes($data->pagetitle);?></td>
                                <td><a href="http://localhost/hensleysauto/<?php echo stripslashes($data->pagename);?>" target="_blank">Go to</a></td>
                                 
                                <?php if($data->status==1)
		 {
			?><td class="hidden-phone">
			<a class="btn btn-small btn-success" href="new-pages.php?action=update_green&upd_id=<?php echo $data->id?>">Active</a></td><?php
		 }
		else
		 {
			?><td class="hidden-phone" >
			<a class="btn btn-small btn-danger" href="new-pages.php?action=update_red&update_id=<?php echo $data->id?>">Deactive</a></td><?php
		 }?>
    
                                <td class="hidden-phone"><a class="btn btn-small btn-primary" href="new-pages.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
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
	  window.location.href='new-pages.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
	
	
	
	$(".preview_add").click(function(){

var inst = FCKeditorAPI.GetInstance("leftcontent");
var right = FCKeditorAPI.GetInstance("rightcontent");
var sValue = inst.GetHTML();
var rValue = right.GetHTML();
$('#testeradd').val(sValue);
$('#testeradd1').val(rValue);
	var ajax_data = $("#myform").serialize();
		 $.ajax({
			 type:"POST",
			 url:"ajax_previewadd.php",
			 data:ajax_data,
			 success:function(html){
				 if(html==50)
					 {
						window.open('../previewlink.php', '', 'height=800,width=800,scrollbars=yes');
					 }
					 else
					 {
					 }
			 }
		 });
	});
	
	});
</script>