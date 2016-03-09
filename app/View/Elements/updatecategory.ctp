<?php
echo $this->Html->script('bootstrap-select');
echo $this->Html->css('bootstrap-select');
?>


<div class="modal fade" id="modalupdatecategory">
  <div class="modal-dialog">
    <div class="modal-content">
         
      <form name="frmupdatecategory" id="frmupdatecategory" method="post">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="60" height="50px"></button>
        <h4 class="modal-title">Add Category</h4>
      </div>
			  <div class="modal-body">
                
					<div class="errormsg"></div>
						 <div class="form-group col-sm-12">
                     
				 <label  for="Name"> Category : <span class="star">*</span> </label>
		<div class="col-md-6">
				<?php    echo $this->Form->input('category_list',array('label'=>false,'type'=>'select','options'=>$arr_CategoryList,'class'=>'validate[required,funcCall[ifSelectNotEmpty]] selectpicker form-control category-dropdown','multiple'=>'multiple' , 'data-max-options' => "5"));
?>
</div>
                     
                         
                    </div>
					 
							 
	<div class="modal-footer poup-footer">
			<div class=" col-sm-4 pull-right">
			
			  <button href="#" data-dismiss="modal" class="btn btn-default">Close</button>
							  <button type="submit" class="btn btn-success" onclick="return fnupdatecategory();" id="addItem">SUBMIT</button>
				 
			</div>
      </div>	  
							  
							
				</div>
      

	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>