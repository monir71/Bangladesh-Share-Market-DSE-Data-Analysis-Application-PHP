<?php 
	require_once("backup.php");
	require_once("dseData.php");
	
	class restore
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
		
		public static function restore_system()
		{
			try
			{
				backup::create_table_company();
				backup::create_table_eps_2019();
				backup::create_table_eps_2020();
				backup::create_table_eps_2021();
				
				dse::delete_database();
				
				//create db dse
				
				dse::create_company_table();
				dse::create_navpe_table();
				dse::create_latest_share_price_table();
				dse::create_eps_2019_table();
				dse::create_eps_2020_table();
				dse::create_eps_2021_table();
				
				//update dse database
				
				dse::insert_company_list_from_dse_to_database();
				dse::update_company_cat_from_dse_to_database();
				dse::insert_latest_share_price_from_dse_to_database();
				
				
			}
			catch(PDOException $e)
			{
				echo "Could not create table: " . $e->getMessage();
			}
			
		}
	}
?>