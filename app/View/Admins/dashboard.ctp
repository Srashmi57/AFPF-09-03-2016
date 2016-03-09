<?php echo $this->Html->script('common'); ?>


<div class="col-md-6">
<div class="box box-danger">
                                <div class="box-header ui-sortable-handle" style="cursor: move;">
                                    <i class="fa fa-user"></i>
                                    <h3 class="box-title">Registered Artist</h3>
                                    <div title="Status" data-toggle="tooltip" class="box-tools pull-right">
                                       
                                    </div>
                                </div>
								<div id="chat-box" class="box-body chat" >
                               
<?php
foreach($arr_ArtistData as $artistdata)
{
	$userfname = $artistdata['Users']['user_fname'];
	$userlname = $artistdata['Users']['user_lname'];
	$userimage = $artistdata['Users']['user_image'];
	$user_biography = $artistdata['Users']['user_biography'];
	$created = $artistdata['Users']['created'];
	$created = date('M d, Y h:mA', strtotime($created));
	if(strlen($user_biography)>200)
	{
		$user_biography = substr($user_biography,0,199);
	}
	$imagepath = Router::url('/',true)."assets/user/".$userimage;
	
		if(file_exists("assets/user/".$userimage)&& trim($userimage)!='')
		 {
				$userimagepath = $imagepath;
		 }
		 else
		 {
			$userimagepath = Router::url('/',true)."assets/default/default.gif"; 
		 }
	
	?>
                                    <!-- chat item -->
                                    <div class="item">
                                        <img class="online" alt="user image" src="<?php echo Router::url('/',true)."assets/default/default.gif"?>">
                                        <p class="message">
                                            <a class="name" >
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo $created;?> </small>
                                               <?php echo ucfirst($userfname)." ".ucfirst($userlname);?> 
                                            </a>
                                            <?php echo $user_biography;?>
                                        </p>
                                     </div><!-- /.item -->
                                    <!-- chat item -->
             
<?php	
}
?>
  </div>
  </div>
</div>


<div class="col-md-6">
<div class="box box-danger">
                                <div class="box-header ui-sortable-handle" style="cursor: move;">
                                    <i class="fa fa-user"></i>
                                    <h3 class="box-title">Registered User</h3>
                                    <div title="Status" data-toggle="tooltip" class="box-tools pull-right">
                                       
                                    </div>
                                </div>
								<div id="chat-box" class="box-body chat" >
<?php
foreach($arr_userData as $userdata)
{
	$userfname = $userdata['Users']['user_fname'];
	$userlname = $userdata['Users']['user_lname'];
	$userimage = $userdata['Users']['user_image'];
	$user_biography = $userdata['Users']['user_biography'];
	$created = $userdata['Users']['created'];
	
	  $created = date('M d, Y h:mA', strtotime($created));
	if(strlen($user_biography)>200)
	{
		$user_biography = substr($user_biography,0,199);
	}
	$imagepath = Router::url('/',true)."assets/user/".$userimage;
		if(file_exists("assets/user/".$userimage)&& trim($userimage)!='')
		 {
				$userimagepath = $imagepath;
		 }
		 else
		 {
			$userimagepath = Router::url('/',true)."assets/default/default.gif"; 
		 }
	?>
	   
	<div class="item">
		<img class="online" alt="user image" src="<?php echo Router::url('/',true)."assets/default/default.gif"?>">
		<p class="message">
			<a class="name" >
				<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo  $created;?> </small>
			   <?php echo ucfirst($userfname)." ".ucfirst($userlname);?> 
			</a>
			  <?php echo $user_biography;?>
		</p>
	 </div><!-- /.item -->
                                

<?php	
}
?>

</div>




