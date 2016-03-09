<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */


App::uses('Debugger', 'Utility');
?>
<div class="row">
	<div class="col-md-8">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
		  <li class="active"><a href="#test" role="tab" data-toggle="tab">Test</a></li>
		  <li><a href="#testlog" role="tab" data-toggle="tab">TestLogin</a></li>
		  <li><a href="#testreg" role="tab" data-toggle="tab">TestRegistration</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane fade in active" id="test">
				<p>
					Hello this is just test tab
				</p>
			</div>
			<div class="tab-pane fade" id="testlog">
				<input type="hidden" name="content_loaded" id="content_loaded" value="0" />
				<p id="testlogcontent">
					Hello this is just testlog tab
				</p>
			</div>
			<div class="tab-pane fade" id="testreg">
				<p>
					Hello this is just testreg tab
				</p>
			</div>
		</div>
	</div>
</div>