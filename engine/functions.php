<?php
/**
===================================
Файл: functions.php
-----------------------------------------------------
Версия: 1.0v
-----------------------------------------------------
Назначение: Библиотека функций
-----------------------------------------------------
Автор: Гузун Дмитрий Витальевич
===================================
**/


if (! defined ( 'WEB_MODER' )) {
	die ( "<P>Доступ к файлу заблакирован!<P>Возможно вы пытаетесь запустить его на прямую" );
}


include_once WM_ENGINE_DIR."/db.php";

//Вывод контента
function WM_mod_content(){
	include "content/header.php";
	include "content/footer.php";
}

function WM_content(){
	if($_GET['mod'])
	WM_get_mod($_GET['mod']);
	else
	WM_get_mod();
}
//Вывод модулей
function WM_get_mod($get = 'main'){
	include WM_MOD_DIR."/$get.php";
}

//Конвертируем данные в массив
function db2Array($data){
	$arr = array();
	while($row = mysql_fetch_assoc($data)){
		$arr[] = $row;
	}
	return $arr;
}





 //--------------------------------------------------------\\
///---!          ФУНКЦИИ РАБОТЫ СО СТУДЕНТАМИ          !---\\\

//Функция добавление студента в БД
function WM_add_student($name,$group_id,$comment){
	$SQL = "INSERT INTO 
						students (
							student,
							group_id,
							comment
							)
						VALUES (
							'$name',
							$group_id,
							'$comment'
							)";
	mysql_query($SQL);
}

//Функция выборки студентов из БД
function WM_select_students($group_id = 0){
if($group_id == 0){
	$SQL = "SELECT 
					id,
					student,
					group_id,
					comment
				FROM 
					students
				ORDER BY student ASC";
	$result = mysql_query($SQL) or die(mysql_error());
	return db2Array($result);
}else{
	$SQL = "SELECT 
					s.id,
					s.student,
					s.group_id,
					s.comment,
					g.group
				FROM 
					students s,
					groups g
				WHERE
					s.group_id = $group_id
				AND
					s.group_id = g.id
				ORDER BY student ASC";
	$result = mysql_query($SQL) or die(mysql_error());
	return db2Array($result);
}
}

function WM_numrow_students($group_id){
$SQL = "SELECT * FROM students WHERE group_id = $group_id";
	$result = mysql_query($SQL) or die(mysql_error());
	$num_rows = mysql_num_rows($result);
	return $num_rows;
}

//Функция выборки студента из БД
function WM_select_student($id){
	$SQL = "SELECT 
					id,
					student,
					group_id,
					comment
				FROM 
					students
				WHERE
					id = ".$id;
	$result = mysql_query($SQL) or die(mysql_error());
	return db2Array($result);
}

//Функция редактирования студента
function WM_edit_student($id,$name,$group_id,$comment){
	$SQL = "UPDATE students
						SET
							student = '$name',
							group_id = $group_id,
							comment = '$comment'
						WHERE 
							id = ".$id;
	mysql_query($SQL);
}

//Функция удаление студента из БД
function WM_delete_student($id){
	$SQL = "SELECT * FROM date WHERE student_id = $id";
	$result = mysql_query($SQL) or die(mysql_error());
	if(mysql_num_rows($result) != 0){
		$SQL = "DELETE FROM date WHERE student_id = $id";
		mysql_query($SQL) or die(mysql_error());
	}
	$SQL = "DELETE FROM students WHERE id = $id";
	mysql_query($SQL);
}
/*__________________________________==КОНЕЦ==__________________________________*/





 //--------------------------------------------------------\\
///---!           ФУНКЦИИ РАБОТЫ С ГРУППАМИ            !---\\\
//Функция добавления группы в БД
function WM_add_group($group){
	$SQL = "INSERT INTO `journal`.`groups` (
`id` ,
`group`
)
VALUES (
NULL , '$group'
);
";
	mysql_query($SQL);
}

//Функция выборки групп из БД
function WM_select_groups(){
	$SQL = "SELECT *
				FROM
					groups";
	$result = mysql_query($SQL) or die(mysql_error());
	return db2Array($result);
}

//Функция выборки группы из БД
function WM_select_group($id){
	$SQL = "SELECT *
				FROM
					groups
				WHERE
					id = ".$id;
	$result = mysql_query($SQL) or die(mysql_error());
	return db2Array($result);
}

//Функция редактирования группы
function WM_edit_group($id,$group){
	$SQL = "UPDATE `journal`.`groups` SET `group` = '$group' WHERE `groups`.`id` =".$id;
	mysql_query($SQL);
}

