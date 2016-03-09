<div class="preproc_main">
    <h2>Invoice</h2>
		<br clear="all"/>
		<div class="cms-bgloader-mask"></div>
		<div class="cms-bgloader"></div>
    	<div class="search">
		<?php 
				echo $this->Form->create('Search');
				//echo $this->Form->input('keywords',array('div'=>false,'label'=>array('text'=>'Keywords','class'=>'search-label'),'class'=>'form-input validate[required]'));
				echo $this->Form->input('vehicle_status',array('type'=>'hidden','value'=>'4'));
				echo '<b>Search By</b>';
				echo '<br clear="all"/>';
				
				echo '<div class="search_cont">';
					echo '<div class="search-label">Reg No</div>';
					echo $this->Form->input('vehicle_reg_no1',array('div'=>false,'label'=>false,'maxlength'=>'4','style'=>'width:40px;','class'=>'form-input uppercase validate[custom[onlyVehicleRegNo1]]'));
					echo $this->Form->input('vehicle_reg_no2',array('div'=>false,'label'=>false,'maxlength'=>'2','style'=>'width:20px;margin-left:10px;','class'=>'form-input uppercase validate[custom[onlyVehicleRegNo2]]'));
					echo $this->Form->input('vehicle_reg_no3',array('div'=>false,'label'=>false,'maxlength'=>'4','style'=>'width:40px;margin-left:10px;','class'=>'form-input uppercase validate[custom[onlyVehicleRegNo3]]'));
				echo '</div>';
				
				/*echo '<div class="search_cont">';
					echo '<div class="search-label">Buyer Phone No</div>';
					echo $this->Form->input('buyer_phone_no',array('div'=>false,'label'=>false,'placeholder'=>'Phone Number','class'=>'form-input','disabled'=>'disabled'));
				echo '</div>';*/
				
				echo '<div class="search_cont">';
					echo '<div class="search-label">Brand</div>';
					echo $this->Form->input('vehicle_brand',array('div'=>false,'label'=>false,'type'=>'select','options'=>$arrVehicleBrandList,'class'=>'','onChange'=>'fnGetModelList(this.value,"SearchVehicleModel","SearchVehicleVariant")'));
				echo '</div>';
				
				echo '<div class="search_cont">';
					echo '<div class="search-label">Model</div>';
					echo $this->Form->input('vehicle_model',array('div'=>false,'label'=>false,'type'=>'select','options'=>$arrVehicleModelList,'class'=>'','onChange'=>'fnGetVariantList(this.value,"SearchVehicleVariant")'));
				echo '</div>';
				
				echo '<div class="search_cont">';
					echo '<div class="search-label">Variant</div>';
					echo $this->Form->input('vehicle_variant',array('div'=>false,'label'=>false,'type'=>'select','class'=>'','options'=>$arrVehicleVariantList));
				echo '</div>';
				
				echo '<div class="search_cont">';
					echo '<br clear="all"/>';
					echo '<br clear="all"/>';
					echo $this->Form->submit('Search', array('div' => false,'class' => 'searchbutton'));
				echo '</div>';
				//echo $this->Form->input('search_keywords',array('div'=>false,'label'=>false,'placeholder'=>'Search Car','class'=>'form-input validate[required]'));
				//echo $this->Form->button('Reset', array('type'=>'reset','class' => 'searchbutton'));
				//echo $this->Form->button('Reset', array('type'=>'reset','onClick="window.location.reload()"));
		?>
		</div>
	
    <div class="invoice_content">
	
    	 <div class="table-div">
			<div class="tr headingrow">
				<div class="th srno">Sr.No</div>
					<div class="th">Reg. No</div>
					<div class="th">Brand</div>
					<div class="th">Model</div>
					<div class="th">Variant</div>
				</div>
            	<?php
                if(is_array($arrSaleVehicleData) && (count($arrSaleVehicleData)) > 0 )
                {	/*print("<pre>");print_r($arrSaleVehicleData);exit;*/
					$srno = 1;
					foreach($arrSaleVehicleData as $val)
					{
                ?>
				<a href="viewinvoice/<?php echo $val['wcz_vehicle']['vid']; ?>">
                <div class="tr">
                    <div class="td srno"><?php echo $srno++; ?> </div>
                    <div class="td"><?php echo $val['wcz_vehicle']['reg_no']; ?></div>
                    <div class="td"><?php echo $val['wcz_brand']['brand_name']; ?></div>
                    <div class="td"><?php echo $val['wcz_model']['model_name']; ?></div>
                    <div class="td"><?php echo $val['wcz_variant']['variant_name']; ?></div>
                </div>
				</a>
          		<?php 
					}
				} 
	       ?>
        </div>
   </div>

</div>