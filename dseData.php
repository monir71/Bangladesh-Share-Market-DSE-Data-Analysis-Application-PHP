<?php
	/*************************************************************/
	/*****	get_connection()								******/
	/*****	create_company_table()							******/
	/*****	create_company_full_name_table()				******/
	/*****	create_navpe_table()							******/
	/*****	create_latest_share_price_table()				******/
	/*****	create_eps_2019_table()							******/
	/*****	create_eps_2020_table()							******/
	/*****	create_eps_2021_table()							******/
	/*****	show_latest_share_price_all_from_dse()			******/
	/*****	show_company_list_from_dse()					******/
	/*****	insert_company_list_from_dse_to_database()		******/
	/*****	update_company_cat_from_dse_to_database()		******/
	/*****													******/
	/*****													******/
	/*****													******/
	/*****													******/
	/*************************************************************/
	class dse
	{
		public static function get_connection()
		{
			try
			{
				$con = new PDO("mysql:host=localhost;dbname=dse", "root", "",array(PDO::ATTR_PERSISTENT => true));
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{
				echo "Connection failed: " . $e->getMessage();
				die();
			}
			return $con;
		}
		
		public static function create_company_table()
		{
			try
			{
				$query = 'CREATE TABLE IF NOT EXISTS company(
					CompanyID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					CompanyName VARCHAR(20) NOT NULL,
					CompanyCat VARCHAR(2) DEFAULT NULL
				)  ENGINE = MyISAM';
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "Company Table created.";
			}
			catch(PDOException $e)
			{
				echo "Could not create table: " . $e->getMessage();
			}
			
		}
		
		public static function create_company_full_name_table()
		{
			try
			{
				$query = 'CREATE TABLE IF NOT EXISTS companyfullname(
					Serial INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					CompanyID INT(10) NOT NULL,
					CompanyName VARCHAR(100) DEFAULT NULL,
					CONSTRAINT fk_company
					FOREIGN KEY (CompanyID) 
					REFERENCES Company(CompanyID)
				)  ENGINE = MyISAM';
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "Company Full Name Table created.";
			}
			catch(PDOException $e)
			{
				echo "Could not create table: " . $e->getMessage();
			}
			
		}
		
		public static function create_navpe_table()
		{
			try
			{
				$query = 'CREATE TABLE IF NOT EXISTS navpe(
					Serial INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					CompanyID INT(10) NOT NULL,
					Nav VARCHAR(15) DEFAULT NULL,
					Pe VARCHAR(15) DEFAULT NULL,
					CONSTRAINT fk_company
					FOREIGN KEY (CompanyID) 
					REFERENCES Company(CompanyID)
				)  ENGINE = MyISAM';
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "NAV-PE Table created.";
			}
			catch(PDOException $e)
			{
				echo "Could not create table: " . $e->getMessage();
			}
		}
		
		public static function create_latest_share_price_table()
		{
			try
			{
				$query = 'CREATE TABLE IF NOT EXISTS latestshareprice(
					Serial INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					CompanyID INT(10) NOT NULL,
					Ltp VARCHAR(15) DEFAULT NULL,
					High VARCHAR(15) DEFAULT NULL,
					Low VARCHAR(15) DEFAULT NULL,
					ClosePrice VARCHAR(15) DEFAULT NULL,
					Ycp VARCHAR(15) DEFAULT NULL,
					ChangePrice VARCHAR(15) DEFAULT NULL,
					Trade VARCHAR(15) DEFAULT NULL,
					ValueMn VARCHAR(15) DEFAULT NULL,
					Volume VARCHAR(15) DEFAULT NULL,
					CONSTRAINT fk_company
					FOREIGN KEY (CompanyID) 
					REFERENCES Company(CompanyID)
				)  ENGINE = MyISAM';
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "Latest Share Price Table created.";
			}
			catch(PDOException $e)
			{
				echo "Could not create table: " . $e->getMessage();
			}
		}
		
		public static function create_eps_2019_table()
		{
			try
			{
				$query = 'CREATE TABLE IF NOT EXISTS eps2019(
					Serial INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					CompanyID INT(10) NOT NULL,
					Eps1 VARCHAR(15) DEFAULT NULL,
					Eps2 VARCHAR(15) DEFAULT NULL,
					Eps3 VARCHAR(15) DEFAULT NULL,
					Eps4 VARCHAR(15) DEFAULT NULL,
					Annual VARCHAR(15) DEFAULT NULL,
					CONSTRAINT fk_company
					FOREIGN KEY (CompanyID) 
					REFERENCES Company(CompanyID)
				)  ENGINE = MyISAM';
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "EPS-2019 Table created.";
			}
			catch(PDOException $e)
			{
				echo "Could not create table: " . $e->getMessage();
			}
		}
		
		public static function create_eps_2020_table()
		{
			try
			{
				$query = 'CREATE TABLE IF NOT EXISTS eps2020(
					Serial INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					CompanyID INT(10) NOT NULL,
					Eps1 VARCHAR(15) DEFAULT NULL,
					Eps2 VARCHAR(15) DEFAULT NULL,
					Eps3 VARCHAR(15) DEFAULT NULL,
					Eps4 VARCHAR(15) DEFAULT NULL,
					Annual VARCHAR(15) DEFAULT NULL,
					CONSTRAINT fk_company
					FOREIGN KEY (CompanyID) 
					REFERENCES Company(CompanyID)
				)  ENGINE = MyISAM';
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "EPS-2020 Table created.";
			}
			catch(PDOException $e)
			{
				echo "Could not create table: " . $e->getMessage();
			}
		}
		
		public static function create_eps_2021_table()
		{
			try
			{
				$query = 'CREATE TABLE IF NOT EXISTS eps2021(
					Serial INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					CompanyID INT(10) NOT NULL,
					Eps1 VARCHAR(15) DEFAULT NULL,
					Eps2 VARCHAR(15) DEFAULT NULL,
					Eps3 VARCHAR(15) DEFAULT NULL,
					Eps4 VARCHAR(15) DEFAULT NULL,
					Annual VARCHAR(15) DEFAULT NULL,
					CONSTRAINT fk_company
					FOREIGN KEY (CompanyID) 
					REFERENCES Company(CompanyID)
				)  ENGINE = MyISAM';
				$con = self::get_connection();
				$con->exec($query);
				$con = null;
				echo "EPS-2021 Table created.";
			}
			catch(PDOException $e)
			{
				echo "Could not create table: " . $e->getMessage();
			}
		}
		
		public static function show_latest_share_price_all_from_dse()
		{
			require_once("simple_html_dom.php");
			$html = file_get_html('https://www.dsebd.org/latest_share_price_all.php');
			$arr = $html->find("table td");
			
			array_splice($arr, 0, 11);
			$count = count($arr)/11;
			for($i = 0; $i < $count; $i++)
			{
				$newArr = array_splice($arr, 0, 11);
				foreach($newArr as $val)
				{
					echo trim(strip_tags($val)) . " # ";
				}
				echo "<br><hr>";
			}

		}
		
		public static function show_company_list_from_dse()
		{
			require_once("simple_html_dom.php");
			$html = file_get_html('https://www.dsebd.org/latest_share_price_all.php');
			$arr = $html->find("table td");
			
			array_splice($arr, 0, 11);
			$count = count($arr)/11;
			echo "Total Company: <b>" . count($arr)/11 . "</b><br>"; 
			echo "Serial Company Name<br><hr>"; 
			
			for($i = 0; $i < $count; $i++)
			{
				$newArr = array_splice($arr, 0, 11);
				echo " &nbsp;" . trim(strip_tags($newArr[0])) . " => " . trim(strip_tags($newArr[1])) . "<br>";
			}
		}
		
		public static function insert_company_list_from_dse_to_database()
		{
			try
			{
				require_once("simple_html_dom.php");
				$html = file_get_html('https://www.dsebd.org/latest_share_price_all.php');
				$arr = $html->find("table td");			
				array_splice($arr, 0, 11);
				
				$con = self::get_connection();
				$stmt = $con->prepare("INSERT INTO company (CompanyName, CompanyCat)
				VALUES (:name, :cat)");
				
				$num = count($arr)/11;
				for($i = 0; $i < $num; $i++)
				{
					$stmt->bindParam(':name', $name);
					$stmt->bindParam(':cat', $cat);
					
					$newArr = array_splice($arr, 0, 11);
					$name = trim(strip_tags($newArr[1]));
					$cat = "";
					$stmt->execute();
				}
				$last_id = $con->lastInsertId();
				$con = null;
				echo "Total " . $last_id . " company listed from DSE.";
			}
			catch(PDOException $e)
			{
				echo "Could not insert company list: " . $e->getMessage();
			}
		}
		
		public static function update_company_cat_from_dse_to_database()
		{
			try
			{
				require_once("simple_html_dom.php");
				$html = file_get_html('https://www.dsebd.org/latest_share_price_all_group.php?group=A');
				$arr = $html->find("table td");			
				array_splice($arr, 0, 11);
				
				$con = self::get_connection();
				$stmt = $con->prepare('UPDATE company SET CompanyCat = "A" WHERE CompanyName = :CompanyName');
				
				$num = count($arr)/11;
				for($i = 0; $i < $num; $i++)
				{
					$stmt->bindParam(':CompanyName', $CompanyName);
					
					$newArr = array_splice($arr, 0, 11);
					$CompanyName = trim(strip_tags($newArr[1]));
					$stmt->execute();
				}

				echo "Company cat A updated.<br>";
				
				$html = file_get_html('https://www.dsebd.org/latest_share_price_all_group.php?group=B');
				$arr = $html->find("table td");			
				array_splice($arr, 0, 11);
				
				$con = self::get_connection();
				$stmt = $con->prepare('UPDATE company SET CompanyCat = "B" WHERE CompanyName = :CompanyName');
				
				$num = count($arr)/11;
				for($i = 0; $i < $num; $i++)
				{
					$stmt->bindParam(':CompanyName', $CompanyName);
					
					$newArr = array_splice($arr, 0, 11);
					$CompanyName = trim(strip_tags($newArr[1]));
					$stmt->execute();
				}

				echo "Company cat B updated.<br>";
				
				$html = file_get_html('https://www.dsebd.org/latest_share_price_all_group.php?group=G');
				$arr = $html->find("table td");			
				array_splice($arr, 0, 11);
				
				$con = self::get_connection();
				$stmt = $con->prepare('UPDATE company SET CompanyCat = "G" WHERE CompanyName = :CompanyName');
				
				$num = count($arr)/11;
				for($i = 0; $i < $num; $i++)
				{
					$stmt->bindParam(':CompanyName', $CompanyName);
					
					$newArr = array_splice($arr, 0, 11);
					$CompanyName = trim(strip_tags($newArr[1]));
					$stmt->execute();
				}

				echo "Company cat G updated.<br>";
				
				$html = file_get_html('https://www.dsebd.org/latest_share_price_all_group.php?group=N');
				$arr = $html->find("table td");			
				array_splice($arr, 0, 11);
				
				$con = self::get_connection();
				$stmt = $con->prepare('UPDATE company SET CompanyCat = "N" WHERE CompanyName = :CompanyName');
				
				$num = count($arr)/11;
				for($i = 0; $i < $num; $i++)
				{
					$stmt->bindParam(':CompanyName', $CompanyName);
					
					$newArr = array_splice($arr, 0, 11);
					$CompanyName = trim(strip_tags($newArr[1]));
					$stmt->execute();
				}

				echo "Company cat N updated.<br>";
				
				$html = file_get_html('https://www.dsebd.org/latest_share_price_all_group.php?group=Z');
				$arr = $html->find("table td");			
				array_splice($arr, 0, 11);
				
				$con = self::get_connection();
				$stmt = $con->prepare('UPDATE company SET CompanyCat = "Z" WHERE CompanyName = :CompanyName');
				
				$num = count($arr)/11;
				for($i = 0; $i < $num; $i++)
				{
					$stmt->bindParam(':CompanyName', $CompanyName);
					
					$newArr = array_splice($arr, 0, 11);
					$CompanyName = trim(strip_tags($newArr[1]));
					$stmt->execute();
				}

				echo "Company cat Z updated.<br>";
				
				$con = null;
			}
			catch(PDOException $e)
			{
				echo "Could not update company cat: " . $e->getMessage();
			}
		}
		
		public static function insert_latest_share_price_from_dse_to_database()
		{
			try
			{
				require_once("simple_html_dom.php");
				$html = file_get_html('https://www.dsebd.org/latest_share_price_all.php');
				$arr = $html->find("table td");			
				array_splice($arr, 0, 11);
				
				$con = self::get_connection();
				$stmt = $con->prepare("INSERT INTO latestshareprice(CompanyID, Ltp, High, Low, ClosePrice, Ycp, ChangePrice, Trade, ValueMn, Volume) VALUES (:CompanyID, :Ltp, :High, :Low, :ClosePrice, :Ycp, :ChangePrice, :Trade, :ValueMn, :Volume)");
				
				$num = count($arr)/11;
				for($i = 0; $i < $num; $i++)
				{
					$stmt->bindParam(':CompanyID', $CompanyID);
					$stmt->bindParam(':Ltp', $Ltp);
					$stmt->bindParam(':High', $High);
					$stmt->bindParam(':Low', $Low);
					$stmt->bindParam(':ClosePrice', $ClosePrice);
					$stmt->bindParam(':Ycp', $Ycp);
					$stmt->bindParam(':ChangePrice', $ChangePrice);
					$stmt->bindParam(':Trade', $Trade);
					$stmt->bindParam(':ValueMn', $ValueMn);
					$stmt->bindParam(':Volume', $Volume);
					
					$newArr = array_splice($arr, 0, 11);
					
					$CompanyID = trim(strip_tags($newArr[0]));
					$Ltp = trim(strip_tags($newArr[2]));
					$High = trim(strip_tags($newArr[3]));
					$Low = trim(strip_tags($newArr[4]));
					$ClosePrice = trim(strip_tags($newArr[5]));
					$Ycp = trim(strip_tags($newArr[6]));
					$ChangePrice = trim(strip_tags($newArr[7]));
					$Trade = trim(strip_tags($newArr[8]));
					$ValueMn = trim(strip_tags($newArr[9]));
					$Volume = trim(strip_tags($newArr[10]));
					
					$stmt->execute();
				}
				$last_id = $con->lastInsertId();
				$con = null;
				echo "Total " . $last_id . " company's latest share price updated from DSE.";
			}
			catch(PDOException $e)
			{
				echo "Could not insert latest share price: " . $e->getMessage();
			}
		}
		
		public static function get_company_number()
		{
			$con = self::get_connection();
			$sql = 'SELECT count(CompanyID) AS NoOfCompany from company';
		}
		
		public static function insert_company_full_name_from_dse_to_database()
		{
			try
			{
				require_once("simple_html_dom.php");
				
				$con = self::get_connection();
				$sql = 'SELECT CompanyName from company LIMIT 10 OFFSET 0';

				$companyID = 1;
				foreach ($con->query($sql) as $row) {
					$html = file_get_html('https://www.dsebd.org/displayCompany.php?name=' . $row['CompanyName']);
					$arr = $html->find("table th i");
					$companyfullname = trim(strip_tags($arr[0]));
					$html = null;
					
					$stmt = $con->prepare("INSERT INTO companyfullname (CompanyID, CompanyName) VALUES (:CompanyID, :CompanyName)");
					$stmt->bindParam(':CompanyID', $companyID);
					$stmt->bindParam(':CompanyName', $companyfullname);
					$stmt->execute();
					$companyID++;
				}
				echo "Company full name inserted successfully.";
			}
			catch(PDOException $e)
			{
				echo "Could not insert company full name: " . $e->getMessage();
			}
		}
		
		public static function insert_company_full_name_from_dse_to_database_20()
		{
			try
			{
				require_once("simple_html_dom.php");
				
				$con = self::get_connection();
				$sql = 'SELECT CompanyName from company LIMIT 10 OFFSET 10';
				$companyID = 1;
				foreach ($con->query($sql) as $row) {
					$html = file_get_html('https://www.dsebd.org/displayCompany.php?name=' . $row['CompanyName']);
					$arr = $html->find("table th i");
					$companyfullname = trim(strip_tags($arr[0]));
					$html = null;
					
					$stmt = $con->prepare("INSERT INTO companyfullname (CompanyID, CompanyName) VALUES (:CompanyID, :CompanyName)");
					$stmt->bindParam(':CompanyID', $companyID);
					$stmt->bindParam(':CompanyName', $companyfullname);
					$stmt->execute();
					$companyID++;
				}
				echo "Company full name inserted successfully.";
			}
			catch(PDOException $e)
			{
				echo "Could not insert company full name: " . $e->getMessage();
			}
		}
	}

?>