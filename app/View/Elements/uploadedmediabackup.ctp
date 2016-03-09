<?php 

foreach($uploadeddata as $usermedia )	
{			
			 $usermedia_id = $usermedia['UserMedia']['usermedia_id'];
			$usermedia_path = Router::url('/', true).$usermedia['UserMedia']['usermedia_path'];
			$usermedia_title = $usermedia['UserMedia']['usermedia_title'];
			$usermedia_type = $usermedia['UserMedia']['usermedia_type'];
			$arraymediatype = explode('/',$usermedia_type);
			switch($arraymediatype[0])
			{
		case "image":
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
					
					
					<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=http://www.simplesharebuttons.com" id="linkedin"><i class="fa fa-linkedin fa-1x"></i></a>
					<a target="_blank" href="https://plus.google.com/share?url=https://encrypted-tbn0.gstatic.com/images?q%3Dtbn:ANd9GcRt6YQ8bwQdOVZqTG7wls93F-bwbENvH292Lfx_TBOY9lLYL5X5RhXVRvk&hl=en" id="gmail"><i class="fa fa-gplus fa-1x"></i></a>
					<a target="_blank" href="http://www.twitter.com/share?url=www.example.com&text=I+am+eating+%23branston+%23pickel+right+now" id="twitter">t</a>
                                        </div>
                                    </figcaption>
                                </figure>
                           </article>
	<?php
			break;
			case "audio":  
					?>	
					
				<?php 
			     break;
				 
			 case "application":  
				if($arraymediatype[1]=="pdf")
				{
					$url = Router::url('/', true).'websites/pdfReader/'.$usermedia_id;
					?>
					<a href="<?php echo $url;?>" target="_blank"><?php echo $usermedia_title?></a>; 
					<?php	
					
				}
				else
				{?>
				<a href="http://docs.google.com/viewer?url=http://devredorange.com/csbrown/Job Manager User Guide Community.docx" target="_blank"><?php echo $usermedia_title?></a>; 
			<?php
				}
				break;
			}
	
	}
	?>

	
	
