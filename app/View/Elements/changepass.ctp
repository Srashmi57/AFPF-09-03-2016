<div class="modal fade" id="modalchangepassword">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="frmchangepassword" id="frmchangepassword" method="post">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body">

<div id="errormsg"></div>
		<div class="row" style="padding-bottom: 15px;">
						<div class="form-group">
								<label  for="Email" class="col-md-4 control-lable">Old Password <span class="star">*</span> </label>
								<div class="col-md-8">
								 <input type="password" name="txtOldPassword" id="txtOldPassword" class="form-control validate[required],maxSize[16],minSize[6]" placeholder="Old Password"/>
					</div>
				</div>
		</div>
                    <div class="row" style="padding-bottom: 15px;">  
                          <div class="form-group">
								<label  for="Email" class="col-md-4 control-lable">New Password <span class="star">*</span></label>
								<div class="col-md-8">
								 <input type="password" name="txtNewPassword" id="txtNewPassword" class="form-control validate[required],maxSize[16],minSize[6]" placeholder="New Password"/>
							</div>
						</div>
					</div>	
					<div class="row" style="padding-bottom: 15px;">
						<div class="form-group">
						<label class='col-md-4'>Confirm Password: <span class="star">*</span></label>
								<div class='col-md-8'>
							
							<?php echo $this->Form->input('confirmpassword', array('type' => 'password', 'class' => 'form-control validate[required,equals[txtNewPassword], maxSize[16],minSize[6]]', 'placeholder'=>'Confirm Password', 'label' => false));?>
							
								</div>
						</div>
					</div>
     
                </div>
      
      <div class="modal-footer poup-footer">
			<div class=" col-sm-4 pull-right">
			
			  
			  <button href="#" data-dismiss="modal" class="btn btn-success">CLOSE</button>
							  <button type="submit" class="btn btn-success" onclick="return fnchangepassword();" id="addItem">SUBMIT</button>
				 
			</div>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>
  