<?php echo $this->Html->script('common'); 
echo $this->Html->css('common.css');
echo $this->Html->script('jquery.tablesorter.min');
echo $this->Html->script('jquery.tablesorter.widgets.min');?>
<?php echo  $this->Html->script('jwplayer');?>
<script>jwplayer.key="O+FYs7sL4MmPQTrTnzu4GnKoKGao3KAW+AQ/PA==";</script>
<script type="text/javascript">
$( document ).ready(function() {
	$('table').tablesorter({
			widgets        : ['zebra', 'columns'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true,
			headers: {1: {sorter: 'custom_sort_function'},2: {sorter: 'false'},3: {sorter: 'false'},4: {sorter: 'false'}	,5: {sorter: 'false'}
       		}
		});
});
</script>

                            <div class="box box-warning">
							 <div class="box-header">
                             
                             <form class="navbar-form"  name="searchfilter" id="searchfilter" method="post">
                                            <div class="input-group">
                                         <input type="text" class="form-control" placeholder="Search"  required name="txtsearch"  id="txtsearch">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default" type="submit" ><i class="glyphicon glyphicon-search"></i></button>
                                                </div>
                                                
                                            </div>
                            </form>
                            
                            
                                </div><!-- /.box-header -->
							
                               
                                <div class="box-body">
								       <table class="table table-bordered tablesorter">
                                        
                                        <thead>
										<tr>
                                            <th >Sr. No.
                                            </th>
                                            <th>Name</th>
											 <th>Media name</th>
                                            
                                            <th>Media</th>
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php
									$count=0;
									/*echo "<pre>";
									print_r($usermedia);
									exit();
									echo "</pre>";*/
									$flashplayerpath = Router::url('/', true)."js/jwplayer/player.swf";
									$imagepath = Router::url('/', true)."assets/default/audio_default.png";
									if(count($usermedia)>0)
									{
									 foreach ($usermedia as $row)
										{
												$count++;
												$user_id = $row['users']['user_id'];
												$usermedia_id = $row['UserMedia']['usermedia_id'];
												if($row['UserMedia']['usermedia_status']==0)
												{
												  $statustext = "<span class='label label-danger'>Inactive</span>";
												   $status=1;
												}
												else
												{
												  $statustext = "<span class='label label-success'>Active</span>";
												  $status=0;
												}
												
											$usermedia_path = Router::url('/', true).$row['UserMedia']['usermedia_path'];
											$thumbnail_path = Router::url('/', true)."files/medium/".$user_id."/".$row['UserMedia']['usermedia_title'];
											$usermedia_type = $row['UserMedia']['usermedia_type'];
											$category_name =$row['category']['category_name'];
											$arraymediatype = explode('/',$usermedia_type);
											$coverid = $artistmediaDetails[0]['UserMedia']['cover_id'];
											if($coverid>0)
											{
												$imageusermedia_path = Router::url('/', true).$artistmediaDetails[0]['usermedia_cover']['usermedia_path'];
												$thumbnail_path = Router::url('/', true)."files/medium/".$retuser_id."/".$artistmediaDetails[0]['usermedia_cover']['usermedia_title'];
												$imagepath = $thumbnail_path;
												$pdfdefault = $thumbnail_path;
												$worddefault = $thumbnail_path;
											}
											else
											{
												$imageusermedia_path = Router::url('/', true).$row['UserMedia']['usermedia_path'];
												$imagepath = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
												$pdfdefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
												$worddefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
											}
											?>
										
										<tr>
										 <td><?php echo $count;?></td>
										<td><?php echo ucfirst($row['users']['user_fname'])." ".ucfirst($row['users']['user_lname']); ?></td>
										<td><?php echo $row['UserMedia']['usermedia_name']; ?></td>
									 
									<td align="center">
									<?php
									 $ext = pathinfo($row['UserMedia']['usermedia_title'], PATHINFO_EXTENSION);
								$audioextarray = array('mp3','wav','aiff','flac','MP3','WAV','AIFF','FLAC','m4a','M4A','f4a','F4A','aac','AAC','ogg','OGG','oga','OGA');
			$videoextarray = array('mp4','wav','mkv','flv','WAV','avi','3gp','MP4','MKV','FLV','AVI','3GP','mov','MOV','m4v','f4v','M4V','F4V','WebM','webm');
		$imageextarray = array('jpeg','jpg','png','JPEG','JPG','PNG','gif','GIF');
		$pdfarray = array('pdf','PDF');
		$docxarray = array('docx','doc','DOCX','DOC');
								if (in_array($ext, $audioextarray))
								{
								   $mediatype = 'audio';
								}
								else if (in_array($ext, $videoextarray))
								{
								   $mediatype = 'video';
								}
								else if (in_array($ext, $imageextarray))
								{
								   $mediatype = 'image';
								}
								else if (in_array($ext, $pdfarray))
								{
								   $mediatype = 'pdf';
								}
								else if (in_array($ext, $docxarray))
								{
								   $mediatype = 'word';
								}
									
								
									switch($mediatype)
									 {
										
									  case "image":
									 ?>
									
									      <img title="Image Title" src="<?php echo $thumbnail_path;?>" style="height:170px;widhth:100%">
										
										<?php
										break;
										case "audio": 
			case "video":
			$randnumber = rand();
				if($mediatype=="video")
					{
					  $imagepath="";
					}			
				?>	
					<div id='artist<?php echo $randnumber;?>' >Loading the player...</div>
					<script type='text/javascript'>
					var playerInstance3 = jwplayer('artist<?php echo $randnumber;?>');
						playerInstance3.setup({
							flashplayer: '<?php echo $flashplayerpath;?>',
							file:'<?php echo $usermedia_path;?>',
							height: 170,
							width:'60%',
							image:'<?php echo $imagepath;?>',
							class:'thumbnail',
							hide: true,
							'plugins': { 'viral-2': {'oncomplete':'False','onpause':'False','functions':'All'} }
						});
						playerInstance3.onPlay(function(e) {
											//alert('<?php echo $randnumber;?>');		
											 var audioFile = getCookie("currentaudio");
											 //alert(audioFile);
											  if (audioFile != "" && audioFile !='artist<?php echo $randnumber;?>') {
												 // alert('yes pause previous');
												  jwplayer(audioFile).pause(true);
												  //alert('paused');
											  }
													//document.cookie = 'currentaudio=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';	
													//setCookie("currentaudio", "<?php echo $randnumber;?>", 365);
													var cookieVal='artist<?php print($randnumber);?>';
													setCookie('currentaudio', cookieVal, 365);
													console.log("Setting Cookies : currentaudio = <?php echo $randnumber;?>" );
									});
					</script>	
 			
										
																					
										
									 <?php
									 break;
									
									
							case "pdf":
				$url = Router::url('/', true).'websites/pdfReader/'.$usermedia_id;
				?>
					<a href="<?php echo $url;?>"  target="_blank"><img src="<?php echo $pdfdefault?>" style="height:170px;widhth:100%" /></a> 
				<?php
			break;
			case "word":
				?>
					<a href="<?php echo Router::url('/',true).$artistmediaDetails[0]['UserMedia']['usermedia_path'];?>"  ><img src="<?php echo $worddefault; ?>" style="height:170px;widhth:100%"/></a> 
				<?php
			break;
				
						}
	
						
							
							?>
								
									</td>
										<td>
												
											<a href="javascript:void(0);" onclick="return fnadmindeletemedia(<?php echo $usermedia_id?>,'<?php echo $mediatype?>');"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a>
										</td>
										</tr>

								<?php }
								}
else
{
?>
  <td colspan="6" class="text-center">Result not found</td>
<?php
}								?>
                                    </tbody></table>	
                                    <div class="pagination pagination-large">
					<ul class="pagination">
							<?php
								echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
								echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
								echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
							?>
						</ul>
					</div>								
                               </div><!-- /.box-body -->
							  
									
                            </div><!-- /.box -->

<div class="modal fade" id="UpdateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Edit User</h4>
      </div>
      <div class="modal-body">
	  <form name="editNewAdmin" id="editNewAdmin" method="post">
      
            <div class="form-group">
                <label  for="Name">First Name  </label>
                     <input type="hidden" name="data[update_admin_id]" class="form-control validate[required]" id="update_admin_id" placeholder="Category name"/>
                    <input type="text" id="update_admin_fname" name="data[update_admin_fname]" class="form-control validate[required]" placeholder="First name"/>
                </div>
                
                 <div class="form-group">
                <label  for="Name">Last Name  </label>
                    
                    <input type="text" name="data[update_admin_lname]" id="update_admin_lname" class="form-control validate[required]" placeholder="Last name"/>
                </div>
                
                   <div class="form-group">
						<label  for="Name">Usertype</label>
                        <?php    echo $this->Form->input('usertype_list',array('label'=>false,'type'=>'select','options'=>$arr_UserTypeList,'class'=>'validate[required] form-control'));
?>
                    </div>
	     
					
				  <div class="form-group">
						<label  for="Name">Username  </label>
                        <input type="email" name="data[update_admin_email]" id="update_admin_email" class="form-control validate[required]" placeholder="Username"/>
                    </div>
                      
                    
                    
                   <div class="form-group">
	 					<label  for="Name"> Image </label>
			           <input type="file" name="userimage"  placeholder="Upload image..." class="validate[required]" >
                         <img id="showcatImage" src="" height="200px" width="200px" class="img-responsive thumbnail" style="margin-top:20px;"/>
	               </div>
                   
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnToUpdateAdmin();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
				

<!--for Add Category-->				
<div class="modal fade" id="example">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Add User</h4>
      </div>
      <div class="modal-body">
	  <form name="addNewAdmin" id="addNewAdmin" method="post" enctype="multipart/form-data">
	        	  <div class="form-group">
						<label  for="Name">First Name  </label>
                        <input type="text" name="txtFirstName" class="form-control validate[required]" placeholder="First name"/>
                    </div>
                     <div class="form-group">
						<label  for="Name">Last Name  </label>
                        <input type="text" name="txtLastName" class="form-control validate[required]" placeholder="Last name"/>
                    </div>
                    
                    <div class="form-group">
						<label  for="Name">Usertype</label>
                        <?php    echo $this->Form->input('usertype_list',array('label'=>false,'type'=>'select','options'=>$arr_UserTypeList,'class'=>'validate[required] form-control'));
?>
                    </div>
                 <div class="form-group">
						<label  for="Name">Email  </label>
                        <input type="email" name="txtEmail" class="form-control validate[required]" placeholder="Email"/>
                    </div>
                      <div class="form-group">
						<label  for="Name">Password  </label>
                        <input type="password" name="txtPassword" class="form-control validate[required]" placeholder="Password"/>
                    </div>
                    
                    
                   <div class="form-group">
	 					<label  for="Name"> Image </label>
			           <input type="file" name="userimage" placeholder="Upload image..." class="validate[required]" >
	               </div>
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnToAddAdmin();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	