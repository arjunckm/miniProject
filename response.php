<?php

include "include/MasterClass.php";

$function=new MasterClass();
if($_GET['data']=="status"){
	echo $function->StudentsDiscontinud();
}
if($_GET['data']=="genderratio"){
	echo $function->getgenderRation();
}
if($_GET['data']=="resultall"){
	echo $function->getallResultratio();
}
if($_GET['data']=="yearenroll"){
	echo $function->getYearWiseEnrollment();
}
if($_GET['data']=="oddevenEnroll"){
	echo $function->getOddEvenEnrollRatio();
}
if($_GET['data']=="statewiselist"){
	echo $function->getListOfStatesWise();
}
