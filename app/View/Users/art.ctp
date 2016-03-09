<script>

setCookie('currentaudio', '', 1);
console.log("Setting Cookies : currentaudio = " );
</script>
<?php 
    $browserPath = Router::url(null, true);
	echo $this->Html->css('bootstrap-fileupload');
	echo $this->Html->script('bootstrap-fileupload');
	echo $this->Html->css('bootstrap-editable');
	echo $this->Html->script('bootstrap-editable.min');
	echo $this->Html->script('common'); 
	echo $this->Html->css('common');
	echo $this->Html->script('jwplayer');
	echo $this->Html->script('countartist');
	echo $this->Html->css('jRating.jquery');
	echo $this->Html->script('jRating.jquery');
	$isloggedclass = $islogin>0?'':"disabled='disabled'";
?>
<div class="container art_bg" id="profilecontent1">
	<div class="artistupload wow fadeInUp">
		<?php
			if(count($artistmediaDetails)>0)
			{
				?>
					<div class="col-md-8 media-details">
						
								<?php echo $this->element('view_artist_details'); ?>
							
						
					</div>
				<?php
			}
			if(count($uploadedmediadata)>0)
			{
				?>
					<div class="col-md-4 top-performer">					
						<div class="top-performer-art">
							Related Uploads
							
						</div>
						<div class="related_uploads_scroller">
						<?php 
							$count=0;
							$retmediarating=0;
							$mediarating_id=0;				
							foreach($uploadedmediadata as $mediadata)
							{
								$usermedia_id = $mediadata['UserMedia']['usermedia_id'];
								$usermedia_path = Router::url('/', true).$mediadata['UserMedia']['usermedia_path'];
								$usermedia_title = $mediadata['UserMedia']['usermedia_title'];
								$usermedia_name = $mediadata['UserMedia']['usermedia_name'];
								$usermedia_type = $mediadata['UserMedia']['usermedia_type'];
								$arraymediatype = explode('/',$usermedia_type);
								$retuser_id = $mediadata['UserMedia']['user_id'];						
								$retuser_id = $mediadata['UserMedia']['user_id'];
								//media rating 
								$count++;
								$retmediarating=0;
								if(count($mediadata['children'])>0)
								{						
									$retmediarating = $mediadata['children']['MediaRating']['media_rating'];
									$retmediarating = $retmediarating>0?$retmediarating:0;
									$mediarating_id = $mediadata['children']['MediaRating']['mediarating_id'];
								}
								if(($islogin>0)&&($retuser_id==$islogin))
								{
									$isDisabled=1;
									
									$votedisable='true';
								}
								else if(($islogin>0)&&$retmediarating>0)
								{
									$isDisabled=1;
									$votedisable=false;
								}
								else if($islogin>0)
								{
									$isDisabled=0;
									$votedisable=false;
								}
								else
								{
									$isDisabled=1;
									$votedisable='true';
								}	
								?>
								<div class="performer-info">						 
									<div class="col-md-1 play">
										<a  class="artistmediatitle" id="<?php echo  $usermedia_id;?>">
											<?php echo $count;?>
										</a>
									</div>
								<div class="col-md-7 infotext">
									<div class="col-md-9">
										<div class="row">
											<a class="artistmediatitle" id="<?php echo  $usermedia_id;?>" ><?php echo  $usermedia_name;?></a>
										</div>
									</div>								
								</div>
								 <div class="col-md-3 rating">
									<div id="jRate<?php echo $usermedia_id;?>" <?php echo $isloggedclass; ?> data-average="<?php echo $retmediarating;?>" data-id="<?php echo $mediarating_id;?>">
										<script type="text/javascript">
											var umid =  <?php echo $usermedia_id?>;
											var login = <?php echo $islogin>0?1:0?>;
											if(login==0)
											{
												$("#jRate<?php echo $usermedia_id;?>").jRating({
													step:false,
													length : 5,
													nbRates : 3,
													bigStarsPath:'<?php echo Router::url('/',true);?>icons/stars.png',
													showRateInfo:false,												  
													canRateAgain : false,
													onClick : function(element,rate) {
														bootbox.alert('Please login to do rate');
													}	
												});
											}
											else
											{												
												$("#jRate<?php echo $usermedia_id;?>").jRating({
													step:true,
													length : 5,
													phpPath:'<?php echo Router::url('/',true);?>users/saveuserrating/'+umid,
													nbRates : 3,
													sendRequest:false,
													bigStarsPath:'<?php echo Router::url('/',true);?>icons/stars.png',
													showRateInfo:false,
													canRateAgain : true,
													isDisabled:'<?php echo $votedisable;?>',
													onClick:function(element,rate){
														var isDisabled  = <?php echo $isDisabled?>;
														if(isDisabled>0)
														{
															bootbox.confirm("New vote will outcast their earlier vote?", function(result) {
																if(result){
																	$.ajax({
																		url: '<?php echo Router::url('/',true);?>users/saveuserrating/<?php echo $usermedia_id;?>',
																		type: 'post',
																		data: {'rate': rate},
																		dataType:'json',
																		success: function (data) {
																			bootbox.alert(data.message);
																			window.location = '<?php echo $browserPath; ?>';
																		}
																	});
																}
															}); 
														}
														else
														{													
														$.ajax({
																url: '<?php echo Router::url('/',true);?>users/saveuserrating/<?php echo $usermedia_id;?>',
																type: 'post',
																 data: {'rate': rate},
																 dataType:'json',
																success: function (data) {
																bootbox.alert(data.message);window.location = '<?php echo $browserPath; ?>';
																}
															});
														}									
													},
													onSuccess : function(data){
														alert(data.message)
													},
													onError : function(){
														alert('Error : please retry');
														}
												});
											}
										</script>
									</div>
									<div class="clear"></div>
								</div>
								</div>
								<?php 
							}?>
							<div>
						</div>
					<?php
			}?>
		 </div>
