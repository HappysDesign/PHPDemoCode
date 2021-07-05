<?php
	function FindString_Fun( $String_Str , $FindString_Str  , $Capital = false  , $Complete = false , $Rear = false , $Start_Int = 0 , $Character = Null  ){
		//echo $Capital . $Complete . $Rear . "<br>";  //'大寫 完整 後面 位移 字符
		//mb_stripos  預設 (前面)
		//mb_strripos  預設 (後面)mb_strripos
		
		//echo "String_Str" . $String_Str . "<br>";
		//echo "FindString_Str" . $FindString_Str  . "<br>";
		if ( !is_null ( $String_Str ) && !is_null ( $FindString_Str ) ){
			if ( ! $Complete ){
				if ( $Capital ){
					if ( ! $Rear ){ 
						//if ( strpos( $String_Str , $FindString_Str , $Start_Int ) !== false ) {  //對大小寫英文有拘束。  尋找部分相同
						//echo "strpos<br>";
						return  ( strpos( $String_Str , $FindString_Str , $Start_Int ) !== false ) ? strpos( $String_Str , $FindString_Str , $Start_Int ) : -1 ; 
						//} 
					} else {
						//if ( strrpos( $String_Str , $FindString_Str , $Start_Int ) !== false ) {  //對大小寫英文有拘束。  尋找部分相同(從後面)
						//echo "strrpos<br>";
						return  ( strrpos( $String_Str , $FindString_Str , $Start_Int ) !== false )? strrpos( $String_Str , $FindString_Str , $Start_Int ) : -1 ;
						//}
					}
				}else{
					if ( ! $Rear ){ 
						if ( is_null ( $Character ) ){
							//if ( mb_stripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) {  //對大小寫英文不拘束。  尋找部分相同
							//echo "mb_stripos<br>";
							return  ( mb_stripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) ? mb_stripos( $String_Str , $FindString_Str , $Start_Int ) : -1 ;
							//} else if ( stripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) {  //對大小寫英文不拘束。  尋找部分相同
							//echo "stripos<br>";
							return  ( stripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) ? stripos( $String_Str , $FindString_Str , $Start_Int ) : -1 ;
							//} 
						}else{
							//if ( mb_strpos( $String_Str , $FindString_Str , $Start_Int , $Character ) !== false ) {  //找中文。  尋找部分相同
							echo "mb_strpos<br>";
							return  ( mb_strpos( $String_Str , $FindString_Str , $Start_Int , $Character ) !== false ) ? mb_strpos( $String_Str , $FindString_Str , $Start_Int , $Character ) : -1 ;
							//}
						}
					} else {
						if ( is_null ( $Character ) ){
							//if ( mb_strripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) {  //對大小寫英文不拘束。  尋找部分相同(從後面)
							//echo "mb_strripos<br>";
							return  ( mb_strripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) ? mb_strripos( $String_Str , $FindString_Str , $Start_Int ) : -1 ;
							//} else if ( strripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) {  //對大小寫英文不拘束。  尋找部分相同(從後面)
							//echo "strripos<br>";
							return  ( strripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) ? strripos( $String_Str , $FindString_Str , $Start_Int ) : -1 ;
							//}
						} else {
							//if ( mb_strrpos( $String_Str , $FindString_Str , $Start_Int , $Character  ) !== false ) {  //找中文。  尋找部分相同(從後面)
							//echo "mb_strrpos<br>";
							return  ( mb_strrpos( $String_Str , $FindString_Str , $Start_Int , $Character  ) !== false ) ? mb_strrpos( $String_Str , $FindString_Str , $Start_Int , $Character  ) : -1 ;
							//}
						} 
					}
					//} else if ( mb_strpos( $String_Str , $FindString_Str , $Start_Int ) !== false ) {  //尋找部分相同
						//echo "可觀看欄位 = " . $DesignationFieldName . "<br>";
						//return  $DesignationFieldName;
					//} else if ( mb_strrpos( $String_Str , $FindString_Str , $Start_Int ) !== false ) {  //尋找部分相同(從後面)
						//echo "可觀看欄位 = " . $DesignationFieldName . "<br>";
						//return  $DesignationFieldName;
					
				}
			} else {  //完全比對
				if ( $Capital ){  //區分大寫
					//if ( strcmp( $String_Str , $FindString_Str ) == 0 ) {  //對大小寫英文有拘束。  尋找完整相同 不相同 大於或小於 0
					//echo "strcmp<br>";
					return ( strcmp( $String_Str , $FindString_Str ) == 0 ) ? 0 : -1 ;
					//}
				} else {  //不區分大寫
					//if ( strcasecmp( $String_Str , $FindString_Str ) == 0 ) {  //對大小寫英文不拘束。  尋找完整相同 不相同 大於或小於 0
					//echo "strcasecmp<br>";
					return  ( strcasecmp( $String_Str , $FindString_Str ) == 0 ) ? 0 : -1 ;
					//}
				}
			}
		}
		return -1;
	}
	//echo FindString_Fun("123",Null);
?>