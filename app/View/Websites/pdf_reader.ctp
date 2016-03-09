<script type="text/javascript">
var strGlobalSiteBasePath = '<?php echo Router::url('/',true); ?>';
var DEFAULT_URL = '<?php echo $pdfpath;?>';
</script>
<?php 
echo $this->element('pdfReader');
?>