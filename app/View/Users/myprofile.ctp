<?php
echo $this->Html->script('bootstrap-datepicker');
echo $this->Html->css('datepicker');
echo $this->Html->css('bootstrap-editable');

echo $this->Html->script('bootstrap-editable.min');

echo $this->Html->css('jquery.treeview');
echo $this->Html->script('jquery.cookie');
echo $this->Html->script('jquery.treeview');
echo $this->Html->script('countartist');
echo $this->Html->script('demo');
echo $this->Html->css('cropper.min');
echo $this->Html->css('main_crop');
echo $this->Html->script('main');
echo $this->Html->script('cropper.min');

?>
<style type="text/css">
.nav_class_body{width: 100%;background-color: #fff;border: 1px solid #ccc;padding: 8px 15px;float: left;}
.sub_cat_list{margin: 0px 0;list-style: none;width:100%;border-bottom:none !important}
.sub_sub_cat_list{padding: 0px;margin: 3px;padding-left: 26px !important;}

.cat_list_checkbox007{
float: left;
display:none;
margin-right: -100px !important;
width: 90px !important;
height: 70px !important;
margin: 0 1px !important;
background-repeat: no-repeat !important;
background-size: contain !important;
-webkit-appearance: none !important;
-moz-appearance: none !important;
outline: 0 !important;
cursor:pointer;
}

.cat_list_checkbox008{

width: 90px !important;
height: 70px !important;
margin: 3px 1px !important;
margin-top: 1% !important;
margin-bottom: 1% !important;
background-repeat: no-repeat !important;
background-size: contain !important;
-webkit-appearance: none !important;
-moz-appearance: none !important;
outline: 0 !important;
cursor:pointer;
display:none;
border: 0 !important;
}
.cat_list_checkbox{
width: 90px !important;
height: 70px !important;
margin: 0px 1px !important;
background-repeat: no-repeat !important;
background-size: contain !important;
-webkit-appearance: none !important;
-moz-appearance: none !important;
outline: 0 !important;
cursor:pointer;
}

.cat_list_checkbox2{

height: 14px !important;
margin: 0 10px !important;

cursor:pointer;
}
.expandview ul li{border:none !important}
</style>
<script type="text/javascript">

	function validate()
	{	
		var isValidated = jQuery('#myprofile').validationEngine('validate');
	
	
		if(isValidated == false)
		{
			return false;
		}
	}  
</script>
   <?php $usertype_id = $arrWebUserProfile['Users']['usertype_id'];
		if(trim($arrWebUserProfile['Users']['user_moodmsg'])!='')
		{
			$moodmsg = $arrWebUserProfile['Users']['user_moodmsg'];
		}
		else
		{
			$moodmsg = 'Enter mood message';
		}
		?>
<?php 
	//print("<pre>");
	//print_r($arrWebUserProfile);
	//print_r($sub_cat_name);
	//exit;
	if($arrWebUserProfile['Users']['usertype_id']==2)
	{		
	  $strcss ="";
	  $stratrist="style='display:none'";
	}
	else
	{
	  $strcss = "style='display:none'";
	   $stratrist = "";
	}
	if($arrWebUserProfile['Users']['user_birth']=="0000-00-00")
	{
	  $birthdate ="";
	}
	else
	{
	  $birthdate = date('m/d/Y',strtotime($arrWebUserProfile['Users']['user_birth']));
	}	
?>	
<div class="container background" id="maincontent">
	<div class="updateprofile">
		<div class="modal-header"><h4 class="modal-title">UPDATE YOUR PROFILE</h4></div>
		<!-- main -->	
		<div class="col-md-12 " style="background-color: #f5f3f4;margin-bottom: 30px;">
		<div class="row form-group col-md-12">
				  <div class="col-md-12 form-group tagline">
			 <label>Tagline :&nbsp;</label> <a href="#" id="user_moodmsg" data-type="text"  data-title="Enter username" data-value="<?php echo $moodmsg;?>" ></a>
			  </div>
	   
	   <div class="col-md-6 form-group pull-right">
			<!--<div class="modal-header">
               <?php  echo "<h4 class='modal-title'>Profile Picture</h4>";?>
			   </div> -->
				<div class="row text-center">
                <div class="cms-bgloader-mask"></div>
				<div class="cms-bgloader"></div>
                <div  >
                    <div class="col-md-12 fileupload-new" align="center">
                    
                    <?php
						  $userfileimage = $arrWebUserProfile['Users']['user_image'];
						 $userfileimagepath = Router::url('/', true).'assets/websiteuser/'.$userfileimage;
						
						if(file_exists("assets/websiteuser/".$userfileimage) && $userfileimage!="")
						{
							$imagepath = $userfileimagepath;
							$id = "imgc";
							
							$cssstyle = "";
						
							?>
							 
							<?php
						}
						else
						{
							$imagepath = Router::url('/', true).'assets/default/user-icon-ap.png';
							$id="";
							$cssstyle = "style='display:none'";
							
						}
						
						
					
						
                   ?>
				   	 <div  id="crop-avatar">
						
    <!-- Current avatar -->
    <div class="avatar-view" style="float: left;width: 63%;" >
	<?php echo "<img id='imgc' style='' src='".$imagepath."' id=".$id."  >";?>
     <button class="image-upload" >Change Profile</button>
    </div>
	<?php
			
				if($current_user['usertype_id']==3)
				{?>

					<button class="image-upload becomeArtist" type="button" name="updateMembership" id="updateMembership" onclick="return fnBecomeArtist();">Become an Artist</button>

				<?php
				}?>
	

    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form class="avatar-form"  enctype="multipart/form-data" method="post" id="avatarform">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="60" height="50px"></button>
              <h4 class="modal-title" id="avatar-modal-label">Change Profile Picture</h4>
            </div>
            <div class="modal-body">
              <div class="avatar-body">

                <!-- Upload image and data -->
                <div class="avatar-upload">
                  <input class="avatar-src" name="avatar_src" type="hidden">
                  <input class="avatar-data" name="avatar_data" type="hidden">
                  <label for="avatarInput">Upload Picture</label>
                  <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                </div>

                <!-- Crop and preview -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-wrapper"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="avatar-preview preview-lg"></div>
                   
                  </div>
                </div>

                <div class="row avatar-btns">
                  <div class="col-md-9">
                    <div class="btn-group">
                      <button class="btn btn-default" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
                     
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-default" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
                     
                    </div>
                  </div>
                  <div class="col-md-3">
                    <button class="btn btn-success btn-block avatar-save"  id="updateprofpic"  type="button">Done</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="modal-footer">
              <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
            </div> -->
          </form>
        </div>
      </div>
    </div><!-- /.modal -->

    <!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
	</div>

			 
                    </div>
                 
                    
                </div>
				
				
            
				</div>
		 </div>	
		  </div>	
		<?php
		if($arrWebUserProfile['Users']['usertype_id']==3)
	{	
	   //echo "<p class='categorynote'> Note:- If you update categories, all the previously selected categories and subcatgories will be overwriiten with the new ones.</p>";
	}?>
			<form role="form" id="myprofile" class="myprofile col-md-12" method="POST">
				<div class="row form-group col-md-6" style="position: absolute;top: -176px;padding: 0;">
					<div class="col-md-12" style="margin-bottom: 20px;">
						<?php 
							echo $this->Form->input('firstname',array('label'=>'First name <span class="star">*</span>','class'=>'form-control validate[required,custom[onlyLetterSp]]','value'=>$arrWebUserProfile['Users']['user_fname']));
						?>
					</div>
					<div class="col-md-12">
						<?php 
							echo $this->Form->input('lastname',array('label'=>'Last name <span class="star">*</span>','class'=>'form-control validate[required,custom[onlyLetterSp]]','value'=>$arrWebUserProfile['Users']['user_lname']));
						?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('mydisplayname',array('label'=>'Display Name <span class="star">*</span>','class'=>'form-control validate[required]','value'=>$arrWebUserProfile['Users']['user_display_name']));
						?>
					</div>
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('phonenumber',array('label'=>'Phone Number <span class="star">*</span>','class'=>'form-control validate[required]','value'=>$arrWebUserProfile['Users']['user_mobileno']));
						?>
					</div>
				</div>
				<div class="row form-group" >
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('usernationlity',array('label'=>'Nationality &nbsp;<span></span>','class'=>' validate[custom[onlyLetterSp]]  form-control','value'=>$arrWebUserProfile['Users']['user_nationality']));
						?>
					</div>         
					<div class="col-md-6">
						<?php   
							$options = array(''=>'Please Select Sex','male'=>'Male','female'=>'Female');
							echo $this->Form->input('userSex',array('label'=>'Sex <span class="star">*</span>','type'=>'select','options'=>$options,'class'=>'validate[required] form-control','value'=>$arrWebUserProfile['Users']['user_sex']));
						?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('birthdate', array('type' => 'text', 'escape' => false,'class' =>'form-control','value' => $birthdate ));
						?>
					</div>
					<div class="col-md-6">
						<?php 
							echo $this->Form->input('biography', array('type' => 'textarea', 'escape' => false,'class' =>'form-control','value' => $arrWebUserProfile['Users']['user_biography'] ));
						?>
						</div>


					
				</div>
				
			
		
					<div class="row form-group" style="top:0px;position:relative;">
				
						
						<div class="col-md-12 expandview" >
						<label  for="Name">Category <span class="star">*</span></label>
										
           
			<?php
			$arrSelectedValue=array();
			$arrSelectedsubValue=array();
			$arrSelectedsubsubValue =array();
			
			$catname ="";
				if(count($arr_userCategory)>0)
				{
						foreach($arr_userCategory as $value)
								{
								
									$arrSelectedValue[]=$value['UserCategory']['category_id'];
								
								
								}
				}
				if(count($arr_usersubCategory)>0)
				{
						foreach($arr_usersubCategory as $usersubcat)
							{
								 	$arrSelectedsubValue[]=$usersubcat['subcat']['subcategory_id'];									
							}
				}
				if(count($arr_usersubsubCategory)>0)
				{
						foreach($arr_usersubsubCategory as $usersubcat)
							{
								 	$arrSelectedsubsubValue[]=$usersubcat['subsubcat']['subsubcategory_id'];									
							}
				}
			?>
             
             
           <?php
		   if($arrWebUserProfile['Users']['usertype_id']==3) { 
          ?>
		  <!-- New category view -->
		  <div class="nav_class_body">
			<?php $p=1;$j=1; foreach($arr_CategoryList as $usercatkey=> $usercat) {
                if($usercat=='Personality'){
					$usercat='PersonalityMain';
									
				}			
				$valuecatid = $usercatkey; 
                if($usercat=='Dance' || $usercat=='Photography' || $usercat=='Freestyle' || $usercat=='Personality' || $usercat=='PersonalityMain'){
				  $subsub_li_style = 'border-bottom: none;display:inline;padding-left: 26px !important;padding: 5px 0px !important;';
				  $subsub_txt_style = 'margin-bottom: 0% !important;margin-top: 1% !important;height: 71px;';
				  $subsub_flotli_style= 'float:left;';
				  $selected_style = 'float: left;margin-bottom: 0% !important;margin-top: 1% !important;height: 71px;';
				}else{
				  $subsub_li_style = 'border-bottom: none;padding-left: 26px !important;padding: 5px 0px !important;';
				  $subsub_txt_style ='';
				  $subsub_flotli_style= '';
				  $selected_style = '';
				}				
				if(in_array($usercatkey,$arrSelectedValue))
				{
					$selected="checked='checked'";
					$sub_list_style = 'display:block';
					$pFlag = 'check';
					$hide_main= 'display:none;';
					$hide_main_check= 'display:block;';
				}
				else
				{
					$selected='';
					$sub_list_style = 'display:none';
					$pFlag = '';
					$hide_main= '';
					$hide_main_check= '';
				}
					$arr_subCategoryList = $this->Caldays->getsubcategories($valuecatid);
			?>
			  <ul class="sub_cat_list">
			    <li>
				<input type="checkbox"  name="artistcategory_list[]" datavalue="<?php echo $usercat?>" value="<?php echo $valuecatid;?>" <?php echo $selected;?> <?php if($pFlag=='check'){?>style="<?php echo $hide_main;?>background-image: url('http://artformplatform.com/afpf/assets/category_list/<?php echo str_replace(' ', '',$usercat)?>check.png')"<?php }else{ ?>style="background-image: url('http://artformplatform.com/afpf/assets/category_list/<?php echo str_replace(' ', '',$usercat)?>.png')"<?php } ?> class="cat_list_checkbox c1"  id="maincat_<?php echo $p; ?>" onclick="ShowSubCat('<?php echo $p; ?>','<?php echo str_replace(' ', '',$usercat); ?>')" /><?php  //echo $usercat;?>
				
				<div  class="cat_list_checkbox008" style="<?php echo $hide_main_check;?>background-image: url('http://artformplatform.com/afpf/assets/category_list/<?php echo str_replace(' ', '',$usercat)?>check.png')" id="maincatcheck_<?php echo $p; ?>" onclick="ShowSubCheckCat('<?php echo $p; ?>','<?php echo str_replace(' ', '',$usercat); ?>')"></div>
				
				<?php if(count($arr_subCategoryList)>0){ ?>
				<ul id="sub_<?php echo $p; ?>" style="<?php echo $sub_list_style;?>">
					<?php
						foreach($arr_subCategoryList as $usersubcatkey=> $usersubcat)
							{
								if($usercat=='Music'){
								    if($usersubcat=='Electronic'){$usersubcat='ElectronicMusic';}
									if($usersubcat=='Jazz'){$usersubcat='JazzMusic';}
									if($usersubcat=='Instrumental'){$usersubcat='InstrumentalMusic';}
									if($usersubcat=='Accoustic'){$usersubcat='AccousticMusic';}
								}
								if($usercat=='Photography'){
								    if($usersubcat=='Sports'){$usersubcat='SportsPhotography';}
									
								}
								if($usercat=='Literature'){
								    if($usersubcat=='Comdey'){$usersubcat='ComdeyLiterature';}
									
								}
								if($usercat=='Art'){
								    if($usersubcat=='Design'){$usersubcat='DesignArt';}
									
								}
							if(in_array($usersubcatkey,$arrSelectedsubValue))
									{
									  $selected="checked='checked'";
									  $subsub_list_style = 'display:block';
									  $subsubFlag = 'check';
									  $hide_sub= 'display:none;';
					                  $hide_sub_check= 'display:block;';
									}
									else
									{
										$selected='';
										$subsubFlag = '';
										$subsub_list_style = 'display:none';
										$hide_sub= '';
					                    $hide_sub_check= '';
										
									}
							$arr_subsubCategoryList = $this->Caldays->getsubsubcategories($usersubcatkey);
					?>
						<li  style="<?php echo $subsub_li_style;?>">
						   <div style="<?php echo $selected_style;?>">
							<input type="checkbox"  name="subcategory_list1[]" datavalue="<?php echo $usersubcatkey?>" value="<?php echo $usersubcatkey;?>" <?php echo $selected;?> <?php if($subsubFlag=='check'){?>style="<?php echo $hide_sub;?><?php echo $subsub_txt_style;?>height: 14px;<?php echo $subsub_flotli_style;?>margin: 0 10px;background-image: url('http://artformplatform.com/afpf/assets/category_list/<?php echo str_replace(' ', '',$usersubcat)?>check.png')"<?php }else{?>style="<?php echo $subsub_txt_style;?>height: 14px;<?php echo $subsub_flotli_style;?>margin: 0 10px;background-image: url('http://artformplatform.com/afpf/assets/category_list/<?php echo str_replace(' ', '',$usersubcat)?>.png')"<?php } ?> id="mainsubcat_<?php echo $j; ?>" class="subscat_<?php echo $p; ?> mainsubcat_<?php echo $p; ?> cat_list_checkbox" onclick="ShowSubSubCat('<?php echo $j; ?>','<?php echo str_replace(' ', '',$usersubcat); ?>')"/><?php  //echo $usersubcat;?>
							
                            <div  class="cat_list_checkbox008 mainsubcatcheck_<?php echo $p; ?>" style="<?php echo $hide_sub_check;?><?php echo $subsub_flotli_style;?>height: 14px;margin: 0 10px;background-image: url('http://artformplatform.com/afpf/assets/category_list/<?php echo str_replace(' ', '',$usersubcat)?>check.png')" id="mainsubcatcheck_<?php echo $j; ?>" onclick="ShowSubSubCheckCat('<?php echo $j; ?>','<?php echo str_replace(' ', '',$usersubcat); ?>','<?php echo $usercat; ?>','<?php echo $p; ?>')"></div>
							
							</div>
							<?php if(count($arr_subsubCategoryList)>0)
		                    { ?>
						    
						    <div class="sub_sub_cat_list sub_<?php echo $p;?>" id="subsub_<?php echo $j; ?>" style="<?php echo $subsub_list_style;?>">
							<table cellpadding="10" style="width: 100%;">
								<tr>
								<?php
				                  $jj=1;
									foreach($arr_subsubCategoryList as $usersubsubcatkey=> $usersubsubcat)
											{
											
											 if($usercat=='Music'){
											  if($usersubcat=='Hip Hop'){
												if($usersubsubcat=='Rap'){$usersubsubcat='Rapmusic';}
												
												}
												if($usersubcat=='Acapella'){
												if($usersubsubcat=='Pop'){$usersubsubcat='Popmusic';}
												
												}
											}
											 if($usercat=='Film'){
											  if($usersubcat=='Documentary'){
												if($usersubsubcat=='Sports'){$usersubsubcat='Sportsmusic';}
												
												}
												
											}
											if($usercat=='Literature'){
											  if($usersubcat=='ComdeyLiterature'){
												if($usersubsubcat=='Mime'){$usersubsubcat='MimeLiterature';}
												
												}
												
											}
											 $usersubsubcat = str_replace('&', '',$usersubsubcat);
											if(in_array($usersubsubcatkey,$arrSelectedsubsubValue))
													{
													  $selected="checked='checked'";
													  $subsubsubFlag = 'check';
													  $hide_sub_sub= 'display:none;';
					                                  $hide_sub_sub_check= 'display:block;';
													}
													else
													{
														$selected='';
														$subsubsubFlag = '';
														$hide_sub_sub= '';
					                                    $hide_sub_sub_check= '';
													}
											?>
								 <td style="float: left;padding-top: 1%;padding-bottom: 1%;padding-left: 0%;padding-right: 0%;">
								 <div style="width:100%;float:left;height: 72px;">
									<input type="checkbox"  name="subsubcategory_list1[]" datavalue="<?php echo $usersubsubcatkey?>" value="<?php echo $usersubsubcatkey;?>" <?php echo $selected;?> <?php if($subsubsubFlag=='check'){?>style="<?php echo $hide_sub_sub;?>float:left;height: 14px;margin: 0 10px;background-image: url('http://artformplatform.com/afpf/assets/category_list/<?php echo str_replace(' ', '',$usersubsubcat)?>check.png')"<?php }else{?>style="float:left;height: 14px;margin: 0 10px;background-image: url('http://artformplatform.com/afpf/assets/category_list/<?php echo str_replace(' ', '',$usersubsubcat)?>.png')"<?php } ?> id="mainsubsubcat_<?php echo $j; ?>_<?php echo str_replace(' ', '',$usersubsubcat); ?>_<?php echo $jj;?>" class="mainsubcat_<?php echo $p; ?> pop_<?php echo $j; ?> cat_list_checkbox lastcat_<?php echo $j; ?>_<?php echo $p; ?>"  onclick="ShowSubSubSubCat('<?php echo $j; ?>','<?php echo str_replace(' ', '',$usersubsubcat); ?>','<?php echo $jj;?>')"/><?php //echo $usersubsubcat?>
									
									<div  class="mainsubcatcheck_<?php echo $p; ?> cat_list_checkbox008 popcheck popcheck_<?php echo $j; ?>" style="<?php echo $hide_sub_sub_check;?>float:left;height: 14px;margin: 0 10px;background-image: url('http://artformplatform.com/afpf/assets/category_list/<?php echo str_replace(' ', '',$usersubsubcat)?>check.png')" id="mainsubsubcatcheck_<?php echo $j; ?>_<?php echo str_replace(' ', '',$usersubsubcat); ?>_<?php echo $jj;?>" onclick="ShowSubSubSubCatcheck('<?php echo $j; ?>','<?php echo str_replace(' ', '',$usersubsubcat); ?>','<?php echo $jj;?>','<?php echo $p; ?>','<?php echo $usersubcat; ?>')"></div>
									</div>
								  </td>
								<?php
								$jj++;
									}
								?>
								</tr>
								</table>
							</div>
							<?php } ?>
						</li>
					<?php $j++; } ?>
				</ul>
			<?php } ?>
				</li>
			  </ul>
			<?php $p++; } ?>
		  </div>
		  <!-- End here -->
	   <!-- <ul id="navigation">
		
	<?php
		foreach($arr_CategoryList as $usercatkey=> $usercat)
							{
									$valuecatid = $usercatkey;							
								if(in_array($usercatkey,$arrSelectedValue))
									{
									  $selected="checked='checked'";
									}
									else
									{
										$selected='';
									}
									$arr_subCategoryList = $this->Caldays->getsubcategories($valuecatid);
									
									?>
									
		<li><input type="checkbox"  name="artistcategory_list[]" datavalue="<?php echo $usercat?>" value="<?php echo $valuecatid;?>" <?php echo $selected;?> /><?php echo $usercat?>
		<?php if(count($arr_subCategoryList)>0)
		{?>
		<ul>
		<?php
		foreach($arr_subCategoryList as $usersubcatkey=> $usersubcat)
							{
							
							if(in_array($usersubcatkey,$arrSelectedsubValue))
									{
									  $selected="checked='checked'";
									}
									else
									{
										$selected='';
									}
							$arr_subsubCategoryList = $this->Caldays->getsubsubcategories($usersubcatkey);
							?>
			
				<li>
				<input type="checkbox"  name="subcategory_list1[]" datavalue="<?php echo $usersubcatkey?>" value="<?php echo $usersubcatkey;?>" <?php echo $selected;?> /><?php echo $usersubcat?> 
						<?php if(count($arr_subsubCategoryList)>0)
		{?>
				<ul>
		
				<?php
				
				foreach($arr_subsubCategoryList as $usersubsubcatkey=> $usersubsubcat)
							{
							if(in_array($usersubsubcatkey,$arrSelectedsubsubValue))
									{
									  $selected="checked='checked'";
									}
									else
									{
										$selected='';
									}
							?>
							<li><input type="checkbox"  name="subsubcategory_list1[]" datavalue="<?php echo $usersubsubcatkey?>" value="<?php echo $usersubsubcatkey;?>" <?php echo $selected;?> /><?php echo $usersubsubcat?> </li>
							<?php
							}
					
							?>
							
							</ul>
							<?php
					}
					?>
				
				</li>
				
<?php
}
	?>			
			</ul>	<?php
			}?>
		</li>
		
			
	
<?php
}?>
</ul> -->
<?php
}
else
{
?>
<dl class="dropdown_cat category_dropdown"> 
  
    <dt>
    <a href="javascript:void(0);">
      <span class="hida">Selected Categories</span>    
      <p class="multiSel"></p>  
    </a>
    </dt>
  
    <dd>
        <div class="mutliSelect">
            <ul>
			<?php
			$arrSelectedValue=array();
			$catname ="";
				if(count($arr_userCategory)>0)
				{
						foreach($arr_userCategory as $value)
								{
								
									$arrSelectedValue[]=$value['UserCategory']['category_id'];
								
								
								}
				}
				foreach($arr_CategoryList as $usercatkey=> $usercat)
							{
									$valuecatid = $usercatkey;							
								if(in_array($usercatkey,$arrSelectedValue))
									{
									  $selected="checked='checked'";
									}
									else
									{
										$selected='';
									}
							?>
                <li>
                    <input type="checkbox"  name="artistcategory_list[]" datavalue="<?php echo $usercat?>" value="<?php echo $valuecatid;?>" <?php echo $selected;?> /><?php echo $usercat?></li>
					<?php
					}?>
             
             
            </ul>
        </div>
    </dd>
 
</dl>
						
<?php

}
	?>				
       
						
					</div> 
					
					</div>
					
					
				<div class="row form-group">
					<div class="col-md-3 col-md-offset-3 text-center">
						<?php 
							echo $this->Form->submit(__('Submit',true), array('class'=>'btn myprofile_btn','onClick'=>'return validate(); '));
							$this->Form->end('');
						?>
					</div>
					<div class="col-md-3 text-center">
					<div class="btn myprofile_btn">Cancel</div>
						
					</div>
				</div>					
			</form>			
		</div>
	</div>
</div>
<?php 
	echo $this->element('changepass');
echo $this->element('becomeartmodal'); 
?>

<script type='text/javascript'>
$('#birthdate').datepicker({endDate: '+0d',
        autoclose: true});
			var total=0;
			 var updateselctedarry = new Array();
			 var updatesubsubselctedarry = new Array();
		$('.updateprofile .dropdown_subcat dt a').on('click', function () {
		
          $('.updateprofile .dropdown_subcat dd ul').slideToggle('fast');
      });
	  $('.updateprofile .dropdown_subcat dd ul li a').on('click', function () {
          $('.updateprofile .dropdown_subcat dd ul').hide();
      });
	  
	  	$('.updateprofile .dropdown_subsubcat dt a').on('click', function () {
		
          $('.updateprofile .dropdown_subsubcat dd ul').slideToggle('fast');
      });
	  $('.updateprofile .dropdown_subsubcat dd ul li a').on('click', function () {
          $('.updateprofile .dropdown_subsubcat dd ul').hide();
      });
	  
	  	$('.updateprofile .dropdown_cat dt a').on('click', function () {
		
          $('.updateprofile .dropdown_cat dd ul').slideToggle('fast');
      });
	  $('.updateprofile .dropdown_cat dd ul li a').on('click', function () {
          $('.updateprofile .dropdown_cat dd ul').hide();
      });
	  
	  $(".updateprofile .dropdown_cat input:checkbox:checked").each(function(){ updateselctedarry.push($(this).val()); });
		$('.updateprofile .dropdown_cat .mutliSelect input[type=checkbox]').on('click', function () { 
		
		
			  if ($(this).is(':checked')) {
			  
			if(updateselctedarry.length>4)
			{
				
				bootbox.alert("Select only five Category");
				$(this).checked = false ;
				return false;
			}
			updateselctedarry.push($(this).val());
				$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/getupdateSubcategoriesList/"+updateselctedarry,
			
			cache: false,
			success: function(data)
			{
				var items = [];
				var count=0;
			
				$('.lblsubcat').css('display','block');
				  $('.userdynasubcat').html(data); 
				
				$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); 
				 
			}
	});
			
             
		}
		else
		{
			if(updateselctedarry.length<=1)
				{
				 bootbox.alert("Please select atleast one category");
				  return false;
					
				}
			  for(var i = updateselctedarry.length - 1; i >= 0; i--) {
							
					
						
								if(updateselctedarry[i] === $(this).val()) {
								   updateselctedarry.splice(i, 1);
								}
							
			}
			
					  $.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/getupdateSubcategoriesList/"+updateselctedarry,
			
			cache: false,
			success: function(data)
			{
				var items = [];
				var count=0;
			
			
				  $('.userdynasubcat').html(data); 
				
				$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); 
				 
			}
	});
		}
		});

		
			  $(".updateprofile .dropdown_subcat input:checkbox:checked").each(function(){ updatesubsubselctedarry.push($(this).val()); });
		$('.updateprofile .dropdown_subcat .mutliSelect input[type=checkbox]').on('click', function () { 
		
	
			  if ($(this).is(':checked')) {
			  
			if(updatesubsubselctedarry.length>4)
			{
				
				bootbox.alert("Select only five subcategory");
				$(this).checked = false ;
				return false;
			}
			updatesubsubselctedarry.push($(this).val());
				$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/getupdateSubSubcategoriesList/"+updatesubsubselctedarry,
			
			cache: false,
			success: function(data)
			{
				var items = [];
				var count=0;
			
				$('.lblsubcat').css('display','block');
				  $('.userdynasubsubcat').html(data); 
				
				$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); 
				 
			}
	});
			
             
		}
	});
		
