<?php 
		$current_date = date('d-m-Y');
		$current_time = date('h:i:s'); 
?>
<div class="invoice_main">
			<div class="back_link">
				<a onClick="javascript: history.go(-1)" class="cursor">Back</a>
			</div>
    <div class="invoice_view">
				<?php
                if(is_array($arrInvoiceVehicleData) && (count($arrInvoiceVehicleData)) > 0 )
                {
					/*print("<pre>");
					print_r($arrInvoiceVehicleData);
					exit;*/
				?>
                
                <div class="header">
					<div class="title">Receipt</div>
					<div class="date">Date: <?php echo date('d-m-Y')?></div>
                    <div class="header_cont">
						<div class="left_cont">
							<b><?php echo $arrInvoiceVehicleData[0]['wcz_users']['user_fname'].'&nbsp'.$arrInvoiceVehicleData[0]['wcz_users']['user_lname'];  ?></b><br />
                            Mob No: <?php echo $arrInvoiceVehicleData[0]['wcz_users']['user_mobileno']; ?><br />
                            Email: <?php $user_emailid = $arrInvoiceVehicleData[0]['wcz_users']['user_emailid']; 
							if(!empty($user_emailid)){ echo $user_emailid; } else { echo 'Not Available';} ?><br />
							Reg No: <?php echo $arrInvoiceVehicleData[0]['wcz_vehicle']['reg_no']; ?>&nbsp;
							<?php echo $arrInvoiceVehicleData[0]['wcz_brand']['brand_name']; ?>
							<?php echo $arrInvoiceVehicleData[0]['wcz_model']['model_name']; ?>&nbsp;
							<?php //echo $arrInvoiceVehicleData[0]['wcz_variant']['variant_name']; ?>
                        </div>
                        <div class="right_cont">
							<a onclick="return editAdminInvoiceContent();" class="cursor" id="edit_admin_invoice_content">Edit</a>
							<a onclick="return saveAdminInvoiceContent();" class="cursor" id="save_admin_invoice_content">Save</a>
							<form style="width:100%;margin:0;"><textarea name="admin_invoice_content" id="admin_invoice_content" class="form-input"><?php echo $arrInvoiceVehicleData[0]['wcz_admin']['admin_invoice_content']; ?></textarea></form>
						</div>
                    </div>
            	</div>
               	<div class="middle">
					<div class="middle_invinfo">
						<div class="payment_info">
							<strong>&nbsp;</strong>
							<a id="addnewrow" class="btn red addnew_rowbtn">Add New Row &nbsp;<b>+</b></a>
						</div>
					</div>
				
				<form method="post" name="invoice_form" id="invoice_form" style="width:100%;">
				<input type="hidden" name="sale_id" id="sale_id" value="<?php echo $arrInvoiceVehicleData[0]['wcz_sale']['sale_id']; ?>" />
				<table id="invoice_table">
                	<tr class="alt-headrow">
                        	<th class="srno align-center">Sr.No</th>
                            <th>Payment Type</th>
                            <th>Date</th>
							<th>Time</th>
                            <th>Amount (Rs)</th>
                        </tr>
						<tbody id="invoice_tbody">
						<?php
						$i = 0; // i variable for unique id's for below foreach loop and javascript numrows (IMP)
						$total_paid_amt= "0";
						
						if(count($arrInvoiceVehicleData[0]['vehicle_transactions']) > 0)
						{
							$srno = 1;
							
							foreach ($arrInvoiceVehicleData[0]['vehicle_transactions'] as $vehicle_transactions)
							{
								$row_id = $srno;
								$i++;
								$rowclass = ($srno%2 == 0)? 'alt-row':'row';
							?>
								<tr class="<?php echo $rowclass; ?>" id="invoice_row<?php echo $row_id; ?>">
									<input type="hidden" name="transaction_id[]" id="transaction_id<?php echo $row_id; ?>" value="<?php echo $vehicle_transactions['Transactions']['transaction_id']; ?>" />
									<td class="align-center"><?php echo $srno++; ?></td>
									<td>
										<?php  
											$transaction_mode = $vehicle_transactions['Transactions']['transaction_mode']; 
										?>
										<select name="payment_mode[]" id="payment_mode<?php echo $row_id; ?>">
											<option value="cash" <?php if($transaction_mode == "cash") { echo 'selected="selected"'; } ?> >Cash</option>
											<option value="check" <?php if($transaction_mode == "check") { echo 'selected="selected"'; } ?> >Check</option>
											<option value="creditcard" <?php if($transaction_mode == "creditcard") { echo 'selected="selected"'; } ?> >Credit Card</option>
											<option value="debitcard" <?php if($transaction_mode == "debitcard") { echo 'selected="selected"'; } ?> >Debit Card</option>
											<option value="netbanking" <?php if($transaction_mode == "netbanking") { echo 'selected="selected"'; } ?> >Net Banking</option>
											<option value="finance" <?php if($transaction_mode == "finance") { echo 'selected="selected"'; } ?> >Finance</option>
										</select>
										<!--<input type="text" name="payment_mode[]" id="payment_mode<?php echo $row_id; ?>" value="<?php echo $vehicle_transactions['Transactions']['transaction_mode']; ?>" class="form-input capitalize"/>-->
									</td>
									<td>
										<input type="text" name="payment_date[]" id="payment_date<?php echo $row_id; ?>" value="<?php echo $vehicle_transactions['Transactions']['transaction_date']; ?>" class="form-input"/>
									</td>
									<td>
										<input type="text" name="payment_time[]" id="payment_time<?php echo $row_id; ?>" value="<?php echo $vehicle_transactions['Transactions']['transaction_time']; ?>" class="form-input"/>
									</td>
									<td>
										<input type="text" name="payment_amount[]" id="payment_amount<?php echo $row_id; ?>" value="<?php echo $vehicle_transactions['Transactions']['transaction_amount']; ?>" class="form-input" />
										<input type="button" id="delete_row" value="-" onclick="return fndeleteRecord('<?php echo $row_id; ?>','<?php echo $vehicle_transactions['Transactions']['transaction_id']; ?>');" class="btn red remove_rowbtn"/>
									</td>
								</tr>
										<?php $total_paid_amt += $vehicle_transactions['Transactions']['transaction_amount']; ?>
								<script type="text/javascript">
									// Datepicker function
									$('#payment_date<?php echo $row_id; ?>').datepicker({ 
													dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true,
													maxDate: "+0D"
										});
		
									// Timepicker function
									$('#payment_time<?php echo $row_id; ?>').timepicker({
													timeFormat: 'hh:mm:ss',
										}); 
								</script>
                        <?php 
							}
						}
						?>
						</tbody>
                        <tr class="alt-amountrow">
                            <td colspan="4">VAT (1.875%)</td>
							<?php $vat_amt = round(($arrInvoiceVehicleData[0]['wcz_sale']['actual_saleprice'] * 1.875)/100); ?>
                            <td><?php echo $vat_amt; ?></td>
							<input type="hidden" name="vat_amt" id="vat_amt" value="<?php echo $vat_amt; ?>" />
                        </tr>
						<tr class="alt-amountrow">
                            <td colspan="4">RTO</td>
							<td>
								<?php $rto_amt = round($arrInvoiceVehicleData[0]['wcz_sale']['rto_amt']); ?>
								<input type="text" name="rto_amt" id="rto_amt" value="<?php echo $rto_amt; ?>" onChange="calculate_extras(this.id)" />
							</td>
                        </tr>
						<tr class="alt-amountrow">
                            <td colspan="4">Insurance</td>
							<td>
								<?php $insurance_amt = round($arrInvoiceVehicleData[0]['wcz_sale']['insurance_amt']); ?>
								<input type="text" name="insurance_amt" id="insurance_amt" value="<?php echo $insurance_amt; ?>" onChange="calculate_extras(this.id)"/>
							</td>
                        </tr>
						<tr class="alt-amountrow">
                            <td colspan="4">Adjustments &nbsp;&nbsp;<div id="adjustment"><a onclick="return adjustment('add')" id="adjustment_add" class="cursor btn red add_deductbtn">+</a>&nbsp;/&nbsp;<a onclick="return adjustment('deduct')" id="adjustment_deduct" class="cursor btn red add_deductbtn">-</a></div></td>
                            <td id="adjustment_input">
								<?php $adjustment_amount = $arrInvoiceVehicleData[0]['wcz_sale']['adjustment_amt']; 
									if($adjustment_amount == 0)
									{
										echo '-';
									}
									else
									{
								?>
									<input type="text" name="adjustment_amt" id="adjustment_amt" value="<?php echo $adjustment_amount; ?>" onChange="return calculate_extras(this.id);"/>
							  <?php } ?>
							</td>
                        </tr>
						<tr class="alt-amountrow">
                            <td colspan="4">Total Paid Amount</td>
							<td id="total_paid_amt_td"><input type="text" name="total_paid_amt" id="total_paid_amt" value="<?php echo $total_paid_amt; ?>" /></td>
                        </tr>
						<tr class="alt-amountrow">
                            <td colspan="4">Current Balance</td>
							<?php $current_balance = ($arrInvoiceVehicleData[0]['wcz_sale']['current_balance']); ?>
                            <td id="current_balance_td"><input type="text" name="current_balance" id="current_balance" value="<?php echo $current_balance; ?>" /></td>
                        </tr>
                        <tr class="alt-amountrow">
                            <td colspan="4">Total Amount</td>
							<?php 
									$total_amount = $arrInvoiceVehicleData[0]['wcz_sale']['total_amount'];
									$actual_saleprice = $arrInvoiceVehicleData[0]['wcz_sale']['actual_saleprice'];
							?>
                            <!--<td id="virtual_total_amount"><?php echo $total_amt; ?></td>-->
							<td><input type="text" name="updated_total_amount" id="updated_total_amount" value="<?php echo $total_amount; ?>" /></td>
							<input type="hidden" name="total_amount" id="total_amount" value="<?php echo $actual_saleprice; ?>" />
                        </tr>
						<input type="hidden" name="delete_InvoiceRecordsIds" id="delete_InvoiceRecordsIds" value="" />
                </table>
				</form>
                </div>
				<br clear="all"/><br clear="all"/><br clear="all"/>
				<div class="footer">
                	Thanks & Regards
				</div>
		<?php   }  ?>
		
   </div>
