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
	}

	public function getSpeedDate( $today )
	{
		$sql= "SELECT * FROM $this->speedTable WHERE time LIKE \"%$today%\" ORDER BY ID DESC;";
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

	public function getPingDate( $today )
	{
		$sql= "SELECT * FROM $this->pingTable WHERE time LIKE \"%$today%\" ORDER BY ID DESC;";
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

	public function getDropDate( $today )
	{
		$sql= "SELECT * FROM $this->dropTable WHERE time LIKE \"%$today%\" ORDER BY ID DESC;";
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
