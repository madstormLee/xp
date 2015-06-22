<?
class Userstory extends MadModel {
	function getPriority() {
		$options = new MadData($this->getSetting('priority')->options);
		$map = $options->dic('value', 'label');
		return $map->{$this->priority};
	}
	function getEstimate() {
		if ( $this->estimate < 8 ) {
			return $this->estimate . ' hours';
		}
		return round($this->estimate / 8, 1) . ' days';
	}
	private $personaList;
	function getPersonaList() {
		if ( is_null($this->personaList) ) {
			$query = "select persona from `$this->name` group by persona";
			$this->personaList = new MadData($this->getDb()->query( $query )->fetchAll(PDO::FETCH_CLASS));
		}
		return $this->personaList;
	}
}
