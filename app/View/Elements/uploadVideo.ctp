
	
	<div class="modal fade" id="videoupload">
  <div class="modal-dialog">
    <div class="modal-content">
         
      <form name="frmvideoupload" id="frmvideoupload" method="post" enctype="multipart/form-data">
      <div class="modal-header">
	
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="60" height="50px"></button>
        <h4 class="modal-title">Vimeo Video Upload</h4>
      </div>
			  <div class="modal-body">
                <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
					<div id="errormsg"></div>
					
							<div class="form-group col-sm-12 col-md-offset-2">
								<label  for="inputEmail3" class="col-sm-3 control-lable">Video Title: <span class="star">*</span> </label>
								<div class="col-sm-6">
								<input name="title" id="title" type="text" class="form-control validate[required]" />
                                                                                           
								</div>
							</div>
							
							<div class="form-group col-sm-12 col-md-offset-2">
								<label  for="inputEmail3" class="col-sm-3 control-lable">Video: <span class="star">*</span> </label>
								<div class="col-sm-6">
								<input type="hidden" name="action" value="upload" />
								<input name="FileInput" id="FileInput" type="file" class="validate[required]" />
                                                                                           
								</div>
								
							</div>
								
							<div class="form-group col-sm-12 col-md-offset-2">
								<label  for="inputEmail3" class="col-sm-3 control-lable">Video Description: <span class="star">*</span> </label>
								<div class="col-sm-6">
								<textarea name="desc" id="desc" type="text" class="form-control validate[required]" ></textarea>
                                                                                        
								</div>
							</div>
							
							  <div class="form-group col-sm-12 col-md-offset-4">
							  <div class="col-sm-offset col-sm-6">
							  <button type="submit" class="btn btn-primary btn-lg btn-block submit-button" onclick="return uploadVideo();" id="addItem">SUBMIT</button>
							  </div>
							  </div>
							
							
				</div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
                 <button href="#" data-dismiss="modal" class="btn btn-default">Close</button>
      
			</div>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>