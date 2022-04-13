<?php

class ScheduleData
{
    private static $tablename = "medic_schedule";

    public function __construct()
    {
        $this->medic_id = "";
        $this->esemana = "";
        $this->fsemana = "";
        $this->week_start = "";
        $this->week_end = "";
        $this->weekend_start = "";
        $this->weekend_end = "";
    }

    public static function getById($id){
        $sql = "select medic_id, esemana, fsemana, week_start, week_end, weekend_start, weekend_end  from ".self::$tablename." where medic_id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0],new ScheduleData());
    }

    public function update(){
        $sql = "update ".self::$tablename." set esemana=\"$this->esemana\",fsemana=\"$this->fsemana\",week_start=\"$this->week_start\",week_end=\"$this->week_end\",weekend_start=\"$this->weekend_start\",weekend_end=\"$this->weekend_end\" where medic_id=$this->medic_id";
        Executor::doit($sql);
    }
}