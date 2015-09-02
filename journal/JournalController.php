<?
class JournalController extends MadController {
	function indexAction() {
		$get = $this->params;

		$index = new MadIndex( $this->model );
		$query = $index->getQuery();
		$query->order('wDate desc');

		if ( empty( $get->wDate ) ) {
			$get->wDate = date('Y-m-d');
		}
		$query->where("date(wDate) like '$get->wDate'");

		if ( $get->searchWord ) {
			$query->where("contents like '%$get->searchWord%'");
		}
		$this->view->index = $index;
	}
	function writeAction() {
		$this->model->fetch( $this->params->id );
	}
	function saveAction() {
		return $this->model->save($this->params);
	}
	function deleteAction() {
		return $this->model->delete( $this->params->id );
	}
}
