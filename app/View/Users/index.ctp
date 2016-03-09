<?php echo $this->Html->script('common'); 
echo $this->Html->css('common.css');
echo $this->Html->script('jquery.tablesorter.min');
echo $this->Html->script('jquery.tablesorter.widgets.min');?>

<script type="text/javascript">
$( document ).ready(function() {
	$(".getdata").click(function()
	{
		var userid = $(this).attr('id');
	
	$.ajax({
		type: "POST",
		url: strGlobalSiteBasePath+"/Users/UpdateUserData",
		data: {"userid" : userid},
		cache: false,
		dataType: 'json',
		success: function(data)
		{
			
				Respstatus = data.status;
					if(Respstatus == "success")
					{
					
						document.getElementById('update_userid').value= data.user_id;
						document.getElementById('update_user_fname').value = data.user_fname;
						document.getElementById('update_user_lname').value = data.user_lname;
						document.getElementById('update_username').value = data.user_name;
						document.getElementById('showcatImage').src = data.user_image;
					
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
			headers: {1: {sorter: 'custom_sort_function'},3: {sorter: 'false'},4: {sorter: 'false'}	
       		}
		});
});
</script>

                            <div class="box box-warning">
							 <div class="box-header">
                                    <h3 class="btn btn-success pull-right"  ><a data-toggle="modal" data-target="#example">Add Category</a></h3>
                                </div><!-- /.box-header -->
							
                               
                                <div class="box-body">
								       <table class="table table-bordered tablesorter">
                                        <thead>
										<tr>
                                            <th >Sr. No.</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php 
										$count=0;
										foreach ($users as $row)
										{
											$count++;
										if($row['User']['user_status']==0)
										{
										  $statustext = "<span class='label label-danger'>Inactive</span>";
										   $status=1;
										}
										else
										{
										  $statustext = "<span class='label label-success'>Active</span>";
										  $status=0;
										}
										
										$imagepath = Router::url('/',true)."assets/user/".$row['User']['user_image'];
										
										
										?>
										
									<tr>
                                    <td><?php echo $count;?></td>
									<td><?php echo $row['User']['user_fname']." ".$row['User']['user_lname']; ?></td>
                                    <td><img src="<?php echo $imagepath;?>" height="80px" width="100px" class="thumbnail"/></td>
									<td><a id="updatestatus" href="#"  onclick="return ChangeStatus('<?php echo $this->params['controller']?>',<?php echo $row['User']['user_id']?>,<?php echo $status?>)"><?php echo $statustext;?></a></td><!-- Adding edit and delete link -->
									<td>
											<a id="<?php echo $row['User']['user_id']; ?>" class="getdata" href="#">Edit</a> |
											<?php echo $this->Html->link('Delete', array('action' => 'delete', $row['User']['user_id']), array('onclick'=>'return false;', 'id'=>'msg-name', 'class'=>' delete-link')); ?>

									</td>
									</tr>

    <?php }  ?>
                                    </tbody></table>	
                                    
                                    <?php echo $this->Paginator->numbers(); ?>    
             <?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
    <?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?>    
    <?php echo $this->Paginator->counter(); ?>								
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
	  <form name="editCategory" id="editCategory" method="post">
      
            <div class="form-group">
                <label  for="Name">First Name  </label>
                     <input type="hidden" name="data[update_userid]" class="form-control validate[required]" id="update_userid" placeholder="Category name"/>
                    <input type="text" name="data[update_user_fname]" class="form-control validate[required]" placeholder="First name"/>
                </div>
                
                 <div class="form-group">
                <label  for="Name">Last Name  </label>
                    
                    <input type="text" name="data[update_user_lname]" class="form-control validate[required]" placeholder="Last name"/>
                </div>
                
                   <div class="form-group">
						<label  for="Name">Usertype</label>
                        <?php    echo $this->Form->input('usertype_list',array('label'=>false,'type'=>'select','options'=>$arr_UserTypeList,'class'=>'validate[required] form-control'));
?>
                    </div>
	     
					
				  <div class="form-group">
						<label  for="Name">Username  </label>
                        <input type="email" name="data[update_username]" class="form-control validate[required]" placeholder="Username"/>
                    </div>
                      
                    
                    
                   <div class="form-group">
	 					<label  for="Name"> Image </label>
			           <input type="file" name="userimage" placeholder="Upload image..." class="validate[required]" >
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
        <h4 class="modal-title">Add User</h4>
      </div>
      <div class="modal-body">
	   <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	  <form name="addNewUser" id="addNewUser" method="post" enctype="multipart/form-data">
	        	  <div class="form-group">
						<label  for="Name">First Name  </label>
                        <input type="text" name="txtFirstName" class="form-control validate[required]" placeholder="First name"/>
                    </div>
                     <div class="form-group">
						<label  for="Name">Last Name  </label>
                        <input type="text" name="txtLastName" class="form-control validate[required]" placeholder="Last name"/>
                    </div>
                    
                    <div class="form-group">
						<label  for="Name">Usertype</label>
                        <?php    echo $this->Form->input('usertype_list',array('label'=>false,'type'=>'select','options'=>$arr_UserTypeList,'class'=>'validate[required] form-control'));
?>
                    </div>
                 <div class="form-group">
						<label  for="Name">Username  </label>
                        <input type="email" name="txtUsername" class="form-control validate[required]" placeholder="Username"/>
                    </div>
                      <div class="form-group">
						<label  for="Name">Password  </label>
                        <input type="password" name="txtPassword" class="form-control validate[required]" placeholder="Password"/>
                    </div>
                    
                    
                   <div class="form-group">
	 					<label  for="Name"> Image </label>
			           <input type="file" name="userimage" placeholder="Upload image..." class="validate[required]" >
	               </div>
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnAddUser();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	