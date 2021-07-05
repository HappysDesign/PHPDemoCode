<?php
	$DatabaseHost = '172.17.0.2';
	//資料庫名稱
	global $Database;
	$Database = 'Demo';
	$Dsn = 'mysql:dbname='.$Database.';host='.$DatabaseHost.';charset=utf8';
	//改成你登入phpmyadmin帳號
	$DBUser = 'root';
	//改成你登入phpmyadmin密碼
	$DBPassword = 'P@ssw0rd';
	//實例化mysqli(資料庫路徑, 登入帳號, 登入密碼, 資料庫)
	global $PDOConnectDatabase;
	
	try {
		$PDOConnectDatabase = new PDO( $Dsn , $DBUser, $DBPassword );
		$PDOConnectDatabase -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	} catch ( PDOException $e ) {
		echo 'Connection failed: ' . $e -> getMessage();
	}
	
	try {
		$PDOConnectDatabase = new PDO( $Dsn , $DBUser, $DBPassword , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) );
	} catch ( PDOException $e ) {
		echo 'Connection failed: ' . $e -> getMessage();
		exit;
	}
?>