<?php
	session_start();  //↓取得使用者語系
	$_SESSION['BrowerDisplayLanguage'] = str_replace( '-' , '_' , strtolower(strtok(strip_tags( $_SERVER['HTTP_ACCEPT_LANGUAGE']), ',')));
	$PHPFunListDirPath = '/PHPFunList/PHPFunList.php';  //PHPFunction 檔案放置位置
	if ( file_exists( __DIR__.$PHPFunListDirPath ))  //本層資料夾路徑
	{
		require_once __DIR__.$PHPFunListDirPath ;
		PHPFunList();
	}elseif ( file_exists( dirname(__DIR__).$PHPFunListDirPath )){  //上層資料夾路徑
		require_once dirname(__DIR__).$PHPFunListDirPath;
		PHPFunList();
	}
	require_once 'PDOConnectionDB.php';  //連結資料庫
	//echo phpinfo();
	//$SelectItem_Array = Array( 'V:1D:病假' , 'V:2D:事假' , 'V:3D:生理假' , 'V:4D:喪假' );
	$SelectItem_Array = Array( 'test1' , 'test2' , 'test3' );
	$SelectItem_Arr = Array(  'Tags_Div' , Null , 'class=Divitem Box'  , 'Tags_Select' , $SelectItem_Array , 'type=text' , 'name=item' , 'required' );
	$AccountInput_Arr = Array(  'Tags_Div' , Null , 'class=DivAccount Box'  , 'Tag_Input' , Null , 'type=text' , 'name=Account' ,  'placeholder=Account' , 'required' );
	$PasswordInput_Arr = Array( 'Tags_Div' , Null , 'class=DivPassword Box' , 'Tag_Input' , Null , 'type=password' , 'name=Password' ,  'placeholder=Password' , 'autocomplete=off' , 'required' );
	$LoginButton_Arr = Array( 'Tags_Div' , Null  , 'class=DivLogin Box' , 'Tags_Button' , 'Login' , 'type=submit' , 'class=LoginButton' ); // , 'class=Login' , 'onclick=test()'
	$LoginPicture_Arr = Array(  'Tags_Div' ,PrintHtmlLanguageArray_Fun( Array( $SelectItem_Arr , $LoginButton_Arr , $PasswordInput_Arr , $AccountInput_Arr ) ), 'class=Loginitem Box' );
	$LoginForm_Arr = Array( 'Tags_Form' , Null , 'class=Login_Form' , 'method=post' , 'onsubmit' );   //插入表單
	$CreateAccount_Arr = Array( 'Tags_Div' , Null , 'class=Loginitem Box' , 'Tags_A' , 'Sign Up' , 'href=http://www.google.com.tw' );
	$LoginPicture_Array = Array( $CreateAccount_Arr , $LoginPicture_Arr , $LoginForm_Arr );
	$LoginPicture_Str = PrintHtmlLanguageArray_Fun( $LoginPicture_Array );//	
	$LoginPicture2 = Array( 'Tags_Div' , $LoginPicture_Str , 'class=LoginPicture2' );
	$BodyHtmlFormt_Str = PrintHtmlLanguageArray_Fun( $LoginPicture2 );//
	echo ExportHtmlPage_Fun( $BodyHtmlFormt_Str );  //輸出Html字串Page  "NoLoginPicture"
?>
