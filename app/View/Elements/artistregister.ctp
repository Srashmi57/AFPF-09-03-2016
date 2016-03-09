<?php echo $this->Html->css('bootstrap-fileupload');
echo $this->Html->script('bootstrap-fileupload');
echo $this->Html->script('bootstrap-datepicker');


echo $this->Html->css('datepicker');
?>

  <div class="modal fade" id="modalartistRegister">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="frmartistRegister" id="frmartistRegister" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img width="60" height="50px" src="<?php echo Router::url('/',true)?>images/close-icon.png"></button>
        <h4 class="modal-title">Register</h4>
      </div>
      <div class="modal-body">
	  
			<div id="artisterrormsg"></div>
                <div class="form-group col-sm-12">
            		    <div class="col-sm-6">
						  <label  for="Name">First Name: <span class="star">*</span>  </label>
				 <input type="text" name="txtFirstName" id="txtFirstName" class="form-control validate[required,custom[onlyLetterSp]]" placeholder="First Name"/>
				   <input type="hidden" name="txtUsertype" id="txtUsertype" class="form-control" value="2"/>
								</div> 
                       <div class="col-sm-6">
								<label  for="Name">Last Name: <span class="star">*</span></label>
								 <input type="email" name="txtLastName" id="txtLastName" class="form-control validate[required,custom[onlyLetterSp]]" placeholder="Last Name"/>
								</div> 
						</div>
      
				 <div class="form-group col-sm-12">
	                   <div class="col-sm-6">
						<label  for="Name">Email: <span class="star">*</span>  </label>
                        <input type="email" name="txtUsername" id="txtUsername" class="form-control validate[required,[funcCall[validateEmail]]]" placeholder="Email"/>
                        </div>
                         <div class="col-sm-6">
                         <label  for="Name">Phone Number: <span class="star">*</span>  </label>
                        <input type="text" name="txtphonenumber" id="txtphonenumber" class="form-control validate[required,custom[phone]]" placeholder="Phone Number"/>
                         </div>
                    </div>
                 
                
                    <div class="form-group col-sm-12 ">
                        <div class="col-sm-6">
						<label  for="Name">Password: <span class="star">*</span>  </label>
                        <input type="Password" name="txtPassword" id="txtPassword" class="form-control validate[required,,minSize[6]]" placeholder="Password"/>
                        </div>
                           <div class="col-sm-6">
                          	<label  for="Name">Confirm Password: <span class="star">*</span>  </label>
                        <input type="Password" name="txtConfirmPassword" id="txtConfirmPassword" class="form-control validate[required,equals[txtPassword]" placeholder="Confirm Password"/>
                          </div>
                    </div>
               
                    <div class="form-group col-sm-12">
                      <div class="col-sm-6 ">
					  
					  
					  
				 <label  for="Name"> Category : <span class="star">*</span> </label>
		
												<dl class="dropdown category_dropdown"> 
  
    <dt>
    <a href="javascript:void(0);">
      <span class="hida">Select Categories</span>    
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
                    <input type="checkbox"  name="category_list[]" datavalue="<?php echo $usercat?>" value="<?php echo $usercatkey;?>" /><?php echo $usercat?></li>
					<?php
					}?>
             
             
            </ul>
        </div>
    </dd>
 
</dl>
                        </div>
                          <div class="col-sm-6">
				 <label  for="Name"> Sex <span class="star"></span> </label>
		
                <select id="selectssex" name="selectssex" class="form-control validate[required]"/>
                <option value="0">Please Select Sex</option>
                    <option value="male">Male</option>
                     <option value="female">Female</option>
                </select>
                        </div>
                    </div>
			
                  
               	 <div class="form-group col-sm-12">
	                   <div class="col-sm-6">
						<label  for="Name">Nationality:  </label>
                        <input type="email" name="txtNationality" id="txtNationality" class="form-control validate[custom[onlyLetterSp]]]" placeholder="Nationality "/>
                        </div>
                         <div class="col-sm-6">
                         <label  for="Name">Birth Date:  </label>
                        <input type="text" name="txtBirth" id="txtBirth" class="form-control " placeholder="mm/dd/yyyy"/>
                         </div>
                    </div>
						<div class="form-group col-sm-12">
						<div class="col-md-6">
								<label  for="displayname">Display Name:  <span class="star">*</span></label>
								<input type="text" name="displayname" id="displayname" class="form-control validate[required]" placeholder="Display Name"/>
										
                       </div>
				  </div>
                  <div class="form-group col-sm-12" align="center">
				  <form id="imageform" method="post" enctype="multipart/form-data">	
   
				    <div class="fileupload col-sm-12 fileupload-new" data-provides="fileupload">
						<div class="fileupload-new " align="center">

				 
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail">
					
					
						</div>
						<div>
							<span class="btn btn-file btn-lg btn-block image-upload register-image-upload"><span class="fileupload-new">UPLOAD IMAGE</span>
							<span class="fileupload-exists change">UPLOAD IMAGE</span><input type="file" name="artistimage" id="artistimage"/></span>
							<a href="#" class="btn fileupload-exists remove" data-dismiss="fileupload">Remove</a>
							
                    </div>
                    
                </div>
				     </form>

                   </div>
             <div class="form-group col-sm-12 ">
			  <div class="col-sm-6"><button type="button" class="btn btn-primary btn-lg btn-block submit-button" onclick="return siteArtistRegister();" >Register</button></div>
               <div class="col-sm-6"><button type="reset" class="btn btn-primary btn-lg btn-block submit-button" data-dismiss="modal">Cancel</button></div>
			<div class="col-sm-12"><h5 class="member-login"><a class="showartistmodallogin" id="showmodallogin" href="javascript:void(0);" class="text-olive">I am already a Member, Login Now</a></h5></div>
         </div>
                </div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
                <span>Register using social networks</span>
        <div class="social-network popup-social">
		<?php echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'artistfacebook', 'escape' => false)); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","facebook",'2'));
												echo $this->Form->hidden('',array('id'=>'artistfacebook_process_url', 'value'=>$strFURL,'name'=>'artistfacebook_process_url'));?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-linkedin fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'artistlinkedin')); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","linkedin",'2'));
												echo $this->Form->hidden('',array('id'=>'artistlinkedin_process_url', 'value'=>$strFURL,'name'=>'artistlinkedin_process_url'));
												
                    ?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-google-plus fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','value'=>'artistgmail')); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "social","register","gmail",'2'));
												echo $this->Form->hidden('',array('id'=>'artistgmail_process_url', 'value'=>$strFURL,'name'=>'artistgmail_process_url'));
												
                    ?>
                </div>
			</div>
      </div>
      
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>
 <script type="text/javascript">
  $(function(){ 
   $('#txtBirth').datepicker({  endDate: '+0d',
        autoclose: true});
});

</script>
