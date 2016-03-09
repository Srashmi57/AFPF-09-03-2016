

                            <div class="box box-warning">
							 <div class="box-header">
                                    <h3 class="btn btn-success pull-right" >Add User Type</h3>
                                </div><!-- /.box-header -->
							<div class="col-md-6">
                               
                                <div class="box-body">
								<?php echo $this->Form->create('usertype', array('action' => 'edit'));?>
								<?php echo $this->Form->input('usertypeid', array('type'=>'hidden'));?>
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>User Type</label>
                                          <?php echo $this->Form->input('usertype', array('type' => 'text', 'class' => 'form-control', 'placeholder'=>'User Type', 'label'=>false));?>
                                        </div>
										
                               </div><!-- /.box-body -->
							   <div class="box-footer">
							
                                      	   <?php 
                    $options = array('label' => 'Submit','class' => 'btn bg-olive','div' =>false);
					echo $this->Form->end($options);?>
                                    </div>
									</div>
                            </div><!-- /.box -->

						
						
							

	
	