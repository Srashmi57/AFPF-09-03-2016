<script type="text/javascript">
	var uploadcoverfor = '';
</script>
<?php
echo $this->Html->script('/js/fileuploaderjs/main');
?>
<div class="modal fade" id="mymediaModal">
  <div class="modal-dialog">
    <div class="modal-content">
   
        <div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button"><img width="60" height="50px" src="http://www.artformplatform.com/afpf/images/close-icon.png"></button>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Upload Media</h4>
      </div>
   		<div class="modal-body media_modal">
		<span class="star">Note:</span> Please select any category or cover option to upload artwork and its cover. 
       <div id="mediacontainer" class="row">
	
	<ul class="nav nav-pills">
	  <li id="add_image" class="active"><a data-toggle="pill" href="#home" style="background-color:transparent;">Upload Media</a></li>
	  <li id="cover_image"  style="background-color:transparent;"><a data-toggle="pill" href="#menu1">Set Cover Image</a></li>
	</ul>
	<div class="tab-content">
	  <div id="home" class="tab-pane fade in active">
		<form id="fileupload" action="" method="POST" enctype="multipart/form-data">
			<div id="mediaupload">
				<div class="form-group col-sm-12">
					  
					<div class="col-sm-6 ">
						<label  for="Name"> Media Name :   </label>
						<input type="text" name="media_name" id="media_name" class="form-control validate[required,minSize[2],maxSize[15]]" placeholder="Media Name"/>
					</div>
					
					<div class="col-sm-6">
						<label> Add Cover Image? : <span class="star">*</span> </label>
						<select name="add_cover" id="add_cover" class="form-control">
							<option value="0">--Select One--</option>
							<option selected="selected" value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
					</div>
					
					<div class="col-sm-6 ">
						<label  for="Name"> Category : <span class="star">*</span> </label>
						<?php    
							echo $this->Form->input('usercategory_list',array('label'=>false,'type'=>'select','options'=>$arr_userCategoryList,'class'=>'validate[required] form-control' ,'onChange'=>'fnGetSubcategoryList(this.value)'));
						?>
					</div>
							
					<div class="col-sm-6">
						<label  for="Name">Subcategory :  </label>
						<?php       
							echo $this->Form->input('subcategory_id',array('label'=>false,'type'=>'select','options' => array(
							'0' => 'Please select subcategory'), 'class'=>'validate[required] form-control subcatlist','onChange'=>'fnGetSubSubcategoryList(this.value)'));
						?>
					</div>
							  
					<div class="col-sm-6">
						<label  for="Name"> Subsubcategory : </label>

						<?php       
							echo $this->Form->input('subsubcategory_id',array('label'=>false,'type'=>'select', 'options' => array('0' => 'Please select subsubcategory'),'class'=>'validate[required] form-control subsubcatlist'));
						?>
					</div>
					<p>
					<p><span class="star">Note:</span></p>
					<!-- <p>Maximum file upload size:50mb</p> -->
					<p>Supported Formats for Artwork Uploads are as follows:</p>
	<p>Audio: mp3, aac, m4a, f4a, ogg</p>
	<p>Video: mp4, webm, m4v, f4v, .mov</p>
	<p>Images: JPEG, GIF, PNG.</p>
					
					<p>
					 <?php 
					  $strtermsUrl = Router::url(array('controller'=>'websites','action'=>'terms'),true);
					 ?>
						<input class="checkbox rememberme" name="terms_me" id="terms" value="" type="checkbox" style="margin: -9px 4px !important;"> I accept <a href="<?php echo $strtermsUrl;?>" target="_blank" style="color:blue">Terms & Conditions</a>
	                </p>
						<?php
							echo $this->Html->css('fileuploadercss/jquery.fileupload');
							echo $this->Html->css('http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css');
						?>
						<div class="col-md-12">
							<!-- The file upload form used as target for the file upload widget -->
							
								<!-- Redirect browsers with JavaScript disabled to the origin page -->
								<noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>
								<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
								<div class="row fileupload-buttonbar" style="display:none">
									<div class="col-md-12">
										<!-- The fileinput-button span is used to style the file input field as button -->
										<span class="btn btn-success fileinput-button">
											<i class="glyphicon glyphicon-plus"></i>
											<span>Add files...</span>
											<input type="file" name="files[]">
										</span>
										<div id="sub-div" class="btn">
										<button type="submit" class="btn btn-primary btn-success start" disabled id="customButton">
										
											<i class="glyphicon glyphicon-upload"></i>
											<span>Start upload</span>
										</button>
										</div>
										<button type="reset" class="btn btn-warning btn-success cancel">
											<i class="glyphicon glyphicon-ban-circle"></i>
											<span>Cancel upload</span>
										</button>
										<!--<button type="button" class="btn btn-danger delete">
											<i class="glyphicon glyphicon-trash"></i>
											<span>Delete</span>
										</button>
										<input type="checkbox" class="toggle">-->
										<!-- The global file processing state -->
										<span class="fileupload-process"></span>
									</div>
									<div>&nbsp;</div>
									<!-- The global progress state -->
									<div class="col-md-5 fileupload-progress fade">
										<!-- The global progress bar -->
										<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
											<div class="progress-bar progress-bar-success" style="width:0%;"></div>
										</div>
										<!-- The extended global progress state -->
										<div class="progress-extended">&nbsp;</div>
									</div>
								</div>
								<!-- The table listing the files available for upload/download -->
								<table role="presentation" class="table table-striped mediatable"><tbody class="files"></tbody></table>
							
							<!-- The template to display files available for upload -->
							<script id="template-upload" type="text/x-tmpl">
							{% for (var i=0, file; file=o.files[i]; i++) { %}
								<tr class="template-upload fade">
									<td>
										<span class="preview"></span>
									</td>
									<td>
										<p class="name">{%=file.name%}</p>
										<strong class="error text-danger"></strong>
									</td>
									<td>
										<p class="size">Processing...</p>
										<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
									</td>
									<td>
										{% if (!i && !o.options.autoUpload) { %}
											<button class="btn btn-primary btn-success start" disabled style="display:none;">
												<i class="glyphicon glyphicon-upload"></i>
												<span>Start</span>
											</button>
										{% } %}
										{% if (!i) { %}
											<button class="btn btn-warning btn-success cancel" >
												<i class="glyphicon glyphicon-ban-circle"></i>
												<span>Cancel</span>
											</button>
										{% } %}
									</td>
								</tr>
							{% } %}
							</script>
							<!-- The template to display files available for download -->
							<script id="template-download" type="text/x-tmpl">
							{% for (var i=0, file; file=o.files[i]; i++) { %}
								<tr class="template-download fade">
									<td>
										<span class="preview">
											{% if (file.thumbnailUrl) { %}
												<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
											{% } %}
										</span>
									</td>
									<td>
										<p class="name" style="color: white;">
											{% if (file.url) { %}
												<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
											{% } else { %}
												<span>{%=file.name%}</span>
											{% } %}
										</p>
										{% if (file.error) { %}
											<div style="color: red;font-weight: bold;"><span class="label label-danger">Error</span> {%=file.error%}</div>
										{% } %}
									</td>
									<td>
										<span class="size" style="color: white;">{%=o.formatFileSize(file.size)%}</span>
									</td>
									<td>
										{% if (file.deleteUrl) { %}
											
											<button class="btn btn-danger btn-success delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
												<i class="glyphicon glyphicon-trash"></i>
												<span>Delete</span>
											</button>
											<!--<input type="checkbox" name="delete" value="1" class="toggle">-->
										{% } else { %}
											<button class="btn btn-warning cancel">
												<i class="glyphicon glyphicon-ban-circle"></i>
												<span>Cancel</span>
											</button>
										{% } %}
									</td>
								</tr>
							{% } %}
							</script>
						</div>
					</p>
				</div>
			</div>
		</form>
	  </div>
	  <div id="menu1" class="tab-pane fade">
		<p id="cover_image_content">
			&nbsp; Please upload art work
		</p>
	  </div>
	</div>
		
	<div class="col-md-12">

	  </div><!-- /.modal-body -->
	  <div class="modal-footer">
				<button aria-hidden="true"  id="closemediamodal" class="btn btn-default">Close</button>
			
			</div>
    </div><!-- /.modal-content -->
  </div>
  </div>
  </div>