//Функция удаления группы из БД 
function WM_delete_group($id){
	$SQL = "SELECT * FROM date WHERE group_id = $id";
	$result = mysql_query($SQL) or die(mysql_error());
	if(mysql_num_rows($result) != 0){
		$SQL = "DELETE FROM date WHERE group_id = $id";
		mysql_query($SQL) or die(mysql_error());
	}
	$SQL = "SELECT * FROM students WHERE group_id = $id";
	$result = mysql_query($SQL) or die(mysql_error());
	if(mysql_num_rows($result) != 0){
		$SQL = "UPDATE students SET group_id = 0 WHERE group_id = $id";
		mysql_query($SQL) or die(mysql_error());
	}
	$SQL = "DELETE FROM groups WHERE id = $id";
	mysql_query($SQL) or die(mysql_error());
}
/*__________________________________==КОНЕЦ==__________________________________*/





 //--------------------------------------------------------\\
///---!          ФУНКЦИИ РАБОТЫ С ПРЕДМЕТАМИ           !---\\\
//Функция добавления предмета в БД
function WM_add_less($less){
	$SQL = "INSERT INTO `journal`.`less` (
`id` ,
`less`
)
VALUES (
NULL , '$less'
);
";
	mysql_query($SQL);
}

//Функция выборки предметов из БД
function WM_select_lessions(){
	$SQL = "SELECT 
					id,
					less
				FROM
					less";
	$result = mysql_query($SQL) or die(mysql_error());
	return db2Array($result);
}

//Функция выборки предмета из БД
function WM_select_lession($id){
	$SQL = "SELECT 
					id,
					less
				FROM
					less
				WHERE
					id = ".$id;
	$result = mysql_query($SQL) or die(mysql_error());
	return db2Array($result);
}

//Функция редактирования предмета
function WM_edit_less($id,$less){
	$SQL= "UPDATE `journal`.`less` SET `less` = '$less' WHERE `less`.`id` =".$id;
	mysql_query($SQL);
}

//Функция удаления предмета из БД
function WM_delete_less($id){
	$SQL = "SELECT * FROM date WHERE less_id = $id";
	$result = mysql_query($SQL) or die(mysql_error());
	if(mysql_num_rows($result) != 0){
		$SQL = "DELETE FROM date WHERE less_id = $id";
		mysql_query($SQL) or die(mysql_error());
	}
	$SQL = "DELETE FROM less WHERE id = $id";
	mysql_query($SQL) or die(mysql_error());
}



/*__________________________________==КОНЕЦ==__________________________________*/




 //--------------------------------------------------------\\
///---!           ФУНКЦИИ РАБОТЫ С ЖУРНАЛАМИ           !---\\\

//Функция создания журнала
function WM_add_journal($date,$less_id,$group_id){
	$SQL = "INSERT INTO date(date,less_id,group_id,student_id) VALUES('$date',$less_id,$group_id,0)";
	mysql_query($SQL) or die(mysql_error());
}

function WM_select_journal($date){
	$SQL = "SELECT d.date,d.less_id,d.group_id,l.less,g.group FROM date d, less l, groups g WHERE d.date = '$date' AND d.less_id = l.id AND d.group_id = g.id AND student_id = 0";
	$result = mysql_query($SQL) or die(mysql_error());
	return db2Array($result);
}

function WM_delete_journal($date,$less_id,$group_id){
	$SQL = "DELETE FROM date WHERE date = '$date' AND less_id = $less_id AND group_id = $group_id";
	mysql_query($SQL) or die(mysql_error());
}

function WM_select_date($date,$less_id = 0,$group_id = 0){		
		if($less_id == 0 and $group_id == 0){
			$SQL = "SELECT * FROM date WHERE date = '$date' AND student_id != 0 AND less_id = (SELECT DISTINCT less_id FROM date)";
		}elseif($group_id == 0){
			$SQL = "SELECT * FROM date WHERE date = '$date' AND student_id != 0 AND less_id = $less_id AND group_id = (SELECT DISTINCT group_id FROM date)";
		}else{
			$SQL = "SELECT * FROM date WHERE date = '$date' AND student_id != 0 AND less_id = $less_id AND group_id = $group_id";
		}
		$result = mysql_query($SQL) or die(mysql_error());
		return db2Array($result);
}