</div>
		<div class="action-buttons" id="action-buttons">
				<a id="edit_button" class="btn red cursor">Edit</a>
				<a onclick="return print_page();" id="print_button" class="btn red cursor">Print</a>
		</div>
<br clear="all"/>
<br clear="all"/>
<!--<b>WINNER CAR ZONE </b><br />Address: Viman Nagar,<br />Royal Tower<br />Pune 444 444 <br /><br />Contact No: 987654321<br />Email: winnercarzone@gmail.com<br />-->
<script type="text/javascript">
	
	$("#edit_button").click(function() {
				//alert('Hi');
				//document.getElementById("action-buttons").innerHTML = '<a onclick="return fnToSaveInvoiceData();" id="save_button" class="btn red cursor">Save</a><a onclick="return print_page();" id="print_button" class="btn red cursor">Print</a>';
				$("#action-buttons").html('<a onclick="return fnToSaveInvoiceData();" id="save_button" class="btn red cursor">Save</a><a onclick="return print_page();" id="print_button" class="btn red cursor">Print</a><a onclick="return cancel();" id="cancel_button" class="btn red cursor">Cancel</a>');
				$("#invoice_form :input").attr("disabled", false);
				//$("#admin_invoice_content").attr("disabled", false);
				$('#addnewrow').show();
				//$("#save_admin_invoice_content").show();
				$('#adjustment').css({display: "inline"});
				$(".remove_rowbtn").css({visibility: "visible"});
				return false;
	});
	
	function print_page(){
		window.print();
		return false;
	}
	
	function cancel(){
		window.location.reload();
		return false;
	}
	
	// Add New Row function
	var numrow = <?php echo $i ?>; // Important for Add Row & Remove Row.

	$(document).ready(function(){
		
		$("#invoice_form :input").attr("disabled", true);
		$("#admin_invoice_content").attr("disabled", true);
		$('#addnewrow').hide();
		$('#save_admin_invoice_content').hide();
		$('#adjustment').css({display: "none"});
		$(".remove_rowbtn").css({visibility: "hidden"});
		
		$("#addnewrow").click(function(){
			
			numrow ++;
			if(numrow%2 == 0){ row_class="alt-row"; }else{ row_class="row"; }
			
			$("#invoice_tbody").append('<tr class="'+row_class+'" id="invoice_row'+numrow+'"><td>'+numrow+'</td><td><select name="payment_mode[]" id="payment_mode'+numrow+'"><option value="cash">Cash</option><option value="check">Check</option><option value="creditcard">Credit Card</option><option value="debitcard">Debit Card</option><option value="netbanking">Net Banking</option><option value="finance">Finance</option></select></td><td><input type="text" name="payment_date[]" id="payment_date'+numrow+'" value="<?php echo $current_date; ?>" class="form-input"/></td><td><input type="text" name="payment_time[]" id="payment_time'+numrow+'" value="<?php echo $current_time; ?>" class="form-input" /></td><td><input type="text" name="payment_amount[]" id="payment_amount'+numrow+'" class="form-input payment_amount" onChange="update_balance(this.id)"/><input type="button" value="-" onclick="return fnremoveRow('+numrow+');" class="btn red remove_rowbtn"></td></tr>');
			
			$('#payment_date'+numrow).datepicker({ 
							dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true,
							maxDate: "+0D"
				});
			$('#payment_time'+numrow).timepicker({
							timeFormat: 'hh:mm:ss',
				}); 
			return false;

		});
	});
	
	// Remove Row function
	function fnremoveRow(getRowID) {
		
		var remove_rowid = getRowID;
		var del_InvoiceRow = '#invoice_row'+remove_rowid;
		var payment_input_id = '#payment_amount'+remove_rowid;
		var payment_input_amount = $(payment_input_id).val();
		var total_paid_amt = $('#total_paid_amt').val();
		
		//alert(remove_rowid+'-'+del_InvoiceRow+'-'+payment_input_amount+'-'+total_paid_amt);
		
		var conf = confirm("Are you sure, You want to remove this row.!");
		if(conf == true)
		{
			total_paid = (total_paid_amt - payment_input_amount);
			//alert(total_paid);
			$('#total_paid_amt').val(total_paid);
			calculate_balance(total_paid);
			
			jQuery(del_InvoiceRow).remove();
			numrow--;
			return false;
		}
		else
		{
			return true;
		}
	}
	
	// Delete Record function
	function fndeleteRecord(getRowID,getRecordID) {
		
		var remove_rowid = getRowID;
		var delete_InvoiceRowId = '#invoice_row'+remove_rowid;
		var payment_input_id = '#payment_amount'+remove_rowid;
		var payment_input_amount = $(payment_input_id).val();
		var total_paid_amt = $('#total_paid_amt').val();
		
		var delete_InvoiceRecordId = getRecordID;
		
		//alert(delete_InvoiceRowId+'-'+delete_InvoiceRecordId);
		//return false;
		if(delete_InvoiceRecordId != "")
		{
			var conf = confirm("Are you sure, You want to delete this record permanently.!");
			if(conf == true)
			{
				var getdelete_InvoiceRecordsIds = $("#delete_InvoiceRecordsIds").val();

				if(getdelete_InvoiceRecordsIds.length > 0)
				{
					delete_InvoiceRecordsIds +=  ","+delete_InvoiceRecordId;
				}
				else
				{
					delete_InvoiceRecordsIds = +delete_InvoiceRecordId;	
				}
				
				$("#delete_InvoiceRecordsIds").val(delete_InvoiceRecordsIds);
				
				total_paid = (total_paid_amt - payment_input_amount);
				//alert(total_paid);
				$('#total_paid_amt').val(total_paid);
				calculate_balance(total_paid);
				
				jQuery(delete_InvoiceRowId).remove();
				numrow--;
				
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}
		
	function calculate_extras(get_input_id){
		
		var input_id = get_input_id;
		var rto_amount = $('#rto_amt').val();
		var insurance_amount = $('#insurance_amt').val();
		var adjustment_input = $("#adjustment_input").html();
		
		var total_paid_amt = $('#total_paid_amt').val();
		var total_amount = $('#total_amount').val();
		
		if(adjustment_input.trim()=="-"){ getadjustment_amt = 0; }	else{ getadjustment_amt = $("#adjustment_amt").val(); }
	
		if(rto_amount != "" || rto_amount != "0" &&  insurance_amount != "" || insurance_amount != "0" && getadjustment_amt != "")
		{
			//alert(rto_amount+'-'+insurance_amount+'-'+getadjustment_amt);
						
			if(input_id == 'rto_amt' || input_id == 'insurance_amt')
			{
				total_calculated_amt = Number(rto_amount) + Number(insurance_amount) + Number(getadjustment_amt);
				//alert(total_calculated_amt);
				
				new_total_amount = Number(total_amount) + Number(total_calculated_amt);
				//alert(new_total_amount);
				$('#updated_total_amount').val(new_total_amount);
				new_balance_due = Number(new_total_amount) - Number(total_paid_amt);
			}
			else if(input_id == 'adjustment_amt')
			{				
				action_symbol = getadjustment_amt.charAt(0);
				adjustment_amt = getadjustment_amt.substr(1);
				
				//alert(adjustment_amt)
				
				if(action_symbol =="+")
				{
					
					//alert(total_amount+'-'+action_symbol+'-'+adjustment_amt);
					new_total_amount = Number(rto_amount) + Number(insurance_amount) + (Number(total_amount) + Number(adjustment_amt));
					//alert(new_total_amount);
					$('#updated_total_amount').val(new_total_amount);
					new_balance_due = Number(new_total_amount) - Number(total_paid_amt);
					
				}
				else
				{
					
					//alert(total_amount+'-'+action_symbol+'-'+adjustment_amt);
					new_total_amount = Number(rto_amount) + Number(insurance_amount) + (Number(total_amount) - Number(adjustment_amt));
					//alert(new_total_amount);
					$('#updated_total_amount').val(new_total_amount);
					new_balance_due = Number(new_total_amount) - Number(total_paid_amt);
					
				}
			}
			
		}
			//alert(new_balance_due);
			$('#current_balance').val(new_balance_due);
	}
	
	/*function add_rto_amt(){
	
		var var rto_amount = $('#rto_amt').val();
		var insurance_amount = $('#insurance_amt').val();
		var total_paid_amt = $('#total_paid_amt').val();
		var total_amount = $('#total_amount').val();
		
		if(rto_amount != "")
		{
			//alert(total_amount+'+'+rto_amount);
			new_total_amount = Number(total_amount) + Number(rto_amount);
			//alert(new_total_amount);
			$('#updated_total_amount').val(new_total_amount);
			new_balance_due = Number(new_total_amount) - Number(total_paid_amt);
		}
		
			//alert(new_balance_due);
			$('#current_balance').val(new_balance_due);
	}
	
	function add_insurance_amt(){
		
		var insurance_amount = $('#insurance_amt').val();
		var rto_amount = $(rto_amt).val();
		var total_paid_amt = $('#total_paid_amt').val();
		var total_amount = $('#total_amount').val();
		
		if(insurance_amount != "")
		{
			//alert(total_amount+'+'+insurance_amount);
			new_total_amount = Number(total_amount) + Number(insurance_amount);
			//alert(new_total_amount);
			$('#updated_total_amount').val(new_total_amount);
			new_balance_due = Number(new_total_amount) - Number(total_paid_amt);
		}
		
			//alert(new_balance_due);
			$('#current_balance').val(new_balance_due);
	}*/
	
	/*function calculate_adjustment(){
	
			var getadjustment_amt = $("#adjustment_amt").val();
			var total_paid_amt = $('#total_paid_amt').val();
			var total_amount = $('#total_amount').val();
						
			if(getadjustment_amt != "")
			{
				action_symbol = getadjustment_amt.charAt(0);
				adjustment_amt = getadjustment_amt.substr(1);
								
				if(action_symbol =="+")
				{
					//alert(total_amount+'-'+action_symbol+'-'+adjustment_amt);
					new_total_amount = Number(total_amount) + Number(adjustment_amt);
					//alert(new_total_amount);
					$('#updated_total_amount').val(new_total_amount);
					new_balance_due = Number(new_total_amount) - Number(total_paid_amt);
					
				}
				else
				{
					
					//alert(total_amount+'-'+action_symbol+'-'+adjustment_amt);
					new_total_amount = Number(total_amount) - Number(adjustment_amt);
					//alert(new_total_amount);
					$('#updated_total_amount').val(new_total_amount);
					new_balance_due = Number(new_total_amount) - Number(total_paid_amt);
					
				}
			}
				//alert(new_balance_due);
				
				$('#current_balance').val(new_balance_due);		
	}*/
		
	// Adjustment
	function adjustment(get_action){
		var action = get_action;
		//alert(action);
		if(action == "add")
		{ sign = "+"; }
		else
		{ sign = "-"; }
		document.getElementById("adjustment_input").innerHTML = '<input type="text" name="adjustment_amt" id="adjustment_amt" value="'+sign+'" class="form-input" onChange="return calculate_extras(this.id);"/>';
		return false;
	}
	
	function update_balance(get_id){
		
		var payment_id = '#'+get_id;
		var payment_amount = $(payment_id).val();
		var total_paid_amt = $('#total_paid_amt').val();
		
			if(payment_amount == "")
			{
				alert('Please Provide Amount.');
				return false;
			}
			else
			{
				//alert(total_amount+'-'+total_paid_amt+'-'+payment_id+'-'+payment_amount);
				//alert(total_paid_amt+'+'+payment_amount);
				total_paid = Number(total_paid_amt) + Number(payment_amount);
				//alert(total_paid);
				$('#total_paid_amt').val(total_paid);
				calculate_balance(total_paid);
			}
	}
		
	function calculate_balance(get_totalpaid){
		var total_paid_amt = get_totalpaid;
		var total_amount = $('#updated_total_amount').val();
		var balance = "";
		
		if(total_paid_amt.length !== "")
		{
			//alert(total_amount+'-'+total_paid_amt);
			balance_due = Number(total_amount) - Number(total_paid_amt);
			//alert(balance_due);
			$('#current_balance').val(balance_due);
			
			if(balance_due == 0)
			{
				$('#addnewrow').text('No Balance');
				$("#addnewrow").attr("id","no_balance");
				$("#addnewrow").attr("onclick","no_balance()");
				$("#addnewrow").css({"cursor":"not-allowed"});
				$("#addnewrow").bind('click', false);
			}
		}
		else
		{
			return false;
		}
	}
	
	function no_balance(){ 
			alert("Balance Amount Is Nil.");
			return true;
	}
		
	function fnToSaveInvoiceData()
	{
		var url = "<?php echo Router::url('/', true).$this->params['controller']."/fnToSaveInvoiceData/"; ?>";
		var type = "POST";
		var options = { 
		//target: '#output2',   // target element(s) to be updated with server response 
		success: function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
					alert(responseText.message);
					window.location.reload();
				}
				else if(responseText.status == "empty")
				{
					alert(responseText.message);
				}
				else if(responseText.status == "fail")
				{
					alert(responseText.message);
				}
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
		$('#invoice_form').ajaxSubmit(options); 
		// !!! Important !!! 
		// always return false to prevent standard browser submit and page navigation 
		return false; 
		
	}
		
	/* Invoice Admin Content */
	function editAdminInvoiceContent(){
			$("#admin_invoice_content").attr("disabled", false);
			$("#save_admin_invoice_content").show();
			$("#edit_admin_invoice_content").hide();
			return false;
	}
	
	function saveAdminInvoiceContent(){
		var get_admin_invoice_content = $("#admin_invoice_content").val();
		var actionUrl = strGlobalSiteBasePath+"invoices/fnToSaveAdminInvoiceContent";
		var datastr = 'get_admin_invoice_content='+get_admin_invoice_content;
		
		//alert(get_admin_invoice_content+'--'+actionUrl);
		//return false;
		
		if(get_admin_invoice_content != "")
		{
			$.ajax({
					type: "POST",
					url: actionUrl,
					data: datastr,
					cache: false,
					dataType: 'json',
					success: function(data)
					{
						resStatus = data.status;
						resMessage = data.message;
						//alert(resMessage);
						if(resStatus == "success")
						{
							alert(resMessage);
							window.location.reload();
							//document.getElementById("successMsg").innerHTML = data.message;
						}
						else if(resStatus == "fail")
						{
							alert(resMessage);
							//document.getElementById("successMsg").innerHTML = data.message;
						}
					}
				});
		}
		else
		{
			alert("Content should not be empty.");
			return false;	
		}
			
	}
	/* Invoice Admin Content */
	/*
		<label>Payment Mode *</label>
		<select name="TxtPayment_mode" id="TxtPayment_mode">
				<option value="cash">Cash</option><option value="check">Check</option><option value="creditcard">Credit Card</option><option value="debitcard">Debit Card</option><option value="netbanking">Net Banking</option><option value="finance">Finance</option>
		</select>
	*/
</script>