</script>

<script type="text/javascript" language="javascript">

jQuery(document).ready(function() { 
       //edit form style - popup or inline
        $.fn.editable.defaults.mode = 'inline';
        $('#user_moodmsg').editable({
            validate: function(value) {
			if(value.length>141)
			 return 'length must be 141 chars.';
                if($.trim(value) == '') 
                    return 'Value is required.';
        },
        type: 'text',
		placeholder:'Whats in your mind!',
        url:strGlobalSiteBasePath+"<?php echo $current_controller;?>/UpdateUserMoodMsg/",
		 title: 'Enter username',
        send:'always',
        ajaxOptions: {
        dataType: 'json'
		
        },
		

	error: function (xhr, status, error) {
					
				   location.reload();
				}
		 })
	 
	 }); 
	 
	 
	

$('#updateprofpic').on('click',function()
	{
			
	var user_id = '<?php  echo $this->Session->read('Auth.WebsitesUser.user_id');?>';
	
	$('.cms-bgloader-mask').show();//show loader mask
	$('.cms-bgloader').show(); //show loading image
	
	var url = strGlobalSiteBasePath+"<?php echo $current_controller;?>/UpdateWebsiteProfpic/"+user_id+"/";
		
		var type = "POST";
		
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			
				$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); //show loading image
				if(responseText.status="success")
				{
					
					$("#avatar-modal").modal('hide');
					window.location.reload();
				
						
					
				}
				
			},	
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			 dataType:  'json'    // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#avatarform').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		
		});
	
