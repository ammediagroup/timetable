<?php
$checked = "";
if($_POST){
	if($_POST['foo'] == 'on')
		$checked = 'checked="on"';
	echo $_POST['blabla8'];
	echo $_POST['foo'];
}
?>
<form name="ch" action="check.php" method="POST"> 
<input name="blabla" type="text">
<input name="foo" type=checkbox onClick="submit();" <?=$checked?>>
</form>