    <!-- End Header Tag -->
	
	<div class="modal fade" id="modalLogin">
  <div class="modal-dialog">
    <div class="modal-content">
         
      <form name="login" id="login" method="post">
      <div class="modal-header">
	  <img src="<?php echo Router::url('/',true)?>images/artist-icon.png" width="70" height="50" style="float:left;padding:5px;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="60" height="50px"></button>
        <h4 class="modal-title">LOGIN</h4>
      </div>
			  <div class="modal-body">
                <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
					<div id="errormsg"></div>
						  <div class="form-group col-sm-12 col-md-offset-2">
								<label  for="inputEmail3" class="col-sm-3 control-lable">Email: <span class="star">*</span> </label>
								<div class="col-sm-6">
								<input type="email" class="form-control validate[required] custom[email]" id="txtusername" name="txtusername" />
								</div>
							</div>
							
								<div class="form-group col-sm-12 col-md-offset-2">
								<label  for="inputPassword3" class="col-sm-3 control-lable">Password: <span class="star">*</span></label>
								<div class="col-sm-6">
								<input type="password"  id="txtpassword" name="txtpassword" class="form-control validate[required]" />
								</div> 
								</div>
							
							  <div class="col-sm-12 col-md-offset-4">
							  <div class="col-sm-offset col-sm-6">
							  <p><a href="javascript:void(0);" id="showmodalPassword">I forgot my password ?</a></p>
							  </div>
							  </div>
							  
							  <div class="form-group col-sm-12 col-md-offset-4">
							  <div class="col-sm-offset col-sm-6">
							  <button type="submit" class="btn btn-primary btn-lg btn-block submit-button" onclick="return loginValidation();" id="addItem">SUBMIT</button>
							  </div>
							  </div>
							  
							  <div class="form-group col-sm-12 col-md-offset-4">
							  <label id="showmodalregister">Create an account</label>
							  <div class="col-sm-offset col-sm-3">
							  <a class="btn btn-primary btn-lg btn-block register-button" id="showmainrgmodal" href="javascript:void(0);" >REGISTER</a>
							  </div>
							  </div>
							
				</div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
                <span>Login using social networks</span>
        <div class="social-network popup-social">
                   <?php echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'userfacebook', 'escape' => false)); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","facebook",'3'));
												echo $this->Form->hidden('',array('id'=>'userfacebook_process_url', 'value'=>$strFURL));?>
                    <a data-original-title="gmail" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-gmail fa-1x"></i></a>
                    <a data-original-title="Twitter" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-twitter fa-1x"></i></a>
                </div>
			</div>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>