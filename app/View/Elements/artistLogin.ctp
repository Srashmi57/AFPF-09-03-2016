    <!-- End Header Tag -->
	
	<div class="modal fade" id="artistLogin" >
  <div class="modal-dialog">
    <div class="modal-content">
         
      <form name="artistlogin" id="artistlogin" method="post">
      <div class="modal-header">
	  
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="60" height="50px"></button>
        <h4 class="modal-title">ARTIST LOGIN</h4>
      </div>
			  <div class="modal-body artistLogin">
        
					<div class="errormsg"></div>
						  <div class="form-group col-sm-10 col-md-offset-1">
								<label  for="inputEmail3" class="col-sm-4 control-lable" style="margin-top:7px;">Email Address:<span class="star">*</span> </label>
								<div class="col-sm-8">
								<input type="email" class="form-control validate[required,[funcCall[validateEmail]]]" id="txtusername" name="txtusername" <?php if ($cookieHelper->read('Utxtusername') !=""){?> value="<?php echo $cookieHelper->read('Atxtusername');?>"<?php } else { ?> value=""<?php } ?>/>
								<input type="hidden" name="usertypeid" id="usertypeid" value="2"/>
								</div>
							</div>
							
								<div class="form-group col-sm-10 col-md-offset-1">
								<label  for="inputPassword3" class="col-sm-4 control-lable" style="margin-top:7px;">Your Password: <span class="star">*</span></label>
								<div class="col-sm-8">
								<input type="password"  id="txtpassword" name="txtpassword" class="form-control validate[required]" <?php if ($cookieHelper->read('Utxtpassword') !=""){?> value="<?php echo $cookieHelper->read('Atxtpassword');?>"<?php } else { ?> value=""<?php } ?>/>
								</div> 
								</div>
							
							  <div class="form-group col-sm-10 col-md-offset-1"> 
							  <div class="col-sm-4"></div>
							  <div class="col-sm-offset col-sm-8">
							  <button type="submit" class="btn btn-primary btn-lg btn-block submit-button login_button" onclick="return loginValidation('artist');" id="addItem">SUBMIT</button>
							  </div>
							  </div>
							  
							  <div class="col-sm-10 col-md-offset-4" style="font-size:13px;">
							  <div class="col-sm-4"><input type="checkbox" class="checkbox rememberme" name="remember_me" value="1" <?php if ($cookieHelper->read('ArememberMe') == '1') echo "checked='checked'"; ?>/> Remember me</div>
							  <div class="col-sm-offset col-sm-4 forgot-password">
							  <p><a href="javascript:void(0);" class="showmodalPassword">Forgot password?</a></p>
							  </div>
							  </div>
							  
							  <div class="form-group col-sm-10 col-md-offset-1">
							  <div class="col-sm-offset col-sm-4" style="padding-right:0;margin-top:7px;">
							  <label >Create an account</label>
							  </div>
							  <div class="col-sm-offset col-sm-8">
							  <a class="btn btn-primary btn-lg btn-block register-button login_button showartistmodal" id="showmainrgmodal" href="javascript:void(0);" >REGISTER</a>
							  </div>
							  </div>
							
				</div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
                <span>Login using social networks</span>
        <div class="social-network popup-social">
                  <?php echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'artistfacebook', 'escape' => false)); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","facebook",'2'));
												echo $this->Form->hidden('',array('id'=>'artistfacebook_process_url', 'value'=>$strFURL));?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-linkedin fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'artistlinkedin')); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","linkedin",'2'));
												echo $this->Form->hidden('',array('id'=>'artistlinkedin_process_url', 'value'=>$strFURL));
												
                    ?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-google-plus fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'artistgmail')); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","gmail",'2'));
												echo $this->Form->hidden('',array('id'=>'artistgmail_process_url', 'value'=>$strFURL));
												
                    ?>
                </div>
			</div>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>