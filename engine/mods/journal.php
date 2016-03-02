<?PHP
/**
===================================
Файл: journal.php
-----------------------------------------------------
Версия: 1.1v
-----------------------------------------------------
Назначение: Журнал добавление
-----------------------------------------------------
Автор: Гузун Дмитрий Витальевич
===================================
**/


if (! defined ( 'WEB_MODER' )) {
	die ( "<P style='color: red'>Доступ к файлу заблакирован!<P>Возможно вы пытаетесь запустить его на прямую" );
}
	if($_GET[date] != NULL){
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
	$dayz = mktime(0,0,0,date("m"),date("d"),date("Y"));
	$dayw = mktime(0,0,0,$month,$day,$year);
//Добавление журнала
if($_GET['date'] and $_GET['modal'] == 'ajax'){
If($_GET['func'] == 'add' and $_GET['less'] == NULL){
	echo "<h1>Выберите предмет</h1>";
	$resault = WM_select_lessions();
echo "<ul class='listview fluid'>";	
foreach($resault as $value){
	echo "<a href='index.php?mod=journal&modal=ajax&func=add&date=$date&less=".$value['id']."'> <li>";
	echo "
                            <div class='icon'>
                                <span class='icon-cube fg-color-blue' ></span>
                            </div>

                            <div class='data'>
                                <h4>".$value['less']."</h4>
                                <div style='float: right'>
                                </div>
                            </div>
                        </li></a>
";
}
echo "</ul>";	

}
If($_GET['func'] == 'add' and $_GET['less'] != NULL and $_GET['group'] == NULL){
	
	echo "<h1>Выберите группу</h1>";
	$resault = WM_select_groups();
echo "<ul class='listview fluid'>";	
foreach($resault as $value){
$num = WM_numrow_students($value['id']);
if($num == 0) continue;
switch($num){
	case 1: $num = $num." студент";break;
	case 2: $num = $num." студента";break;
	case 3: $num = $num." студента";break;
	case 4: $num = $num." студента";break;
	default: $num = $num." студентов";
}
	echo "<a href='index.php?mod=journal&modal=ajax&func=add&date=$date&less=".$_GET['less']."&group=".$value['id']."'> <li>";
	echo "
                            <div class='icon'>
                                <span class='icon-cube fg-color-blue' ></span>
                            </div>

                            <div class='data'>
                                <h4>".$value['group']."</h4>
                                <p>$num</p><div style='float: right'>
                                </div>
                            </div>
                        </li></a>
";
}

echo "</ul>";	
}
if($_GET['less'] != NULL and $_GET['group'] != NULL){
	$less_id = $_GET['less'];
	$group_id = $_GET['group'];
	WM_add_journal($date,$less_id,$group_id);
echo "
<blockquote style='border-left: 4px green solid'><h3 class='fg-color-green'>Журнал успешно добавлен</h3></blockquote>
";
}
}

?>