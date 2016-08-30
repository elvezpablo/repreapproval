<?php
include("config.php");
include('head.php');
include("FCKeditor/fckeditor.php"); 
include('header.php');
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE  new_page SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:style-two.php?msg=updated");
	}	
}
 
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE  new_page SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:style-two.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	//echo "select pagename from new_page where id='".$_REQUEST['dlt_id']."'";die;
	$pageNameDel=mysql_fetch_assoc(mysql_query("select pagename from new_page where id='".$_REQUEST['dlt_id']."'"));
	unlink('../'.$pageNameDel['pagename']);
	//$deleteSubmenu=mysql_query("delete from  sub_menu  where url='".$pageNameDel['pagename']."'");
	//$selectMainmenu=mysql_query("select id from main_menu where link='".$pageNameDel['pagename']."'");
	$countMenu=mysql_num_rows($selectMainmenu);
	if($countMenu>0)
	{
		$id=mysql_fetch_assoc($selectMainmenu);
		$deleteSubmenu12=mysql_query("delete from  sub_menu  where main_menu_id='".$id['id']."'");
		$deleteSubmenu123=mysql_query("delete from  main_menu  where id='".$id['id']."'");
	}
	$delete=mysql_query("delete from  new_page  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:style-two.php?msg=deleted");
	}	
}


if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
	//print_r($_REQUEST);die;
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
	
	$file = 'http://www.repreapproval.com/'.$pgname;
	  $file_headers = @get_headers($file);
	  
      if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
      $exists = '12345';
                       }
        else {
       		 $exists = '123';	
          }
	
	 if($numrow1==0 and $exists=='12345')
	{
	
	if(isset($_REQUEST['defaultColm']))
	{
		$RightCont='';
	}
	else
	{
		$RightCont=$_REQUEST['rightcontent'];
	}
	
		  	 $insert_sql=mysql_query("insert into new_page set pagename='".$pgname."',metatitle ='".addslashes($_REQUEST['metatitle'])."',metakeyword='".addslashes($_REQUEST['metakeyword'])."',metadescription ='".addslashes($_REQUEST['metadescription'])."',pagetitle='".addslashes($_REQUEST['pagetitle'])."',pagesubtitle='".$_REQUEST['pagesubtitle']."', rightcontent='".addslashes($RightCont)."', content='".addslashes($_REQUEST['content'])."',url='".addslashes($_REQUEST['url'])."',smallcontent='".$_REQUEST['urltext']."'"); 
			 copy("../create_pages.php","../$pgname");
       if($insert_sql)
		   {
			   header("location:style-two.php?msg=Added");
		   
}
	 }
	  else {
				 header("location:style-two.php?msg=Already");
				}
			
		
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{
	if(isset($_REQUEST['defaultColm']))
	{
		$RightCont='';
	}
	else
	{
		$RightCont=$_REQUEST['rightcontent'];
	}
$insert_pages=mysql_query("update  new_page set metatitle='".addslashes($_REQUEST['metatitle'])."',metakeyword='".addslashes($_REQUEST['metakeyword'])."',metadescription='".addslashes($_REQUEST['metadescription'])."',pagetitle='".addslashes($_REQUEST['pagetitle'])."',rightcontent='".addslashes($RightCont)."',content='".addslashes($_REQUEST['content'])."',pagesubtitle='".$_REQUEST['pagesubtitle']."',url='".addslashes($_REQUEST['url'])."',smallcontent='".$_REQUEST['urltext']."' where id='".$_REQUEST['edit_id']."'");
		if($insert_pages)
		{
			header("LOCATION:style-two.php?msg=updated");
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
                     Manage Style Two Pages <i>(using a two-column layout)</i>
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="dashboard.php">Dashboard</a>
                     
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
                            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" >
                            
                            <div class="control-group">
                                    <label class="control-label">Page Name</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Page Name" required name="pagename" id="pagename"  class="input-xxlarge" value="" />
                                        <input type="hidden" name="hiddenImage" id="hiddenImage" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Meta Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Meta Title" id="metatitle"  name="metatitle" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Meta Keywords</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Meta Keyword" id="metakeyword"  name="metakeyword" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Description</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Meta Description" id="metadescription"  name="metadescription" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Page Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Page Title" id="pagetitle"  name="pagetitle" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">
                                      Page Sub Title
                                    </label>
                                    <div class="controls">
                                 <input type="text" placeholder="Page Sub Title" id="pagesubtitle"   name="pagesubtitle" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                  <div class="control-group">
                                    <label class="control-label">
                                      Action
                                    </label>
                                    <div class="controls">
                                 <input type="text" placeholder="URL" id="url"   name="url" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">
                                      Url Text
                                    </label>
                                    <div class="controls">
                                 <input type="text" placeholder="Url Text" id="urltext"   name="urltext" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                  <div class="control-group" >
                                    <label class="control-label"> Content</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "style-two.php"));