function WM_select_date_notice($date,$less_id,$group_id,$student_id){
	$SQL = "SELECT notice FROM date WHERE date = '$date' AND less_id = $less_id AND group_id = $group_id AND student_id = $student_id";
	$result = mysql_query($SQL) or die(mysql_error());
	return db2Array($result);
}

function WM_select_date_stud($date,$less_id,$group_id,$student_id,$mod = 1){
	if($mod == 1)
		$SQL = "SELECT * FROM date WHERE date = '$date' AND less_id = $less_id AND group_id = $group_id AND student_id = $student_id";
	if($mod == 2)
		$SQL = "SELECT * FROM date WHERE date = '$date' AND less_id = $less_id AND group_id = $group_id AND student_id = $student_id AND active = 0";
	if($mod == 3)
		$SQL = "SELECT * FROM date WHERE date = '$date' AND less_id = $less_id AND group_id = $group_id AND student_id = $student_id AND notice != null";
	$result = mysql_query($SQL) or die(mysql_error());
		if(mysql_num_rows($result)==0){
			$res = false;
			return $res;
		}else{ 
			$res = true;
			return $res; 
}
}


function WM_add_date($date,$less_id,$group_id,$student_id,$notice = null){
$active0 = WM_select_date_stud($date,$less_id,$group_id,$student_id,2);
$active1 = WM_select_date_stud($date,$less_id,$group_id,$student_id);
	if($notice == null){
		if($active0 == false and $active1 == false)
			$SQL = "INSERT INTO date(date,less_id,group_id,student_id) VALUES('$date',$less_id,$group_id,$student_id)";
		if($active0 == true)
			$SQL = "UPDATE date SET active = 1 WHERE date = '$date' AND less_id = $less_id AND group_id = $group_id AND student_id = $student_id";
	}else{
		if($foo == false)
			$SQL = "INSERT INTO date(date,less_id,group_id,student_id,notice,active) VALUES('$date',$less_id,$group_id,$student_id,'$notice',0)";
		else
			$SQL = "UPDATE date SET notice = '$notice' WHERE date = '$date' AND less_id = $less_id AND group_id = $group_id AND student_id = $student_id";
	}
	mysql_query($SQL) or die(mysql_error());
}

function WM_is_date($date){
		$SQL = "SELECT * FROM date WHERE date = '$date'";
		$result = mysql_query($SQL) or die(mysql_error());
		if(mysql_num_rows($result)==0){
			$res = false;
			return $res;
		}else{ 
			$res = true;
			return $res; 
}
}

function WM_delete_date($date,$less_id,$group_id,$student_id,$notice = 0,$full = null){
$active0 = WM_select_date_stud($date,$less_id,$group_id,$student_id,2);
$active1 = WM_select_date_stud($date,$less_id,$group_id,$student_id);
$active2 = WM_select_date_stud($date,$less_id,$group_id,$student_id,3);
	if($active1 == true){
		if($active0 == false){
			if($active2 == false)
				$SQL = "DELETE FROM date WHERE date = '$date' AND less_id = $less_id AND group_id = $group_id AND student_id = $student_id";
			if($active2 == true)
				$SQL = "UPDATE date SET active = 0 WHERE date = '$date' AND less_id = $less_id AND group_id = $group_id AND student_id = $student_id";
		}
		if($active0 == true and $active2 == true and $notice == 1)
			$SQL = "DELETE FROM date WHERE date = '$date' AND less_id = $less_id AND group_id = $group_id AND student_id = $student_id";
		if($full == 'full')
			$SQL = "DELETE FROM date WHERE date = '$date' AND less_id = $less_id AND group_id = $group_id AND student_id = $student_id";
		mysql_query($SQL) or die(mysql_error());
	}
}
//function WM_add_pass($password){
	//$password = md5(md5($password));
	//$SQL = "INSElatT vre admin (password) VALUES('$password')";
	//mysql_query($SQL) or die(mysql_error());
//}
function WM_edit_pass($password){
	$password = md5(md5($password));
	$SQL = "UPDATE admin SET password = '$password'";
	mysql_query($SQL) or die(mysql_error());
}
function WM_admin($password){
	$password = md5(md5($password));
	$SQL = "SELECT password FROM admin WHERE password = '$password'";
		$result = mysql_query($SQL) or die(mysql_error());
		if(mysql_num_rows($result)==0){
			$res = false;
			return $res;
		}else{ 
			$res = true;
			return $res; 
		}
}
/*__________________________________==КОНЕЦ==__________________________________*/

 //--------------------------------------------------------\\
///---!                ФУНКЦИИ КАЛЕНДАРЯ               !---\\\

