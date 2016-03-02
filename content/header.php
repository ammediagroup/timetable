<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">

    <link href="content/css/modern.css" rel="stylesheet">
    <link href="content/css/modern-responsive.css" rel="stylesheet">
    <link href="content/css/site.css" rel="stylesheet" type="text/css">
    <link href="content/css/WM_mod.css" rel="stylesheet" type="text/css">
    <link href="content/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="content/styles/nyroModal.css" type="text/css" media="screen" />
	
    <script type="text/javascript" src="content/js/assets/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="content/js/assets/jquery.mousewheel.min.js"></script>

    <script type="text/javascript" src="content/js/modern/dropdown.js"></script>
    <script type="text/javascript" src="content/js/modern/accordion.js"></script>
    <script type="text/javascript" src="content/js/modern/buttonset.js"></script>
    <script type="text/javascript" src="content/js/modern/carousel.js"></script>
    <script type="text/javascript" src="content/js/modern/input-control.js"></script>
    <script type="text/javascript" src="content/js/modern/pagecontrol.js"></script>
	<script type="text/javascript" src="content/js/jquery.nyroModal.custom.js"></script>

    <title>Журнал</title>
</head>
<body class="modern-ui" onload="prettyPrint()">
        
<?PHP
if(!$_GET['modal']){
?>
 <div class="page [secondary] with-sidebar">
<div class="page-sidebar">
            <ul>
                <li class="sticker sticker-color-orange dropdown">
					<a href="index.php">
					<i class="icon-address-book"></i> Журнал</a></li>
                <li class="sticker sticker-color-orangeDark" data-role="dropdown">
					<a href="?mod=students">
					<i class="icon-user-3"></i> Студенты</a>
						<ul class="sub-menu light sidebar-dropdown-menu <?if($_GET['mod'] == 'students') echo "open"?>">
                        <li><a  class="icon-clipboard" href="?mod=students" style="text-align: left"> Список</a></li>
                        <li><a class="icon-plus-2" href="?mod=students&func=add" style="text-align: left"> Добавление</a></li>
                    </ul>
				</li>
                <li class="sticker sticker-color-green dropdown " data-role="dropdown"
				><a href="?mod=groups">
				<i class="icon-folder"></i> Группы</a>
						<ul class="sub-menu light sidebar-dropdown-menu <?if($_GET['mod'] == 'groups') echo "open"?>">
                        <li><a  class="icon-clipboard" href="?mod=groups" style="text-align: left"> Список</a></li>
                        <li><a class="icon-plus-2" href="?mod=groups&func=add" style="text-align: left"> Добавление</a></li>
                    </ul>
				</li>
                <li class="sticker sticker-color-pink dropdown active" data-role="dropdown">
                    <a href="?mod=lessions">
					<i class="icon-cube"></i> Предметы</a>
                    <ul class="sub-menu light sidebar-dropdown-menu <?if($_GET['mod'] == 'lessions') echo "open"?>">
                        <li><a  class="icon-clipboard" href="?mod=lessions" style="text-align: left"> Список</a></li>
                        <li><a class="icon-plus-2" href="?mod=lessions&func=add" style="text-align: left"> Добавление</a></li>
                    </ul>
                </li>
            </ul>
        </div>
<div class="page-region" style='padding:20px'>
<?WM_content();?>
</div>
</div>
<?PHP
}
else
{
WM_content();
}
?>
