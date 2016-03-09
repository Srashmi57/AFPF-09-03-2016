<div class="modal fade" id="modaluserRegister" >
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="frmuserRegister" id="frmuserRegister" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img width="60" height="50px" src="<?php echo Router::url('/',true)?>images/close-icon.png"></button>
					<h4 class="modal-title">Register</h4>
				</div>
				<div class="modal-body userRegister">
					<div id="usererrormsg"></div>		
					<div class="form-group col-sm-12">
            		    <div class="col-sm-6">
							<label  for="Name">First Name: <span class="star">*</span></label>
							<input type="text" name="txtFirstName" id="txtFirstName" class="form-control validate[required, custom[onlyLetterSp]]" placeholder="First Name"/>
							<input type="hidden" name="txtUsertype" id="txtUsertype" class="form-control" value="3"/>
						</div> 
                       <div class="col-sm-6">
							<label  for="Name">Last Name: <span class="star">*</span></label>
							 <input type="email" name="txtLastName" id="txtLastName" class="form-control validate[required, custom[onlyLetterSp]]" placeholder="Last Name"/>
						</div> 
					</div>      
					<div class="form-group col-sm-12">
						<div class="col-sm-6">
							<label  for="Name">Email: <span class="star">*</span>  </label>
							<input type="email" name="txtUsername" id="txtUsername" class="form-control validate[required,[funcCall[validateEmail]]]" placeholder="Email"/>
                        </div>
						<div class="col-sm-6">
							<label  for="Name">Phone Number: <span class="star">*</span>  </label>
							<input type="text" name="txtphonenumber" id="txtphonenumber" class="form-control  validate[required,custom[phone]]" placeholder="Phone Number"/>
						</div>
                    </div>                
                    <div class="form-group col-sm-12 ">
                        <div class="col-sm-6">
							<label  for="Name">Password: <span class="star">*</span>  </label>
							<input type="Password" name="txtUserPassword" id="txtUserPassword" class="form-control validate[required,minSize[6]]" placeholder="Password"/>
                        </div>
						<div class="col-sm-6">
                          	<label  for="Name">Confirm Password: <span class="star">*</span>  </label>
							<input type="Password" name="txtConfirmPassword" id="txtConfirmPassword" class="form-control validate[required,equals[txtUserPassword]]" placeholder="Confirm Password"/>
						</div>
					</div>
					<div class="form-group col-sm-12">
						<div class="col-sm-6 "> 
							<label  for="Name"> Category : <span class="star">*</span> </label>
							
											<dl class="dropdown category_dropdown"> 
  
    <dt>
    <a href="javascript:void(0);">
      <span class="hida">Select Category</span>    
      <p class="multiSel"></p>  
    </a>
    </dt>
  
    <dd>
        <div class="mutliSelect">
            <ul>
			<?php
		
			$catname ="";
			
				foreach($arr_CategoryList as $usercatkey=> $usercat)
							{
																
						
							?>
                <li>
                    <input type="checkbox"  id="category_list1"  name="category_list1[]" datavalue="<?php echo $usercat?>" value="<?php echo $usercatkey?>"  /><?php echo $usercat?></li>
					<?php
					}?>
             
             
            </ul>
        </div>
    </dd>
 
</dl>
						
						</div>						
						<div class="col-md-6">
							<label  for="displayname">Display Name: <span class="star">*</span> </label>
							<input type="text" name="userdisplayname" id="userdisplayname" class="form-control validate[required]" placeholder="Display Name"/>										
						</div>
                    </div>
					<div class="form-group col-sm-12">
					
					</div>
              
             <div class="form-group col-sm-12 ">
			 <div class="col-sm-6"><button type="button" class="btn btn-primary btn-lg btn-block submit-button" onclick="return siteUserRegister();">Register</button></div>
             <div class="col-sm-6"><button type="reset" class="btn btn-primary btn-lg btn-block submit-button" data-dismiss="modal">Cancel</button></div>
			<div class="col-sm-12"><h5 class="member-login"><a  class="showusermodallogin" id="showusermodallogin" href="javascript:void(0);" class="text-olive">I am already a Member, Login Now</a></h5></div>
         </div>
                </div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
                <span>Register using social networks</span>
        <div class="social-network popup-social">
                    
						<?php echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'userloginfacebook', 'escape' => false)); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","facebook",'3'));
												echo $this->Form->hidden('socialuserfb',array('id'=>'userloginfacebook_process_url', 'value'=>$strFURL));?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-linkedin fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'userloginlinkedin')); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","linkedin",'3'));
												echo $this->Form->hidden('socialuserlk',array('id'=>'userloginlinkedin_process_url', 'value'=>$strFURL));
												
                    ?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-google-plus fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'userlogingmail')); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","gmail",'3'));
												echo $this->Form->hidden('socialusergplus',array('id'=>'userlogingmail_process_url', 'value'=>$strFURL));
												
                    ?>
					
                </div>
			</div>
      </div>
      
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>

<script type="text/javascript">

</script>
