<?
class Journal extends MadModel {
	private $searchDate = '';
	private $searchWord = '';

	function setSearchDate( $date='' ) {
		if ( empty( $date ) ) {
			$date = date('Y-m-d');
		}
		$this->searchDate = $date;
		return $this;
	}
	function setSearchWord( $word='' ) {
		$this->searchWord = $word;
		return $this;
	}
	function getSearchDate() {
		if ( empty( $this->searchDate ) ) {
			$this->searchDate = date('Y-m-d');
		}
		return $this->searchDate;
	}
	function getIndex() {
		if ( ! is_null( $this->index ) ) {
			return $this->index;
		}
		$this->index = new MadIndex( $this );

		$query = $this->index->getQuery();
		$query->order('wDate desc');

		if ( $this->searchDate ) {
			$query->where("date(wDate) like '$this->searchDate'");
		}
		if ( $this->searchWord ) {
			$query->where("contents like '%$this->searchWord%'");
		}
		return $this->index;
	}
	function getDays() {
		$query = "select date( wDate ) as day, count(*) as cnt, userId from Journal group by day, userId order by day desc";
		$days = $this->getDb()->query( $query )->fetchAll( PDO::FETCH_CLASS, 'Journal' );

		$rv = array();
		foreach( array_chunk( $days, 10 ) as $row ) {
			$rv[] = new MadData( array(
				'duration' => $row[0]->day.' ~ '.end( $row )->day,
				'data' => $row,
			));
		}
		return $rv;
	}
}
