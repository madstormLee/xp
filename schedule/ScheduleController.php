<?
class ScheduleController extends MadController {
	function createAction() {
		$query = $this->model->getScheme();
		return $this->db->exec($query);
	}
	function dropAction() {
		$query = "drop table Schedule";
		return $this->db->exec($query);
	}
	function indexAction() {
		$query = "select * from Schedule";
		$data = $this->db->query( $query )->fetchAll( PDO::FETCH_CLASS, get_class($this->model) );
	}
	function writeAction() {
		$this->model->fetch( $this->params->id );
	}
	function viewAction() {
		$this->model->fetch( $this->params->id );
	}
	function saveAction() {
		$post = $this->params;
		$query = "insert into Schedule
			(sDate, eDate, title, contents)
			values
			(
				'$post->sDate',
				'$post->eDate',
				'$post->title',
				'$post->contents'
			)";
		return $this->db->exec( $query );
	}
	function deleteAction() {
		return $this->model->delete( $this->params->id );
	}
}
