
    <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Session->flash(); ?>
    <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            
           
			<?php echo $this->Form->create('Admin');?>
			<div class="body bg-gray">
                    <div class="form-group">
					<?php echo $this->Form->input('email', array('type' => 'email', 'class' => 'form-control validate[required,[funcCall[validateEmail]]]', 'placeholder'=>'User Name', 'label'=>false));?>
					</div>
					
					<div class="form-group">
                        <?php echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control validate[required]', 'placeholder'=>'Password', 'label'=>false));?>
				      </div>   
				</div>
				    <div class="footer">                                                               
                    <?php 
                    
					echo $this->Form->button('Sign me in', array('onclick' => "return checkLogin('Admin');",'class'=>'btn bg-olive btn-block')); 
					echo $this->Form->end();?>
                </div>

            
        </div>