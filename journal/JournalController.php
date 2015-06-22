<?
class JournalController extends MadController {
	function indexAction() {
		$get = $this->params;
		$model = $this->model;

		$model->setSearchDate( $get->wDate );
		$model->setSearchWord( $get->searchWord );
	}
	function writeAction() {
		$this->model->fetch( $this->params->id );
	}
	function saveAction() {
		return $this->model->setData( $this->params )->save();
	}
	function deleteAction() {
		return $this->model->delete( $this->params->id );
	}
}
