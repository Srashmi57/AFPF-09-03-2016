<?php $vehicleID = $arrWebHomeDetailstock[0]['wcz_vehicle']['vid'];?>
<script type="text/javascript">

function existresisterd()
{
	$('#enquiryform').hide();
	fnwebPopOpen("enquiryuserexist");

}

function fnenquiry()
{
	
	
	document.getElementById('conformationcode').value="";
	document.getElementById('resisterdno').value="";
	$('#visitorinq_div5').show();
	$("#visitorinq_div6").attr("style", "visibility:hidden;");
	$('#enquiryuserexist').hide();
	fnwebPopOpen("enquiryform");

}
function fnenquiryafterlogin()
{
	//alert('hi');
	//var isValidated = jQuery('#enquirylogin').validationEngine('validate');
		var vid=$('#vid').val();
		//alert(vid);
		$('.cms-bgloader-mask').show();//show loader mask
		$('.cms-bgloader').show(); //show loading image
		
		 var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnAddToVisistorInq/"?>";
		
		
		
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
				
				alert("enquiry added successfully");
				
				$('.cms-bgloader-mask').hide();//hide loader mask
				$('.cms-bgloader').hide(); //hide loading image
				window.location.reload(true);
				}
				if(responseText.status == "alreadyenquiry")
				{
				
				alert("You have already added enquiry on this car");
				
				$('.cms-bgloader-mask').hide();//hide loader mask
				$('.cms-bgloader').hide(); //hide loading image
				//window.location.reload(true);
				}
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
		
	
	
	$('#enquirylogin').ajaxSubmit(options); 
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false; 
	
	
}
function fnenquiryexist()
{
	
	var resistrdphoneno = $('#resistrdphoneno').val();
	var conformationcode= $('#conformationcode').val();
	var vid=$('#vid').val();
	var isValidated = jQuery('#enquiryuserexistform').validationEngine('validate');
 
	 if(isValidated == false)
	{
	return false;
	}
	
	else
	{
		$('.cms-bgloader-mask').show();//show loader mask
		$('.cms-bgloader').show(); //show loading image
		if(conformationcode!="")
		{
		var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnconformation/"?>";
		
		}
		else
		{
		
		var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnRegister/"?>";
		}
		
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				
				
				if(conformationcode != "")
				{
				if(responseText.status == "fail")
					
					{
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					
					alert("Please enter correct code");
					
					
					
					}
				if(responseText.status == "success")
					{
					
					
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					var datastr = "vid="+vid;
					var url=  "<?php echo Router::url('/', true).$this->params['controller']."/fnAddToVisistorInq/"?>";
					$.ajax({
						type: "POST",
						url: url,
						data: datastr,
						cache: false,
						dataType: 'json',
						success: function(data)
						{
							Respstatus = data.status;
							
							if(Respstatus=="success")
							{
								
								alert("Your enquiry has been submited successsfully");
								window.location.reload(true);
							
							}
							if(Respstatus == "alreadyenquiry")
							{
							
							alert("You have already added enquiry on this car");
							
							$('.cms-bgloader-mask').hide();//hide loader mask
							$('.cms-bgloader').hide(); //hide loading image
							//window.location.reload(true);
							}
						
						}
							
						
						});
					
					
					
					}
					
				
				
				
				
				
				
				
				}
			else
			{
					if(responseText.status == "resend")
					{
						$('.cms-bgloader-mask').hide();//hide loader mask
						$('.cms-bgloader').hide(); //hide loading image
						
						
						document.getElementById('visitorinq_div5').style.display = 'none';
						document.getElementById('visitorinq_div6').style.visibility = 'visible';
						document.getElementById('conformationcode').value = responseText.code;
						var confirmationcode=document.getElementById('code').value;
						var strcode=responseText.code;
						
						
						
						
					
					}
					
					if(responseText.status == "existinguser")
					{
					
					
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					var datastr = "vid="+vid;
					var url=  "<?php echo Router::url('/', true).$this->params['controller']."/fnAddToVisistorInq/"?>";
					$.ajax({
						type: "POST",
						url: url,
						data: datastr,
						cache: false,
						dataType: 'json',
						success: function(data)
						{
							Respstatus = data.status;
							
							if(Respstatus=="success")
							{
								
								alert("Your enquiry has been submited successsfully");
								window.location.reload(true);
							
							}
							if(Respstatus == "alreadyenquiry")
							{
							
							alert("You have already added enquiry on this car");
							
							$('.cms-bgloader-mask').hide();//hide loader mask
							$('.cms-bgloader').hide(); //hide loading image
							//window.location.reload(true);
							}
						}
							
						
						});
					
					
					
					}
					
					
					if(responseText.status == "success")
					{
					
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					var datastr = "vid="+vid;
					var url=  "<?php echo Router::url('/', true).$this->params['controller']."/fnAddToVisistorInq/"?>";
					$.ajax({
						type: "POST",
						url: url,
						data: datastr,
						cache: false,
						dataType: 'json',
						success: function(data)
						{
							Respstatus = data.status;
							
							if(Respstatus=="success")
							{
								
								alert("Your enquiry has been submited successsfully");
								window.location.reload(true);
							
							}
							if(Respstatus == "alreadyenquiry")
							{
							
							alert("You have already added enquiry on this car");
							
							$('.cms-bgloader-mask').hide();//hide loader mask
							$('.cms-bgloader').hide(); //hide loading image
							//window.location.reload(true);
							}
						}
							
						
						});
					
					
					}
					
					if(responseText.status == "alreadyenquiry")
					{
					
					alert("You Have already enquiry on this car");
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					window.location.reload(true);
					}
				
			
			}
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
		
	
	
	$('#enquiryuserexistform').ajaxSubmit(options); 
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false; 
	
	}


}

