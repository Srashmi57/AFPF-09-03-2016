<?php echo $this->Html->script('common'); 
echo $this->Html->css('common');
echo $this->Html->script('jquery.tablesorter.min');
echo $this->Html->script('jquery.tablesorter.widgets.min');?>



<script type="text/javascript">
$( document ).ready(function() {
	$(".getdata").click(function()
		{
		
			var banner_id = $(this).attr('id');
			
		
		$.ajax({
			type: "POST",
			url: strGlobalSiteBasePath+"/admins/Updatewebsitebanner",
			data: {"banner_id" : banner_id},
			cache: false,
			dataType: 'json',
			success: function(data)
			{
					Respstatus = data.status;
						if(Respstatus == "success")
						{
						
						//alert(data.catimage);
							document.getElementById('update_bannerid').value= data.banner_id;
							document.getElementById('update_banner_title').value = data.banner_title;
							document.getElementById('update_banner_subtitle').value = data.banner_subtitle;
							document.getElementById('showbannerImage').src = data.banner_image;
							document.getElementById('update_cat_list').value = data.category_id;
							$('#editBanner').validationEngine('hideAll');
							$("#UpdateModal").modal('show');
						
						}
						else
						{
							
							alert("Failed");
							return false;
						}
			}
		});
		
	});
	
	$('table').tablesorter({
			widgets        : ['zebra', 'columns'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true,
			headers: {
          
            1: {
                sorter: 'custom_sort_function'
            },
           
			 3: {
                sorter: 'false'
            },
			 4: {
                sorter: 'false'
            },
			 5: {
                sorter: 'false'
            }
			
       		}
		});
});
</script>

                            <div class="box box-warning">
							 <div class="box-header">
                             
                             <form class="navbar-form"  name="searchfilter" id="searchfilter" method="post">
                                            <div class="input-group">
                                         <input type="text" class="form-control" placeholder="Search"  required name="txtsearch"  id="txtsearch">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default" type="submit" ><i class="glyphicon glyphicon-search"></i></button>
                                                </div>
                                                
                                            </div>
											   <h3 class="btn btn-success pull-right"  ><a id="addnewbanner">Add Banner</a></h3>
                            </form>
                            
                            
                                </div><!-- /.box-header -->
							
                               
                                <div class="box-body">
								       <table class="table table-bordered tablesorter">
                                        
                                        <thead>
										<tr>
                                            <th >Sr. No.
                                            </th>
                                            <th>Title</th>
											 <th>Category</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php
									$count=0;
									if(count($websitebanners)>0)
									{
									 foreach ($websitebanners as $row)
										{
											$count++;
											if($row['banner']['banner_status']==0)
											{
											  $statustext = "<span class='label label-danger'>Inactive</span>";
											   $status=1;
											}
											else
											{
											  $statustext = "<span class='label label-success'>Active</span>";
											  $status=0;
											}
											$bannerimage = $row['banner']['banner_image'];
											$imagepath = Router::url('/',true)."assets/banner/".$bannerimage;
											
											if(file_exists("assets/banner/".$bannerimage)&& trim($bannerimage)!='')
											 {
												$bannerimagepath = $imagepath;
											 }
											 else
											 {
												$bannerimagepath = Router::url('/',true)."assets/default/default.gif" ;
											 }
										?>
										
									<tr>
									 <td><?php echo $count;?></td>
									<td><?php echo ucfirst($row['banner']['banner_title']); ?></td>
									<td><?php echo $row['cat']['category_name']; ?></td>
                                    <td><img src="<?php echo $bannerimagepath;?>" height="80px" width="100px" class="thumbnail"/></td>
									<td><a id="updatestatus" href="javascript:void(0);"  onclick="return ChangeStatus('<?php echo $this->params['controller']?>',<?php echo $row['banner']['banner_id']?>,<?php echo $status?>,'banner')"><?php echo $statustext;?></a></td><!-- Adding edit and delete link -->
									<td>
										<a id="<?php echo $row['banner']['banner_id']; ?>" class="getdata" href="javascript:void(0);">Edit</a> |	
											<?php echo $this->Html->link('Delete', array('action' => 'delete', $row['banner']['banner_id'],'banner'), array('onclick'=>'return false;', 'id'=>'msg-name', 'class'=>' delete-link')); ?>

									</td>
									</tr>

								<?php } 
                          }		
			else
			{?>
			<td colspan="6" class="text-center">Result not found</td>
				<?php }			?>
                                    </tbody></table>	
                                    <div class="pagination pagination-large">
					<ul class="pagination">
							<?php
								echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
								echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
								echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
							?>
						</ul>
					</div>								
                               </div><!-- /.box-body -->
							  
									
                            </div><!-- /.box -->

<div class="modal fade" id="UpdateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Edit Banner</h4>
      </div>
      <div class="modal-body">
         <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	<div id="errormsg"></div>
	  <form name="editBanner" id="editBanner" method="post">
      
            <div class="form-group">
                <label  for="Name">Banner Title: <span class='star'>*</star>  </label>
                     <input type="hidden" name="data[update_bannerid]" class="form-control validate[required]" id="update_bannerid" placeholder="Banner Id"/>
                    <input type="text" id="update_banner_title" name="data[update_banner_title]" class="form-control validate[required,maxSize[100]minSize[0]]" placeholder="First name"/>
                </div>
                <div class="form-group">
                         <label  for="Name"> Category : <span class='star'>*</star> </label>
		
				<?php    echo $this->Form->input('update_cat_list',array('label'=>false,'type'=>'select','options'=>$arr_CategoryList,'class'=>'validate[required] form-control'));
?>
                    </div>
                 <div class="form-group">
                <label  for="Name">Banner Sub Title: <span class='star'>*</star>  </label>
                    
                    <textarea name="data[update_banner_subtitle]" id="update_banner_subtitle" class="form-control validate[required]" placeholder="Banner Sub Title"></textarea>
                </div>
                
                   <div class="form-group">
	 					<label  for="Name"> Image: <span class='star'>*</star> </label>
						<span class="info">Upload Image size greater than 1920*375</span>
			           <input type="file" name="bannerimage"  placeholder="Upload image..." class="" >
                         <img id="showbannerImage" src="" height="200px" width="200px" class="img-responsive thumbnail" style="margin-top:20px;"/>
	               </div>
                   
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnUpdateBanner();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
				

<!--for Add Category-->				
<div class="modal fade" id="example">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Add Banner</h4>
      </div>
      <div class="modal-body">
       <div class="cms-bgloader-mask"></div>
	<div class="cms-bgloader"></div>
	<div id="erroraddmsg"></div>
	  <form name="addbanner" id="addbanner" method="post" enctype="multipart/form-data">
	        	  <div class="form-group">
						<label  for="Name">Banner Title: <span class='star'>*</star>  </label>
                        <input type="text" name="txtBannerTitle" class="form-control validate[required,custom[onlyLetterSp],maxSize[100]minSize[0]]" placeholder="Banner Title"/>
                    </div>
					<div class="form-group">
                         <label  for="Name"> Category : <span class='star'>*</star> </label>
		
				<?php    echo $this->Form->input('category_list',array('label'=>false,'type'=>'select','options'=>$arr_CategoryList,'class'=>'validate[required] form-control'));
?>
                    </div>
                     <div class="form-group">
						<label  for="Name">Banner Sub Title:<span class='star'>*</star>  </label>
                        <textarea id="txtBannerSubTitle" name="txtBannerSubTitle" placeholder="Banner Sub Title" value="" class="form-control validate[required]" ></textarea>
                    </div>
                    
                    
                   <div class="form-group">
	 					<label  for="Name"> Image:<span class='star'>*</star> </label>
						<span class="info">Upload Image size greater than 1920*375</span>
			           <input type="file" name="bannerimage" placeholder="Upload image..." class="validate[required]" >
	               </div>
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnToAddBanner();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	<script type="text/javascript">
$("#addnewbanner").click(function()
{
	$('#addbanner').find("input,textarea,select").val('');
	$("#example").modal('show');
	$('#addbanner').validationEngine('hideAll');
})
</script>	