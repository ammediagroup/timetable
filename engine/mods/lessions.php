<?PHP
/**
===================================
Файл: lessions.php
-----------------------------------------------------
Версия: 1.0v
-----------------------------------------------------
Назначение: Предметы
-----------------------------------------------------
Автор: Гузун Дмитрий Витальевич
===================================
**/


if (! defined ( 'WEB_MODER' )) {
	die ( "<P>Доступ к файлу заблакирован!<P>Возможно вы пытаетесь запустить его на прямую" );
}

if ($_GET['func'] == 'delete' and $_GET['id']){
	if($_POST){
	$chek = WM_admin($_POST['pass']);
		if($chek){
			WM_delete_less($_GET['id']);
			echo "Удалено";
		}
		else{
			echo "Неверный Пароль";
		}
	}
	echo "<a href='index.php?mod=lessions'><-назад</a>";
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
}
	

elseif ($_GET['func'] == 'add'){
	if($_POST){
		$less = $_POST['less'];
		WM_add_less($less);
	}
	echo "
		<h1><span class='icon-plus-2 fg-color-green'></span> Добавление Предмета</h1>
		<form action='index.php?mod=lessions&func=add' method='POST'>
		<h2>Название предмета</h2>
		<div class='input-control text'>
        <input type='text' name='less' class='with-helper' placeholder='Название предмета'/>
        <button class='helper'></button>
		</div>
		<input type='submit' value='Сохранить'/>
		<input type='reset'  value='Сбросить'/>
		</form>
	";
}
elseif ($_GET['func'] == 'edit' and $_GET['id']) {
	if($_POST){
		$id = $_GET['id'];
		$less = $_POST['less'];
		WM_edit_less($id,$less);
	}
	$resault = WM_select_lession($_GET['id']);
	$less = $resault[0];
	echo "
		<h1><span class='icon-pencil fg-color-blue'></span> Редактирование Предмета</h1>
		<form action='index.php?mod=lessions&func=edit&id=".$_GET['id']."' method='POST'>
		<h2>Группа</h2>
		<div class='input-control text'>
        <input type='text' name='less' class='with-helper' placeholder='".$less['less']."' value='".$less['less']."'/>
        <button class='helper'></button>
		</div>
    <input type='submit' value='Сохранить'/>
    <input type='reset'  value='Сбросить'/>
	</form>";
}
else
{
	echo "<h1><span class='icon-cube'></span> Предметы</h1>";
$resault = WM_select_lessions();
echo "<ul class='listview fluid'>";	
foreach($resault as $value){
	echo "<li>
                            <div class='icon'>
                                <span class='icon-cube' ></span>
                            </div>

                            <div class='data'>
                                <h4>".$value['less']."</h4>
                                <div style='float: right'>
                                    <a href='index.php?mod=lessions&func=edit&id=".$value['id']."'><span class='icon-pencil' ></span></a>
                                    <a href='index.php?mod=lessions&func=delete&id=".$value['id']."'><span class='icon-cancel-2' style='color:red' ></span></a>
                                </div></div>
                        </li>
";
}
echo "</ul>";	
	


}
?>