//New js for categories

function ShowSubCat(mainId,usercatname) {
	var usersubcat_l = usercatname.replace(/\s+/, "");
	if ($('#maincat_'+mainId).is(":checked")) {
	    $('#maincatcheck_'+mainId).show();
		$('.sub_'+mainId).show();
		
		$('#maincat_'+mainId).css("display", "none");
		$('#sub_'+mainId).show();
		
		$('.mainsubcat_'+mainId).prop('checked', true);
		
		$('.mainsubcat_'+mainId).each(function() {
		
		  $(this).css("display", "none");
		});
		
		$('.mainsubcatcheck_'+mainId).each(function() {
		  $(this).css("display", "block");
		});
		
		
	    $('#maincat_'+mainId).css('background-image', 'url(http://artformplatform.com/afpf/assets/category_list/'+usersubcat_l+'check.png)');
	    
        
		
	} else {
		
		
		
		    $('#maincat_'+mainId).css('background-image', 'url(http://artformplatform.com/afpf/assets/category_list/'+usersubcat_l+'.png)');
			//document.getElementsByClassName("mainsubcat_"+mainId).checked = false;
			$('.mainsubcat_'+mainId).removeAttr('checked');
			
			$('.mainsubcat_'+mainId).each(function() {
				var backGroundImage = $(this).css('background-image');
				$(this).css('background-image', backGroundImage.replace("check",""));
			    
			});
			
			
			$('#sub_'+mainId).hide();
			$('.sub_'+mainId).hide();
		
		
	}
}
function ShowSubCheckCat(mainId,usercatname) {
	  
	  var usersubcat_l = usercatname.replace(/\s+/, "");
	  
	  $('#maincat_'+mainId).css('background-image', 'url(http://artformplatform.com/afpf/assets/category_list/'+usersubcat_l+'.png)');
	  $('.mainsubcat_'+mainId).removeAttr('checked');
	  
	  $('.mainsubcat_'+mainId).css("display", "block");
	  $('.mainsubcatcheck_'+mainId).css("display", "none");
	  $('.pop_'+mainId).css("display", "block");
	  $('.popcheck').css("display", "none");
	  
	  $('#maincat_'+mainId).removeAttr('checked');
	  $('#maincatcheck_'+mainId).hide();
	  $('#maincat_'+mainId).css("display", "block");
			$('.mainsubcat_'+mainId).each(function() {
				var backGroundImage = $(this).css('background-image');
				$(this).css('background-image', backGroundImage.replace("check",""));
			    
			});
			$('#sub_'+mainId).hide();
			$('.sub_'+mainId).hide();
		
		
	
}
// Second part 

