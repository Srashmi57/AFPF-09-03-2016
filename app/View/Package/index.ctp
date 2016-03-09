<?php echo $this->Html->script('common'); 
echo $this->Html->css('common.css');
echo $this->Html->script('jquery.tablesorter.min');
echo $this->Html->script('jquery.tablesorter.widgets.min');?>

<script type="text/javascript">
$( document ).ready(function() {
	$(".getdata").click(function()
	{
		var package_id = $(this).attr('id');
	
	$.ajax({
		type: "POST",
		url: strGlobalSiteBasePath+"/Packages/UpdatePackageData",
		data: {"package_id" : package_id},
		cache: false,
		dataType: 'json',
		success: function(data)
		{
				Respstatus = data.status;
					if(Respstatus == "success")
					{
					
						//alert(data.image);
						document.getElementById('update_packageid').value=data.package_id;
						document.getElementById('update_pack_name').value=data.package_name;
						document.getElementById('update_pack_price').value=data.package_price;
					
						
						$("#UpdateModal").modal('show');
					
					}
					else
					{
						
						alert("Failed");
						return false;
					}
		}
	});
	
	});
	
	$('table').tablesorter({
			widgets        : ['zebra', 'columns'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true,
			headers: {1: {sorter: 'custom_sort_function'},3: {sorter: 'false'},4: {sorter: 'false'}	
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
                           <h3 class="btn btn-success pull-right"  ><a data-toggle="modal" data-target="#example">Add Package</a></h3>
                            </form>
                                </div><!-- /.box-header -->
							
                               
                                <div class="box-body">
								       <table class="table table-bordered tablesorter">
                                        <thead>
										<tr>
                                            <th >Sr. No.</th>
                                            <th>Package </th>
											 <th>Price </th>
                                            <th>Status</th>
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
										<?php
										$count=0;
										 foreach ($packages as $row)
										{
											$count++;
										if($row['Package']['package_status']==0)
										{
											   $statustext = "<span class='label label-danger'>Inactive</span>";
											   $status=1;
										}
										else
										{
												$statustext = "<span class='label label-success'>Active</span>";
												$status=0;
										}
										
										?>
										
                                        <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['Package']['package_name']; ?></td>
                                        <td><?php echo $row['Package']['package_price']; ?></td>
                                        <td><a id="updatestatus" href="javascript:void(0);"  onclick="return ChangeStatus('<?php echo $this->params['controller']?>',<?php echo $row['Package']['package_id']?>,<?php echo $status?>,'Package')"><?php echo $statustext;?></a></td>
                                        <td>
                                                <a id="<?php echo $row['Package']['package_id']; ?>" class="getdata" href="javascript:void(0);">Edit</a> |
                                                <?php echo $this->Html->link('Delete', array('action' => 'delete', $row['Package']['package_id'], 'Package'), array('onclick'=>'return false;', 'id'=>'msg-name', 'class'=>' delete-link')); ?>
                                        
                                        </td>
                                        </tr>

    <?php }  ?>
                                    </tbody></table>									
                               </div><!-- /.box-body -->
 <div class="pagination pagination-large">
					<ul class="pagination">
							<?php
								echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
								echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
								echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
							?>
						</ul>
		</div>
									
                            </div><!-- /.box -->



<div class="modal fade" id="UpdateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Edit Package</h4>
      </div>
      <div class="modal-body">
	   <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	  <form name="editPackage" id="editPackage" method="post">
	          <div class="form-group">
		
				<label  for="Name"> Package </label>
                        <input type="hidden" name="data[update_packageid]" id="update_packageid" class="form-control validate[required]" placeholder="Name"/>
                          <input type="text" name="data[update_pack_name]" id="update_pack_name" class="form-control validate[required]" placeholder="Name"/>
						
                    </div>
					
					<div class="form-group">
		
				<label  for="Name"> Price </label>
                        <input type="text" name="data[update_pack_price]" id="update_pack_price" class="form-control validate[required,custom[number]]" placeholder="Price"/>
                    </div>
                   
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnUpdatePackage();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

						
						
<div class="modal fade" id="example">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Add Package</h4>
      </div>
      <div class="modal-body">
	   <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
	  <form name="addPackage" id="addPackage" method="post">
	          <div class="form-group">
		
				<label  for="Name"> Package </label>
                        <input type="text" name="package_name" class="form-control validate[required]" placeholder="Name"/>
						
                    </div>
					
					<div class="form-group">
		
				<label  for="Name"> Price </label>
                        <input type="text" name="package_price" class="form-control validate[required,custom[number]]" placeholder="Price"/>
                    </div>
                   
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnAddPackage();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	