$oFCKeditor = new FCKeditor("content");
 $oFCKeditor->BasePath = $sBasePath.'FCKeditor/';
$oFCKeditor->Value="";
$oFCKeditor->Width  = '800px' ;
$oFCKeditor->Height = '500px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                                 <input type="hidden" name="tester2" id="testeradd2" value="" />
                                 <div class="control-group">
                                    <label class="control-label">
                                      Default Right Column
                                    </label>
                                    <div class="controls">
                                 <input type="checkbox"  id="defaultColm"   name="defaultColm" class="input-xxlarge" value="yes" />
                                    </div>
                                </div>
                                
                                 <div class="control-group" id="rightCol">
                                    <label class="control-label">Right Content</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "style-two.php"));
$oFCKeditor = new FCKeditor("rightcontent");
 $oFCKeditor->BasePath = $sBasePath.'FCKeditor/';
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
                                    
                                    <button type="button" class="btn" onClick="window.location='style-two.php';"><i class=" icon-remove"></i>Cancel</button>
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
                            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" id="myform123">
                             <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"  class="span12"  />
                                <div class="control-group">
                                    <label class="control-label">Meta Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text"   id="metatitle"name="metatitle" class="input-xxlarge" value="<?php echo stripslashes($data_edit['metatitle']);?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Meta Keywords</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Meta Keywords"  name="metakeyword"  id="metakeyword" class="input-xxlarge" value="<?php echo stripslashes($data_edit['metakeyword']);?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Description</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Meta Description"  name="metadescription" id="metadescription"  class="input-xxlarge" value="<?php echo stripslashes($data_edit['metadescription']);?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Page Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Page Title"  name="pagetitle"  id="pagetitle" class="input-xxlarge" value="<?php echo stripslashes($data_edit['pagetitle']);?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">
                                      Sub Title
                                    </label>
                                    <div class="controls">
                                        <input type="text" placeholder="Sub Title"  name="pagesubtitle"  id="pagesubtitle"class="input-xxlarge" value="<?php echo stripslashes($data_edit['pagesubtitle']);?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">
                                      Action
                                    </label>
                                    <div class="controls">
                                 <input type="text" placeholder="URL" id="url"   name="url" class="input-xxlarge" value="<?php echo stripslashes($data_edit['url']);?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">
                                      Url Text
                                    </label>
                                    <div class="controls">
                                 <input type="text" placeholder="Url Text" id="urltext"   name="urltext" class="input-xxlarge" value="<?php echo stripslashes($data_edit['smallcontent']);?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Content</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "style-two.php"));
$oFCKeditor = new FCKeditor("content");
 $oFCKeditor->BasePath = $sBasePath.'FCKeditor/';
$oFCKeditor->Value=stripslashes($data_edit['content']);
$oFCKeditor->Width  = '600px' ;
$oFCKeditor->Height = '400px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                                  <input type="hidden" name="tester2" id="testeradd2" value="" />
                                
                                <div class="control-group">
                                    <label class="control-label">
                                      Default Right Column
                                    </label>
                                    <div class="controls">
                                 <input type="checkbox"  id="defaultColm"   name="defaultColm" class="input-xxlarge" value="yes" <?php if($data_edit['rightcontent']==''){?>checked="checked"<?php }?>/>
                                    </div>
                                </div>
                                
                                <div class="control-group" id="rightCol" <?php if($data_edit['rightcontent']==''){?>style="display:none"<?php }?>>
                                    <label class="control-label">Right Content</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "style-two.php"));