function ShowSubSubCheckCat(mainId,usersubcat,maincatname,mcatid) {
    var total=$('.subscat_'+mcatid+':checkbox:checked').length;
	
	var usersubcat_l = usersubcat.replace(/\s+/, "");
	
    $('#mainsubcat_'+mainId).css('background-image', 'url(http://artformplatform.com/afpf/assets/category_list/'+usersubcat_l+'.png)');
	$('#mainsubcat_'+mainId).removeAttr('checked');
	$('#mainsubcatcheck_'+mainId).hide();
	$('#mainsubcat_'+mainId).css("display", "block");
	
	$('.pop_'+mainId).removeAttr('checked');
	
			$('.pop_'+mainId).each(function() {
				var backGroundImage = $(this).css('background-image');
				$(this).css('background-image', backGroundImage.replace("check",""));
			    
			});
			
			$('#subsub_'+mainId).hide();
	if(total==1){
		var maincatname = maincatname.replace(/\s+/, "");
		$('#maincat_'+mcatid).css('background-image', 'url(http://artformplatform.com/afpf/assets/category_list/'+maincatname+'.png)');
		$('#maincat_'+mcatid).removeAttr('checked');
		$('#maincatcheck_'+mcatid).hide();
		$('#maincat_'+mcatid).css("display", "block");
		$('#sub_'+mcatid).hide();
		$('.sub_'+mcatid).hide();
	}
		
		
	
}
function ShowSubSubCat(mainId,usersubcat) {
	var usersubcat_l = usersubcat.replace(/\s+/, "");
	
	if ($('#mainsubcat_'+mainId).is(":checked")) {
	   
		$('#mainsubcatcheck_'+mainId).show();
		$('#mainsubcat_'+mainId).css("display", "none");
		
        $('#mainsubcat_'+mainId).css('background-image', 'url(http://artformplatform.com/afpf/assets/category_list/'+usersubcat_l+'check.png)');
		$('#subsub_'+mainId).show();
		
        $('.pop_'+mainId).prop('checked', true);
		
		$('.pop_'+mainId).each(function() {
		
		  $(this).css("display", "none");
		});
		
		$('.popcheck_'+mainId).each(function() {
		  $(this).css("display", "block");
		});
	
	} else {
		//document.getElementById("mainsubsubcat_"+mainId).checked = false;
		
		  $('#mainsubcat_'+mainId).css('background-image', 'url(http://artformplatform.com/afpf/assets/category_list/'+usersubcat_l+'.png)');
			$('.pop_'+mainId).removeAttr('checked');
			
			$('.pop_'+mainId).each(function() {
				var backGroundImage = $(this).css('background-image');
				$(this).css('background-image', backGroundImage.replace("check",""));
			    
			});
			
			$('#subsub_'+mainId).hide();
		
		
		
	}
}
//Third part