function fncontactsubmit()
	{
	
	
	var isConformationForm = $('#conformationcode').val();
	var code=$('#code').val();
	var phoneno=$('phoneno').val();
	var vid=$('#vid').val();
	//alert(phoneno);
	//alert(vid);
	//alert("hi"+isConformationForm);
	//alert(code);
	var isValidated = jQuery('#enquiryres').validationEngine('validate');
 
	 if(isValidated == false)
	{
	return false;
	}
	
	else
	{
		$('.cms-bgloader-mask').show();//show loader mask
		$('.cms-bgloader').show(); //show loading image
		if(isConformationForm != "")
		{
		var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnconformation/"?>";
		}
		else
		{
		 var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnRegister/"?>";
		//alert(url);
		}
		
		//alert(url);
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(isConformationForm != "")
				{
				if(responseText.status == "fail")
					
					{
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					
					alert("Please enter correct code");
					
					
					
					}
				if(responseText.status == "success")
					{
					
					
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					var datastr = "vid="+vid;
					var url=  "<?php echo Router::url('/', true).$this->params['controller']."/fnAddToVisistorInq/"?>";
					$.ajax({
						type: "POST",
						url: url,
						data: datastr,
						cache: false,
						dataType: 'json',
						success: function(data)
						{
							Respstatus = data.status;
							
							if(Respstatus=="success")
							{
								
								alert("Your enquiry has been submited successsfully");
								window.location.reload(true);
							
							}
						}
							
						
						});
					
					
					
					}
					
				
				
				
				
				
				
				
				}
			else
				
			{
				if(responseText.status == "alreadyenquiry")
					{
					
					alert("You Have already enquiry on this car");
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					window.location.reload(true);
					}
				
				
				if(responseText.status == "resend")
				{
				
						$('.cms-bgloader-mask').hide();//hide loader mask
						$('.cms-bgloader').hide(); //hide loading image
						
						document.getElementById('visitorinq_div').style.display = 'none';
						document.getElementById('visitorinq_div1').style.display = 'none';
						document.getElementById('visitorinq_div2').style.display = 'none';
						document.getElementById('visitorinq_div4').style.display = 'none';
						document.getElementById('visitorinq_div3').style.visibility = 'visible';
						document.getElementById('alreadylink').style.display = 'none';
						document.getElementById('conformationcode').value = responseText.code;
						var confirmationcode=document.getElementById('code').value;
						//alert("below"+confirmationcode);
						var strcode=responseText.code;
				
				}
				if(responseText.status == "useradded")
					
				{
						$('.cms-bgloader-mask').hide();//hide loader mask
						$('.cms-bgloader').hide(); //hide loading image
						document.getElementById('visitorinq_div').style.display = 'none';
						document.getElementById('visitorinq_div1').style.display = 'none';
						document.getElementById('visitorinq_div2').style.display = 'none';
						document.getElementById('visitorinq_div4').style.display = 'none';
						document.getElementById('visitorinq_div3').style.visibility = 'visible';
						document.getElementById('alreadylink').style.display = 'none';
						document.getElementById('conformationcode').value = responseText.code;
						var confirmationcode=document.getElementById('code').value;
						var strcode=responseText.code;
				}
					
			
				if(responseText.status == "success")
					{
					
					
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					var datastr = "vid="+vid;
					var url=  "<?php echo Router::url('/', true).$this->params['controller']."/fnAddToVisistorInq/"?>";
					$.ajax({
						type: "POST",
						url: url,
						data: datastr,
						cache: false,
						dataType: 'json',
						success: function(data)
						{
							Respstatus = data.status;
							
							if(Respstatus=="success")
							{
								
								alert("Your enquiry has been submited successsfully");
								window.location.reload(true);
							
							}
						}
							
						
						});
					
					
					
					}
			
				if(responseText.status == "existinguser")
					{
					
					
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					var datastr = "vid="+vid;
					var url=  "<?php echo Router::url('/', true).$this->params['controller']."/fnAddToVisistorInq/"?>";
					$.ajax({
						type: "POST",
						url: url,
						data: datastr,
						cache: false,
						dataType: 'json',
						success: function(data)
						{
							Respstatus = data.status;
							
							if(Respstatus=="success")
							{
								
								alert("Your enquiry has been submited successsfully");
								window.location.reload(true);
							
							}
						}
							
						
						});
					
					
					
					}
			
			
			}
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
		
	
	
	$('#enquiryres').ajaxSubmit(options); 
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false; 
	
	}
}
</script>


    <div class="cms-bgloader-mask"></div>
    <div class="cms-bgloader"></div>
    <div id="alertgeneric-popupmask"></div>
   
    <div id="enquiryuserexist" class="alertgeneric-popup">
    	<?php 
		$strcontactformUrl = Router::url(array('controller'=>'websites','action'=>'detail'),true);
		//echo $this->Form->create('Search',array('action'=>$strSearchBrandUrl));
	?>
	<div class="topbg"><div class="tittle">Contact information</div>
	 <br clear="all" /><br clear="all" />
	<form name="enquiryuserexistform" id="enquiryuserexistform"  method="POST">
		
		
		<div style="visibility:hidden;">
		<br clear="all" />
		<?php  
		echo $this->Form->input('code',array('div'=>array('id'=>'visitorinq_div6'),'id'=>'code','class'=>'form-input','label'=>'Confirmation Code'));?>
		</div>
		
		<?php echo $this->Form->input('resistrdphoneno',array('div'=>array('id'=>'visitorinq_div5'),'id'=>'resisterdno','label'=>'Phone','class'=>'form-input validate[required,custom[max]]'));?>
		<?php  $vid = $arrWebHomeDetailstock[0]['wcz_vehicle']['vid'];?>
		<?php  echo $this->Form->input('vid', array('type'=>'hidden', 'value'=>$vid)); ?>
		<div style="float:right">
		<input type="button" name="submit" id="" onclick="return fnenquiryexist();" value="Submit" class="btn"/>
		<input type="button" name="Cancel" value="Cancel" onclick=fnPopClose("enquiryuserexist"); class="btn" />
		</div>
		<a onclick="return fnenquiry();" style="cursor:pointer;float:left;margin:30px 1px 1px 12px;font-size:15px">Go To Back</a>
		
	</form>
 
 </div>
  </div> 






