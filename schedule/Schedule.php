<?
class Schedule extends MadModel {
	function fetch( $id='' ) {
		$minute = floor(date('i')/30 ) * 30;
		$this->data = array(
			'sDate' => date("Y-m-d H:$minute:00"),
			'eDate' => date("Y-m-d H:$minute:00", strToTime('+1 hour')),
			'title' => '',
			'contents' => '',
		);
		return $this->data;
	}
	function getScheme() {
		$table = get_class($this);
		$sql = "
			create table $table (
				id integer,
				sDate datetime,
				eDate datetime,
				title varchar(255),
				contents text,
				primary key(id)
			)
";
		return $sql;
	}
	function timeRatio() {
		return (date('G') + date('i')/60);
	}
	function getTimeIndex() {
		$data = new MadData;

		$scheduleData = new MadData( array(
			'10' => array(
				new MadData(array(
					'date' => '2015-03-06',
					'hour' => '10',
					'minute' => '30',
					'duration' => '2',
					'title' => 'test',
					'contents' => 'test data',
				)),
			),
		));
		foreach( range(0,23) as $hour ) {
			$row = new MadData;
			$row->hour = $hour;
			if ( isset($scheduleData->$hour) ) {
				$row->schedule = $scheduleData->$hour;
			}	else {
				$row->schedule = array();
			}
			$data[$hour] = $row;
		}
		return $data;
	}
	function getCurrentWeather() {
		$file = 'schedule/weather.xml';
		if ( ! is_file ( $file ) ) {
			$xmlData = file_get_contents( 'http://www.kma.go.kr/wid/queryDFSRSS.jsp?zone=1147061000');
			file_put_contents($file, $xmlData );
		} else {
			$xmlData = file_get_contents( $file );
		}

		$xml = simplexml_load_string( $xmlData );
		$json = json_encode( $xml );
		$data = json_decode( $json );
		$current = $data->channel->item->description->body->data[0];
		return $current;
	}
}
