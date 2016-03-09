<?php
class koolTreeComponent extends Component {



/**
 * Image resize
 * @param int $width
 * @param int $height
 */
	public function categoryHtml(){
	
	App::import('Vendor', 'KoolTreeView/kooltreeview');
		// some settings
		
		
	
	 
$treearr = array(   
						array("root","koolsuite","KoolSuite",false),
						array ("koolsuite","koolajax","KoolAjax",false),	
						array ("koolsuite","kooltabs","KoolTabs",false),
						array ("koolsuite","kooltreeview","KoolTreeView",false),
						array ("koolsuite","koolimageview","KoolImageView",false),
						
						array ("root","extensions","Extensions",false),
						array ("extensions","webextension","Web extension",false),
						array ("webextension","core","Base core",false),
						array ("webextension","addon","Add on",false),
						array ("extensions","application","Application",false),
						array ("application","graphic","Graphic design",false),
						array ("application","flash","Flash player",false),
						
						array ("root","support","Supports",false),
						array ("support","guide","Guide",false),
						array ("support","update","Update",false)
					);
	$_node_template = "<input type='checkbox' id='cb_{id}' value='1' name='cb_{name}' {check} onclick='toogle(\"{id}\")'><label for='cb_{id}'>{text}</label>";
	
	$treeview = new KoolTreeView("treeview");
	$treeview->scriptFolder = "KoolTreeView";
	$treeview->imageFolder= "KoolTreeView/icons";
	$treeview->styleFolder = "default";
	$root = $treeview->getRootNode();
	
	$root->text = str_replace("{id}","treeview.root",$_node_template);
	$root->text = str_replace("{name}","treeview_root",$root->text);
	$root->text = str_replace("{text}","Select Categories",$root->text);
	$root->text = str_replace("{check}",isset($_POST["cb_treeview_root"])?"checked":"",$root->text);
	$root->expand=true;

	for ( $i = 0 ; $i < sizeof($treearr) ; $i++)
	{
		$_text = str_replace("{id}",$treearr[$i][1],$_node_template);
		$_text = str_replace("{name}",$treearr[$i][1],$_text);
		$_text = str_replace("{text}",$treearr[$i][2],$_text);
		$_text = str_replace("{check}",isset($_POST["cb_".$treearr[$i][1]])?"checked":"",$_text);
		$treeview->Add($treearr[$i][0],$treearr[$i][1],$_text,$treearr[$i][3]);
	}
	$treeview->showLines = true;
	$treeview->selectEnable = false;
	$treeview->keepState = "onpage";
		
		return $treeview->Render();
	
	}
	

}
