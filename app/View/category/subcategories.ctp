<?php echo $this->Html->script('common'); 
echo $this->Html->css('common.css');
echo $this->Html->script('jquery.tablesorter.min');
echo $this->Html->script('jquery.tablesorter.widgets.min');?>

<script type="text/javascript">
$( document ).ready(function() {
	$("#category_list").val("data[category_list]");
	$(".getdata").click(function()
		{
		
			var subcategoryid = $(this).attr('id');
			
		
		$.ajax({
			type: "POST",
			url: strGlobalSiteBasePath+"categories/UpdateSubCategoryData",
			data: {"subcategoryid" : subcategoryid},
			cache: false,
			dataType: 'json',
			success: function(data)
			{
					Respstatus = data.status;
						if(Respstatus == "success")
						{
						
						//alert(data.catimage);
							document.getElementById('update_subcategoryid').value= data.subcategory_id;
							document.getElementById('update_subcategory').value = data.subcategory_name;
							document.getElementById('category_list').value = data.category_id;
							document.getElementById('showsubcatImage').src = data.subcategory_image;
						//	$('#editSubCategory').validationEngine('hideAll');
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
                                         <input type="text" class="form-control" placeholder="Search" required name="txtsearch"  id="txtsearch">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default" type="submit" ><i class="glyphicon glyphicon-search"></i></button>
                                                </div>
                                                
                                            </div>
                                  <h3 class="btn btn-success pull-right"  ><a id="addnewsubcat">Add SubCategory</a></h3>

                            </form>
                                </div><!-- /.box-header -->
							
                               
                                <div class="box-body">
                             
								       <table class="table table-bordered tablesorter">
                                        <thead>
										<tr>
                             	 <th>Sr. No.</th>
                                 <th>Sub Category</th>
                                  <th>Category						
                                	</th>
                                         <!-- <th> Image</th>-->
                                            <th>Status</th>
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php
										$count=0;
										if(count($subcategory)>0)
										{
									 foreach ($subcategory as $row)
										{
											$count++;
												if($row['subcategory']['subcategory_status']==0)
												{
												  $statustext = "<span class='label label-danger'>Inactive</span>";
												   $status=1;
												}
												else
												{
												   $statustext = "<span class='label label-success'>Active</span>";
												  $status=0;
												}
												$imagepath = Router::url('/',true)."assets/subcategory/".$row['subcategory']['subcategory_image'];
										?>
										
									<tr>
									<td><?php echo $count;?></td>
									<td><?php echo $row['subcategory']['subcategory_name']; ?></td>
                                    <td><?php echo $row['Category']['category_name']; ?></td>
								 <td><img src="<?php echo $imagepath;?>" height="80px" width="100px" class="thumbnail"/></td>
									<td><a id="updatestatus" href="#"  onclick="return ChangeStatus('<?php echo $this->params['controller']?>',<?php echo $row['subcategory']['subcategory_id']?>,<?php echo $status?>,'Subcategory')"><?php echo $statustext;?></a></td>
									<td>
<a id="<?php echo $row['subcategory']['subcategory_id']; ?>" class="getdata" href="javascript:void(0);">Edit</a> |
											<?php echo $this->Html->link('Delete', array('action' => 'delete', $row['subcategory']['subcategory_id'],'Subcategory'), array('onclick'=>'return false;', 'id'=>'msg-name', 'class'=>' delete-link')); ?>

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




<div class="modal fade" id="UpdateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Edit Subcategory</h4>
      </div>
      	  <form name="editSubCategory" id="editSubCategory" method="post" enctype="multipart/form-data">

      <div class="modal-body">
	   <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	          <div class="form-group">
		
				<label  for="Name">Sub Category: <span class='star'>*</star> </label>
                        
                         <input type="hidden" name="data[update_subcategoryid]" class="form-control validate[required]" id="update_subcategoryid" placeholder="SubCategory name"/>
						  <input type="text" name="data[update_subcategory]" class="form-control validate[required]" id="update_subcategory" placeholder="SubCategory name"/>
                    </div>
                    
                    	<div class="form-group">
                         <label  for="Name"> Category : <span class='star'>*</star> </label>
		
				<?php    echo $this->Form->input('category_list',array('label'=>false,'type'=>'select','options'=>$arr_CategoryList,'class'=>'validate[required] form-control'));
?>
                    </div>
					
					 <div class="form-group">
		
				<label  for="Name"> Image </label>
                      <input type="file" name="subcatimage" id="subcatimage" placeholder="Upload image..." class="" >
                      <img id="showsubcatImage" src="" height="200px" width="200px" class="img-responsive thumbnail" style="margin-top:20px;"/>
					
                    </div>
                   
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnUpdateSubCategory();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



						
						
<div class="modal fade" id="example">
  <div class="modal-dialog">
    <div class="modal-content">
          	  <form name="addSubCategory" id="addSubCategory" method="post" enctype="multipart/form-data">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Add Subcategory</h4>
      </div>
      <div class="modal-body">

	   <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	          <div class="form-group">
		
				<label  for="Name"> SubCategory: <span class='star'>*</star> </label>
                        <input type="text" name="subcategory" class="form-control validate[required]" placeholder="SubCategory name"/>
                    </div>
                 	<div class="form-group">
                    <label  for="Name"> Category: <span class='star'>*</star> </label>
<?php                    echo $this->Form->input('category_list',array('label'=>false,'type'=>'select','options'=>$arr_CategoryList,'class'=>'validate[required] form-control'));
?>
</div>
                      <div class="form-group">
				<label  for="Name"> Image: <span class='star'>*</star> </label>
        
					<input type="file" name="subcatimage" placeholder="Upload image..." class="validate[required]" >
                        </div>
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnAddSubCategory();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$("#addnewsubcat").click(function()
{
	$('#addSubCategory').find("input,textarea,select").val('');
	$("#example").modal('show');
	$('#addSubCategory').validationEngine('hideAll');
})
</script>