<div class="cms-bgloader-mask"></div>
    <div class="cms-bgloader"></div>
    <div id="alertgeneric-popupmask"></div>
   
    <div id="enquiryform" class="alertgeneric-popup">
    	<?php 
		$strcontactformUrl = Router::url(array('controller'=>'websites','action'=>'detail'),true);
		//echo $this->Form->create('Search',array('action'=>$strSearchBrandUrl));
	?>
	<div class="topbg"><div class="tittle">Contact information</div>
	
	<form name="enquiryres" id="enquiryres"  method="POST">
		
		
		<div style="visibility:hidden;">
		<br clear="all" /><br clear="all" />
		<?php  
		echo $this->Form->input('code',array('div'=>array('id'=>'visitorinq_div3'),'id'=>'code','class'=>'form-input','label'=>'Confirmation code'));?>
		
		</div>
		
		
		<?php  $vid = $arrWebHomeDetailstock[0]['wcz_vehicle']['vid'];?>
		<?php  echo $this->Form->input('vid', array('type'=>'hidden', 'value'=>$vid)); ?>
		<?php  echo $this->Form->input('fname',array('div'=>array('id'=>'visitorinq_div'),'id'=>'name','label'=>'First Name','class'=>'form-input validate[custom[onlyLetterSp]]'));?></br>
		<?php  echo $this->Form->input('lname',array('div'=>array('id'=>'visitorinq_div4'),'id'=>'lname','label'=>'Last Name','class'=>'form-input validate[custom[onlyLetterSp]]'));?></br>
		<?php  echo $this->Form->input('phoneno',array('div'=>array('id'=>'visitorinq_div1'),'id'=>'no','label'=>'Phone','class'=>'form-input validate[required,custom[max]]'));?></br>
		<?php  echo $this->Form->input('email',array('div'=>array('id'=>'visitorinq_div2'),'id'=>'email','label'=>'Emailid','class'=>'form-input validate[custom[email]]'));?></br>
		<?php  echo $this->Form->input('conformationcode', array('id'=>'conformationcode','type'=>'hidden', 'value'=>'')); ?>
		
		<div style="float:right">
		<input type="button" name="submit" id="" onclick="return fncontactsubmit();" value="Submit" class="btn"/>
		<input type="button" name="Cancel" value="Cancel" onclick=fnPopClose("enquiryform"); class="btn" />
		</div>
		<div id="alreadylink"><a onclick="return existresisterd();" style="cursor:pointer;float:left;margin:30px 1px 1px 12px;font-size:15px">Already Resistered</a></div>
	</form>
 
 </div>
  </div> 
	