</div></div>
<script type="text/javascript">
	$(".artistmediatitle").on('click',function()
	{
		var uploadedmediaid = $(this).attr('id');
		$('.cms-bgloader-mask').show();//show loader mask
		$('.cms-bgloader').show(); //show loading image
		$.ajax({ 
			type: "GET",
			url: strGlobalSiteBasePath+"users/getartistmedia/"+uploadedmediaid+"/<?php echo $showedit;?>",
			dataType: 'json',
			data:"",
			cache:false,
			success: function(data)
			{
				$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); //show loading image
				if(data.status == "success")
				{
			
					
					$('.tabloader').hide();
					$('.media-details').html(data.content);
					//$('#contact_loaded').val('1');
				}
				else
				{
					alert("fail");
				}
			}
	});
});

function fnaddComment(user_mediaid)
{
	$('.cms-bgloader-mask').show();//show loader mask
	$('.cms-bgloader').show(); //show loading image
	$.ajax({ 
		type: "GET",
		url: strGlobalSiteBasePath+"users/getartistmedianame/"+user_mediaid,
		dataType: 'json',
		data:"",
		cache:false,
		success: function(data)
		{
			$('.cms-bgloader-mask').hide();//show loader mask
			$('.cms-bgloader').hide(); //show loading image
			if(data.status == "success")
			{		
				$("#artistmediatitle").text(data.content);
				$("#usermediaid").val(user_mediaid);
				$("#txtcomment").val('');
				$("#commentmodal").modal('show');
			}
			else
			{
				alert("fail");
			}
		}
	});
}

</script>
<?php echo $this->element('commentmodal');?>
<?php echo $this->Html->script('modal'); ?>
<?php echo $this->element('mainmodallogin'); ?>
<?php echo $this->element('userLogin'); ?>
<?php echo $this->element('artistLogin'); ?>
<?php echo $this->element('forgotpass'); ?>
<?php echo $this->element('changepass'); ?>
<?php echo $this->element('artistregister'); ?>
<?php echo $this->element('userregister'); ?>
<?php echo $this->element('mainmodalregister'); ?>
<?php echo $this->element('followermodel'); ?>
<?php echo $this->element('followingmodel'); ?>
<?php echo $this->element('likemodel'); ?>
<?php echo $this->element('updatecommentmodal'); ?>