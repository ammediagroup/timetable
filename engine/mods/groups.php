<?PHP
/**
===================================
����: groups.php
-----------------------------------------------------
������: 1.0v
-----------------------------------------------------
����������: ������
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
			WM_delete_group($_GET['id']);
			echo "�������";
		}
		else{
			echo "�������� ������";
		}
	}
	echo "<a href='index.php?mod=groups'><-�����</a>";
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
		$group = $_POST['group'];
		WM_add_group($group);
	}
	echo "
		<h1><span class='icon-plus-2 fg-color-green'></span> ���������� ������</h1>
		<form action='index.php?mod=groups&func=add' method='POST'>
		<h2>�������� ������</h2>
		<div class='input-control text'>
        <input type='text' name='group' class='with-helper' placeholder='�������� ������'/>
        <button class='helper'></button>
		</div>
		<input type='submit' value='���������'/>
		<input type='reset'  value='��������'/>
		</form>
	";
}
elseif ($_GET['func'] == 'edit' and $_GET['id']) {
	if($_POST){
		$id = $_GET['id'];
		$group = $_POST['group'];
		WM_edit_group($id,$group);
	}
	$resault = WM_select_group($_GET['id']);
	$group = $resault[0];
	echo "
		<h1><span class='icon-pencil fg-color-blue'></span> �������������� ������</h1>
		<form action='index.php?mod=groups&func=edit&id=".$_GET['id']."' method='POST'>
		<h2>������</h2>
		<div class='input-control text'>
        <input type='text' name='group' class='with-helper' placeholder='".$group['group']."'/>
        <button class='helper'></button>
		</div>
    <input type='submit' value='���������'/>
    <input type='reset'  value='��������'/>
	</form>";
}
elseif ($_GET['func'] == 'open' and $_GET['id']){
	$resault = WM_select_group($_GET['id']);
	$group = $resault[0];
	echo "<h1><span class='icon-folder'></span> ".$group['group']."</h1>
	<table class='bordered'><thead>";
	echo "<tr>";
	echo "<th class='right'>���</th>";
	echo "<th class='right'>������</th>";
	echo "<th class='right'>�������</th>";
	echo "<th class='right'>���������</th>";
	echo "</tr></thead>";
	echo "<tbody>";
	$a = WM_select_students($_GET['id']);
	foreach($a as $value){
		echo "<tr><td>".$value['student']."</td>";
		echo "<td>".$value['group']."</td>";
		echo "<td>".$value['comment']."</td>";
		echo "<td>
		<a href='index.php?mod=students&func=edit&id=".$value['id']."'><span class='icon-pencil'></span></a>
		<a href='index.php?mod=students&func=delete&id=".$value['id']."'><span class='icon-cancel-2' style='color:red'></span></a>		
		</td></tr>";
	}
	echo "</tbody>";
	echo "</table>";
}
else
{
	echo "<h1><span class='icon-folder'></span> ������</h1>";
	
$resault = WM_select_groups();
echo "<ul class='listview fluid'>";	
foreach($resault as $value){
	echo "<a href='index.php?mod=groups&func=open&id=".$value['id']."'> 

<li>
                            <div class='icon'>
                                <span class='icon-folder' ></span>
                            </div>

                            <div class='data'>
                                <h4>".$value['group']."</h4>
                                <div style='float: right'>
                                    <a href='index.php?mod=groups&func=edit&id=".$value['id']."'><span class='icon-pencil' ></span></a>
                                    <a href='index.php?mod=groups&func=delete&id=".$value['id']."'><span class='icon-cancel-2' style='color:red' ></span></a>
                                </div>";
$a = WM_select_students($value['id']);
$num_rows = 0;
foreach($a as $value){
		$num_rows++;
	}
if($num_rows >= 0){
	switch($num_rows){
		case 1 : $num = $num_rows." - �������";
			break;
		case 2 : $num = $num_rows." - ��������";
			break;
		case 3 : $num = $num_rows." - ��������";
			break;
		case 4 : $num = $num_rows." - ��������";
			break;
		default:  $num = $num_rows." - ���������";
	}
echo $num;
}
echo	"</div>
                        </li>
</a>";
}
echo "</ul>";	
	
	


}
?>