function WM_cal_today($month,$year) {
    if ($month == '12') {
    $month = 1;
    $year++;
    }
    else $month++;

    $today = date("d", mktime(0,0,0,$month,0,$year));
    return $today;
}

function WM_Calendar($month,$year,$day_set,$today,$column_width) {

$month=intval($month);

if ($month == 12) {
    $prev_month = $month - 1;
    $prev_year = $year;
    $next_month = 1;
    $next_year = $year + 1;
}
elseif ($month == 1) {
    $prev_month = 12;
    $prev_year = $year - 1;
    $next_month = $month + 1;
    $next_year = $year;
}
else {
    $prev_month = $month - 1;
    $prev_year = $year;
    $next_month = $month + 1;
    $next_year = $year;
}

$Month_Text['01'] = 'Январь';
$Month_Text['02'] = 'Февраль';
$Month_Text['03'] = 'Март';
$Month_Text['04'] = 'Апрель';
$Month_Text['05'] = 'Май';
$Month_Text['06'] = 'Июнь';
$Month_Text['07'] = 'Июль';
$Month_Text['08'] = 'Август';
$Month_Text['09'] = 'Сентябрь';
$Month_Text['10'] = 'Октябрь';
$Month_Text['11'] = 'Ноябрь';
$Month_Text['12'] = 'Декабрь';

$lm1 = date("t", mktime(0,0,0,$prev_month,1,$prev_year));
$nm1 = date("t", mktime(0,0,0,$next_month,1,$next_year));
$day_lm = $day_set;
$day_nm = $day_set;
if($day_lm > $lm1) $day_lm = $lm1;
if($day_nm > $nm1) $day_nm = $nm1;
if($month <= 9) $month = "0".$month;
if($prev_month <= 9) $prev_month = "0".$prev_month;
if($next_month <= 9) $next_month = "0".$next_month;
		$string = '<tr>' .
          '<td colspan="1" align="center"><font color="#666666"><a href="index.php?date='.$prev_year.'-'.$prev_month.'-'.$day_lm.'"><abbr title="'.$prev_year.'-'.$Month_Text[$prev_month].'"><<</abbr></a></font></td>' .
          '<td colspan="5" align="center"><font color="#666666"><b>'.$year.' г -  '.$Month_Text[$month].'</b></font></td>' .
          '<td colspan="1" align="center"><font color="#666666"><a href="index.php?date='.$next_year.'-'.$next_month.'-'.$day_nm.'"><abbr title="'.$next_year.'-'.$Month_Text[$next_month].'">>></abbr></a></td>' .
          '</tr>' .

          '<tr><td align="center"><font color="#666666"><b>Пн</b><height="1" width="'.$column_width.'" border="0" /></font></td>'."\n" .
          '<td align="center"><font color="#666666"><b>Вт</b><height="1" width="'.$column_width.'" border="0" /></font></td>'."\n" .
          '<td align="center"><font color="#666666"><b>Ср</b><height="1" width="'.$column_width.'" border="0" /></font></td>'."\n" .
          '<td align="center"><font color="#666666"><b>Чт</b><height="1" width="'.$column_width.'" border="0" /></font></td>'."\n" .
          '<td align="center"><font color="#666666"><b>Пт</b><height="1" width="'.$column_width.'" border="0" /></font></td>'."\n" .
          '<td align="center"><font color="#2D83E9"><b>Сб</b><height="1" width="'.$column_width.'" border="0" /></font></td>'."\n" .
          '<td align="center"><font color="#2D83E9"><b>Вс</b><height="1" width="'.$column_width.'" border="0" /></font></td></tr>'."\n" .
          '<tr>';
    $start = date("w",mktime(0,0,0,$month,1,$year)) - 1;
    if ($start == -1) $start = 6;
	$bg_color = "bg-color-blueLight";
	$lm = $lm1-$start;
	$i=0;
    while ($i<$start) {
	if($i == 5) $bg_color = "bg-color-blue";
	$lm++;
	$date = $prev_year."-".$prev_month."-".$lm;
	if(WM_is_date($date)) $string .= "<td><a href='index.php?date=".$date."' class='button cal_button ".$bg_color." fg-color-greenLight'  id='date_link'>$lm</a></td>";
	else $string .= "<td><a href='index.php?date=".$date."' class='button cal_button ".$bg_color." fg-color-greenLight'>$lm</a></td>";
	$i++;
	}

    $frame = $start - 1;

    for ($i=1; $i<=$today; $i++) {
        $day = mktime(0,0,0,date("m"),$i,date("Y"));
        $frame++;
		if($i <= 9) $dayz = "0".$i;
		else $dayz = $i;
		$date = $year."-".$month."-".$dayz;
		if($day_set == $i){
		$day_color = "bg-color-green";
		$weekend_color = $day_color;
		}elseif($i == date("d") and ($frame == 5 || $frame == 6)){
		$day_color = "bg-color-blue";
		$weekend_color = "bg-color-blue";
		}else{
		$day_color = "bg-color-blueLight";
		$weekend_color = "bg-color-blue";
		}
        if($frame > 6) {
            $string .= "</tr>\n";
            if($i < $today) $string .= '<tr>';
            $frame = 0;
        }

        if($month == date("m", $day) && $year == date("Y", $day) && date("d") == date("d", $day)) {
			if(WM_is_date($date)){
				$string .= "<td align=\"center\">" .
							"<a href='index.php?date=".$date."' class='button cal_button ".$day_color." today' id='date_link'>$i</a></td>";
			}else{
				$string .= "<td align=\"center\">" .
							"<a href='index.php?date=".$date."' class='button cal_button ".$day_color." today'>$i</a></td>";
			}
            continue;
        }

        if ($frame == 5 || $frame == 6) {
			if(WM_is_date($date)){
				$string .= "<td align=\"center\">" .
							"<a href='index.php?date=".$date."' class='button cal_button ".$weekend_color."' id='date_link'>$i</a></td>";
			}else{
				$string .= "<td align=\"center\">" .
							"<a href='index.php?date=".$date."' class='button cal_button ".$weekend_color."'>$i</a></td>";
			}
        }

        else {
			if(WM_is_date($date)){
				$string .= "<td align=\"center\">" .
							"<a href='index.php?date=".$date."' class='button cal_button ".$day_color."' id='date_link'>$i</a></td>";
			}else{
				$string .= "<td align=\"center\">" .
							"<a href='index.php?date=".$date."' class='button cal_button ".$day_color."'>$i</a></td>";
			}
        }
    }
	
	$bg_color = "bg-color-blueLight";
    for ($i=1; $frame < 6; $frame++) {
	$d = "0".$i;
	$date = $next_year."-".$next_month."-".$d;
	if($frame == 4 or $frame == 5) $bg_color = "bg-color-blue";
	if(WM_is_date($date)) $string .= "<td><a href='index.php?date=".$date."' id='date_link' class='button cal_button ".$bg_color." fg-color-greenLight'>$i</a></td>";
	else $string .= "<td><a href='index.php?date=".$date."' class='button cal_button ".$bg_color." fg-color-greenLight''>$i</a></td>";	
	$i++;
	}

    if ($frame < 6) $string .= "</tr>";
    return $string;
}

