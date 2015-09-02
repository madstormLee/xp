<?
class TodoController extends MadController {
	function indexAction() {
		$this->model->setDomain( $this->params->domain );
	}
	function writeAction() {
		$this->model->fetch( $this->params->id );
	}
	function saveAction() {
		return $this->model->save( $this->params );
	}
	function deleteAction() {
		return $this->model->delete( $this->params->id );
	}
}
