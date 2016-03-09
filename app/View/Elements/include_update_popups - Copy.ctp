<?php $seller_id = $arrtoUpdateDetails[0]['wcz_seller']['seller_id']; ?>
<?php $vehicleID = $arrtoUpdateDetails[0]['wcz_vehicle']['vid']; ?>
<?php 
	if(isset($arrtoUpdateDetails[0]['wcz_procpayment_details']['procpay_id']))
	{
			$procpay_id = $arrtoUpdateDetails[0]['wcz_procpayment_details']['procpay_id']; 
	}
	else
	{
			$procpay_id = "";	
	}
?>

<script type="text/javascript">

// FUNCTION FOR UPDATE CUSTOMER DETAILS	
function fnUpdateCustomerDetails()
{
	/*var seller_name = $('#seller_name').val();
	var seller_email = $('#seller_email').val();
	var seller_conact_no = $('#seller_conact_no').val();
	var seller_address = $('#seller_address').val();
	if(seller_name == "" || seller_email == "" || seller_conact_no == "" || seller_address == "")
	{
		alert("All fiels are mandatory.");
		return false;
	}*/
	
	var isValidated = jQuery('#custdetailsupdateform').validationEngine('validate');
	if(isValidated == false)
	{
		return false;
	}
	else
	{
		//alert('hi');
		//$('#docloader').show();
		var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnUpdateCustomerdetails/".$seller_id; ?>";
		var type = "POST";
		var options = 
		{ 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
					//$('#docloader').hide();
					alert(responseText.message);
					window.location.reload();
				}
				else
				{
					alert(responseText.message);
				}
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
		$('#custdetailsupdateform').ajaxSubmit(options); 
		// !!! Important !!! 
		// always return false to prevent standard browser submit and page navigation 
		return false;
	}
}

// FUNCTION FOR UPDATE PAYMENT DETAILS	
function fnUpdatePaymentDetails()
{
	/*var purchase_price = $('#purchase_price').val();
	var payouts = $('#payouts').val();
	var rf_expected = $('#rf_expected').val();
	var proc_remarks = $('#proc_remarks').val();
	if(purchase_price == "" || payouts == "" || rf_expected == "")
	{
		alert("All fiels are mandatory.");
		return false;
	}*/
	var isValidated = jQuery('#paymentdetailsupdateform').validationEngine('validate');
	if(isValidated == false)
	{
		return false;
	}
	else
	{
	var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnUpdatePaymentdetails/".$procpay_id; ?>";
	var type = "POST";
	var options = { 
	//target:        '#output2',   // target element(s) to be updated with server response 
	success:	function(responseText, statusText, xhr, $form) {
			if(responseText.status == "success")
			{
				//$('#docloader').hide();
				alert(responseText.message);
				window.location.reload();
			}
			else
			{
				alert(responseText.message);
			}
		},								
			 
		// other available options: 
		url:       url,         // override for form's 'action' attribute 
		type:      type,        // 'get' or 'post', override for form's 'method' attribute 
		dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
	} 
	$('#paymentdetailsupdateform').ajaxSubmit(options); 
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false;
	}
}

// FUNCTION FOR UPDATE REFURBISHMENT DETAILS	
function fnUpdateRefbDetails()
{
	/*var certified = $('#120_certified').val();
	var rf_actual = $('#rf_actual').val();
	var refurbish_remarks = $('#refurbish_remarks').val();
	if(rf_actual == "")
	{
		alert("All fiels are mandatory.");
		return false;
	}*/
	
	var isValidated = jQuery('#refbdetailsupdateform').validationEngine('validate');
	if(isValidated == false)
	{
		return false;
	}
	else
	{
	var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnUpdateRefbdetails/".$procpay_id; ?>";
	var type = "POST";
	var options = { 
	//target:        '#output2',   // target element(s) to be updated with server response 
	success:	function(responseText, statusText, xhr, $form) {
			if(responseText.status == "success")
			{
				//$('#docloader').hide();
				alert(responseText.message);
				window.location.reload();
			}
			else
			{
				alert(responseText.message);
			}
		},								
			 
		// other available options: 
		url:       url,         // override for form's 'action' attribute 
		type:      type,        // 'get' or 'post', override for form's 'method' attribute 
		dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
	} 
	$('#refbdetailsupdateform').ajaxSubmit(options); 

	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false;
	}
}

