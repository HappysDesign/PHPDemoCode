<?php
	function PHPFunList( $FunctionFolderName = Null ){
		require_once $FunctionFolderName . 'ReplaceString_Fun.php';  //指定字串替換;
		require_once $FunctionFolderName . 'SegmentationString_Fun.php';  //分割字串存入陣列
		require_once $FunctionFolderName . 'FindString_Fun.php';  //找尋特定文字
		require_once $FunctionFolderName . 'DisplayLanguage_Fun.php';  //翻譯文字;
		require_once $FunctionFolderName . 'PrintHtmlLanguageArray_Fun.php';  //取得所有人員與部門資料;
		require_once $FunctionFolderName . 'ExportHtmlPage_Fun.php';  //輸出HtmPage;
	}
	
?>