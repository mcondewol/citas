<?php
class LocationData {
	public static $tablename = "location";


	public function __construct(){
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into location (name,id_municipio, usering, fechaing) ";
		$sql .= "values (\"$this->name\",\"$this->idubicacion\",\"$this->iduser\",now())";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto LocationData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",id_municipio=\"$this->idubicacion\"  where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new LocationData());
	}

	public static function getAll(){
		$sql_user = (isset($_SESSION['user_id'])) ? "select * from user where id = ". $_SESSION['user_id'] : "select * from user where id = 0 ";
		$query_user = Executor::doit($sql_user);
		$rest = Model::one($query_user[0],new UserData());
		if (!isset($rest->idlocation)) {
			$sql = "select * from ".self::$tablename;
		} else {
			$sql = "select * from location where id = ".$rest->idlocation;
		}
		$query = Executor::doit($sql);
		return Model::many($query[0],new LocationData());

	}

    public static function getAll_municipio(){
		$sql = "select * from municipios ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new LocationData());

	}
	public static function getOne_municipio($id){
		$sql = "select * from municipios where id= ".$id;
		$query = Executor::doit($sql);
		return Model::one($query[0],new LocationData());
	}

    public static function getAll_departamentos(){
		$sql = "select * from departamentos ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new LocationData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new LocationData());
	}


}

?>