// FUNCTION FOR UPDATE SALES DETAILS	
function fnUpdateSalesDetails()
{
	/*var sales_price = $('#sales_price').val();
	if(sales_price == "")
	{
		alert("All fiels are mandatory.");
		return false;
	}*/
	var isValidated = jQuery('#salesdetailsupdateform').validationEngine('validate');
	if(isValidated == false)
	{
		return false;
	}
	else
	{
	var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnUpdateSalesdetails/".$procpay_id; ?>";
	var type = "POST";
	var options = { 
	//target:        '#output2',   // target element(s) to be updated with server response 
	success:	function(responseText, statusText, xhr, $form) {
			if(responseText.status == "success")
			{
				//$('#docloader').hide();
				alert(responseText.message);
				window.location.reload();
			}
			else
			{
				alert(responseText.message);
			}
		},								
			 
		// other available options: 
		url:       url,         // override for form's 'action' attribute 
		type:      type,        // 'get' or 'post', override for form's 'method' attribute 
		dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
	} 
	$('#salesdetailsupdateform').ajaxSubmit(options); 
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false;
	}
}

// FUNCTION FOR UPDATE VEHICLE DETAILS	
function fnUpdateVehicleDetails()
{
	/*var intreg_no = $('#reg_no').val();
	var intbrand = $('#VehicleVehicleBrand').val();
	var intmodel = $('#VehicleVehicleModel').val();
	var intvariant = $('#VehicleVehicleVariant').val();
	var intbodystyle = $('#VehicleVehicleBodyStyle').val();
	var fual_type = $('#fual_type').val();
	var color = $('#color').val();
	var kilometers = $('#kilometers').val();
	var owner_type = $('#owner_type').val();
	var insurance_type = $('#insurance_type').val();
	if(intreg_no == "" || intbrand == "")
	{
		alert("All fiels are mandatory.");
		return false;
	}*/
	var isValidated = jQuery('#vehicledetailsupdateform').validationEngine('validate');
	if(isValidated == false)
	{
		return false;
	}
	else
	{
	var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnUpdateVehicledetails/".$vehicleID; ?>";
	var type = "POST";
	var options = { 
	//target:        '#output2',   // target element(s) to be updated with server response 
	success:	function(responseText, statusText, xhr, $form) {
			if(responseText.status == "success")
			{
				//$('#docloader').hide();
				alert(responseText.message);
				window.location.reload();
			}
			else
			{
				alert(responseText.message);
			}
		},								
			 
		// other available options: 
		url:       url,         // override for form's 'action' attribute 
		type:      type,        // 'get' or 'post', override for form's 'method' attribute 
		dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
	} 
	$('#vehicledetailsupdateform').ajaxSubmit(options); 
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false;
	}
}

// FUNCTION FOR UPDATE VEHICLE DETAILS	
function fnUpdateGeneralDetails()
{
	/*var expected_price = $('#expected_price').val();
	if(expected_price == "")
	{
		alert("Expected Price is mandatory.");
		return false;
	}*/
	var isValidated = jQuery('#generaldetailsupdateform').validationEngine('validate');
	if(isValidated == false)
	{
		return false;
	}
	else
	{
		var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnUpdateGeneraldetails/".$vehicleID; ?>";
		var type = "POST";
		var options = 
		{ 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
					//$('#docloader').hide();
					alert(responseText.message);
					window.location.reload();
				}
				else
				{
					alert(responseText.message);
				}
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
		$('#generaldetailsupdateform').ajaxSubmit(options); 
		// !!! Important !!! 
		// always return false to prevent standard browser submit and page navigation 
		return false;
	}
}

function fnToAddNewSaleImages()
{
	var intVehicle_id = $('#vehicle_id').val();
	var isValidated = jQuery('#addnewsalesimages').validationEngine('validate');
	if(isValidated == false)
	{
		return false;
	}
	else
	{

	$('#imgloader').show();
	var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnToAddNewSalesImages/"?>"+intVehicle_id;
	var type = "POST";
	var options = { 
	//target:        '#output2',   // target element(s) to be updated with server response 
	success:	function(responseText, statusText, xhr, $form) {
			if(responseText.status == "success")
			{
				$('#imgloader').hide();
				alert(responseText.message);
				$("#addnewsalesimages")[0].reset();
				window.location.reload();
			}
			else
			{
				$('#imgloader').hide();
			}
		},								
			 
		// other available options: 
		url:       url,         // override for form's 'action' attribute 
		type:      type,        // 'get' or 'post', override for form's 'method' attribute 
		dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
	} 
	$('#addnewsalesimages').ajaxSubmit(options); 
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false; 
	}
}