<?php echo $this->Html->script('alreadyres');?>		
<section id="car">
	<div class="container">	
		<article>

			<div class="row pagetitle">
				<div class="col-xs-12">
					<h2><?php  
					$year=$arrWebDetailStockVehicle[0]['wcz_vehicle']['manufacture_date'] ;
					$yeararr=explode("-",$year);?>
					<?php echo($arrWebHomeDetailstock[0]['wcz_brand']['brand_name']);?> <?php echo($arrWebHomeDetailstock[0]['wcz_model']['model_name']);?> <?php echo($arrWebHomeDetailstock[0]['wcz_variant']['variant_name']);?> <?php echo($yeararr[0]);?> </h2>
					
				</div>
			</div>	

		<div class="row">
			<div class="col-md-6">
				<ul class="nav nav-tabs" id="tab-car">
					<li class="active"><a href="#images">Images Tab</a></li>
					<!--<li><a href="#video">Video Tab</a></li>
					<li class="active"><a href="#maps">Google Maps Tab</a></li>-->
				</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="images">
						<div id="carousel-car" class="carousel slide">

							<a class="carousel-control" href="#carousel-car" data-slide="prev">
							    <i class="icon-left-open"></i>
							</a>

							<a class="carousel-control next" href="#carousel-car" data-slide="next">
							    <i class="icon-right-open"></i>
							</a>
							
							<div class="carousel-inner">
									
								<?php if(is_array($arrWebHomeDetailstock) && (count($arrWebHomeDetailstock) > 0))
								{	
								//print_r($arrWebHomeDetailstock[0]['vehicle_sales_images']);
								$intVehilcleImageCnt = 0;
								if($arrWebHomeDetailstock[0]['vehicle_sales_images'])
								{
								foreach ($arrWebHomeDetailstock[0]['vehicle_sales_images'] as $vehicle_sales_images)
									{
									
									$vehicle_sales_image_name = $vehicle_sales_images['VehicleImages']['vehicle_image_name'];
									//print_r($vehicle_sales_image_name);
									//$vehicle_sales_no_image_name=vehicle_no_sales_img_36.jpg;
									
									
									$intVehilcleImageCnt++;
									
									
									if($intVehilcleImageCnt == 1)
											{
									
									
									
									
									//echo 'hi';
									echo '<div class="item active"><a rel="gallery1"  href="'.Router::url('/',true).'/vehicledata/SalesStockimages/'.$vehicle_sales_image_name.'" class="fancybox">';
									echo $this->Html->image('/vehicledata/SalesStockimages/'.$vehicle_sales_image_name,array('width'=>'160px','height'=>'160px'));
									echo '</a></div>';
											}
									
									else
									{
									echo '<div class="item"><a rel="gallery1" rel="gallery1"  href="'.Router::url('/',true).'/vehicledata/SalesStockimages/'.$vehicle_sales_image_name.'" class="fancybox">';
									echo $this->Html->image('/vehicledata/SalesStockimages/'.$vehicle_sales_image_name,array('width'=>'160px','height'=>'160px'));
									echo '</a></div>';
									}
									
									//echo "--".$vehicle_images['VehicleImages']['vehicle_image_name'];
									
									}
										
									}
									
									
									else
									{
									
									echo'<div class="item active">';
									echo'<a class="fancybox" data-rel="gallery1">';
									echo $this->Html->image('/vehicledata/PreProcEnquiry/vehicle_imgs/no_ImgAvaialable.jpg',
					array('width'=>'160px','height'=>'160px'));
									echo'</a>';
									echo'</div>';
									echo'<div class="item">';
									echo'<a class="fancybox" rel="gallery1">';
									echo $this->Html->image('/vehicledata/PreProcEnquiry/vehicle_imgs/no_ImgAvaialable.jpg',
					array('width'=>'160px','height'=>'160px'));
									echo'</a>';
									echo'</div>';
									}
									
								
									}
									
									
									?>
								
								
							</div>

						</div>
					</div>
					
				</div>
			</div>
			<!--<div class="tags price"><span></span> $15,250</div>-->
		
			<div class="col-md-6">
				
						<div class="vechicledetail">
							
							<?php 
							if(is_array($arrWebHomeDetailstock) && (count($arrWebHomeDetailstock) > 0))
							
							
								{
							//$price=$arrWebHomeDetailstock[0]['wcz_vehicle']['expected_price'];		
							
							//$price1=$arrWebSuggVehicle[0]['expected_price'];
							?>
							<div class="name"><div class="heading">Brand:</div><div class="value"><?php echo $arrWebHomeDetailstock[0]['wcz_brand']['brand_name'];?></div></div>
							<div class="name"><div class="heading">Model:</div><div class="value"><?php echo $arrWebHomeDetailstock[0]['wcz_model']['model_name']; ?></div></div>
							<div class="name"><div class="heading">Variant:</div><div class="value"><?php echo $arrWebHomeDetailstock[0]['wcz_variant']['variant_name']; ?></div></div>
							<div class="name"><div class="heading">Price:</div><div class="value"><?php echo $arrWebHomeDetailstock[0]['wcz_procpayment_details']['sales_price']; ?></div></div>
							<div class="name"><div class="heading">Kilometers:</div><div class="value"><?php echo $arrWebHomeDetailstock[0]['wcz_vehicle']['kilometers']; ?></div></div>
							<div class="name"><div class="heading">Year:</div><div class="value"><?php echo $arrWebHomeDetailstock[0]['wcz_vehicle']['manufacture_date']; ?></div></div>
							<div class="name"><div class="heading">Insurance Type:</div><div class="value"><?php echo $arrWebHomeDetailstock[0]['wcz_vehicle']['insurance_type']; ?></div></div>
							<div class="name"><div class="heading">Owner Type:</div><div class="value"><?php echo $arrWebHomeDetailstock[0]['wcz_vehicle']['owner_type']; ?></div></div>
							<div class="name"><div class="heading">Insurance Validity:</div><div class="value"><?php echo $arrWebHomeDetailstock[0]['wcz_vehicle']['insurance_validity']; ?></div></div>
							<div class="name"><div class="heading">Fual Type:</div><div class="value"><?php echo $arrWebHomeDetailstock[0]['wcz_vehicle']['fual_type']; ?></div></div>
							<?php }?></br></br>
							
						
						<?php 
						
						
						if($logged_in!="")
						{
						if($arrWebHomeDetailstock[0]['wcz_vehicle']['vehicle_status']=='4')
						{
						echo'<button type="button" class="btn" disabled>Contact seller</button>';
						echo '</br>';
						echo '</br>';
						echo'<div style="color:red;">This Car has been sold</div>';
						}
						else
						{
						if(empty($arrWebUseralredyentry))
						{
						echo'<form type="POST" id="enquirylogin" name="enquirylogin">';
						$vid = $arrWebHomeDetailstock[0]['wcz_vehicle']['vid'];
						echo'<input type="hidden" id="vid" name="vid" value='.$vid.'>';
						echo'<button type="button" class="btn" onclick="return fnenquiryafterlogin();">Contact seller</button>';
						echo'</form>';
						}
						
						
						else
						{
						echo'<button type="button" class="btn" disabled>Contact seller</button>';
						echo '</br>';
						echo '</br>';
						echo'<div style="color:red;">Already done enquiry on this car</div>';
						}
						}
						}
						
						
						else
						{
						if($arrWebHomeDetailstock[0]['wcz_vehicle']['vehicle_status']=='4')
						{
						echo'<button type="button" class="btn" disabled>Contact seller</button>';
						echo '</br>';
						echo '</br>';
						echo'<div style="color:red;">This Car has been sold</div>';
						}
						else
						{
						echo'<button type="button" class="btn btn-alt"  onclick=fnwebPopOpen("enquiryform");>Contact seller</button>';
						}
						}
						
						?> 
						</div>
						
						
					
			
				
			
			
			
	<div class="col-md-3" style="margin-top:23px;">
		<!--<div class="suggest">-->

			<div id="main" class="suggested_cars_sidebar">
					<h3>Suggested cars</h3>
				<div class="nano">
					<div class="overthrow content description">
						
						<?php if(is_array($arrWebSuggVehicle) && (count($arrWebSuggVehicle) > 0))
									{	
									
									
									foreach ($arrWebSuggVehicle as $suggvehicledetails)
										{
										$strVehicleDetilUrl = Router::url(array('controller'=>'websites','action'=>'detail'),true)."/".$suggvehicledetails['wcz_vehicle']['vid'];
										
										?>
							
								
								<?php
								echo'<div class="popular">';
								echo'<div class="seperator">';
                                                                echo'<a href="'.$strVehicleDetilUrl.'">';
								if($suggvehicledetails['wcz_vehicle']['images']=="")
								{
								echo $this->Html->image('/vehicledata/PreProcEnquiry/vehicle_imgs/no_ImgAvaialable.jpg',
								array('width'=>'150px','height'=>'80px'));
								}
								else
								{
								echo $this->Html->image('/vehicledata/SalesStockimages/'.$suggvehicledetails['wcz_vehicle']['images'],array('width'=>'151px','height'=>'85px'));
								}
                                                               echo'</a>';

                                                                    ?>
								<?php echo'<div class="name">'.$suggvehicledetails['wcz_brand']['brand_name'].'</div>';?>
								<div class="price">
								
								Price: <?php echo($suggvehicledetails['wcz_procpayment_details']['sales_price']);?></br>
								Fuel Type:<?php echo($suggvehicledetails['wcz_vehicle']['fual_type']); ?></br>
								Year: <?php echo($suggvehicledetails['wcz_vehicle']['manufacture_date']); ?></br>
								kilometers:<?php echo($suggvehicledetails['wcz_vehicle']['kilometers']); ?></br>
								<?php echo'</div></div></div>';}}?>
								
							
						
					
					</div>
				</div>
			</div>	
				<?php echo $this->Html->script('websitejs/jquery.nanoscroller');
				     echo $this->Html->script('websitejs/main');?>

			
		<!--</div>-->
		</div>
		</div>
		
		<!--<div>&nbsp;</div>-->
		
		
		
		<?php echo $this->Session->flash(); ?>
		<div class="row extrainfo">
			<!--<div class="col-md-12">
				<ul class="nav nav-tabs alt" id="tab-car2">
					<li class="active"><a href="#features">Features</a></li>
					<li><a href="#facebook">Share on Facebook</a></li>
					<li><a href="#send">Send to a Friends</a></li>
					<li><a href="#comments">Comments (12)</a></li>
				</ul>

				<div class="tab-content alt">
					<div class="tab-pane active" id="features">
						<div class="row">
							<div class="col-md-3">
								<h4>Convenience</h4>
								<div class="list-group">
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Cruise Control</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Keyless</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Power Door Locks</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Cehicle Anti-Therft Sistem</a>
								</div>
							</div>
							<div class="col-md-3">
								<h4>Entretainment</h4>
								<div class="list-group">
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>AM/FM Stereo</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>CD Player</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>MP3 Player</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Auxiliary Audio Imput</a>
								</div>
							</div>
							<div class="col-md-3">
								<h4>Interior</h4>
								<div class="list-group">
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Cloth Seats</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Driver Air Bag</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Passenger Air Bag</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Passenger Air Bag On/Off Switch</a>
								</div>
							</div>
							<div class="col-md-3">
								<h4>Exterior </h4>
								<div class="list-group">
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Cloth Seats</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Driver Air Bag</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Passenger Air Bag</a>
									<a href="#" class="list-group-item"><i class="icon-right-open"></i>Passenger Air Bag On/Off Switch</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h3>General Description</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div>
						</div>



					</div>
					<div class="tab-pane" id="facebook">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labordolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco labe et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
					</div>
					<div class="tab-pane" id="send">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
					</div>
					<div class="tab-pane" id="comments">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
					</div>
				</div>

			</div>
		</div>-->
		
		
		</article>
		
		

	</div>
