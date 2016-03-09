<?php echo $this->Html->script('myprofile');?>
<!-- sell car-->	
	<section id="sell">
		<div class="container">

			<div class="row pagetitle">
				<div class="col-xs-12">
					<h2>My Profile</h2>
				</div>
			</div>	

			<div class="row">
				<article>
					<!-- main -->	
					<div class="col-md-9">

						
						<div class="row">
						<div class="col-md-12">
						

						
						</div>
						</div>
						
						<form role="form" id="myprofile" class="myprofile" method="POST">
						
						
						
						
						<div class="row">
							<div class="col-xs-12"><!--<h3>Customer details:</h3>--></div>
							<div class="col-md-4">
								
								<?php //$AddUrl=Router::url(array('controller'=>'cars','action'=>'index'),true);?>
								<?php //echo $this->Form->create('Vehicle',array('id'=>'sell','type'=>'file','method'=>'post'));?>
								<?php echo $this->Form->input('firstname',array('label'=>'first name. &nbsp;<span></span>','class'=>'form-control validate[required]','value'=>$arrWebUserProfile[0]['wcz_users']['user_fname']));?>
								<?php echo $this->Form->input('lastname',array('label'=>'Last name &nbsp;<span></span>','class'=>'form-control validate[required]','value'=>$arrWebUserProfile[0]['wcz_users']['user_lname']));?>
								<!--<div class="form-group">
									<label for="vim">Customer name:</label>
									<input class="form-control" id="vim">
								</div>-->
								<?php echo $this->Form->input('email',array('label'=>'Emailid &nbsp;<span></span>','class'=>'form-control validate[required]','value'=>$arrWebUserProfile[0]['wcz_users']['user_emailid']));?>
								<?php //echo $this->Form->label('Address/Location');?>
									<?php //echo $this->Form->textarea('Vehicle.remarks',array('rows' => '6', 'cols' => '30','class'=>'form-control'));?>
								<!--<div class="form-group">
									<label for="made">Customer email:</label>
									<input class="form-control" id="made">
								</div>-->
								
							</div>
								
							
							<div class="col-md-4">
								<?php //echo $this->Form->input('suggestme_seating_cpacity',array('label'=>'Seating Capacity. &nbsp;<span></span>','class'=>'form-control validate[required]'));?>
								
								<?php //echo $this->Form->input('suggestme_class',array('label'=>'Prefered class. &nbsp;<span></span>','class'=>'form-control','type'=>'select','options'=>array('Convertible'=>'Convertible','Coupe'=>'Coupe','Hatchback'=>'Hatchback','Pickup Truck'=>'Pickup Truck','Sedan'=>'Sedan','Van'=>'Van','Station Wagon'=>'Station Wagon','Luxury Cars'=>'Luxury Cars','Sport Utility Vehicles/SUV'=>'Sport Utility Vehicles/SUV','Mid-size Cars'=>'Mid-size Cars')));?>
								<!--<div class="form-group">
									<label for="price">Contact number:</label>
									<input class="form-control" id="price">
								</div>-->
								<!--<div class="form-group">-->
									
									<?php /*echo $this->Form->input('Vehicle.address',array('class'=>'form-control validate[required]','label'=>'Address/location. &nbsp;<span></span>'));*/?>
									<!--<label for="style">Address/location:</label>-->
									<!--<input class="form-control" id="price">-->
									<!--<div class="input-group">
										<input type="text" class="form-control"  id="style">
										<span class="input-group-addon" data-toggle="tooltip" title="Please Select the body style of your car." id="body_info"><i class="icon-info-circled"></i></span>
									</div>
								</div>-->
							</div>
								
							<div class="col-md-4">
								
								<?php //echo $this->Form->input('remarks',array('label'=>'Remark. &nbsp;<span></span>','class'=>'form-control'));?>
								<!--<div class="form-group">
									<label for="price">Remark:</label>
									<input class="form-control" id="price">
								</div>-->
							
							
							</div>
						</div>	
							
						<div class="row">
							<!--<div class="col-xs-12"><h3>Vehicle Details:</h3></div>-->
							<div class="col-md-4">
								
								<?php 
								
								//echo $this->Form->input('Vehicle.vehicle_reg_no1',array('label'=>'Registration No. &nbsp;<span>*</span>','maxlength'=>'4','style'=>'width:43px;text-transform:uppercase; ','class'=>'form-control uppercase validate[required]'));
								//echo $this->Form->input('Vehicle.vehicle_reg_no2',array('label'=>false,'maxlength'=>'2','style'=>'width:44px;margin:-34px 6px 0px 43px;text-transform:uppercase; ','class'=>'form-control uppercase validate[required]'));
								//echo $this->Form->input('Vehicle.vehicle_reg_no3',array('label'=>false,'maxlength'=>'4','style'=>'width:44px;margin:-34px 63px 0px 86px;text-transform:uppercase; ','class'=>'form-control uppercase validate[required]'));
								
								?>
								<?php //echo $this->Form->input('Vehicle.vehicle_reg_no',array('label'=>'Registration No. &nbsp;<span></span>','class'=>'form-control'));?>
								<!--<div class="form-group">
									<label for="vim">Registration No:</label>
									<input class="form-control" id="vim">
								</div>-->
								<?php  //echo $this->Form->input('Vehicle.vehicle_brand',array('class' => 'form-control  validate[required]','label'=>'Brand &nbsp;<span>*</span>','type'=>'select','options'=>$arrVehicleBrandList,'onChange'=>'fnGetModelList(this.value,"VehicleVehicleModelsell","VehicleVehicleVariantsell")'));?>
								<?php  //echo $this->Form->input('Vehicle.vehicle_variantsell',array('class' => 'form-control validate[required]','label'=>'Variant &nbsp;<span>*</span>','type'=>'select','options'=>$arrVehicleVariantList));?>
								<?php //echo $this->Form->input('Variant', array('class' => 'form-control','type'=>'select','options'=>$arrVehicleVariantList));?>
								<!--<div class="form-group">
									<label for="made">Brand:</label>
									<input class="form-control" id="made">
								</div>-->
								<?php //echo $this->Form->input('Vehicle.show_vehicle_manufacture_date',array('label'=>'Manufacture Date &nbsp;<span>*</span>','class'=>'form-input','readonly'=>'readonly'));
		//echo $this->Form->hidden('vehicle_manufacture_date'); ?>
								<?php //echo $this->Form->input('Vehicle.show_vehicle_manufacture_date',array('class'=>'form-control validate[required]','label'=>'Manufacture Date &nbsp;','readonly'=>'readonly'));
								//echo $this->Form->hidden('vehicle_manufacture_date');?>
								<?php //echo $this->Form->input('Vehicle.Vehicle_Purchase Date',array('label'=>'Purchase Date. &nbsp;<span></span>','class'=>'form-control'));?>
								<!--<div class="form-group">
									<label for="price">Model:</label>
									<input class="form-control" id="price">
								</div>-->
								<div class="form-group">
									
									<?php //echo $this->Form->input('Vehicle.vehicle_insurance_type', array('class' => 'form-control','label'=>'Insurance Type &nbsp;<span>*</span>','type'=>'select','options'=>array('Nil'=>'Nil','Zero debt'=>'Zero debt','Third party'=>'Third party','Comprehensive'=>'Comprehensive')));?>
									<!--<label for="style">Variant:</label>
									<input class="form-control" id="price">-->
									<!--<div class="input-group">
										<input type="text" class="form-control"  id="style">
										<span class="input-group-addon" data-toggle="tooltip" title="Please Select the body style of your car." id="body_info"><i class="icon-info-circled"></i></span>
									</div>-->
								</div>
							</div>
							
							<div class="col-md-4">
								
								<?php  //echo $this->Form->input('Vehicle.vehicle_variantsell',array('class' => 'form-control validate[required]','label'=>'Variant &nbsp;<span>*</span>','type'=>'select','options'=>$arrVehicleVariantList));?>
								<?php  //echo $this->Form->input('Vehicle.vehicle_brand',array('class' => 'form-control  validate[required]','label'=>'Brand &nbsp;<span>*</span>','type'=>'select','options'=>$arrVehicleBrandList,'onChange'=>'fnGetModelList(this.value,"VehicleVehicleModelsell","VehicleVehicleVariantsell")'));?>
								<?php //echo $this->Form->input('vehicle_brand', array('class' => 'form-control','options'=>$arrVehicleBrandList,'onChange'=>'fnGetModelList(this.value)'));?>
								<!--<div class="form-group">
									<label for="year">Fual Type:</label>
									<input class="form-control" id="year">
								</div>-->

								<div class="form-group">
									
									<?php //echo $this->Form->input('Vehicle.vehicle_body_style',array('label'=>'Body Style &nbsp;<span>*</span>','type'=>'select','options'=>$arraVehicleBodyStyleList,'class' => 'form-control validate[required]'));?>
									<?php //echo $this->Form->input('Vehicle.vehicle_fual_type',array('class' => 'form-control validate[required]','label'=>'Fual Type &nbsp;<span>*</span>','type'=>'select','options'=>array('Petrol'=>'Petrol','Diesel'=>'Diesel','LPG'=>'LPG','CNG'=>'CNG')));?>
									
								</div>

								<div class="form-group">
									
									<?php //echo $this->Form->input('Vehicle.vehicle_kilometers',array('label'=>'Kilometers. &nbsp;<span></span>','class'=>'form-control validate[required]'));?>
									<!--<label for="mileage">Color:</label>
									<input class="form-control" id="mileage">-->
								</div>
								<div class="form-group">
									<?php //echo $this->Form->input('Vehicle.show_vehicle_insurance_validity',array('label'=>'Insurance Validity &nbsp;','class'=>'form-control validate[required]','readonly'=>'readonly'));
									//echo $this->Form->hidden('Vehicle.vehicle_insurance_validity');?>
									<?php //echo $this->Form->input('Vehicle.Vehicle_Insurance validity',array('label'=>'Insurance validity. &nbsp;<span></span>','class'=>'form-control','readonly'=>'readonly'));?>
									<!--<label for="year2">Purchase Date:</label>
									<input class="form-control" id="year2">-->
								</div>
								
								
								<div class="form-group">
									
									
									<!--<label for="mileage2">Kilometers:</label>
									<input class="form-control" id="mileage2">-->
								</div>
								<div class="form-group">
									
									
									
									<!--<label for="color">Color:</label>
									
									<?php //echo $this->Form->input('Vehicle.vehicle_color',array('label'=>'color. &nbsp;<span></span>','class'=>'form-control'));?>
									<!--<select class="form-control" id="color">
										<option>-SELECT-</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>-->
								</div>	
							</div>

							<div class="col-md-4">
								<div class="form-group">
									
									<?php  //echo $this->Form->input('Vehicle.vehicle_modelsell',array('class' => 'form-control validate[required]','label'=>'Model &nbsp;<span>*</span>','type'=>'select','options'=>$arrVehicleModelList,'onChange'=>'fnGetVariantList(this.value,"VehicleVehicleVariantsell")'));?>
									<?php //echo $this->Form->input('Vehiclevehicle_model', array('class' => 'form-control','type'=>'select' ,'options'=>$arrVehicleModelList,'onChange'=>'fnGetVariantList(this.value)'));?>
									<!--<label for="year2">Purchase Date:</label>
									<input class="form-control" id="year2">-->
								</div>

								<div class="form-group">
									<?php //echo $this->Form->input('Vehicle.vehicle_color',array('label'=>'Color. &nbsp;<span></span>','class'=>'form-control validate[required]'));?>
								</div>

								<div class="form-group">
									
									<?php //echo $this->Form->input('Vehicle.vehicle_owner_type', array('class' => 'form-control','label'=>'Owner(s) &nbsp;<span>*</span>','type'=>'select','options'=>array('1'=>'1st','2'=>'2nd','3'=>'3rd','4'=>'4th','more than 4'=>'more than 4')));?>
									
								</div>
								
								

								
								<!--<div class="form-group">
									<label for="model2">Color:</label>
									<select class="form-control" id="model2">
										<option>-SELECT-</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>	-->
							</div>

							</div>

							<!--<div class="row">		
							<div class="col-md-4">
								<div class="form-group">
									<label for="name">Name:</label>
									<input class="form-control" id="name">
								</div>
								<div class="form-group">
									<label for="email">Email:</label>
									<input class="form-control" id="email">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="surname">Surname:</label>
									<input class="form-control" id="surname">
								</div>
								<div class="form-group">
									<label for="phone">Phone Number:</label>
									<select class="form-control" id="phone">
										<option>-SELECT-</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
							</div>

							</div>
							
							<div class="row">
								<div class="form-group col-md-8">
									<label for="description">Description</label>
									<textarea id="description" class="form-control" rows="6"></textarea>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12">
									<button type="submit" class="btn info">Send Information</button>	
								</div>
							</div>-->

							
							<div class="row">
							<div class="col-xs-12"><!--<h3>General details:</h3>--></div>
							<div class="col-md-4">
								<div class="form-group">
									
									<?php //echo $this->Form->input('Vehicle_Date_of_valuation',array('label'=>'Date of valuation. &nbsp;<span></span>','class'=>'form-control'));?>
									<?php //echo $this->Form->input('Vehicle.show_vehicle_date_of_evaluation',array('class'=>'form-control validate[required]','readonly'=>'readonly','label'=>'Date Of Evaluation &nbsp;<span>*</span>'));
									//echo $this->Form->hidden('Vehicle.vehicle_date_of_evaluation');
									?>
								</div>

								<div class="form-group">
									<?php //echo $this->Form->input('Vehicle_Expected_Price',array('label'=>'Expected Price. &nbsp;<span></span>','class'=>'form-control'));?>
								
								<?php //echo $this->Form->input('Vehicle.vehicle_expected_price',array('label'=>'Price &nbsp;<span>*</span>','class'=>'form-control validate[required]'));
		?>
								</div>
								
							</div>	
								
							
							<div class="col-md-4">
								<div class="form-group">
									<?php //echo $this->Form->label('Remarks');?>
									<?php //echo $this->Form->textarea('Vehicle.remarks',array('rows' => '6', 'cols' => '30','class'=>'form-control'));?>
									
									
								</div>
								<div class="form-group">
									
									<?php //echo $this->Form->input('Vehicle.vehicle_images.', array('type' => 'file', 'multiple','label'=>'Upload Images','class'=>'form-control','required'=>false));?>
									<!--<label for="style">Upload pics :</label>
									<input class="form-control" id="price">-->
									<!--<div class="input-group">
										<input type="text" class="form-control"  id="style">
										<span class="input-group-addon" data-toggle="tooltip" title="Please Select the body style of your car." id="body_info"><i class="icon-info-circled"></i></span>
									</div>-->
								</div>
							</div>
								
							<div class="col-md-4">
								
							
							
							</div>
							
						</div>	
						
						
						<div class="row">
								<div class="col-xs-12">
								<?php echo $this->Form->submit(__('Submit Information',true), array('class'=>'btn'));
						            $this->Form->end('');?>
								<!--<button type="submit" class="btn info" name="submit">Submit Information</button>-->
								</div>
							</div>
						
						
						</form>
					</div>
					<!-- end mail -->	


					<!-- sidebar -->	
					<!--<aside class="col-md-3">
						<div class="row">
							<h3><span>Why sel</span> with us?</h3>
							<div class="panel-group" id="accordion">
								
								<div class="panel panel-accordion">
									<div class="panel-heading">
										<p class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									  			<span class="badge pull-right"><i class="icon-minus"></i></span>Integer sed porta quam tempus aliquam
											</a>
								  		</p>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											<strong>Integer sed porta quam</strong>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.
										</div>
									</div>
								</div>
								
								<div class="panel panel-accordion">
									<div class="panel-heading">
										<p class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
												<span class="badge pull-right"><i class="icon-plus"></i></span>Integer sed porta quam tempus aliquam
											</a>
										</p>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">
											<strong>Integer sed porta quam</strong>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
										</div>
									</div>
								</div>

								<div class="panel panel-accordion">
									<div class="panel-heading">
										<p class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
												<span class="badge pull-right"><i class="icon-plus"></i></span>Integer sed porta quam tempus aliquam
											</a>
										</p>
									</div>
									
									<div id="collapseThree" class="panel-collapse collapse">
										<div class="panel-body">
											<strong>Integer sed porta quam</strong>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
										</div>
									</div>
								</div>

								<div class="panel panel-accordion">
									<div class="panel-heading">
										<p class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
												<span class="badge pull-right"><i class="icon-plus"></i></span>Integer sed porta quam tempus aliquam
											</a>
										</p>
									</div>
									
									<div id="collapseFour" class="panel-collapse collapse">
										<div class="panel-body">
											<strong>Integer sed porta quam</strong>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
										</div>
									</div>
								</div>

								<div class="panel panel-accordion">
									<div class="panel-heading">
										<p class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
												<span class="badge pull-right"><i class="icon-plus"></i></span>Integer sed porta quam tempus aliquam
											</a>
										</p>
									</div>
									
									<div id="collapseFive" class="panel-collapse collapse">
										<div class="panel-body">
											<strong>Integer sed porta quam</strong>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<h3><span>Text</span> widget</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. <i class="icon-right-thin"></i></p>
						</div>

						<div class="row">
							<h3><span>Link</span> list</h3>
							<div class="list-group">
								<a href="#" class="list-group-item"><i class="icon-right-open"></i>Cras justo odio</a>
								<a href="#" class="list-group-item"><i class="icon-right-open"></i>Dapibus ac facilisis in</a>
								<a href="#" class="list-group-item"><i class="icon-right-open"></i>Morbi leo risus</a>
								<a href="#" class="list-group-item"><i class="icon-right-open"></i>Porta ac consectetur ac</a>
								<a href="#" class="list-group-item"><i class="icon-right-open"></i>Vestibulum at eros</a>
							</div>
						</div>

						<div class="row">
							<h3><span>More</span> cars on flickr</h3>
							<ul class="flickr-feed"></ul>
						</div>

					</aside>-->
					<!-- end sidebar -->	

				</article>
			</div>
		</div>
	</section>
