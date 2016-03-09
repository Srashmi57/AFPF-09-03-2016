
<div class="modal fade" id="medianamemodal">
  <div class="modal-dialog">
    <div class="modal-content">
         
      <form name="frmmedianame" id="frmmedianame" method="post">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="60" height="50px"></button>
        <h4 class="modal-title">Update Media Name</h4>
      </div>
			  <div class="modal-body">
                
					<div class="errormsg"></div>
						  <div class="form-group col-sm-12 col-md-offset-2">
								<label  for="inputEmail3" class="col-sm-3 control-lable">Media:  </label>
								<div class="col-sm-6">
								<input type="text" name="medianame" id="medianame" value="" class="form-control validate[required,minSize[2],maxSize[25]]"/>
								<input type="hidden" name="medianameid" id="medianameid" value=""/>
								</div>
							</div>
							
								
							
							  
							 
	<div class="modal-footer poup-footer">
			<div class=" col-sm-4 pull-right">
			
			  <button href="#" data-dismiss="modal" class="btn btn-default">Close</button>
							  <button type="submit" class="btn btn-success" onclick="return updateMedianameprocess();" id="addItem">SUBMIT</button>
				 
			</div>
      </div>	  
							  
							
				</div>
      

	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>