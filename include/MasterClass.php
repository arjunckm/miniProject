<?php
/**
 * Created by PhpStorm.
 * User: Arjun J S
 * Date: 04-10-2016
 * Time: 02:06 AM
 */

require_once ('config.php');


class MasterClass
{
    private $mysqli;

    function __construct()
    {
        $this->mysqli = new mysqli(DBHOST, DBUSER, DBPASSWORD, DATABASE);
    }

    function __destruct()
    {
        $this->mysqli->close();
    }

    
    public function distinctState(){  //list of distinct state

        $query = $this -> mysqli -> query("SELECT DISTINCT state FROM `students_details_me`");
        if ($this -> mysqli -> affected_rows > 0) {
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
               echo $row["state"]."<br/>";
            }
        }else {
            echo 'No Data';
        }
    }

    public function distinctStatus(){ //distinct Status List

        $distinctStatusArr=array();
        $query = $this -> mysqli -> query("SELECT DISTINCT status FROM `students_details_me`");
        if ($this -> mysqli -> affected_rows > 0) {
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
               $distinctStatusArr[]=$row['status'];
            }
            return $distinctStatusArr;
        }
    }

    public function StudentsDiscontinud(){ //no. of Students Discontinud vs completed
        $func=new MasterClass();
        $statuslist=$func->distinctStatus();
        $sql="SELECT";
        foreach ($statuslist as $key => $value) {                      
           $sql.="(SELECT COUNT(status) FROM `students_details_me` WHERE status='$value')as $value";
           if($key==(count($statuslist)-1)){
                $sql.="";
            }else{
                $sql.=",";
            }  
        }
        $query = $this -> mysqli -> query("$sql");
        $dataArray=array();
        if ($this -> mysqli -> affected_rows > 0) {
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
                $dataArray[]=$row;
            }
        }
        return json_encode($dataArray);
    }

    public function getgenderRation(){
        $query = $this -> mysqli -> query('select(SELECT count(gender) FROM `students_details_me` WHERE gender="M") as MALE, (SELECT count(gender) FROM `students_details_me` WHERE gender="F") as FEMALE');
        $dataArray=array();
        if ($this -> mysqli -> affected_rows > 0) {
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
                $dataArray[]=$row;
            }
        }
        return json_encode($dataArray);
    }

    public function getallResultratio(){
        $query = $this -> mysqli -> query('select(SELECT count(result) FROM `students_details_me` WHERE result="DIST") as Distinction, (SELECT count(result) FROM `students_details_me` WHERE result="FIRST") as First, (SELECT count(result) FROM `students_details_me` WHERE result="SECOND") as Second,(SELECT count(result) FROM `students_details_me` WHERE result="PASS") as JustPass');
        $dataArray=array();
        if ($this -> mysqli -> affected_rows > 0) {
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
                $dataArray[]=$row;
            }
        }
        return json_encode($dataArray);
    }


    public function getDistinctStartYear(){ //distinct Start Year List

        $DistinctStartYear=array();
        $query = $this -> mysqli -> query("SELECT DISTINCT start_year FROM students_details_me ORDER by start_year ASC");
        if ($this -> mysqli -> affected_rows > 0) {
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
               $DistinctStartYear[]=$row['start_year'];
            }
            return $DistinctStartYear;
        }
    }

    public function getYearWiseEnrollment(){ //no. of Students Enrolled By Year
        $func=new MasterClass();
        $getlist=$func->getDistinctStartYear();

        $sql="";
        foreach ($getlist as $key => $value) {                      
           $sql.="SELECT COUNT(status) as noofstudent, start_year  FROM `students_details_me` WHERE start_year='$value'";
           if($key==(count($getlist)-1)){
                $sql.="";
            }else{
                $sql.=" UNION ";
            }  
        }
        $query = $this -> mysqli -> query("$sql");
        $dataArray=array();
        if ($this -> mysqli -> affected_rows > 0) {
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
                $dataArray[]=$row;
            }
        }
        return json_encode($dataArray);
    }

    public function getOddEvenEnrollRatio(){
         $query = $this -> mysqli -> query('select(SELECT count(batch_type) FROM `students_details_me` WHERE batch_type="ODD") as ODD, (SELECT count(batch_type) FROM `students_details_me` WHERE batch_type="EVEN") as EVEN');
        $dataArray=array();
        if ($this -> mysqli -> affected_rows > 0) {
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
                $dataArray[]=$row;
            }
        }
        return json_encode($dataArray);
    }

    public function getListOfStatesWise(){
        $query=$this->mysqli->query('SELECT count(state) as stateCount,state  FROM `students_details_me`WHERE state !="" GROUP BY state');
         $dataArray=array();
        /* $stateCoutnt=array();
         $States=array();*/
        if ($this -> mysqli -> affected_rows > 0) {
            while ($row = $query -> fetch_array(MYSQLI_ASSOC)) {
                //$dataArray[$row['state']]=$row['stateCount'];


                $stateCoutnt[]=$row['stateCount'];
                $States[]=$row['state'];
            }
        }
        $dataArray['count']=$stateCoutnt;
        $dataArray['states']=$States;
        return json_encode($dataArray);
    }
}