function fnToAddNewPreImages()
{	
	var intVehicle_id = $('#vehicle_id').val();
	var isValidated = jQuery('#addnewpreimages').validationEngine('validate');
	if(isValidated == false)
	{
		return false;
	}
	else
	{
	
		$('.cms-bgloader-mask').show();//show loader mask
		$('.cms-bgloader').show(); //show loading image
		var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnToAddNewPreImages/"?>"+intVehicle_id;
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			if(responseText.status == "success")
			{
				$('.cms-bgloader-mask').hide();//hide loader mask
				$('.cms-bgloader').hide(); //hide loading image
				alert(responseText.message);
				$("#addnewpreimages")[0].reset();
				window.location.reload();
			}
			else
			{
				$('.cms-bgloader-mask').hide();//hide loader mask
				$('.cms-bgloader').hide(); //hide loading image
				alert(responseText.message);
			}
		},								
			 
		// other available options: 
		url:       url,         // override for form's 'action' attribute 
		type:      type,        // 'get' or 'post', override for form's 'method' attribute 
		dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
	} 
	$('#addnewpreimages').ajaxSubmit(options); 
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false; 
	}
}

function fnToUpdateSaleImages()
{
	var intVehicle_id = $('#vehicle_id').val();
	var sales_vehicle_images = $('#sales_vehicle_images').val();
	//alert(intVehicle_id);
	//return false;
	
	if(sales_vehicle_images == "")
	{
		alert("Please select image(s) to upload.");
		return false;
	}
	else
	{
	
	$('#imgloader').show();
	var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnToUpdateSaleImages/"?>"+intVehicle_id;
	var type = "POST";
	var options = { 
	//target:        '#output2',   // target element(s) to be updated with server response 
	success:	function(responseText, statusText, xhr, $form) {
			if(responseText.status == "success")
			{
				$('#imgloader').hide();
				window.location.reload();
			}
			else
			{
				$('#imgloader').hide();
			}
		},								
			 
		// other available options: 
		url:       url,         // override for form's 'action' attribute 
		type:      type,        // 'get' or 'post', override for form's 'method' attribute 
		dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
	} 
	$('#updatesalesimages').ajaxSubmit(options); 
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false; 
	}
}

function fnToUpdatePreImages()
{
	var intVehicle_id = $('#vehicle_id').val();
	var vehicle_pre_images = $('#vehicle_pre_images').val();
	//alert(intVehicle_id);
	//return false;
	
	if(vehicle_pre_images == "")
	{
		alert("Please select image(s) to upload.");
		return false;
	}
	else
	{
	
		$('.cms-bgloader-mask').show();//show loader mask
		$('.cms-bgloader').show(); //show loading image
		var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnToUpdatePreImages/"?>"+intVehicle_id;
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			if(responseText.status == "success")
			{
				$('.cms-bgloader-mask').hide();//hide loader mask
				$('.cms-bgloader').hide(); //hide loading image
				alert(responseText.message);
				$("#updatepreimages")[0].reset();
				window.location.reload();
			}
			else
			{
				$('.cms-bgloader-mask').hide();//hide loader mask
				$('.cms-bgloader').hide(); //hide loading image
				alert(responseText.message);
			}
		},								
			 
		// other available options: 
		url:       url,         // override for form's 'action' attribute 
		type:      type,        // 'get' or 'post', override for form's 'method' attribute 
		dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
	} 
	$('#updatepreimages').ajaxSubmit(options); 
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false; 
	}
}

</script>
<style>
form div{ margin-bottom:0; padding:0; }
#vehicledetailsupdateform label{ width:33%; margin-bottom:10px; }
#vehicledetailsupdateform .form-input{ width:65%; margin-bottom:10px; font-size:0.8em; }
</style>

