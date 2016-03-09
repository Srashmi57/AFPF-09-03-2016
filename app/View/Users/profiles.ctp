<?php echo $this->Html->script('category'); ?>


                            <div class="box box-warning">
							 <div class="box-header">
                                
                                </div><!-- /.box-header -->
							
                               
                                <div class="box-body">
								       									
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
				

	