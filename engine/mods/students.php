<?PHP
/**
===================================
����: students.php
-----------------------------------------------------
������: 1.0v
-----------------------------------------------------
����������: ��������
-----------------------------------------------------
�����: ����� ������� ����������
===================================
**/


if (! defined ( 'WEB_MODER' )) {
	die ( "<P>������ � ����� ������������!<P>�������� �� ��������� ��������� ��� �� ������" );
}

if ($_GET['func'] == 'delete' and $_GET['id']){
if($_POST){
	$chek = WM_admin($_POST['pass']);
		if($chek){
			WM_delete_student($_GET['id']);
			echo "�������";
		}
		else{
			echo "�������� ������";
		}
	}
	echo "<a href='index.php?mod=students'><-�����</a>";
	echo " <form avtion='".$_SERVER['REQUEST_URI']."' method='POST'>
<h2>������</h2>
<div class='input-control password'>
<input type='password' name='pass' class='with-helper' placeholder='������� ������'/>
<button class='helper'></button>
</div>
<hr>
		<input type='submit' value='���������'/>
</form>
";
}
elseif ($_GET['func'] == 'add'){
	if($_POST){
		$name = $_POST['name'];
		$group_id = $_POST['group_id'];
		$comment = $_POST['comment'];
		WM_add_student($name,$group_id,$comment);
	}
	$resault1 = WM_select_groups();
	$groups  = $resault1;
	echo "
		<h1><span class='icon-plus-2 fg-color-green'></span> ���������� ��������</h1>
		<form action='index.php?mod=students&func=add' method='POST'>
		<h2>�.�.�</h2>
		<div class='input-control text'>
        <input type='text' name='name' class='with-helper' placeholder='������� ���'/>
        <button class='helper'></button>
		</div>
		<h2>������</h2>
		<div class='input-control select'>
		<select name='group_id'>
			<option value='0'>�������� ������</option>";
	foreach ($groups as $group){
		echo "<option value='".$group['id']."' >".$group['group']."</option>";
	}
	echo "
		</div></select>
		<h2>�����������</h2>
		<div class='input-control textarea'>
<textarea name='comment'>
</textarea>
		</div>
		<input type='submit' value='���������'/>
		<input type='reset'  value='��������'/>
		</form>
	";
}
elseif ($_GET['func'] == 'edit' and $_GET['id']) {
	$resault = WM_select_student($_GET['id']);
	$student1 = $resault[0];
	if($_POST){
		$id = $_GET['id'];
		if($_POST['name'] == NULL){
		$name = $student1['student'];
		}
		else
		{
		$name = $_POST['name'];
		}
		$group_id = $_POST['group_id'];
		$comment = $_POST['comment'];
		WM_edit_student($id,$name,$group_id,$comment);
	}
	$resault = WM_select_student($_GET['id']);
	$student = $resault[0];
	$resault1 = WM_select_groups();
	$groups  = $resault1;
	echo "
		<h1><span class='icon-pencil fg-color-blue'></span> �������������� ��������</h1>";
	if($name != null) echo "<h2 class='fg-color-green'>������ ������� ���������������</h2>";
	echo	"<form action='index.php?mod=students&func=edit&id=".$_GET['id']."' method='POST'>
		<h2>�.�.�</h2>
		<div class='input-control text'>
        <input type='text' name='name' class='with-helper' placeholder='".$student['student']."' value='".$student['student']."'/>
        <button class='helper'></button>
		</div>
		<h2>������</h2>
		<div class='input-control select'>
		<select name='group_id'>
			<option value='0'>�������� ������</option>";
	foreach ($groups as $group){
		if($student['group_id'] == $group['id'])
		echo "<option value='".$group['id']."' selected>".$group['group']."</option>";
		else
		echo "<option value='".$group['id']."' >".$group['group']."</option>";
	}
	echo "</div></select>
	<h2>�����������</h2>
	<div class='input-control textarea'>
<textarea name='comment'>".$student['comment']."</textarea>
    </div>
    <input type='submit' value='���������'/>
    <input type='reset'  value='��������'/>
	</form>";
}
else
{
	echo "<h1><span class='icon-user-3'></span> ��������</h1>
	<table class='bordered'><thead>";
	echo "<tr>";
	echo "<th class='right'>���</th>";
	echo "<th class='right'>������</th>";
	echo "<th class='right'>�������</th>";
	echo "<th class='right'>���������</th>";
	echo "</tr></thead>";
	echo "<tbody>";
	$a = WM_select_students();
	foreach($a as $value){
	if($value['group_id'] != 0){
	$group = WM_select_group($value['group_id']);
	$group = $group[0];
	}else{
	$group['group'] = '-';
	}
		echo "<tr><td>".$value['student']."</td>";
		echo "<td>".$group['group']."</td>";
		echo "<td>".$value['comment']."</td>";
		echo "<td>
		<a href='index.php?mod=students&func=edit&id=".$value['id']."'><span class='icon-pencil'></span></a>
		<a href='index.php?mod=students&func=delete&id=".$value['id']."'><span class='icon-cancel-2' style='color:red'></span></a>		
		</td></tr>";
	}
	echo "</tbody>";
	echo "</table>";
}
?>