<style type="text/css">
.top_info span{width: 60px !important;}
</style>
    <div class="col-md-4 top-performer">
               		<div class="performer-text">
                  	 <span class="performer-icon">
                   	 
                 	   Top Performers
					   <span class="top-performer-icon"><img src="<?php echo Router::url('/',true)?>images/performer1.png"></span>
					   <!--<img src="<?php echo Router::url('/',true)?>images/performer1.png"/></span>-->
                	</div>
                    <div class="clear"></div>
					<div class="top-performer-scroller">
					<?php
					$count=0;
					$action  = $this->request->params['action'];
					$controller = $this->params['controller'];
					
				if(count($averagemedia)>0)
				{
					foreach($averagemedia as $avgmedia)
					{
						$count++;
						$starpath = $count==1? Router::url('/',true).'icons/orange-star.png':Router::url('/',true).'icons/starwhite.png';
						$artistUrl = Router::url(array('controller'=>'users','action'=>'artist'),true)."/".$avgmedia['UserMedia']['user_id'];
						$usermedia_id = $avgmedia['UserMedia']['usermedia_id'];
						$usermedia_type = $avgmedia['UserMedia']['usermedia_type'];
						$category_image = $avgmedia['cat']['category_image'];
						
						 if(isset($avgmedia['subsubcat']['subsubcategory_name'])&&($action=='subcategory'||$action=='subsubcategory'))
						{
							$category_name = $avgmedia['subsubcat']['subsubcategory_name'];
						}
						else if(isset($avgmedia['subcat']['subcategory_name'])&&$action=='category')
						{
							$category_name = $avgmedia['subcat']['subcategory_name'];
							
						}
						else
						{
							$category_name = $avgmedia['cat']['category_name'];
						}
						if(isset($avgmedia['subsubcat']['subsubcategory_image'])&&($action=='subcategory'||$action=='subsubcategory'))
						{
							$category_image = $avgmedia['subsubcat']['subsubcategory_image'];
							$catimagepath =  Router::url('/',true)."assets/subsubcategory/".$category_image;
						}
						
						else if(isset($avgmedia['subcat']['subcategory_image'])&&$action=='category')
						{
							$category_image = $avgmedia['subcat']['subcategory_image'];
							$catimagepath =  Router::url('/',true)."assets/subcategory/".$category_image;
 							
						}
						else
						{
							$category_image = $avgmedia['cat']['category_image'];
							$catimagepath =  Router::url('/',true)."assets/category/".$category_image;
						}
						
						
					
					
							//$finalrate = round($avgmedia[0]['avgrate']*70);
							$finalrate = round($avgmedia[0]['totalrating']);
						
					?>

							<div class="performer-info <?php echo $count==1?'active':'';?>">
									<div class="col-md-1 playtext">
								<?php echo $count;?> 
											</div>
										
									<div class="col-md-4 infotext">
										<div class="col-md-9">
												<div class="row">
												<a class="mediatitle" id="<?php echo  $usermedia_id;?>" ><?php echo mb_strimwidth($avgmedia['UserMedia']['usermedia_name'],0, 12, "..");?></a>
												</div> 
												<div class="row artistname">
												<!-- <a class="mediatitle" id="<?php echo  $usermedia_id;?>" > -->
												<a class="mediatitle" href="<?php echo $artistUrl;?>"><?php 
												if($avgmedia['users']['user_display_name']!="")
												{
												echo $avgmedia['users']['user_display_name'];
												}
												else
												{
													echo  	$avgmedia['users']['user_fname'];
												}											
												?></a> 
												</div>
										</div>
											
								</div>
								<div class="col-md-2 likes_count">
								<span class="glyphicon glyphicon-heart"></span>
								<div class="count"><?php echo $finalrate;?></div>
								</div>
								<div class="col-md-2 topperformer_play">
								<?php 
								$arraymediatype = explode('/',$usermedia_type);
								$currentmediaType = $arraymediatype[0];
								if($currentmediaType=="video"||$currentmediaType=="audio")
								{
								   $class="playpauseaudio";
								}
								else
								{
									$class="mediatitle";
								}
								
								?>
								<a class="<?php echo $class?>" play="0" id="<?php echo  $usermedia_id;?>" ><img class="playpauseimg<?php echo  $usermedia_id;?>" src="<?php echo Router::url('/',true)?>images/play_new.png"/></a>
								</div>
								<div class="col-md-2 top_info">
											<img src="<?php echo $catimagepath;?>" height="60px" width="60px;"/>
											<span class="figcaption"><?php echo mb_strimwidth($category_name,0, 10, "..");?></span>
											</div>
											
							
							</div>
							
					 <?php
				    }
				}
				else
				{
				  echo "<div class='top-performer-screensaver'>";
					echo "<img src='".Router::url('/',true)."/assets/default/top-performer-screensaver.png'/>";
					echo "</div>";
				}?>
					</div>					 
			 </div>