function ShowSubSubSubCat(mainId,usersubcat,usid) {

	var usersubcat_l = usersubcat.replace(/\s+/, "");
	var usersubcat_l = usersubcat_l.replace(/\s+/, "");
	var usersubcat_l = usersubcat_l.replace('&', "");
	
	if ($('#mainsubsubcat_'+mainId+'_'+usersubcat_l+'_'+usid).is(":checked")) {
	   
		$('#mainsubsubcatcheck_'+mainId+'_'+usersubcat_l+'_'+usid).show();
	    $('#mainsubsubcat_'+mainId+'_'+usersubcat_l+'_'+usid).css("display", "none");
	
        $('#mainsubsubcat_'+mainId+'_'+usersubcat_l+'_'+usid).css('background-image', 'url(http://artformplatform.com/afpf/assets/category_list/'+usersubcat_l+'check.png)');
		//$('#subsub_'+mainId).show();
	
	} else {
		//document.getElementById('#mainsubsubcat_'+mainId+'_'+usersubcat_l).checked = false;
		
		  $('#mainsubsubcat_'+mainId+'_'+usersubcat_l+'_'+usid).css('background-image', 'url(http://artformplatform.com/afpf/assets/category_list/'+usersubcat_l+'.png)');
			//$('.pop_'+mainId).removeAttr('checked');
			$('#mainsubsubcat_'+mainId+'_'+usersubcat_l+'_'+usid).removeAttr('checked');
			//$('#subsub_'+mainId).hide();
		
		
		
	}
}

