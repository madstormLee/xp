<?
class Todo extends MadModel {
	function setDomain( $domain = 'todo' ) {
		if ( empty( $domain ) ) {
			$domain = 'todo';
		}
		$this->domain = $domain;
		return $this;
	}
	function getIndex() {
		$index = new MadIndex($this);
		$index->getQuery()->limit()->where("domain like '$this->domain%'");
		return $index;
	}
}
