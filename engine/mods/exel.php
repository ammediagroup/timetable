<?PHP
/**
===================================
����: journal.php
-----------------------------------------------------
������: 1.1v
-----------------------------------------------------
����������: ������ ����������
-----------------------------------------------------
�����: ����� ������� ����������
===================================
**/


if (! defined ( 'WEB_MODER' )) {
	die ( "<P style='color: red'>������ � ����� ������������!<P>�������� �� ��������� ��������� ��� �� ������" );
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
//���������� �������
if(1 == 1){
	$excel=new ExcelWriter("myXls.xls");
	
	if($excel==false)	
		echo $excel->error;
		
	$myArr=array("Name","Last Name","Address","Age");
	$excel->writeLine($myArr);

	$myArr=array("�������","Pandit","23 mayur vihar",19);
	$excel->writeLine($myArr);
	
	$excel->writeRow();
	$excel->writeCol("Manoj");
	$excel->writeCol("Tiwari");
	$excel->writeCol("80 Preet Vihar");
	$excel->writeCol(24);
	
	$excel->writeRow();
	$excel->writeCol("Harish");
	$excel->writeCol("Chauhan");
	$excel->writeCol("115 Shyam Park Main");
	$excel->writeCol(22);

	$myArr=array("Tapan","Chauhan","1st Floor Vasundhra",25);
	$excel->writeLine($myArr);
	
	$excel->close();
	echo "data is write into myXls.xls Successfully.";
}

?>
	