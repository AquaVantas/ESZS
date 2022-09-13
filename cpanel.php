<!DOCTYPE html>
<?php
	session_start();
	$cpanel_tab = $_GET['tab'];
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link rel="stylesheet" href="Style/Master.css">
	</head>
	<body>
		<div class="cpanel-navigation-wrapper">
			<div class="right-side">
				<div class="logo-wrapper">
					<div class="">
						EŠZS CPanel
					</div>
				</div>
				<div class="navigation-links">
					<a href="?tab=webpage_editor" class="nav-link <?php if($cpanel_tab == "webpage_editor"){echo "active"; } ?>">Spletna stran</a>
					<a href="?tab=news_editor">Novice</a>
					<a href="?tab=tournaments">Tekmovanja</a>
				</div>
			</div>
			<div class="left-side">
			</div>
		</div>
	</body>
	<footer>
	</footer>
</html>