$oFCKeditor = new FCKeditor("rightcontent");
 $oFCKeditor->BasePath = $sBasePath.'FCKeditor/';
$oFCKeditor->Value=stripslashes($data_edit['rightcontent']);
$oFCKeditor->Width  = '600px' ;
$oFCKeditor->Height = '400px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>                                    </div>
                                </div>
                                  <input type="hidden" name="tester1" id="testeradd1" value="" />
                                  
                                <div class="form-actions">
          <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
          
           <button type="button" class="btn preview_add" >Preview</button>
                                    <button type="button" class="btn" onClick="window.location='style-two.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                                
                            <?php } else {
								
								$list_pages=mysql_query("SELECT * FROM  new_page order by pagename");
                                 $count=mysql_num_rows($list_pages);
								?>
                            <!-- END FORM--><div class="btn-group">
                                         <button  onClick="window.location='style-two.php?action=add';" class="btn green" id="editable-sample_new">
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
                      		  <div class="widget-body" id="draggable_portlets123">
                        <table class="table table-striped table-bordered" id=""> 
                            <thead> 
							<?php if($count>0) {?>
                            <tr>
                                <th style="width:8px;">ID</th>
                                 <th class="hidden-phone" >Page Name</th>
                                <th class="hidden-phone">Page Title</th>
                                <th class="hidden-phone">Edit</th>
                                <th class="hidden-phone">Delete</th>
                                
                            </tr>
                              <div id="response" style="display:none"></div>
                            </thead>
                            <tbody class="sortable">
                            <?php $ijij=1; 
							$url='http://www.repreapproval.com/';
while($data=mysql_fetch_object($list_pages))
{
 ?>
                            <tr class="odd gradeX widget" id="arrayorder_<?php echo $data->id; ?>">
                                <td><?php echo $ijij ?></td>
                                <td><?php echo stripslashes($data->pagename);?></td>
                                <td><?php echo stripslashes($data->pagetitle);?></td>
                                <td><a href="http://www.repreapproval.com/<?php echo stripslashes($data->pagename);?>" target="_blank"><?php echo $url.$data->pagename ?></a></td>
                                <td class="hidden-phone"><a class="btn btn-small btn-primary" href="style-two.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
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
	  window.location.href='style-two.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
	
	
	
$(".preview_add").click(function(){
var right = FCKeditorAPI.GetInstance("rightcontent");
var inst = FCKeditorAPI.GetInstance("content");
var sValue = inst.GetHTML();

$('#testeradd2').val(sValue);
if($("#defaultColm").is(':checked'))
	{
   var rValue = '';
	}
else
{
  var rValue = right.GetHTML();
}

var fd = new FormData(); 
var metatitle=$('#metatitle').val();
var metakeyword=$('#metakeyword').val();
var metadescription=$('#metadescription').val();
var pagetitle=$('#pagetitle').val();
var pagesubtitle=$('#pagesubtitle').val();
var rightcontent=$('#rightcontent').val();
var content=$('#content').val();
var url=$('#url').val();
var urltext=$('#urltext').val();

		 $.ajax({
			 type:"POST",
			 url:'ajax_previewadd.php?url='+url+'&metatitle='+metatitle+'&metakeyword='+metakeyword+'&metadescription='+metadescription+'&pagetitle='+pagetitle+'&pagesubtitle='+pagesubtitle+'&tester1='+rValue+'&tester2='+sValue+'&urltext='+urltext,
			  data:fd,
			  processData: false,
              contentType: false,
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
	
	$('#defaultColm').on('click',function(){
		
	if($("#defaultColm").is(':checked'))
	{
   $('#rightCol').hide('slow');
	}
else
{
   $('#rightCol').show('slow');
}
		});
	
	});
</script>
<?php if(isset($_REQUEST['msg'])&& $_REQUEST['msg']=='Already') {?>
                      <script>
                     apprise('This page name is already used. Please use a different name prior to saving.');
                     </script>
                     <?php }?>