function ShowSubSubSubCatcheck(mainId,usersubcat,usid,hid,catname) {
    
    var total=$('.lastcat_'+mainId+'_'+hid+':checkbox:checked').length;
	
	var usersubcat_l = usersubcat.replace(/\s+/, "");
	var usersubcat_l = usersubcat_l.replace(/\s+/, "");
	var usersubcat_l = usersubcat_l.replace('&', "");
	
	$('#mainsubsubcatcheck_'+mainId+'_'+usersubcat_l+'_'+usid).hide();
	$('#mainsubsubcat_'+mainId+'_'+usersubcat_l+'_'+usid).css("display", "block");
	

		//document.getElementById('#mainsubsubcat_'+mainId+'_'+usersubcat_l).checked = false;
		
	   $('#mainsubsubcat_'+mainId+'_'+usersubcat_l+'_'+usid).css('background-image', 'url(http://artformplatform.com/afpf/assets/category_list/'+usersubcat_l+'.png)');
			//$('.pop_'+mainId).removeAttr('checked');
			$('#mainsubsubcat_'+mainId+'_'+usersubcat_l+'_'+usid).removeAttr('checked');
			//$('#subsub_'+mainId).hide();
	if(total == 1){
	var catname = catname.replace(/\s+/, "");
	
    $('#mainsubcat_'+mainId).css('background-image', 'url(http://artformplatform.com/afpf/assets/category_list/'+catname+'.png)');
	$('#mainsubcat_'+mainId).removeAttr('checked');
	$('#mainsubcatcheck_'+mainId).hide();
	$('#mainsubcat_'+mainId).css("display", "block");
	$('#subsub_'+mainId).hide();
	}
		
		
	
}
</script>