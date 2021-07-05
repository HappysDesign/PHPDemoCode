<?php
	function DisplayLanguage_Fun( $DisplayString ){
		if ( !isset ( $_SESSION['BrowerDisplayLanguage'] ) ){
			echo 'SESSION (BrowerDisplayLanguage) 未啟用<br>';
		}
		if ( isset ($_SESSION['BrowerDisplayLanguage'] ) ){
			if ( strcasecmp( $_SESSION['BrowerDisplayLanguage'] ,'en_us' ) == 0 ) {
				$DisplayLanguage  = $DisplayString;
			} else {
				$SelectCMD = "SELECT " . $_SESSION['BrowerDisplayLanguage'] ." FROM weblanguage Where en_US = '".$DisplayString."'";
				$Stmt = $GLOBALS['PDOConnectDatabase'] -> prepare( $SelectCMD );
				$Stmt -> execute();
				$DataRow = $Stmt -> fetchAll( PDO::FETCH_ASSOC );
				if ( !empty ( $DataRow ) ) {
					if ( Count ( $DataRow )  == 1 ) {
						$DataRow = array_values( $DataRow[0] );
						$DisplayLanguage = $DataRow[0];
					} else if ( 1 < Count ( $DataRow )  ) {
						return "超過兩筆";
					}
				} else {
				}
			}
		}
		if ( !isset ( $_SESSION['BrowerDisplayLanguage'] )  ){
			$DisplayLanguage = $DisplayString;
		}elseif ( !isset ( $DisplayLanguage ) ){
			if ( FindString_Fun( $_SESSION['BrowerDisplayLanguage'] , "zh_TW" ) != -1 ) {
				if ( isset ($_SESSION['SelectTableName'] ) && !is_Null ( $DisplayString ) && !empty ( $DisplayString ) ){  //利用資料庫的備註當翻譯
					$FieldNameComment = GetTableFieldValue_Fun( $_SESSION['SelectTableName'] , 'COMMENT' , $DisplayString );
					if ( $FieldNameComment != -1 ) {
						if ( !empty( $FieldNameComment ) ){  //回傳空值就回傳原本的值
							$DisplayLanguage = $FieldNameComment;
						}else{
							$DisplayLanguage = $DisplayString;
						}
					}else{
						$DisplayLanguage = $DisplayString;
					}
				}else{
					$DisplayLanguage = $DisplayString;
				}
			}else{
				$DisplayLanguage = $DisplayString;  //"找不到對應語系"
			}
		}
		Return $DisplayLanguage;
	}
?>