<!-- Customer Update Details Form -->
<div id="updateCustDetailsPopup" class="update-popup">
    <fieldset>
        <legend>Customer Details</legend>
        <form name="custdetailsupdateform" id="custdetailsupdateform" method="post" enctype="multipart/form-data">
            <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $seller_id; ?>" />
            <label>Full Name *</label>
            <input type="text" name="seller_name" id="seller_name" class="form-input validate[required,custom[onlyLetterSp]]" value="<?php echo $arrtoUpdateDetails[0]['wcz_seller']['seller_name']; ?>" />
            <br clear="all" />
            
            <label>Email *</label>
            <input type="text" name="seller_email" id="seller_email" class="form-input validate[required,custom[email]]" value="<?php echo $arrtoUpdateDetails[0]['wcz_seller']['seller_email']; ?>" />
            <br clear="all" />
            
            <label>Contact Number *</label>
            <input type="text" name="seller_conact_no" id="seller_conact_no" class="form-input validate[required,custom[phone]]" value="<?php echo $arrtoUpdateDetails[0]['wcz_seller']['seller_conact_no']; ?>" />
            <br clear="all" />
            
            <label>Address *</label>
            <textarea name="seller_address" id="seller_address" class="form-input validate[required]"><?php echo $arrtoUpdateDetails[0]['wcz_seller']['seller_address']; ?></textarea>
            <br clear="all" />
            
            <label>Remarks </label>
            <textarea name="seller_remark" id="seller_remark" class="form-input"><?php echo $arrtoUpdateDetails[0]['wcz_seller']['seller_remark']; ?></textarea>
            <br clear="all" />
            
            <input type="button" name="Submit" value="Submit" onclick="return fnUpdateCustomerDetails();" class="alertgeneric_pop_ok" />
            <input type="button" name="Cancel" value="Cancel" onclick="fnPopClose('updateCustDetailsPopup');" class="alertgeneric_pop_cancel" />
            
        </form>
    </fieldset>
</div>  
<!-- Customer Update Details Form -->

<!-- Payment Details Update Form -->
<div id="updatePaymentDetailsPopup" class="update-popup">
    <fieldset>
        <legend>Payment Details</legend>
        <form name="paymentdetailsupdateform" id="paymentdetailsupdateform" method="post" enctype="multipart/form-data">
            <input type="hidden" name="procpay_id" id="procpay_id" value="<?php echo $procpay_id; ?>" />
            <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $vehicleID; ?>" />
            
            <label>Purchase Price *</label>
            <input type="text" name="purchase_price" id="purchase_price" class="form-input validate[required,custom[integer]]" value="<?php echo $arrtoUpdateDetails[0]['wcz_procpayment_details']['purchase_price']; ?>" />
            <br clear="all" />
            
            <label>Payouts *</label>
            <input type="text" name="payouts" id="payouts" class="form-input validate[required,custom[integer]]" value="<?php echo $arrtoUpdateDetails[0]['wcz_procpayment_details']['payouts']; ?>" />
            <br clear="all" />
            
            <label>RF (Expected Cost) *</label>
            <input type="text" name="rf_expected" id="rf_expected" class="form-input validate[required,custom[integer]]" value="<?php echo $arrtoUpdateDetails[0]['wcz_procpayment_details']['rf_expected']; ?>" />
            <br clear="all" />
            
            <label>Remarks </label>
            <textarea name="proc_remarks" id="proc_remarks" class="form-input"><?php echo $arrtoUpdateDetails[0]['wcz_procpayment_details']['proc_remarks']; ?></textarea>
            <br clear="all" />
            
            <input type="button" name="Submit" value="Submit" onclick="return fnUpdatePaymentDetails();" class="alertgeneric_pop_ok" />
            <input type="button" name="Cancel" value="Cancel" onclick="fnPopClose('updatePaymentDetailsPopup');" class="alertgeneric_pop_cancel" />
            
        </form>
    </fieldset>
</div>  
<!-- Payment Details Update Form -->

