<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */
 
 
?>
<div class="col-md-6 nopadding">
	<?php
		$strDirectoryPath = WWW_ROOT."files\\thumbnail";
		$arrDirectoryListing = scandir($strDirectoryPath);
		/*print("<pre>");
		print_r($arrDirectoryListing);
		exit;*/

		foreach($arrDirectoryListing as $strDirCont)
		{
			if($strDirCont == "." || $strDirCont == "..")
			{
				continue;
			}
			else
			{
				?>
					<div class="col-md-3 bottommargin nopadding">
						<img src="<?php echo ROUTER::url('/',true)."files/thumbnail/".$strDirCont;?>" alt="<?php echo $strDirCont;?>" title="Media Image" />
					</div>
				<?php
			}
		}
	?>
</div>
