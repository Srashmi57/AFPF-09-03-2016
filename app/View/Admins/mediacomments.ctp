<?php echo $this->Html->script('common'); 
echo $this->Html->css('common.css');
echo $this->Html->script('jquery.tablesorter.min');
echo $this->Html->script('jquery.tablesorter.widgets.min');?>

<script type="text/javascript">
$( document ).ready(function() {
	$('table').tablesorter({
			widgets        : ['zebra', 'columns'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true,
			headers: {1: {sorter: 'custom_sort_function'},4: {sorter: 'false'}	,5: {sorter: 'false'}
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
                            </form>
                            
                            
                                </div><!-- /.box-header -->
							
                               
                                <div class="box-body">
								       <table class="table table-bordered tablesorter">
                                        
                                        <thead>
										<tr>
                                            <th >Sr. No.
                                            </th>
                                            <th>Name</th>
											 <th>User Type</th>
											 <th>Media</th>
											  <th>Comment</th>
                                           <!-- <th>Status</th>-->
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php
									$count=0;
									/*echo "<pre>";
									print_r($mediacomments);
									exit();
									echo "</pre>";*/
									if(count($mediacomments)>0)
									{
									 foreach ($mediacomments as $row)
										{
											$count++;
											if($row['MediaComment']['mediacomment_status']==0)
											{
											  $statustext = "<span class='label label-danger'>Inactive</span>";
											   $status=1;
											}
											else
											{
											  $statustext = "<span class='label label-success'>Active</span>";
											  $status=0;
											}
										
										?>
										
									<tr>
									 <td><?php echo $count;?></td>
									<td><?php echo ucfirst($row['users']['user_fname'])." ".ucfirst($row['users']['user_lname']); ?></td>
									<td><?php echo $row['usertype']['usertype_name']; ?></td>
                                    <td><?php echo $row['usermedia']['usermedia_name'];?></td>
									<td><?php echo $row['MediaComment']['usermedia_comment']; ?></td>
									<!--<td><a id="updatestatus" href="javascript:void(0);"  onclick="return ChangeStatus('<?php echo $this->params['controller']?>',<?php echo $row['MediaComment']['mediacomment_id']?>,<?php echo $status?>,'MediaComment')"><?php echo $statustext;?></a></td>--><!-- Adding edit and delete link -->
									<td>
											
											<?php echo $this->Html->link('Delete', array('action' => 'delete', $row['MediaComment']['mediacomment_id'],'MediaComment'), array('onclick'=>'return false;', 'id'=>'msg-name', 'class'=>' delete-link')); ?>

									</td>
									</tr>

    <?php }
	}
else
{
?>
<td colspan="6" class="text-center">Result not found</td>
<?php
}	?>
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
	  <form name="editNewAdmin" id="editNewAdmin" method="post">
      
            <div class="form-group">
                <label  for="Name">First Name  </label>
                     <input type="hidden" name="data[update_admin_id]" class="form-control validate[required]" id="update_admin_id" placeholder="Category name"/>
                    <input type="text" id="update_admin_fname" name="data[update_admin_fname]" class="form-control validate[required]" placeholder="First name"/>
                </div>
                
                 <div class="form-group">
                <label  for="Name">Last Name  </label>
                    
                    <input type="text" name="data[update_admin_lname]" id="update_admin_lname" class="form-control validate[required]" placeholder="Last name"/>
                </div>
                
                   <div class="form-group">
						<label  for="Name">Usertype</label>
                        <?php    echo $this->Form->input('usertype_list',array('label'=>false,'type'=>'select','options'=>$arr_UserTypeList,'class'=>'validate[required] form-control'));
?>
                    </div>
	     
					
				  <div class="form-group">
						<label  for="Name">Username  </label>
                        <input type="email" name="data[update_admin_email]" id="update_admin_email" class="form-control validate[required]" placeholder="Username"/>
                    </div>
                      
                    
                    
                   <div class="form-group">
	 					<label  for="Name"> Image </label>
			           <input type="file" name="userimage"  placeholder="Upload image..." class="validate[required]" >
                         <img id="showcatImage" src="" height="200px" width="200px" class="img-responsive thumbnail" style="margin-top:20px;"/>
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
	  <form name="addNewAdmin" id="addNewAdmin" method="post" enctype="multipart/form-data">
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
						<label  for="Name">Email  </label>
                        <input type="email" name="txtEmail" class="form-control validate[required]" placeholder="Email"/>
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
        <button type="button" class="btn btn-primary" onclick="return fnToAddAdmin();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	