<!-- Refurbishment Details Update Form -->
<div id="updateRefbDetailsPopup" class="update-popup">
    <fieldset>
        <legend>Refurbishment Details</legend>
        <form name="refbdetailsupdateform" id="refbdetailsupdateform" method="post" enctype="multipart/form-data">
            <input type="hidden" name="procpay_id" id="procpay_id" value="<?php echo $procpay_id; ?>" />
            <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $vehicleID; ?>" />
            
           <!-- Enabled only for super admin -->
            <?php if($current_user['admin_type'] != '1')
			{ 
			?>
			
            <label>Certified (120 points checked) *</label>
            <?php $certified = $arrtoUpdateDetails[0]['wcz_procpayment_details']['120_certified']; ?>
                <label>Yes&nbsp;<input type="radio" name="120_certified" id="120_certified" value="1" <?php if($certified==1) { echo 'checked="checked"'; } ?> /></label>
               <label>No&nbsp;<input type="radio" name="120_certified" id="120_certified" value="0" <?php if($certified==0) { echo 'checked="checked"'; } ?> /></label>
            <br clear="all" />
			
            <?php } ?>
			<!-- Enabled only for super admin -->
            
            <label>RF (Actual Cost) *</label>
            <input type="text" name="rf_actual" id="rf_actual" class="form-input validate[required,custom[integer]]" value="<?php echo $arrtoUpdateDetails[0]['wcz_procpayment_details']['rf_actual']; ?>" />
            <br clear="all" />
            
            <label>Remarks </label>
            <textarea name="refurbish_remarks" id="refurbish_remarks" class="form-input"><?php echo $arrtoUpdateDetails[0]['wcz_procpayment_details']['refurbish_remarks']; ?></textarea>
            <br clear="all" />
            
            <input type="button" name="Submit" value="Submit" onclick="return fnUpdateRefbDetails();" class="alertgeneric_pop_ok" />
            <input type="button" name="Cancel" value="Cancel" onclick="fnPopClose('updateRefbDetailsPopup');" class="alertgeneric_pop_cancel" />
            
        </form>
    </fieldset>
</div>  
<!-- Refurbishment Details Update Form -->

<!-- Sales Details Update Form -->
<div id="updateSalesDetailsPopup" class="update-popup">
    <fieldset>
        <legend>Sales Details</legend>
        <form name="salesdetailsupdateform" id="salesdetailsupdateform" method="post" enctype="multipart/form-data">
            <input type="hidden" name="procpay_id" id="procpay_id" value="<?php echo $procpay_id; ?>" />
            
            <label>Sale Price *</label>
            <input type="text" name="sales_price" id="sales_price" class="form-input validate[required,custom[integer]]" value="<?php echo $arrtoUpdateDetails[0]['wcz_procpayment_details']['sales_price']; ?>" />
            <br clear="all" />
            
            <label>Remarks </label>
            <textarea name="sales_remark" id="sales_remark" class="form-input"><?php echo $arrtoUpdateDetails[0]['wcz_procpayment_details']['sales_remark']; ?></textarea>
            <br clear="all" />
            
            <input type="button" name="Submit" value="Submit" onclick="return fnUpdateSalesDetails();" class="alertgeneric_pop_ok" />
            <input type="button" name="Cancel" value="Cancel" onclick="fnPopClose('updateSalesDetailsPopup');" class="alertgeneric_pop_cancel" />
            
        </form>
    </fieldset>
</div>  
<!-- Sales Details Update Form -->