<script type="text/javascript">
$("#media_name").change(function()
{
 if($(this).val().length>25)
 {
    alert("minimum length 25 chars");
	$(this).val('');
	$('.fileupload-buttonbar').css('display','none');
 }
})

$('#closemediamodal').click(
	function(){
		$("#mymediaModal").modal('hide');
	
});
$(".start").click(function(e)
{
	
 if($('.files').find("tr").length<=0)
	{
		$("#mymediaModal").modal('hide');
		bootbox.alert("No file being selected to upload");
		
	}
	
	
	
	
})

$(".cancel").click(function()
{
	$("#mymediaModal").modal('hide');
})
$("#add_cover").change(function()
{
  var checkcatid = $('#usercategory_list').val();
	if($(this).val()<=0)
	{
		$(".fileupload-buttonbar").css('display','none');
	}
	else if((checkcatid>0)&&($(this).val()!=0))
	{
		$(".fileupload-buttonbar").css('display','block');	
	}
})


$('#terms').on('change', function(){

if ($('#terms').is(":checked")) {
    $('#customButton').prop('disabled',false);
}
else{
    $('#customButton').prop('disabled',true);
}
});

$('#sub-div').on('click',function(e){
if( $('#customButton').prop('disabled') ) 
    {
        alert('You must agree with our terms and conditions before proceeding');
    }
    
	
});
</script>