<?php

class Model
{
	/**
	 * @param object $db A PDO database connection
	 */
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
		$sql= "SELECT * FROM SPEED WHERE time LIKE \"%$today%\" ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}
	
	public function getSpeedAll()
	{
		$sql= "SELECT * FROM SPEED ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getSpeedLast()
	{
		$sql= "SELECT * FROM SPEED ORDER BY ID DESC LIMIT 1;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getPingDate( $today )
	{
		$sql= "SELECT * FROM PING WHERE time LIKE \"%$today%\" ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}
	
	public function getPingAll()
	{
		$sql= "SELECT * FROM PING ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getPingLast()
	{
		$sql= "SELECT * FROM PING ORDER BY ID DESC LIMIT 1;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getDropDate( $today )
	{
		$sql= "SELECT * FROM DISCONNECT WHERE time LIKE \"%$today%\" ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}
	
	public function getDropAll()
	{
		$sql= "SELECT * FROM DISCONNECT ORDER BY ID DESC;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getDropLast()
	{
		$sql= "SELECT * FROM DISCONNECT ORDER BY ID DESC LIMIT 1;";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}
}
