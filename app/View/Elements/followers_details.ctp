				
						
								
									<?php 
								
									foreach($followersarray as $followfarray)
									{
										$user_fname = $followfarray['users']['user_fname'];
										$user_lname = $followfarray['users']['user_lname'];
										$user_id = $followfarray['users']['user_id'];
										$usertype_id = $followfarray['users']['usertype_id'];
										 $user_image = $followfarray['users']['user_image'];
										$usertype = $usertype_id==2?"Artist":"User";
										$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';
										$rateuserimagepath = Router::url('/', true).'assets/websiteuser/'.$user_image;
										if(file_exists("assets/websiteuser/".$user_image) && $user_image!="")
										{
										 $imagepath = $rateuserimagepath;
										}
										else
										{
											$imagepath=Router::url('/', true)."images/user_icon_count.png";
										}
										
									?>
									<div class="col-md-12 followers-popup-list">
										<div class="col-md-2">
											<img src="<?php echo $imagepath;?>" height="60px" width="60px" class=" img-circle" />
										</div>
										<div class="col-md-10">
												<a href="<?php echo $usertypehref;?>"><?php echo $user_fname." ".$user_lname;?></a>
												<p><?php echo $usertype;?></p>
										</div>
									</div>
								
									<?php 
									}
									?>
					