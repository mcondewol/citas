<?php
class ReservationData {
	public static $tablename = "reservation";
	

	public function ReservationData(){
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function getPacient(){ return PacientData::getById($this->pacient_id); }
	public function getMedic(){ return MedicData::getById($this->medic_id); }
	public function getStatus(){ return StatusData::getById($this->status_id); }
	public function getPayment(){ return PaymentData::getById($this->payment_id); }
 
	public function add(){
		$sql = "insert into reservation (title,note,medic_id,date_at,time_at,pacient_id,user_id,price,status_id,payment_id,sick,symtoms,medicaments,created_at) ";
		$sql .= "values (\"$this->title\",\"$this->note\",\"$this->medic_id\",\"$this->date_at\",\"$this->time_at\",$this->pacient_id,$this->user_id,\"$this->price\",$this->status_id,$this->payment_id,\"$this->sick\",\"$this->symtoms\",\"$this->medicaments\",$this->created_at)";
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

// partiendo de que ya tenemos creado un objecto ReservationData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set title=\"$this->title\",pacient_id=\"$this->pacient_id\",medic_id=\"$this->medic_id\",date_at=\"$this->date_at\",time_at=\"$this->time_at\",note=\"$this->note\",sick=\"$this->sick\",symtoms=\"$this->symtoms\",medicaments=\"$this->medicaments\",status_id=\"$this->status_id\",payment_id=\"$this->payment_id\",price=\"$this->price\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where pacient_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservationData());
	}

	public static function getRepeated($medic_id,$date_at,$time_at){
		$sql = "select * from ".self::$tablename." where  medic_id=$medic_id and date_at= STR_TO_DATE(\"$date_at\",'%d/%m/%Y') and time_at=\"$time_at\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservationData());
	}



	public static function getByMail($mail){
		$sql = "select * from ".self::$tablename." where mail=\"$mail\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservationData());
	}

	public static function getEvery(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." where date(date_at)>=date(NOW()) order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}


	public static function getAllPendings(){
		$sql = "select * from ".self::$tablename." where date(date_at)>=date(NOW()) and status_id=1 and payment_id=1 order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}


	public static function getAllByPacientId($id){
		$sql = "select * from ".self::$tablename." where pacient_id=$id order by date_at DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

	public static function getAllByMedicId($id){
		$sql = "select * from ".self::$tablename." where medic_id=$id order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

	public static function getOld($pacient_id){
		$sql = "select * from ".self::$tablename." where pacient_id = $pacient_id order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

	public static function getDia($medic_id,$dia,$hora){
		$arr = explode("/",$dia);
		$date_convert = $arr[2].'-'.$arr[1].'-'.$arr[0];
		$d = date('l', strtotime($date_convert));
		
		$week = date('N', strtotime($date_convert));
		$letra = "";
		switch ($d) {
			case "Sunday":
				$letra = "domingo";
			break;
			case "Monday":
				$letra = "lunes";
			break;
			case "Tuesday":
				$letra ="martes";
			break;
			case "Wednesday":
				$letra = "miercoles";
			break;
			case "Thursday":
				$letra= "jueves";
			break;
			case "Friday":
				$letra = "viernes";
			break;
			case "Saturday":
				$letra = "sabado";
			break;
		}
		if ($week < 6) {
			$sql = "select * from" ." medic_schedule "."where  medic_id=$medic_id and esemana like '%$letra%' and  week_start <= '$hora' and week_end >= '$hora' ;";
			$query = Executor::doit($sql);
			return Model::one($query[0],new ReservationData());
		} else {
			$sql = "select * from" ." medic_schedule "."where  medic_id=$medic_id and fsemana like '%$letra%' and  weekend_start <= '$hora' and weekend_end >= '$hora' ;";
			$query = Executor::doit($sql);
			return Model::one($query[0],new ReservationData());
		}
		
		
	}


}

?>