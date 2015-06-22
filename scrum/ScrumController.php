<?
class ScrumController extends MadController {
	function indexAction() {
	}
	function settingAction() {
	}
	function saveSettingAction() {
		$json = new MadJson("data/config.json");
		$post = $this->params;
		$post->item->filter();
		$json->setData( $post );
		return $json->save();
	}
}
