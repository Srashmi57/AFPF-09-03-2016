<?php 

foreach($uploadeddata as $usermedia )	
{			
			 $usermedia_id = $usermedia['UserMedia']['usermedia_id'];
			$usermedia_path = Router::url('/', true).$usermedia['UserMedia']['usermedia_path'];
			$usermedia_title = $usermedia['UserMedia']['usermedia_title'];
			$usermedia_type = $usermedia['UserMedia']['usermedia_type'];
			$arraymediatype = explode('/',$usermedia_type);
	
		?>
                            <article>
                                <figure>
                                    <a href="#"><img src="<?php echo $usermedia_path;?>" alt=""></a>
                                    <figcaption>
                                        <a href="#"></a>
                                        <div class="social-network">

                                       	<?php echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class', 'id'=>'facebook','value'=>'userfacebook', 'escape' => false)); 
												$strFURL = $this->Html->url(array("controller"=>"social","action" => "share","facebook"));
												echo $this->Form->hidden('',array('id'=>'userfacebook_process_url', 'value'=>$strFURL));?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-linkedin fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'linkedin','value'=>'linkedin')); 
												$strFURL = "http://www.linkedin.com/shareArticle?mini=true&url=http://www.simplesharebuttons.com";
												echo $this->Form->hidden('',array('id'=>'linkedin_process_url', 'value'=>$strFURL));
												
                    ?>
					<?php							
                    echo $this->Form->button('<i class="fa fa-google-plus fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'gmail', 'value'=>'gmail')); 
												$strFURL = "https://plus.google.com/share?url=https://encrypted-tbn0.gstatic.com/images?q%3Dtbn:ANd9GcRt6YQ8bwQdOVZqTG7wls93F-bwbENvH292Lfx_TBOY9lLYL5X5RhXVRvk&hl=en";
												echo $this->Form->hidden('',array('id'=>'gmail_process_url', 'value'=>$strFURL));
												
                    ?>
					
					<?php							
                    echo $this->Form->button('<i class="fa fa-twitter fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'twitter', 'value'=>'twitter')); 
												$strFURL = "http://www.twitter.com/share?url=www.example.com&text=I+am+eating+%23branston+%23pickel+right+now";
												echo $this->Form->hidden('',array('id'=>'twitter_process_url', 'value'=>$strFURL));
												
                    ?>
					
                                        </div>
                                    </figcaption>
                                </figure>
                           </article>
	<?php
			
				 
			
			
	
	}
	?>

	
	
