<?php
	
	/*************************************************************/
	/*****	get_connection()								******/
	/*****	create_table_company()							******/
	/*****	create_table_eps_2019()							******/
	/*****	create_table_eps_2020()							******/
	/*****	create_table_eps_2021()							******/
	/*****	delete_database_eps()							******/
	/*****	delete_database_dse()							******/
	/*****	create_database_eps()							******/
	/*****	create_database_dse()							******/
	/*****													******/
	/*****													******/
	/*************************************************************/

	class backup
	{
		public static function get_connection()
		{
			try
			{
				$con = new PDO("mysql:host=localhost;dbname=eps", "root", "",array(PDO::ATTR_PERSISTENT => true));
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{
				echo "Connection failed: " . $e->getMessage();
				die();
			}
			return $con;
		}

		public static function create_table_company()
		{
			try
			{
				$query = 'CREATE TABLE company SELECT * FROM dse.company';
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "Company Table created.";
			}
			catch(PDOException $e)
			{
				echo "Could not create table company: " . $e->getMessage();
			}
			
		}
		
		public static function create_table_eps_2019()
		{
			try
			{
				$query = "CREATE TABLE eps2019 SELECT * FROM dse.eps2019";
				
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "eps2019 created.";				
			}
			catch(PDOException $e)
			{
				echo "Could not create table eps2019" . $e->getMessage();
			}
		}
		
		public static function create_table_eps_2020()
		{
			try
			{
				$query = "CREATE TABLE eps2020 SELECT * FROM dse.eps2020";
				
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "eps2020 created.";				
			}
			catch(PDOException $e)
			{
				echo "Could not create table eps2020" . $e->getMessage();
			}
		}
		
		public static function create_table_eps_2021()
		{
			try
			{
				$query = "CREATE TABLE eps2021 SELECT * FROM dse.eps2021";
				
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "eps2021 created.";				
			}
			catch(PDOException $e)
			{
				echo "Could not create table eps2021" . $e->getMessage();
			}
		}
		
		public static function delete_database_eps()
		{
			try
			{
				$query = "DELETE DATABASE eps";
				
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "dse Database deleted.";				
			}
			catch(PDOException $e)
			{
				echo "Could not delete eps database: " . $e->getMessage();
			}
		}
		
		public static function delete_database_dse()
		{
			try
			{
				$query = "DELETE DATABASE dse";
				
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "dse Database deleted.";				
			}
			catch(PDOException $e)
			{
				echo "Could not delete dse database: " . $e->getMessage();
			}
		}
		
		public static function create_database_eps()
		{
			try
			{
				$query = "CREATE DATABASE eps";
				
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "dse Database deleted.";				
			}
			catch(PDOException $e)
			{
				echo "Could not create eps database: " . $e->getMessage();
			}
		}
		
		public static function create_database_dse()
		{
			try
			{
				$query = "CREATE DATABASE dse";
				
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "dse Database deleted.";				
			}
			catch(PDOException $e)
			{
				echo "Could not create dse database: " . $e->getMessage();
			}
		}

	}

?>