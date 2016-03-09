

                            <div class="box box-warning">
							 <div class="box-header">
                                    <h3 class="btn btn-success pull-right" >View User Type</h3>
                                </div><!-- /.box-header -->
							
                               
                                <div class="box-body">
								       <table class="table table-bordered">
                                        <tbody>
										<tr>
                                            <th >Sr. No.</th>
                                            <th>User Type</th>
                                            <th>Status</th>
                                            <th >Action</th>
                                        </tr>
										<?php foreach ($usertypes as $row)
										{
										if($row['Usertype']['status']==0)
										{
										  $statustext = "Inactive";
										   $statuscss = "color:red";
										}
										else
										{
										  $statustext = "Active";
										   $statuscss = "color:green";
										}
										
										?>
										
<tr>
<td><?php echo $row['Usertype']['usertypeid']; ?></td>
<td><?php echo $row['Usertype']['usertype']; ?></td>
<td><?php echo $statustext; ?></td><!-- Adding edit and delete link -->
<td>
        <?php echo $this->Html->link('Edit', array('action'=>'edit', $row['Usertype']['usertypeid']));?> |
        <?php echo $this->Html->link('Delete', array('action' => 'delete', $row['Usertype']['usertypeid']), array('onclick'=>'return false;', 'id'=>'msg-name', 'class'=>' delete-link')); ?>

</td>
</tr>

    <?php }  ?>
                                    </tbody></table>									
                               </div><!-- /.box-body -->
							  
									
                            </div><!-- /.box -->

						
						
							

	
	