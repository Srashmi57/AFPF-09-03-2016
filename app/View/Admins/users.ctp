<?php echo $this->Html->script('common'); 
echo $this->Html->css('common.css');
echo $this->Html->script('jquery.tablesorter.min');
echo $this->Html->script('jquery.tablesorter.widgets.min');?>

<script type="text/javascript">
$( document ).ready(function() {
	$(".getdata").click(function()
	{
	
		var admin_id = $(this).attr('id');
	
	$.ajax({
		type: "POST",
		url: strGlobalSiteBasePath+"/Admins/getSubAdminUpdateData",
		data: {"admin_id" : admin_id},
		cache: false,
		dataType: 'json',
		success: function(data)
		{
			
				Respstatus = data.status;
					if(Respstatus == "success")
					{
					
						document.getElementById('update_admin_id').value= data.admin_id;
						document.getElementById('update_admin_fname').value = data.admin_fname;
						document.getElementById('update_admin_lname').value = data.admin_lname;
						document.getElementById('update_admin_email').value = data.admin_email;
						document.getElementById('showcatImage').src = data.admin_image;
							$("#usertype_list").val(data.usertype_id);
							$('#editNewAdmin').validationEngine('hideAll');
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
			headers: {1: {sorter: 'custom_sort_function'},2: {sorter: 'false'},3: {sorter: 'false'},4: {sorter: 'false'}	,5: {sorter: 'false'}
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
                <h3 class="btn btn-success pull-right"  ><a id="adduser">Add User</a></h3>
                            </form>
                           
                                </div><!-- /.box-header -->
							
                               
                                <div class="box-body">
								       <table class="table table-bordered tablesorter">
                                        
                                        <thead>
										<tr>
                                            <th >Sr. No.
                                            </th>
                                            <th>Name                                    
									</th>
											 <th>User Type</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php
									$count=0;
									if(count($users)>0)
									{
									 foreach ($users as $row)
										{
											$count++;
											if($row['Admin']['admin_status']==0)
											{
											  $statustext = "<span class='label label-danger'>Inactive</span>";
											   $status=1;
											}
											else
											{
											  $statustext = "<span class='label label-success'>Active</span>";
											  $status=0;
											}
										$adminimage = $row['Admin']['admin_image'];
											$imagepath = Router::url('/',true)."assets/admin/".$adminimage;
											
											if(file_exists("assets/admin/".$adminimage)&&$adminimage!="")
											 {
												$adminimagepath = $imagepath;
											 }
											 else
											 {
												$adminimagepath = Router::url('/',true)."assets/default/default.gif" ;
											 }
										?>
										
									<tr>
									 <td><?php echo $count;?></td>
									<td><?php echo ucfirst($row['Admin']['admin_fname'])." ".ucfirst($row['Admin']['admin_lname']); ?></td>
									<td><?php echo $row['usertype']['usertype_name']; ?></td>
                                    <td><img src="<?php echo $adminimagepath;?>" height="80px" width="100px" class="thumbnail"/></td>
									<td><a id="updatestatus" href="javascript:void(0);"  onclick="return ChangeStatus('<?php echo $this->params['controller']?>',<?php echo $row['Admin']['admin_id']?>,<?php echo $status?>,'Admin')"><?php echo $statustext;?></a></td><!-- Adding edit and delete link -->
									<td>
											<a id="<?php echo $row['Admin']['admin_id']; ?>" class="getdata" href="javascript:void(0);">Edit</a> |
											<?php echo $this->Html->link('Delete', array('action' => 'delete', $row['Admin']['admin_id'],'Admin'), array('onclick'=>'return false;', 'id'=>'msg-name', 'class'=>' delete-link')); ?>

									</td>
									</tr>

				<?php } 
				}
				else
				{
				?>
				  <td colspan="6" class="text-center">Result not found</td>
				<?php 
				}
	?>
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
        <h4 class="modal-title">Edit User</h4>
      </div>
      <div class="modal-body">
	  	   <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	  <form name="editNewAdmin" id="editNewAdmin" method="post">
      
            <div class="form-group">
                <label  for="Name">First Name: <span class='star'>*</star>  </label>
                     <input type="hidden" name="data[update_admin_id]" class="form-control validate[required]" id="update_admin_id" placeholder="Category name"/>
                    <input type="text" id="update_admin_fname" name="data[update_admin_fname]" class="form-control validate[required,custom[onlyLetterSp]maxSize[20]minSize[0]]" placeholder="First name"/>
                </div>
                
                 <div class="form-group">
                <label  for="Name">Last Name: <span class='star'>*</star>  </label>
                    
                    <input type="text" name="data[update_admin_lname]" id="update_admin_lname" class="form-control validate[required,custom[onlyLetterSp]maxSize[20]minSize[0]]" placeholder="Last name"/>
                </div>
                
                   <div class="form-group">
						<label  for="Name">Usertype: <span class='star'>*</star></label>
                        <?php    echo $this->Form->input('usertype_list',array('label'=>false,'type'=>'select','options'=>$arr_UserTypeList,'class'=>'validate[required] form-control'));
?>
                    </div>
				
                   <div class="form-group">
	 					<div class="row">
						<div class="col-md-6">
						<label  for="Name"> Image: <span class='star'>*</star> </label>
			           <input type="file" name="userimage"  placeholder="Upload image..." class="" >
					   </div>
					   <div class='col-md-6'>
                         <img id="showcatImage" src="" height="100px" width="100px" class="img-responsive thumbnail" style="margin-top:20px;"/>
						 </div>
						 </div>
	               </div>
                   
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnToUpdateAdmin();" id="addItem" >Save changes</button>
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
        <h4 class="modal-title">Add User</h4>
      </div>
      <div class="modal-body">
	  	   <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	  <form name="addNewAdmin" id="addNewAdmin" method="post" enctype="multipart/form-data">
	        	  <div class="form-group">
						<label  for="Name">First Name: <span class='star'>*</star>  </label>
                        <input type="text" name="txtFirstName" class="form-control validate[required,custom[onlyLetterSp]maxSize[20]minSize[0]]" placeholder="First name"/>
                    </div>
                     <div class="form-group">
						<label  for="Name">Last Name: <span class='star'>*</star>  </label>
                        <input type="text" name="txtLastName" class="form-control validate[required,custom[onlyLetterSp]maxSize[20]minSize[0]]" placeholder="Last name"/>
                    </div>
                    
                    <div class="form-group">
						<label  for="Name">Usertype: <span class='star'>*</star></label>
                        <?php    echo $this->Form->input('usertype_list',array('label'=>false,'type'=>'select','options'=>$arr_UserTypeList,'class'=>'validate[required] form-control'));
?>
                    </div>
                 <div class="form-group">
						<label  for="Name">Email: <span class='star'>*</star>  </label>
                        <input type="email" name="txtEmail" class="form-control validate[required,[funcCall[validateEmail]]]" placeholder="Email"/>
                    </div>
                   
                   <div class="form-group">
	 					<label  for="Name"> Image:  </label>
			           <input type="file" name="userimage" placeholder="Upload image..."  >
	               </div>
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnToAddAdmin();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
<script type="text/javascript">
$("#adduser").click(function()
{
	$('#addNewAdmin').find("input,textarea,select").val('');
	$("#example").modal('show');
	$('#addNewAdmin').validationEngine('hideAll');
})
</script>	