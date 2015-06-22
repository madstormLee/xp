<?
class KanbanController extends MadController {
	function indexAction() {
		$get = $this->params;
		if ( ! $get->project ) {
			$get->project = 'maintain';
		}
		$query = "select * from Kanban where project='$get->project'";
		$this->view->index = $this->db->query( $query )->fetchAll( PDO::FETCH_CLASS, 'Kanban' );
		$this->view->params = $this->params;
	}
	function writeAction() {
		$id = $this->params->id;
		$query = "select * from Kanban where id=$id";
		if ( $stmt = $this->db->query( $query ) ) {
			$this->model->setData( $stmt->fetch( PDO::FETCH_ASSOC ) );
		}
	}
	function saveAction() {
		$post = $this->params;
		if ( ! $post->wDate ) {
			$post->wDate = date('Y-m-d H:i:s');
		}
		if ( $post->id ) {
			$statement = $this->db->prepare( "update Kanban set project=?, status=?, wip=? where id=?" );
			$statement->execute( array($post->project, $post->status, $post->wip , $post->id) );
		} else {
			$statement = $this->db->prepare( "insert into Kanban (project, status, wip, wDate) values (?,?,?,?)" );
			$statement->execute( array($post->project, $post->status, $post->wip, $post->wDate ) );
		}
		$this->js->replace('./?wDate=' . date('Y-m-d', strToTime($post->wDate)) );
	}
	function deleteAction() {
		$statement = $this->db->prepare( "delete from Kanban where id=?" );
		$statement->execute( array($this->params->id) );
		$this->js->replace('./');
	}
	/************************ refactoring and migration ************************/
	function dropAction() {
		return $this->db->exec( 'drop table Kanban' );
	}
	function createAction() {
		return $this->db->exec( $this->model->getScheme() );
	}
	function indexAllAction() {
		$result = $this->db->query( "select * from Kanban" )->fetchAll( PDO::FETCH_CLASS, 'Kanban' );
		printR( $result );
	}
}
