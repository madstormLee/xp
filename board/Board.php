<?
class Board extends MadModel {
	function setData( $data=array() ) {
		$this->data = $data;
		return $this;
	}
	function getScheme() {
		return "
			create table Board (
				id integer primary key,
				status varchar(20) default 'backlog',
				wip integer,
				wDate datetime
			);
			";
	}
	function __toString() {
		return $this->contents;
		// return htmlEntities($this->contents, ENT_QUOTES | ENT_IGNORE, 'UTF-8');
	}
}
