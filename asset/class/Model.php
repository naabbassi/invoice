<?php

class Model extends Mysql{

	protected $datamembers = array();
	protected $PrimaryKey="Id";
	protected $TableName ="Table";
	public $UnProtectedExecute = false;	
	static  $id=12;
	
	
	public  function ReadyString($value)
	{
			return $value;
	}
	public function __set($variable, $value){
		$this->datamembers[strtolower($variable)] = $value;
	}
	
	public function __get($variable){
		return $this->datamembers[strtolower($variable)];
	}
 
	public function HasField($name){
		return isset($this->datamembers[strtolower($name)]);
	}
	
	public function HasRecord($cond){
		return $this->Count($cond) > 0;
	}
	
	public function Select($cond="",$fields="*",$order="",$limit="",$EXT=""){
		if($cond  !="") $cond  = " Where $cond";
		if($order !="") $order = " Order By $order";
		if($limit !="") $limit = " LIMIT $limit";
		$table = $this->TableName;
		$sql="SELECT $fields From $table $cond  $EXT $order $limit";
		
		$result= array();
		$r=$this->Query($sql);

		while($row = $this->Fetch($r)){
			$t= clone $this;
			foreach ($row as $k => $v){
				$k=strtolower($k);
				$t->$k=$v;
			}
			$result[]=$t;
		}
		return $result;
	}
	
	public function Count($cond=""){
		if($cond !="")$cond =" Where ".$cond;
		$table=$this->TableName;
		$r=$this->Query("select count(*) as cntx from $table $cond");
		$row = $this->Fetch($r);
		return $row['cntx'];
	}
	
	public function Sum($field,$cond=""){
		if($cond !="")$cond =" Where ".$cond;
		$table=$this->TableName;
		$r=$this->Query("select sum($field) as sumx from $table $cond");
		$row = $this->Fetch($r);
		return intval($row['sumx']);
	}
	
	public function Max($field,$cond=""){
		if($cond !="")$cond =" Where ".$cond;
		$table=$this->TableName;
		$r=$this->Query("select Max(`$field`) as mx from `$table` $cond");
		$row = $this->Fetch($r);
		return $row['mx'];		
	}
	
	public function All(){
		return $this->Select();
	}
	public function Limit($limit=10,$cond="",$order=""){
		return $this->Select($cond,"*",$order,$limit);
	}
	public function Filter($cond,$order=""){
		return $this->Select($cond,"*" , $order);
	}
	public function FindByCond($cond){
		$table =$this->TableName;
		$fd=$this->Select($cond);
		if(count($fd)>0)
			return $fd[0];
	}
	public function Find($field,$value,$op="="){
		$fd=($this->Select($field .$op . "'".$this->ReadyString($value)."'"));
		if(count($fd)>0)
			return $fd[0];
	}

	public function FindAll($cond=""){
		return $this->Select($cond);
	}
	
	public function FindByKey($key){
		$fd=$this->Select($this->PrimaryKey ."=".$this->ReadyString($key));
		if(count($fd)>0)
			return $fd[0];
	}
	public function Maxid()
	{
		$sql="Select max(`id`) as mx from `".$this->TableName."`";
		$r=$this->Query($sql);
		$row = $this->Fetch($r);
		return $row['mx'];		
	}
	public function UpdateByCond($cond,$field="*"){
		$ff=array();
		$table=$this->TableName;
		if($field=="*"){
			foreach ($this->datamembers as $k => $v)
				if($k != $this->PrimaryKey)
					$ff[]= "`".$k."`='" . $this->ReadyString($v)."'";
			$ff=implode(",", $ff);
		}else{
			$ff="`$field`='".$this->$field."'";
		}

			
		$sql="UPDATE `$table` SET $ff where $cond";
		$this->Query($sql);		
	}
	public function Update($field="*"){
		$cond = $this->PrimaryKey;
		
		if($cond !="" && $this->HasField($cond))
			$cond = " WHERE `$cond` ='".$this->ReadyString($this->$cond)."'";
		else
			$cond="";		
		$this->UpdateByCond($cond,$field);
	}
	
	public function Clear(){
		$table=$this->TableName;
		$this->Query("TRUNCATE TABLE `$Table`");
	}
	
	public function Delete($key=""){
		$table=$this->TableName;
		$k=$this->PrimaryKey;
		$v=$key;
		$sql="DELETE FROM $table WHERE `$k`='$v'";
		$this->Query($sql);
	}
	
	public function getLastKey(){
		  $mx= $this->Max($this->PrimaryKey);
		  return $mx;
	}
		
	public function Save(){
		//implode
		$fs=array();
		$vs=array();
		$table=$this->TableName;
		
		foreach ($this->datamembers as $k => $v)
		{
			$fs[]= "`".$k."`";
			$vs[]="'" . $this->ReadyString($v)."'";
		}

		$fs=implode(",", $fs);
		$vs=implode(",", $vs);
		
		$sql="INSERT INTO $table ($fs) VALUES ($vs) ";
//		echo "<pre>\n$sql</pre>";
		$this->Query($sql);
		$this->datamembers[strtolower($this->PrimaryKey)] = $this->LastInsertId();
	}	 
}

?>