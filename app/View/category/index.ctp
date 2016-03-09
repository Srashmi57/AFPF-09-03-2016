<?php echo $this->Html->script('common'); 
echo $this->Html->css('common');
echo $this->Html->script('jquery.tablesorter.min');
echo $this->Html->script('jquery.tablesorter.widgets.min');?>
<script type="text/javascript">
$( document ).ready(function() {
	$(".getdata").click(function()
	{
		var categoryid = $(this).attr('id');
		
	
	$.ajax({
		type: "POST",
		url: strGlobalSiteBasePath+"/Categories/UpdateCategoryData",
		data: {"categoryid" : categoryid},
		cache: false,
		dataType: 'json',
		success: function(data)
		{
				Respstatus = data.status;
					if(Respstatus == "success")
					{
					
					
						document.getElementById('update_categoryid').value= data.category_id;
						document.getElementById('update_category').value = data.category_name;
						document.getElementById('showcatImage').src = data.category_image;
						$('#editCategory').validationEngine('hideAll');
					
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
            2: {
                sorter: 'false'
            },
			 3: {
                sorter: 'false'
            },
			 4: {
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
                                     <h3 class="btn btn-success pull-right" style="margin-top:0px;"  ><a id="addnewcat">Add Category</a></h3>
                            </form>
                                  
                                </div><!-- /.box-header -->
							
                               
                                <div class="box-body">
								       <table class="table table-bordered tablesorter">
                                        <thead>
										<tr>
                                     
                                            <th >Sr. No.</th>
                                            <th>Category  </th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php
										$count=0;
										if(count($category)>0)
										{
											foreach ($category as $row)
											{
													$count++;
												if($row['Category']['category_status']==0)
												{
												  $statustext = "<span class='label label-danger'>Inactive</span>";
												   $status=1;
												}
												else
												{
												  $statustext = "<span class='label label-success'>Active</span>";
												  $status=0;
												}
												
												$imagepath = Router::url('/',true)."assets/category/".$row['Category']['category_image'];
												
											
											?>
										
										<tr>
										<td><?php echo $count; ?></td>
										<td><?php echo $row['Category']['category_name']; ?></td>
										<td><img src="<?php echo $imagepath;?>" height="80px" width="100px" class="thumbnail"/></td>
										<td><a id="updatestatus" href="javascript:void(0);"  onclick="return ChangeStatus('<?php echo $this->params['controller']?>',<?php echo $row['Category']['category_id']?>,<?php echo $status;?>,'Category')"><?php echo $statustext;?></a></td><!-- Adding edit and delete link -->
										<td>
												<a id="<?php echo $row['Category']['category_id']; ?>" class="getdata" href="javascript:void(0);">Edit</a> |
												<?php echo $this->Html->link('Delete', array('action' => 'delete', $row['Category']['category_id'],'Category'), array('onclick'=>'return false;', 'id'=>'msg-name', 'class'=>'delete-link')); ?>

										</td>
										</tr>

								<?php } 
						}
						else
						{?>
						  <td colspan="6" class="text-center">Result not found</td>
						<?php
						}?>
                                    </tbody></table>	

				 	
                               </div><!-- /.box-body -->
			 <div class="pagination pagination-large">
					<ul class="pagination">
							<?php
								echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
								echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
								echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
							?>
						</ul>
					</div>
									
                            </div><!-- /.box -->

<div class="modal fade" id="UpdateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Edit Category</h4>
      </div>
      <div class="modal-body">
	       <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	  <form name="editCategory" id="editCategory" method="post">
	          <div class="form-group">
		
				<label  for="Name"> Category: <span class='star'>*</star></label>
                        
                         <input type="hidden" name="data[update_categoryid]" class="form-control validate[required]" id="update_categoryid" placeholder="Category name"/>
						  <input type="text" name="data[update_category]" class="form-control validate[required,maxSize[20]minSize[0]]" id="update_category" placeholder="Category name"/>
                    </div>
					
					<div class="form-group">
					
							<label  for="Name"> Image: <span class='star'>*</star></label>
						  <input type="file" name="catimage" id="catimage" placeholder="Upload image..." class="" >
						 
						 
							<img id="showcatImage" src="" height="70px" width="100px" class="img-responsive thumbnail" style="margin-top:20px;"/>
							
					</div>
				
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnUpdateCategory();" id="addItem" >Save changes</button>
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
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
	       <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	  <form name="addCategory" id="addCategory" method="post" enctype="multipart/form-data">
	          <div class="form-group">
				<label  for="Name"> Category: <span class='star'>*</star> </label>
                        <input type="text" name="category" class="form-control validate[required,maxSize[20]minSize[0]]" placeholder="Category name"/>
                 </div>
				 
           <div class="form-group">
			<label  for="Name"> Image: <span class='star'>*</star></label>
                <input type="file" name="catimage" placeholder="Upload image..." class="validate[required]" >
            </div>
     
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnAddCategory();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	
<script type="text/javascript">
$("#addnewcat").click(function()
{
	$('#addCategory').find("input,textarea,select").val('');
	$("#example").modal('show');
	$('#addCategory').validationEngine('hideAll');
})
</script>	