function WM_write_exel($date,$less_id,$group_id,$download = 0){
require_once WM_ENGINE_DIR."/classes/class.writeexcel_workbook.inc.php";
require_once WM_ENGINE_DIR."/classes/class.writeexcel_worksheet.inc.php";

if($download == 0){
$resault = WM_select_lession($less_id);
$less = $resault[0]['less'];
$resault = WM_select_group($group_id);
$group = $resault[0]['group'];
$resault = WM_select_students($group_id);
$students = $resault;
$fname = tempnam("/exel/$date", "$date_$less_$group.xls");
$workbook = new writeexcel_workbook($fname);
$worksheet = $workbook->addworksheet('Журнал');
$i = 1;
foreach($students as $student){
	$a = WM_select_date_stud($date,$less_id,$group_id,$student['id']);
	$b = WM_select_date_stud($date,$less_id,$group_id,$student['id'],2);
	$notice = WM_select_date_notice($date,$less_id,$group_id,$student['id']);
	$notice = $notice[0]['notice'];
	if($a and $b) $data = false;
	if($a and !$b) $data = true;
	if(!$a and !$b) $data = false;
	$A = "A".$i;
	$B = "B".$i;
	$C = "C".$i;
	$worksheet->write($A, $student['student']);
	if($data) $worksheet->write($B, "+");
	else $worksheet->write($B, "-");
	$worksheet->write($C, $notice);
	$i++;
}

$workbook->close();
}
if($download == 1){
header("Content-Type: application/x-msexcel; name=\"$date_$less_$group.xls\"");
header("Content-Disposition: inline; filename=\"$date_$less_$group.xls\"");
$fname = tempnam("/exel/$date", "$date_$less_$group.xls");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
}
}
?>