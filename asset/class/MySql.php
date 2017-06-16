<?php

class Mysql{
	public static $Server   = "localhost";
	static $User     = "root";
	static $Password = "";
	static $DataBaseName = "techno";
	static $Connection;
	static $DataBase;
	static $LoadConnection=0;
	static $CharSet="utf8";
	static $TRANS =false;
	static $TRSS  = array();
	
	public function __construct(){
		if(Mysql::$LoadConnection==0){
			Mysql::$Connection = mysql_connect(Mysql::$Server,Mysql::$User,Mysql::$Password);
			Mysql::$DataBase   = mysql_select_db(Mysql::$DataBaseName,Mysql::$Connection);
			$charset=Mysql::$CharSet;
			mysql_query("SET NAMES $charset");
			Mysql::$LoadConnection=1;
		}
	}
	
	public function StartTransaction(){
		Mysql::$TRANS =true;
	}
	
	public function Commit(){
		mysql_query("SET AUTOCOMMIT = 0");
		mysql_query("START TRANSACTION");
		$K=1;
		foreach (Mysql::$TRSS as $T){
			$L=mysql_query($T);
			$K = $K and $L;
		}
		if($K)
			mysql_query("COMMIT");
		else
			mysql_query("ROLLBACK");
		Mysql::$TRANS =false;
	}
	
	public function Query($sql){
		if(Mysql::$TRANS==true)
			Mysql::$TRSS[]=$sql;
		else
		{
			return mysql_query($sql);
		}
	}
	
	public function Fetch($Res){
		return mysql_fetch_assoc($Res);
	}
	
	public function LastInsertId(){
		return mysql_insert_id();
	}
	
}

?>