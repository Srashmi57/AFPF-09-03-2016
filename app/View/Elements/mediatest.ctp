<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */


App::uses('Debugger', 'Utility');
$strFileUploadUrl = Router::url(array('controller'=>'test','action'=>'uploadfile'),true);
if($intCoverNewFor != "")
{
	?>
		<script type="text/javascript">
			var uploadcoverfor = '<?php echo $intCoverNewFor; ?>';
		</script>
	<?php
}
else
{
	?>
		<script type="text/javascript">
			var uploadcoverfor = '';
		</script>
	<?php
}
?>
<?php
echo $this->Html->script('/js/fileuploaderjs/main');
?>
<script type="text/javascript">
	$(document).ready(function () {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			 var mediatargettab = $(e.target).attr("href");
			 if(mediatargettab == "#existingmedia")
			 {
				$('.tabloader').show();
				fnExistingMediaContent();
				/*if($('#medialister').length>0)
				{
					$('.tabloader').hide();
				}
				else
				{
					fnExistingMediaContent();
				}*/
			 }
		});
	});
</script>

<div id="mediacontainer" class="row">
	<div class="col-md-12">
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane fade in active" id="mediaupload">
				<!--<p class="tabloader"></p>-->
				<p>
					<?php
						echo $this->Html->css('fileuploadercss/jquery.fileupload');
						echo $this->Html->css('http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css');
					?>
					<div class="col-md-12">
						<!-- The file upload form used as target for the file upload widget -->
						<form id="fileupload" action="<?php echo $strFileUploadUrl; ?>" method="POST" enctype="multipart/form-data">
							<!-- Redirect browsers with JavaScript disabled to the origin page -->
							<noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>
							<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
							<div class="row fileupload-buttonbar">
								<div class="col-md-12">
									<!-- The fileinput-button span is used to style the file input field as button -->
									<span class="btn btn-success fileinput-button black-button">
										<i class="glyphicon glyphicon-plus"></i>
										<span>Add files...</span>
										<input type="file" name="files[]" multiple>
									</span>
									<button type="submit" class="btn btn-primary start black-button">
										<i class="glyphicon glyphicon-upload"></i>
										<span>Start upload</span>
									</button>
									<button type="reset" class="btn btn-warning cancel black-button">
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
							<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
						</form>
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
										<button class="btn btn-primary start black-button" disabled>
											<i class="glyphicon glyphicon-upload"></i>
											<span>Start</span>
										</button>
									{% } %}
									{% if (!i) { %}
										<button class="btn btn-warning cancel black-button"> 
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
									<p class="name">
										{% if (file.url) { %}
											<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
										{% } else { %}
											<span>{%=file.name%}</span>
										{% } %}
									</p>
									{% if (file.error) { %}
										<div><span class="label label-danger">Error</span> {%=file.error%}</div>
									{% } %}
								</td>
								<td>
									<span class="size">{%=o.formatFileSize(file.size)%}</span>
								</td>
								<td>
									{% if (file.deleteUrl) { %} 
										
										<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
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
	</div>
</div>