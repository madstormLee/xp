<?
class Journal extends MadModel {
	function getDays() {
		$query = "select date( wDate ) as day, count(*) as cnt, userId from Journal group by day, userId order by day desc";
		$db = MadDb::create();
		$days = $db->query( $query )->fetchAll( PDO::FETCH_CLASS, 'Journal' );

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