<?php echo $this->element('sql_dump'); ?>
		
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
	
	
	//echo $this->Html->script('websitejs/fancybox/jquery.fancybox');
	
	// Slider Revolution
	echo $this->Html->script('websitejs/plugins/revolution/js/jquery.themepunch.plugins.min');
	echo $this->Html->script('websitejs/plugins/revolution/js/jquery.themepunch.revolution.min');
	
	// Custom
	echo $this->Html->script('websitejs/script');
	echo $this->Html->script('jquery/jquery.form');	
	echo $this->Html->script('http://maps.google.com/maps/api/js?latitude=18.566644,longitude=73.915407&sensor=true', false);
	?>
<script type='text/javascript'>
	$(document).ready(function () {
	
		
		$('#VehicleShowVehicleManufactureDate').datepicker({ 
						dateFormat: 'dd M yy', changeMonth: true, changeYear: true,
						altField: "#VehicleVehicleManufactureDate", altFormat: "yy-mm-dd",
						maxDate: "+0D"
			});
			
		$('#VehicleShowVehicleInsuranceValidity').datepicker({ 
						dateFormat: 'dd M yy' ,
						altField: "#VehicleVehicleInsuranceValidity", altFormat: "yy-mm-dd"
			});
						
		$('#VehicleShowVehicleDateOfEvaluation').datepicker({ 
						dateFormat: 'dd M yy',
						altField: "#VehicleVehicleDateOfEvaluation", altFormat: "yy-mm-dd",
						minDate: 0,
			});
	});
</script>
