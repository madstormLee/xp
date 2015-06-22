<?
class TodoController extends MadController {
	function init() {
		parent::init();
		$get = $this->params;
		if ( ! $get->domain ) {
			$get->domain = 'todo';
		}
		$this->model->domain = $get->domain;
	}
	function indexAction() {
	}
	function listAction() {
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