<!-- Vehicle Update Details Form -->
<div id="updateVehicleDetailsPopup" class="update-popup">
    <fieldset>
        <legend>Vehicle Details</legend>
        <form name="vehicledetailsupdateform" id="vehicledetailsupdateform" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Vehicle[vehicle_id]" id="vehicle_id" value="<?php echo $vehicleID; ?>" />
            
            <?php 
				/*echo '<div class="input text">';
				
				echo $this->Form->input('vehicle_reg_no1',array('div'=>false,
					'label'=>'Registration No. &nbsp;<span>*</span>',
					'maxlength'=>'4','style'=>'width:40px;','class'=>'form-input'));
					
				echo $this->Form->input('vehicle_reg_no2',array('div'=>false,
					'label'=>false,'maxlength'=>'2','style'=>'width:20px;margin-left:10px;',
					'class'=>'form-input'));
				
				echo $this->Form->input('vehicle_reg_no3',array('div'=>false,
					'label'=>false,'maxlength'=>'4','style'=>'width:40px;margin-left:10px;',
					'class'=>'form-input'));
					
				echo '</div>';*/
			?>
            
            <label>Registration No *</label>
            <input type="text" name="Vehicle[reg_no]" id="reg_no" class="form-input" value="<?php echo $arrtoUpdateDetails[0]['wcz_vehicle']['reg_no']; ?>" readonly="readonly" />
            <br clear="all" />
            
            <?php echo $this->Form->input('Vehicle.vehicle_brand',array('label'=>'Brand *','type'=>'select',
				'options'=>$arrVehicleBrandList,
				'onChange'=>'fnGetModelList(this.value,"VehicleVehicleModel","VehicleVehicleVariant")',
				'class'=>'form-input validate[required]',
				'selected'=>$arrtoUpdateDetails[0]['wcz_vehicle']['brand'])); 
			?>
            
            <?php echo $this->Form->input('Vehicle.vehicle_model',array('label'=>'Model','type'=>'select',
				'options'=>$arrVehicleSelectedModelList,
				'onChange'=>'fnGetVariantList(this.value,"VehicleVehicleVariant")',
				'class'=>'form-input validate[required]',
				'selected'=>$arrtoUpdateDetails[0]['wcz_vehicle']['model'])); 
			?>
            
            <?php echo $this->Form->input('Vehicle.vehicle_variant',array('label'=>'Variant','type'=>'select',
				'options'=>$arrVehicleSelectedVariantList,
				'class'=>'form-input validate[required]',
				'selected'=>$arrtoUpdateDetails[0]['wcz_vehicle']['variant']));
			?>
			<?php echo $this->Form->input('Vehicle.vehicle_body_style',array('label'=>'Body Style','type'=>'select',
				'options'=>$arraVehicleBodyStyleList,
				'class'=>'form-input validate[required]',
				'selected'=>$arrtoUpdateDetails[0]['wcz_vehicle']['body_style']));
			?>
			
            <?php echo $this->Form->input('Vehicle.vehicle_fual_type',array('label'=>'Fual Type *',
			'type'=>'select',
			'options'=>array('Petrol'=>'Petrol','Diesel'=>'Diesel','Electric'=>'Electric','LPG'=>'LPG','CNG'=>'CNG'),
			'class'=>'form-input validate[required]',
			'selected'=>$arrtoUpdateDetails[0]['wcz_vehicle']['fual_type'])); 
			?>
            <div class="input select">
            <label>Color *</label>
            <input type="text" name="Vehicle[color]" id="seller_conact_no" class="form-input validate[required,custom[onlyLetterSp]]" value="<?php echo $arrtoUpdateDetails[0]['wcz_vehicle']['color']; ?>" />
            <br clear="all" />
            </div>
            <?php echo $this->Form->input('Vehicle.show_vehicle_manufacture_date',array('label'=>'Manufacture Date *',
			'class'=>'form-input validate[required]',
			'readonly'=>'readonly',
			'value'=>$SetManufactureDate));
			echo $this->Form->hidden('Vehicle.vehicle_manufacture_date',array('value'=>$arrtoUpdateDetails[0]['wcz_vehicle']['manufacture_date']));
			?>
            <br clear="all" />
            <label>Kilometers *</label>
            <input type="text" name="Vehicle[kilometers]" id="kilometers" class="form-input validate[required,custom[integer]]" value="<?php echo $arrtoUpdateDetails[0]['wcz_vehicle']['kilometers']; ?>" />
            <br clear="all" />
            
            <?php echo $this->Form->input('Vehicle.owner_type',array('label'=>'Owner(s) *','type'=>'select',
			'options'=>array('1st'=>'1st','2nd'=>'2nd','3rd'=>'3rd','4th'=>'4th','more than 4'=>'more than 4'),
			'class'=>'form-input validate[required]',
			'selected'=>$arrtoUpdateDetails[0]['wcz_vehicle']['owner_type']));
			?>
            
            <?php echo $this->Form->input('Vehicle.vehicle_insurance_type',array('label'=>'Insurance Type *','type'=>'select',
			'options'=>array('Nil'=>'Nil','Zero debt'=>'Zero debt','Third party'=>'Third party','Comprehensive'=>'Comprehensive'),
			'class'=>'form-input validate[required]',
			'selected'=>$arrtoUpdateDetails[0]['wcz_vehicle']['insurance_type'])); 
			?>
            
            <?php
					if($arrtoUpdateDetails[0]['wcz_vehicle']['insurance_type'] == "Nil")
					{
						echo $this->Form->input('Vehicle.show_vehicle_insurance_validity',array('div'=>array('id'=>'ShowVehicleInsuranceValidityDiv','style'=>'display:none;'),'label'=>'Insurance Validity','class'=>'form-input','readonly'=>'readonly','value'=> $SetInsuranceValiDate));
					}
					else
					{
						echo $this->Form->input('Vehicle.show_vehicle_insurance_validity',array('div'=>array('id'=>'ShowVehicleInsuranceValidityDiv','style'=>'display:block;'),'label'=>'Insurance Validity','class'=>'form-input','readonly'=>'readonly','value'=> $SetInsuranceValiDate));
					}
					echo $this->Form->hidden('Vehicle.vehicle_insurance_validity',array('value'=>$arrtoUpdateDetails[0]['wcz_vehicle']['insurance_validity']));
			?>
            
            <input type="button" name="Submit" value="Submit" onclick="return fnUpdateVehicleDetails();" class="alertgeneric_pop_ok" />
            <input type="button" name="Cancel" value="Cancel" onclick="fnPopClose('updateVehicleDetailsPopup');" class="alertgeneric_pop_cancel" />
			
        </form>
    </fieldset>
