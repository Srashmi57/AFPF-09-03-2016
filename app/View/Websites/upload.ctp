<?php echo $strActionScript;
echo $this->Html->script('videoupload');



?>

<div role="tabpanel">

<div id="profilecontent" class="content uploads-bg">
		<div class="tab-content">
			
						<div class="featured-artist">
						<div class="upload-media"><a  onClick="return uploadMedia();" data-toggle="modal"><span class="glyphicon glyphicon-upload"></span> Upload Media</a></div>
						<?php echo $this->element('uploadedmedia');?>
						</div>
			</div>
			
	</div>
</div>
			

 

<?php 
echo $this->element('medianame');?>
<?php 	echo $this->element("mediaModal"); ?>
<?php 
 echo $this->Html->script('modal'); 
?>
<?php echo $this->element('changepass'); ?>

<?php 
echo $this->Html->css('jquery.fileupload');
echo $this->Html->css('http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css');


?>
<script>
$(document).ready(function(){
        $("[rel^='lightbox']").prettyPhoto();
 });
 </script>
