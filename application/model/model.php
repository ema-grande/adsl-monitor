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

		$today = date( "Y-m-d", time() );
		//$today = time();
	}

	/**
	 * @param String $today "%Y-%m-%d" date representation
	 * @return array Returns an array containing all of the result set rows 
	 */
	public function getSpeedDate( $today )
	{
		$sql= "SELECT * FROM $this->speedTable WHERE FROM_UNIXTIME(time,'%Y-%m-%d') LIKE \"%$today%\" ORDER BY ID DESC;";
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
	 * @param String $today "%Y-%m-%d" date representation
	 * @return 
	 */
	public function getSpeedAvgDay( $today )
	{
		$sql = "SELECT * FROM $this->speedTable WHERE FROM_UNIXTIME(time, '%Y-%m-%d') LIKE \"$today\"";
		$query = $this->db->prepare($sql);
		$query->execute();
		$list = $query->fetchAll();
		$avg["num"] = count($list);
		if ($avg['num'] == 0) return;

		$avg["dl"] = 0.0;
		$avg["up"] = 0.0;
		$avg["ping"] = 0.0;
		
		foreach ($list as $item) {
			$avg["dl"] += (float)$item->dl;
			$avg["up"] += (float)$item->up;
			$avg["ping"] += (float)$item->ping;
		}
		$avg["dl"] /= $avg["num"];
		$avg["up"] /= $avg["num"];
		$avg["ping"] /= $avg["num"];

		return $avg;
	}

	/**
	 * @param String $today "%Y-%m-%d" date representation
	 * @return array Returns an array containing all of the result set rows 
	 */
	public function getPingDate( $today )
	{
		$sql= "SELECT * FROM $this->pingTable WHERE FROM_UNIXTIME(time,'%Y-%m-%d') LIKE \"%$today%\" ORDER BY ID DESC;";
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
	 * @param String $today "%Y-%m-%d" date representation
	 * @return array Returns an array containing all of the result set rows 
	 */
	public function getDropDate( $today )
	{
		$sql= "SELECT * FROM $this->dropTable WHERE FROM_UNIXTIME(time,'%Y-%m-%d') LIKE \"%$today%\" ORDER BY ID DESC;";
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