<script type="text/javascript">
$(".mediatitle").on('click',function()
{
   var uploadedmediaid = $(this).attr('id');
   
				
				
				$(".gallry-details").html("");
    $('.performer-info').removeClass('active');
	$(this).parents('.performer-info').addClass('active');
	
	$('.cms-bgloader-mask').show();//show loader mask
	  $('.cms-bgloader').show(); //show loading image
   	$.ajax({ 
			type: "GET",
			url: strGlobalSiteBasePath+"users/getAvgartistmedia/"+uploadedmediaid+"/<?php echo $this->request->params['action']; ?>",
			dataType: 'json',
			data:"",
			cache:false,
			success: function(data)
			{
			
				if(data.status == "success")
				{
				
					$('.gallry-details').html(data.content);
					//$('#contact_loaded').val('1');
					$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); //show loading image
					
				}
				else
				{
					alert("fail");
				}
			}
	});
});

$(".playpauseaudio").on('click',function()
{
   var uploadedmediaid = $(this).attr('id');
   var fileplaying = 'mediaaudio'+uploadedmediaid;
  
			var isplaying = $(this).attr('play');
			//alert(isplaying);
				if(isplaying==1)
				{
					var audioFile = getCookie("currentaudio");
					//alert(audioFile);
					 if (audioFile != "" ) {
						 // alert('yes pause previous');
						
							jwplayer(audioFile).pause(true);
						$('.playpauseaudio').attr('play','0');
						$('.playpauseaudio img').attr('src','<?php echo Router::url('/',true)?>images/play_new.png');
						 $(this).attr( 'play','2');
						 $('.playpauseimg'+uploadedmediaid).attr('src','<?php echo Router::url('/',true)?>images/play_new.png');
						  //alert('paused');
					  }
					  else
					  {
					    isplaying=0;
					  }
					
				}
				if(isplaying==2)
				{
					var audioFile = getCookie("currentaudio");
					 if (audioFile != "" ) {
						 // alert('yes pause previous');
						
									jwplayer(audioFile).play(true);
						$('.playpauseaudio').attr('play','0');
						$('.playpauseaudio img').attr('src','<?php echo Router::url('/',true)?>images/play_new.png');
						 $(this).attr( 'play','1');
						 $('.playpauseimg'+uploadedmediaid).attr('src','<?php echo Router::url('/',true)?>images/pause_new.png');
						  //alert('paused');
					  }
					  else
					  {
					    isplaying=0;
					  }
					  
				}
				 if(isplaying==0)
				{
					$('.playpauseaudio').attr('play','0');
					$('.playpauseaudio img').attr('src','<?php echo Router::url('/',true)?>images/play_new.png');
					$(this).attr( 'play','1');
					$('.playpauseimg'+uploadedmediaid).attr('src','<?php echo Router::url('/',true)?>images/pause_new.png');
							$(".gallry-details").html("");
				$('.performer-info').removeClass('active');
				$(this).parents('.performer-info').addClass('active');
				
				$('.cms-bgloader-mask').show();//show loader mask
				  $('.cms-bgloader').show(); //show loading image
				$.ajax({ 
						type: "GET",
						url: strGlobalSiteBasePath+"users/getAvgartistmedia/"+uploadedmediaid+"/<?php echo $this->request->params['action']; ?>",
						dataType: 'json',
						data:"",
						cache:false,
						success: function(data)
						{
						
							if(data.status == "success")
							{
							
								$('.gallry-details').html(data.content);
								//$('#contact_loaded').val('1');
								$('.cms-bgloader-mask').hide();//show loader mask
								$('.cms-bgloader').hide(); //show loading image
								
							}
							else
							{
								alert("fail");
							}
						}
				});
			}
});

</script>