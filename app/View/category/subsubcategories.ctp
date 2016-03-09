<?php echo $this->Html->script('common'); 
echo $this->Html->css('common.css');
echo $this->Html->script('jquery.tablesorter.min');
echo $this->Html->script('jquery.tablesorter.widgets.min');?>

<script type="text/javascript">
$( document ).ready(function() {
	
	$(".getdata").click(function()
	{
	
		var subsubcategory_id = $(this).attr('id');
		
	
	$.ajax({
		type: "POST",
		url: strGlobalSiteBasePath+"categories/UpdateSubSubCategoryData",
		data: {"subsubcategory_id" : subsubcategory_id},
		cache: false,
		dataType: 'json',
		success: function(data)
		{
				Respstatus = data.status;
					if(Respstatus == "success")
					{
					//alert(data.category_id);
						$("#category_listid").val(data.category_id);
						
						$("#subcategory_id").val(data.subcategory_id);
						document.getElementById('update_subsubcategory_id').value= data.subsubcategory_id;
						document.getElementById('update_subsubcategoryname').value = data.subsubcategory_name;
						document.getElementById('showsubcatImage').src = data.subsubcategory_image;
						$('#editSubCategory').validationEngine('hideAll');	
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
			 4: {
                sorter: 'false'
            },
			 5: {
                sorter: 'false'
            },
			6: {
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
                                         <input type="text" class="form-control" placeholder="Search" required name="txtsearch"  id="txtsearch">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default" type="submit" ><i class="glyphicon glyphicon-search"></i></button>
                                                </div>
                                                
                                            </div>
											
                                   <h3 class="btn btn-success pull-right"  ><a id="addnewsubcat">Add Sub SubCategory</a></h3>
                           </form>
                                </div><!-- /.box-header -->
							
                               
                                <div class="box-body">
								       <table class="table table-bordered tablesorter">
                                        <thead>
										<tr>
                                            <th >Sr. No.</th>
                                             <th>Category</th>
                                             <th>Sub Category</th>
                                            <th>Sub Sub Category</th>
                                          <!--  <th>Image</th>-->
                                            <th>Status</th>
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php
										$count=0;
							if(count($subsubcategory)>0)
							{
								 foreach ($subsubcategory as $row)
										{
												$count++;
											if($row['subsubcat']['subsubcategory_status']==0)
											{
											  $statustext = "<span class='label label-danger'>Inactive</span>";
											   $status=1;
											}
											else
											{
											   $statustext = "<span class='label label-success'>Active</span>";
											  $status=0;
											}
											$imagepath = Router::url('/',true)."assets/subsubcategory/".$row['subsubcat']['subsubcategory_image'];
											?>
											
									<tr>
									<td><?php echo $count; ?></td>
                                     <td><?php echo $row['Category']['category_name']; ?></td>
                                      <td><?php echo $row['subcat']['subcategory_name']; ?></td>
									<td><?php echo $row['subsubcat']['subsubcategory_name']; ?></td>
									 <td><img src="<?php echo $imagepath;?>" height="80px" width="100px" class="thumbnail"/></td>
									<td><a id="updatestatus" href="javascript:void(0);"  onclick="return ChangeStatus('<?php echo $this->params['controller']?>',<?php echo $row['subsubcat']['subsubcategory_id']?>,<?php echo $status?>,'Subsubcategory')"><?php echo $statustext;?></a></td>
									<td>
<a id="<?php echo $row['subsubcat']['subsubcategory_id']; ?>" class="getdata" href="javascript:void(0);">Edit</a> |
											<?php echo $this->Html->link('Delete', array('action' => 'delete', $row['subsubcat']['subsubcategory_id'],'Subsubcategory'), array('onclick'=>'return false;', 'id'=>'msg-name', 'class'=>' delete-link')); ?>

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




				
						
<div class="modal fade" id="example">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Add SubsubCategory</h4>
      </div>
      <div class="modal-body">
	  <form name="addSubSubCategory" id="addSubSubCategory" method="post">
	   <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	  
	          <div class="form-group">
		
				<label  for="Name"> SubCategory: <span class='star'>*</star> </label>
                        <input type="text" name="subsubcategory" class="form-control validate[required]" placeholder="SubCategory name"/>
                    </div>
                 	<div class="form-group">
                    <label  for="Name"> Category: <span class='star'>*</star> </label>
<?php                    echo $this->Form->input('category_list',array('label'=>false,'type'=>'select','options'=>$arr_CategoryList,'class'=>'validate[required] form-control','onChange'=>'fnGetSubcategoryList(this.value)'));
?>
</div>

                 	<div class="form-group">
                    <label  for="Name"> SubCategory: <span class='star'>*</star> </label>
                    
						<select id="subcatlist" name="subcategory_id" class="validate[required] form-control subcatlist">
						<option value="">Please select subcategory</option>
						</select>
						</div>
						
                        <div class="form-group">
							<label  for="Name"> Image </label>
							<input type="file" name="subsubcatimage" placeholder="Upload image..." class="validate[required]" >
                         </div> 
     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnAddSubSubCategory();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	
<div class="modal fade" id="UpdateModal">
   <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Edit SubsubCategory</h4>
      </div>
	  <form name="editSubSubCategory" id="editSubSubCategory" method="post" >
      <div class="modal-body">
   <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	          <div class="form-group">
		
				<label  for="Name">Subsub Category: <span class='star'>*</star>  </label>
                        
                         <input type="hidden" name="data[update_subsubcategory_id]" class="form-control validate[required]" id="update_subsubcategory_id" placeholder="SubCategory name"/>
						  <input type="text" name="data[update_subsubcategoryname]" class="form-control validate[required]" id="update_subsubcategoryname" placeholder="SubCategory name"/>
                    </div>
                    
                    	<div class="form-group">
                         <label  for="Name"> Category: <span class='star'>*</star> </label>
		
				<?php    echo $this->Form->input('category_listid',array('label'=>false,'type'=>'select','options'=>$arr_CategoryList,'class'=>'validate[required] form-control','onChange'=>'fnGetSubcategoryList(this.value)'));
?>
                    </div>
					
					<div class="form-group">
                    <label  for="Name"> SubCategory: <span class='star'>*</star> </label>
                                        <?php       echo $this->Form->input('subcategory_id',array('label'=>false,'type'=>'select','options'=>$arr_subCategoryList,'class'=>'validate[required] form-control subcatlist'));
?>
						
						</div>
					
					<div class="form-group">
					<label  for="Name"> Image </label>
                      <input type="file" name="subsubcatimage" id="subsubcatimage" placeholder="Upload image..." class="" >
                      <img id="showsubcatImage" src="" height="200px" width="200px" class="img-responsive thumbnail" style="margin-top:20px;"/>
		             </div>
                   
     
                
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnUpdateSubSubCategory();" id="addItem" >Save changes</button>
      </div>
	  </div><!-- /.modal-body -->
	   </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->
<script type="text/javascript">
$("#addnewsubcat").click(function()
{
	$('#addSubSubCategory').find("input,textarea,select").val('');
	$("#example").modal('show');
	$('#addSubSubCategory').validationEngine('hideAll');
})
</script>