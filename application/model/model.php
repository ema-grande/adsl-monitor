<?php

class Model
{
	/**
	 * @param object $db A PDO database connection
	 */

	private $speedTable = "SPEED";
	private $pingTable = "PING";
	private $dropTable = "DROPS";
	
	function __construct($db)
	{
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit('Database connection could not be established.');
		}
	}

	/**
	 * @param String $time "%Y-%m-%d" date representation
	 * @return array Returns an array containing all of the result set rows 
	 */
	public function getSpeedDate( $time )
	{
		$sql= "SELECT * FROM $this->speedTable WHERE FROM_UNIXTIME(time,'%Y-%m-%d') LIKE \"%$time%\" ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}
	
	public function getSpeedAll()
	{
		$sql= "SELECT * FROM $this->speedTable ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getSpeedLast()
	{
		$sql= "SELECT * FROM $this->speedTable ORDER BY ID DESC LIMIT 1;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	/**
	 * @param String $time "%Y-%m-%d" date representation
	 * @param String $format "%Y" | "%Y-%m" | "%Y-%m-%d"
	 * @return stdClass $avg - float $dl, float $up, float $ping
	 * 
	 */
	public function getAvgSpeedDate( $time )
	{
		$avg = new stdClass;
		$sql = "SELECT * FROM $this->speedTable WHERE FROM_UNIXTIME(time, '%Y-%m-%d') LIKE \"%$time%\"";
		$query = $this->db->prepare($sql);
		$query->execute();
		$list = $query->fetchAll();
		$listCount = count($list);
		
		if ( $listCount == 0 ) return;

		$avg->dl = 0.0;
		$avg->up = 0.0;
		$avg->ping = 0.0;
		$pingCount = $listCount + 1; /* to avoid div by 0 */
		
		foreach ($list as $item) {
			$avg->dl += (float)$item->dl;
			$avg->up += (float)$item->up;
			$avg->ping += (float)$item->ping;
			if ($item->ping == "NAN") { $pingCount -= 1; }
		}
		$avg->dl /= $listCount;
		$avg->up /= $listCount;
		$avg->ping /= $pingCount;

		return $avg;
	}

	/**
	 * @param String $time "%Y-%m-%d" date representation
	 * @return array Returns an array containing all of the result set rows 
	 */
	public function getPingDate( $time )
	{
		$sql= "SELECT * FROM $this->pingTable WHERE FROM_UNIXTIME(time,'%Y-%m-%d') LIKE \"%$time%\" ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}
	
	public function getPingAll()
	{
		$sql= "SELECT * FROM $this->pingTable ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getPingLast()
	{
		$sql= "SELECT * FROM $this->pingTable ORDER BY ID DESC LIMIT 1;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	/**
	 * @param String $time "%Y-%m-%d" date representation
	 * @return array Returns an array containing all of the result set rows 
	 */
	public function getDropDate( $time )
	{
		$sql= "SELECT * FROM $this->dropTable WHERE FROM_UNIXTIME(time,'%Y-%m-%d') LIKE \"%$time%\" ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}
	
	public function getDropAll()
	{
		$sql= "SELECT * FROM $this->dropTable ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getDropLast()
	{
		$sql= "SELECT * FROM $this->dropTable ORDER BY ID DESC LIMIT 1;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}
}
