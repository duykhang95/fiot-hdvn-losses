<?php

class mysql
{
	private $sname =DB_SERVER;
	private $unmae = DB_USERNAME;
	private $password =DB_PASSWORD;

	private $db_name = DB_NAME;

	// private $sname = "ifsmvp.com";
	// private $unmae = "ifsmvp_tech";
	// private $password = "ifsmvp@2021";

	// private $db_name = "ifsmvp_hdvn_database";

	public $conn;

	function __construct()
	{
		// do anything...
	}
	public function connect()
	{
		$this->conn = mysqli_connect($this->sname, $this->unmae, $this->password, $this->db_name);
		mysqli_set_charset($this->conn, 'UTF8');
		if (!$this->conn) {
			die("Connection failed: " . mysqli_connect_error());
			return false;
		}
		return true;
	}
	public function disconn()
	{
		if ($this->conn) {
			mysqli_close($this->conn);
		}
	}

	public function query_data($sql)
	{
		$dtb = array();
		$result = -1;
		if ($this->connect()) {
			$rawdata = mysqli_query($this->conn, $sql); //fix loi ky tu dac biet
			while ($row = mysqli_fetch_assoc($rawdata)) {
				$dtb[] = $row;
			}
			$result = 1;
		}
		return [$dtb, $result];
	}
	public function query_change($sql)
	{
		if ($this->connect()) {
			$result = mysqli_query($this->conn, $sql); //fix loi ky tu dac biet
			if ($result) {
				return 1;
			}
			return 0;
		}
		return -1;
	}

	public function query_change_multi($sql)
	{
		if ($this->connect()) {
			$result = mysqli_multi_query($this->conn, $sql); //fix loi ky tu dac biet
			if ($result) {
				return 1;
			}
			return 0;
		}
		return -1;
	}

	//function query_insert==> return result === fail/succed/errconn
	//function queyr_select==> json data or row data ===> rowdata,resutl(fail/succed/errconn)
}
