<?
class Kanban extends MadModel {
	function __construct( $id = '' ) {
		$this->fetch( $id );
	}
	function setData( $data=array() ) {
		$this->data = $data;
		return $this;
	}
	function getScheme() {
		return "
			create table Kanban (
				id integer primary key,
				project varchar(20) default 'maintain',
				status varchar(20) default 'backlog',
				wip integer,
				wDate datetime
			);
			";
	}
	function fetch( $id='' ) {
	}
	function save() {
		return file_put_contents( $this->id, $this->contents );
	}
	function delete( $id = '' ) {
		if ( is_file( $this->id ) ) {
			return unlink( $this->id );
		}
		return false;
	}
	function __toString() {
		return $this->contents;
		// return htmlEntities($this->contents, ENT_QUOTES | ENT_IGNORE, 'UTF-8');
	}
}
