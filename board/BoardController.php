<?
class BoardController extends MadController {
	function createAction() {
	}
	function saveCreateAction() {
		printR( $this->params );
		die;
	}
	function indexAction() {
		$this->view->index = new MadIndex( $this->model );
	}
	function viewAction() {
		$get = $this->params;
		if ( ! $get->domain ) {
			$get->domain = 'maintain';
		}

		$index = new MadIndex( $this->model );
		$index->getQuery()->where( "domain='$get->domain'");

		$this->view->index = $index;
	}
	function writeAction() {
		$id = $this->params->id;
		$query = "select * from Board where id=$id";
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
			$statement = $this->db->prepare( "update Board set domain=?, status=?, wip=? where id=?" );
			$statement->execute( array($post->domain, $post->status, $post->wip , $post->id) );
		} else {
			$statement = $this->db->prepare( "insert into Board (domain, status, wip, wDate) values (?,?,?,?)" );
			$statement->execute( array($post->domain, $post->status, $post->wip, $post->wDate ) );
		}
		$this->js->replace('./?wDate=' . date('Y-m-d', strToTime($post->wDate)) );
	}
	// todo: from scrum
	function saveSettingAction() {
		$json = new MadJson("data/config.json");
		$post = $this->params;
		$post->item->filter();
		$json->setData( $post );
		return $json->save();
	}
	function deleteAction() {
		$statement = $this->db->prepare( "delete from Board where id=?" );
		$statement->execute( array($this->params->id) );
		$this->js->replace('./');
	}
}
