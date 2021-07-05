<?php
	function SegmentationString_Fun( $String_Str , $FindString = Null  , $limit_Int = Null , $SegmentationNum = 1 ) {
		if ( $SegmentationNum == 1 ){
			//echo "explode<br>";
			if ( is_null( $limit_Int )  ) {
				return explode( $FindString , $String_Str );
			}else if ( 1 < $limit_Int ){
				return explode( $FindString , $String_Str , $limit_Int );
			}else {
				return False;
			}
			
		} else if ( $SegmentationNum == 2 ) {
			return str_split( $String_Str );  //根據每個字元切割
		} else if ( $SegmentationNum == 3 ) {
			return mb_split( "\s" , $String_Str );  //依空白分割
		} else if ( $SegmentationNum == 4 ) {
			return $NewString1 = preg_split("/[\s,]+/", $String_Str );  //依空白分割
			return $NewString2 = preg_split('//', $String_Str, -1, PREG_SPLIT_NO_EMPTY);  //一個字為分割
		}
		
		
		
		
		/*if ( $FindString_StartInt != -1 ) {
			if ( is_null ( $Character ) ){
				//if ( mb_strripos( $String_Str , $FindString_Str , $StartStr ) !== false ) {  //對大小寫英文不拘束。  尋找部分相同(從後面)
				//echo "mb_strripos<br>";
				return ( substr( $String_Str , $FindString_StartInt , $GetString_LenInt ) !== false ) ? substr( $String_Str , $FindString_StartInt , $GetString_LenInt ) : -1 ;
				//} else if ( strripos( $String_Str , $FindString_Str , $StartStr ) !== false ) {  //對大小寫英文不拘束。  尋找部分相同(從後面)
				//}
			} else {
				//if ( mb_strrpos( $String_Str , $FindString_Str , $StartStr , $Character  ) !== false ) {  //找中文。  尋找部分相同(從後面)
				//echo "mb_strrpos<br>";
				return ( mb_substr ( $String_Str , $FindString_StartInt , $GetString_LenInt , $Character  ) !== false ) ? mb_substr( $String_Str , $FindString_StartInt , $GetString_LenInt , $Character  ) : -1 ;
				//}
			}
		}else{
			return Null;
		}*/
		
	}
?>