<?php
	function ReplaceString_Fun( $String_Str , $SearchStr , $Replacement , $Capital = False , $CountNum = Null , $ReplaceNum = 1 , $Start = 0 , $StringLength = 0 ) {
		//$SearchStr 搜尋值 $Replacement 覆蓋值 $String_Str 被搜尋值  $Capital 大寫  $CountNum 覆蓋次數  $ReplaceNum選擇 Fun
		if ( $ReplaceNum == 1 ){
			if ( $Capital ) {
				if ( is_Null( $CountNum ) ){
					return str_replace( $SearchStr , $Replacement , $String_Str );
				} else {
					return str_replace( $SearchStr , $Replacement , $String_Str , $CountNum );
				}
			}else{
				if ( is_Null( $CountNum ) ){
					return str_ireplace( $SearchStr , $Replacement , $String_Str );
				} else {
					return str_ireplace( $SearchStr , $Replacement , $String_Str , $CountNum );
				}
			}
		} else if ( $ReplaceNum == 2 ) {
			return substr_replace ( $String_Str , $Replacement , $Start , $StringLength );			
		} else if ( $ReplaceNum == 3 ) {
			
		} else if ( $ReplaceNum == 4 ) {
			
		}

	}
?>