</div>  
<!-- Vehicle Update Details Form -->

<!-- Update General Details Form -->
<div id="updateGeneralDetailsPopup" class="alertgeneric-popup">
    	<fieldset>
        	<legend>General Details</legend>
        	<form name="generaldetailsupdateform" id="generaldetailsupdateform" method="post" enctype="multipart/form-data">
            	<input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $vehicleID; ?>" />
                
                <?php 
					echo $this->Form->input('Vehicle.show_vehicle_date_of_valuation',array('label'=>'Date Of Valuation',
					'class'=>'form-input',
					'readonly'=>'readonly',
					'value'=>$SetDateOfValuation));
					echo $this->Form->hidden('Vehicle.vehicle_date_of_valuation',array('value'=>$arrtoUpdateDetails[0]['wcz_vehicle']['date_of_valuation']));
				?>
                
                <label>Expected Price *</label>
                <input type="text" name="Vehicle[expected_price]" id="expected_price" class="form-input validate[required,custom[integer]]" value="<?php echo $arrtoUpdateDetails[0]['wcz_vehicle']['expected_price']; ?>" />
                <br clear="all" />
                
                <input type="button" name="Submit" value="Submit" onclick="return fnUpdateGeneralDetails();" class="alertgeneric_pop_ok" />
                <input type="button" name="Cancel" value="Cancel" onclick="fnPopClose('updateGeneralDetailsPopup');" class="alertgeneric_pop_cancel" />
                
            </form>
        </fieldset>
</div>  
<!-- Update General Details Form -->

<!-- Update Sales Images Form -->
<div id="updateSalesImagesPopup" class="alertgeneric-popup">
    	<fieldset>
        	<legend>Sale Vehicle Images</legend>
        	<form name="updatesalesimages" id="updatesalesimages" method="post" enctype="multipart/form-data">
            	<input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $vehicleID; ?>" />

               	<label>Upload Sales Images * (Hold <b>Ctrl</b> to upload multiple images.)</label>
               	<input type="file" name="vehicle_sales_images[]" id="vehicle_sales_images" multiple="multiple" class="form-input" />
				<span id="imgloader" style="display:none;"><img src='<?php echo Router::url('/', true);?>img/loader.gif'/></span>
                <br clear="all" /><br clear="all" />
                <input type="button" name="Submit" value="Submit" onclick="return fnToUpdateSaleImages();" class="alertgeneric_pop_ok" />
                <input type="button" name="Cancel" value="Cancel" onclick="fnPopClose('updateSalesImagesPopup');" class="alertgeneric_pop_cancel" />
            </form>
        </fieldset>
</div>
<!-- Update Sales Images Form -->

<!-- Add New Sales Images Form -->
<div id="AddNewSalesImagesPopup" class="alertgeneric-popup">
    	<fieldset>
        	<legend>Add New Sale Vehicle Images</legend>
        	<form name="addnewsalesimages" id="addnewsalesimages" method="post" enctype="multipart/form-data">
            	<input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $vehicleID; ?>" />

               	<label>Upload Sales Images * (Hold <b>Ctrl</b> to upload multiple images.)</label>
               	<input type="file" name="new_vehicle_sales_images[]" id="new_vehicle_sales_images" multiple="multiple" class="form-input validate[required] validate[checkFileType[jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG]]" />
				<span id="imgloader" style="display:none;"><img src='<?php echo Router::url('/', true);?>img/loader.gif'/></span>
                <br clear="all" /><br clear="all" />
                <input type="button" name="Submit" value="Submit" onclick="return fnToAddNewSaleImages();" class="alertgeneric_pop_ok" />
                <input type="button" name="Cancel" value="Cancel" onclick="fnPopClose('AddNewSalesImagesPopup');" class="alertgeneric_pop_cancel" />
            </form>
        </fieldset>
