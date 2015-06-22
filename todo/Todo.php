<?
class Todo extends MadModel {
	function getIndex() {
		$index = parent::getIndex();
		$index->getQuery()->limit()->where("domain like '$this->domain%'");
		return $index;
	}
}
