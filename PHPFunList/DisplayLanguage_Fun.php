<?php
	function DisplayLanguage_Fun( $DisplayString ){
		//echo 'DisplayString Fun = '. $DisplayString . "<br>";
		//echo "DisplayLanguage_Fun = " . htmlentities( $DisplayString ) . "<br>";  //不刪除  除錯用 HtmlLangValue
		if ( !isset ( $_SESSION['BrowerDisplayLanguage'] ) ){
			echo 'SESSION (BrowerDisplayLanguage) 未啟用<br>';
		}
		//禁用錯誤報告
		//error_reporting(0);
		//報告運行時錯誤
		//error_reporting(E_ERROR | E_WARNING | E_PARSE);
		//報告所有錯誤
		//error_reporting(E_ALL);
		//echo "Display DisplayString = " . htmlentities( $DisplayString ) . "<br>";  //不刪除  除錯用 HtmlLangValue
		if ( isset ($_SESSION['BrowerDisplayLanguage'] ) ){
			if ( strcasecmp( $_SESSION['BrowerDisplayLanguage'] ,'en_us' ) == 0 ) {
				$DisplayLanguage  = $DisplayString;
			} else {
				$SelectCMD = "SELECT " . $_SESSION['BrowerDisplayLanguage'] ." FROM weblanguage Where en_US = '".$DisplayString."'";
				//echo $SelectCMD ;
				$Stmt = $GLOBALS['PDOConnectDatabase'] -> prepare( $SelectCMD );
				$Stmt -> execute();
				$DataRow = $Stmt -> fetchAll( PDO::FETCH_ASSOC );
				//echo 'select DisplayLanguage = '.$DisplayLanguage.'<br>';
				if ( !empty ( $DataRow ) ) {
					if ( Count ( $DataRow )  == 1 ) {
						$DataRow = array_values( $DataRow[0] );
						//$LanguageValues = $LanguageData -> fetch_assoc();
						//print_r($LanguageValues);
						//return  $DataRow[0];
						$DisplayLanguage = $DataRow[0];
						//echo 'DisplayLanguage Sql = '.$DisplayLanguage.'<br>';
					} else if ( 1 < Count ( $DataRow )  ) {
						return "超過兩筆";
					}
				} else {
					//$DisplayLanguage = $DisplayString;
				}
			}
		}
		//echo 'DisplayLanguage select end = '.$DisplayLanguage.'<br>';
		if ( !isset ( $_SESSION['BrowerDisplayLanguage'] )  ){
			$DisplayLanguage = $DisplayString;
		}elseif ( !isset ( $DisplayLanguage ) ){
			if ( FindString_Fun( $_SESSION['BrowerDisplayLanguage'] , "zh_TW" ) != -1 ) {
				if ( isset ($_SESSION['SelectTableName'] ) && !is_Null ( $DisplayString ) && !empty ( $DisplayString ) ){  //利用資料庫的備註當翻譯
					//echo 'COMMENT DisplayLanguage = '.$DisplayString.'<br>';
					$FieldNameComment = GetTableFieldValue_Fun( $_SESSION['SelectTableName'] , 'COMMENT' , $DisplayString );
					/*if (  ){
						$FieldNameComment = GetTableFieldValue_Fun( $_SESSION['SelectTableName'] , 'COMMENT' , $DisplayString );
					}else{
						$FieldNameComment = -1;
					}*/
					//echo 'FieldNameComment = '.$FieldNameComment.'<br>';
					if ( $FieldNameComment != -1 ) {
						if ( !empty( $FieldNameComment ) ){  //回傳空值就回傳原本的值
							$DisplayLanguage = $FieldNameComment;
						}else{
							$DisplayLanguage = $DisplayString;
						}
					}else{
						$DisplayLanguage = $DisplayString;
						//echo $DisplayLanguage;
					}
				}else{
					$DisplayLanguage = $DisplayString;
					//$_SESSION['SelectTableName'] = 'User';
				}
			}else{
				$DisplayLanguage = $DisplayString;  //"找不到對應語系"
			}
		}
		Return $DisplayLanguage;
	}
?>