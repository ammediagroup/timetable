<?PHP
/**
===================================
Файл: main.php
-----------------------------------------------------
Версия: 1.1v
-----------------------------------------------------
Назначение: Журнал
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
if($_GET['pass'] == 'add'){
	if($_POST){
	$chek = WM_admin($_POST['pass1']);
		if($chek){
			WM_edit_pass($_POST['pass2']);
			echo "Пароль успешно изменен";
		}
		else{
			echo "Введеный пароль не верен";
		}
	}
echo " <form avtion='".$_SERVER['REQUEST_URI']."' method='POST'>
<h2>Старый пароль</h2>
<div class='input-control password'>
<input type='password' name='pass1' class='with-helper' placeholder='Введите старый пароль'/>
<button class='helper'></button>
</div>
<h2>Новый пароль</h2>
<div class='input-control password'>
<input type='password' name='pass2' class='with-helper' placeholder='Введите новый пароль'/>
<button class='helper'></button>
</div>
<hr>
		<input type='submit' value='Сохранить'/>
		<input type='reset'  value='Сбросить'/>
</form>
";
}
if($_GET['less'] != null and $_GET['group'] != null){
	if($_GET['func'] == 'delete'){
		if($_POST){
	$chek = WM_admin($_POST['pass']);
		if($chek){
			WM_delete_journal($date,$_GET['less'],$_GET['group']);
			echo "Удалено";
		}
		else{
			echo "Неверный Пароль";
		}
	}
	echo "<a href='index.php'><-назад</a>";
	echo " <form avtion='".$_SERVER['REQUEST_URI']."' method='POST'>
<h2>Пароль</h2>
<div class='input-control password'>
<input type='password' name='pass' class='with-helper' placeholder='Введите пароль'/>
<button class='helper'></button>
</div>
<hr>
		<input type='submit' value='Отправить'/>
</form>
";
		
	}else{
	$less_id = $_GET['less'];
	$group_id = $_GET['group'];
	$resault = WM_select_date($date,$less_id,$group_id);
	$res = $resault[0];
	$resault = WM_select_lession($less_id);
	$less = $resault[0];
	$resault = WM_select_group($group_id);
	$group = $resault[0];
	
	$students = WM_select_students($_GET['group']);
		if($_GET['modal'] == null){
	echo "
    <div class='toolbar' style='height: 40px; position: realative' align='right'>
        <a class='bg-color-white' href='index.php?mod=exel&date=$date&less=$less_id&group=$group_id'><i class='fg-color-red icon-file-excel'></i></a>
        <a class='bg-color-white' href='index.php?date=$date&less=$less_id&group=$group_id&modal=1'><i class='fg-color-red icon-printer'></i></a>
        <a class='bg-color-white'  href='index.php?mod=main&func=delete&date=$date&less=$less_id&group=$group_id'><i class='fg-color-red icon-cancel-2'></i></a>
    </div>";
	}else{
		echo "
    <div class='toolbar' style='height: 40px; position: realative' align='right'>
        <a class='bg-color-white' onclick='javascript:window.print()'><i class='fg-color-red icon-printer'></i></a>
    </div>";
	}
	echo "<table class='bordered'><thead>";
	echo "<tr>";
	echo "<th colspan='3' class='right'>$date / $less[less] / $group[group]</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th class='right'>Имя</th>";
	echo "<th class='right'></th>";
	echo "<th class='right'>Заметка</th>";
	echo "</tr></thead>";
	echo "<tbody>";
	foreach($students as $student){
	$a = WM_select_date_stud($date,$less_id,$group_id,$student['id']);
	$b = WM_select_date_stud($date,$less_id,$group_id,$student['id'],2);
	if($a and $b) $data = false;
	if($a and !$b) $data = true;
	if(!$a and !$b) $data = false;
		echo "<tr height='40px'><td>".$student['student']."-".$student['id']."</td>";

		echo "<td width='40px'><form action='".$_SERVER['REQUEST_URI']."' method='POST'>
		<input type='text' name='student_idd' value='".$student['id']."' style='position:absolute;left:-500px;z-index:-99'>";
		if($_GET['modal'] == null) echo "<label class='input-control switch' onclick=''>";
         if($data){
			if($_GET['modal'] == null) echo "<input type='checkbox' name='check' checked='' onClick='submit();'/>";
			else echo "<font size='5'>+</font>";
		}else{
			if($_GET['modal'] == null) echo "<input type='checkbox' name='check' onClick='submit();'/>";
			else echo "<font size='5'>-</font>";
		}
        if($_GET['modal'] == null) echo "<span class='helper'></span></label>";
		echo						"</form></td>";
		echo "<td width='30%'></td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	}
}

if($_GET['journal'] == NULL and $_GET['less'] == null and $_GET['group'] == null){

	if($_GET['modal'] == null)	echo "<h1><span class='icon-address-book'></span>Журнал</h1>";
if($_GET['func'] == null){
if($_GET['modal'] == null){
	if($dayw >=$dayz and $_GET['less'] == NULL)
	echo "<a href='".$_SERVER['PHP_SELF']."?mod=journal&modal=ajax&func=add&date=$date' target='_blank' class='nyroModal'><span class='icon-plus-2 fg-color-green' style='position: absolute;right: 0px; top: 50px'>".$date."</span></a>";
	echo "<script type=\"text/javascript\">
	$(function() {
	$('.nyroModal').nyroModal();
	$.nmObj({
	sizes: {	// Size information
    initW: 850,	// Initial width
    initH: 850,	// Initial height
    w: 800,		// width
    h: 800,		// height
    minW: 700,	// minimum width
    minH: 700,	// minimum height
    wMargin: 0,	// Horizontal margin
    hMargin: 0	// Vertical margin
  }
	});
	});
	</script>";
    echo "<table class='cal_table' cellpadding='0' cellspacing='0' border='0' align='center' style='margin-top:5px; margin-bottom:10px; '>";


$day_number = WM_cal_today($month,$year);
print $mid_html = WM_Calendar($month, $year, $day, $day_number, $column_width);


	echo "</table><br><br><br>";
	
	echo "<span>Добавленные  <a href='index.php?pass=add'>.</a></span>
			<hr>";
			}

	if(WM_is_date($date)){
		if($_GET['less'] == NULL){
			$resault = WM_select_journal($date);
			//echo "<span style='position: absolute;right: 0px; top: 50px'>".$date."</span>";
			echo "<ul class='listview fluid'>";	
			foreach($resault as $value){
				echo "<a href='index.php?date=$date&less=".$value['less_id']."&group=".$value['group_id']."'><li>";
				echo "
                            <div class='icon'>
                                <span class='icon-cube fg-color-blue' ></span>
                            </div>

                            <div class='data'>
                                <h4>".$value['less']."</h4>
									<p>".$value['group']."</p>
                                <div style='float: right'>";
				echo "<a href='index.php?date=$date&less=".$value['less_id']."&group=".$value['group_id']."' class='button' style='background-color: #008287;color: white'>Выбрать</a>
				<a href='".$_SERVER['PHP_SELF']."?mod=main&func=delete&date=$date&less=".$value['less_id']."&group=".$value['group_id']."'><span class='icon-cancel-2' style='color:red' ></span></a>";														
				echo	"          </div>
                            </div>
                        </li></a>
					";
			}
			echo "</ul>";	
		}
	}else{
	echo "Данные отсутствуют!";
	}	
}
}
?>