</div>
<!-- Add New Sales Images Form -->

<!-- Add New Pre Images Form -->
<div id="AddNewPreImagesPopup" class="alertgeneric-popup">
    	<fieldset>
        	<legend>Add New Pre Vehicle Images</legend>
        	<form name="addnewpreimages" id="addnewpreimages" method="post" enctype="multipart/form-data">
            	
				<label>Upload Images * (Hold <b>Ctrl</b> to upload multiple images.)</label>
               	<input type="file" name="new_vehicle_pre_images[]" id="new_vehicle_pre_images" multiple="multiple" class="form-input validate[required] validate[checkFileType[jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG]]" />
                
				<span id="imgloader" style="display:none;"><img src='<?php echo Router::url('/', true);?>img/loader.gif'/></span>
                <br clear="all" /><br clear="all" />
                <input type="button" name="Submit" value="Submit" onclick="return fnToAddNewPreImages();" class="alertgeneric_pop_ok" />
                <input type="button" name="Cancel" value="Cancel" onclick="fnPopClose('AddNewPreImagesPopup');" class="alertgeneric_pop_cancel" />
            </form>
        </fieldset>
</div>
<!-- Add New Pre Images Form -->

<!-- Update Pre Images Form -->
<div id="updatePreImagesPopup" class="alertgeneric-popup">
    	<fieldset>
        	<legend>Pre Owner's Update Vehicle Image</legend>
        	<form name="updatepreimages" id="updatepreimages" method="post" enctype="multipart/form-data">
            	<input type="hidden" name="getvehicle_image_id" id="getvehicle_image_id" value="<?php echo $vehicleID; ?>" />

               	<label>Upload Images * (Hold <b>Ctrl</b> to upload multiple images.)</label>
               	<input type="file" name="vehicle_pre_images" id="vehicle_pre_images" multiple="multiple" class="form-input" />
                
				<span id="imgloader" style="display:none;"><img src='<?php echo Router::url('/', true);?>img/loader.gif'/></span>
                <br clear="all" /><br clear="all" />
                <input type="button" name="Submit" value="Submit" onclick="return fnToUpdatePreImages();" class="alertgeneric_pop_ok" />
                <input type="button" name="Cancel" value="Cancel" onclick="fnToCloseUpdatePopup('updatePreImagesPopup');" class="alertgeneric_pop_cancel" />
            </form>
        </fieldset>
</div>
<!-- Update Pre Images Form -->

<script type='text/javascript'>
	$(document).ready(function () {
	
		$("#VehicleVehicleInsuranceType").on('change',function(){
		
			var insurance_type = $("#VehicleVehicleInsuranceType").val();
			//alert(insurance_type);
				if(insurance_type == "Nil")
				{
					$("#ShowVehicleInsuranceValidityDiv").hide();
					$("#VehicleVehicleInsuranceValidity").val('');
					return false;
				}
				else
				{
					$("#ShowVehicleInsuranceValidityDiv").show();
					return false;
				}
		});
	
		$('#VehicleShowVehicleManufactureDate').datepicker({ 
						dateFormat: 'dd M yy', changeMonth: true, changeYear: true, yearRange: "1980:+0",
						altField: "#VehicleVehicleManufactureDate", altFormat: "yy-mm-dd",
						maxDate: "+0D"
			});
			
		$('#VehicleShowVehicleInsuranceValidity').datepicker({ 
						dateFormat: 'dd M yy' ,
						altField: "#VehicleVehicleInsuranceValidity", altFormat: "yy-mm-dd"
			});
						
		$('#VehicleShowVehicleDateOfValuation').datepicker({ 
						dateFormat: 'dd M yy',
						altField: "#VehicleVehicleDateOfValuation", altFormat: "yy-mm-dd",
						minDate: 0, maxDate: "+1M"
			});
	});
</script>