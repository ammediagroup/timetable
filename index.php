<?PHP
/**
===================================
Файл: index.php
-----------------------------------------------------
Версия: 1.1v
-----------------------------------------------------
Назначение: Главный файл
===================================
**/

define ('WEB_MODER',TRUE);
define ( 'WM_ROOT_DIR', dirname ( __FILE__ ) );
define ( 'WM_ENGINE_DIR', WM_ROOT_DIR . '/engine' );
define ( 'WM_MOD_DIR', WM_ENGINE_DIR . '/mods' );

include_once WM_ENGINE_DIR."/functions.php";
include_once WM_ENGINE_DIR."/classes/excelwriter.inc.php";


if($_POST['student_idd'] != null){
		if($_GET['date'] != NULL){
	$date = explode("-", $_GET[date]);	
    $year = $date["0"];
    $month = $date["1"];
	$day = $date["2"];
	}else{
    $year = date("Y");
    $month = date("m");
	$day = date("d");
	}
	$date = $year."-".$month."-".$day;
	$student_id = $_POST['student_idd'];
	$less_id = $_GET['less'];
	$group_id = $_GET['group'];
		if($_POST['check'] == 'on'){
			WM_add_date($date,$less_id,$group_id,$student_id);
		header("location: ".$_SERVER['REQUEST_URI']."");
		}
		if($_POST['check'] == null){
			WM_delete_date($date,$less_id,$group_id,$student_id);
		header("location: ".$_SERVER['REQUEST_URI']."");
		}
	}
if($_GET['mod'] == 'exel' && $_GET['date'] != null && $_GET['less'] != null && $_GET['group'] != null) {
$students = WM_select_students($_GET['group']);
if($_GET['date'] != NULL){
	$date = explode("-", $_GET[date]);	
    $year = $date["0"];
    $month = $date["1"];
	$day = $date["2"];
	}else{
    $year = date("Y");
    $month = date("m");
	$day = date("d");
	}
	$date = $year."-".$month."-".$day;
	$less_id = $_GET['less'];
	$group_id = $_GET['group'];
	

$output = "№\tИмя\tП\tЗаметка\n";
$i=1;	
foreach($students as $student){
	$a = WM_select_date_stud($date,$less_id,$group_id,$student['id']);
	$b = WM_select_date_stud($date,$less_id,$group_id,$student['id'],2);
	if($a and $b) $data = false;
	if($a and !$b) $data = true;
	if(!$a and !$b) $data = false;
	if($data) $act = "+"; else $act = "-";

    $output .= "$i\t".$student['student']."\t$act\t\"\n\"line break\"\n";
$i++;
}

header("Content-type: application/vnd.ms-excel");
header('Content-disposition: attachment; filename="report_' . $date . '.xls"');
print $output;
exit;
}
else{
WM_mod_content();
}
?>