</section>


<?php
	// Javascript Files
	// jQuery
?>
	
<?php
	echo'<script>window.jQuery || document.write("<script src=\"'.Router::url('/',true).'js/websitejs/jquery.min.1.9.1.js\"")</script>';
	
	//Respond.js media queries for IE8
	echo $this->Html->script('websitejs/respond.min');
	
	// Bootstrap 
	echo $this->Html->script('websitejs/bootstrap.min');
	
	// Retina.js
	echo $this->Html->script('websitejs/retina');
	
	//Placeholder.js http://widgetulous.com/placeholderjs/
	echo $this->Html->script('websitejs/placeholder');
	
	// Go to top
	echo $this->Html->script('websitejs/jquery.scrollTo-1.4.3.1-min');
	
	
	
	echo $this->Html->script('websitejs/fancybox/jquery.fancybox');
	
	// Slider Revolution
	echo $this->Html->script('websitejs/plugins/revolution/js/jquery.themepunch.plugins.min');
	echo $this->Html->script('websitejs/plugins/revolution/js/jquery.themepunch.revolution.min');
	
	// Custom
	echo $this->Html->script('websitejs/script');
	// End Javascript Files
	//echo $this->Html->script('jquery/jquery-1.9.1');
	echo $this->Html->script('jquery/jquery.form');
	
	?>