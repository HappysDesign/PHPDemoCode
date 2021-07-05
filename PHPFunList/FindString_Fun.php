<?php
	function FindString_Fun( $String_Str , $FindString_Str  , $Capital = false  , $Complete = false , $Rear = false , $Start_Int = 0 , $Character = Null  ){
		//echo $Capital . $Complete . $Rear . "<br>";  //'大寫 完整 後面 位移 字符
		if ( !is_null ( $String_Str ) && !is_null ( $FindString_Str ) ){
			if ( ! $Complete ){
				if ( $Capital ){
					if ( ! $Rear ){ 
						return  ( strpos( $String_Str , $FindString_Str , $Start_Int ) !== false ) ? strpos( $String_Str , $FindString_Str , $Start_Int ) : -1 ; 
					} else {
						return  ( strrpos( $String_Str , $FindString_Str , $Start_Int ) !== false )? strrpos( $String_Str , $FindString_Str , $Start_Int ) : -1 ;
					}
				}else{
					if ( ! $Rear ){ 
						if ( is_null ( $Character ) ){
							return  ( mb_stripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) ? mb_stripos( $String_Str , $FindString_Str , $Start_Int ) : -1 ;
							return  ( stripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) ? stripos( $String_Str , $FindString_Str , $Start_Int ) : -1 ;
						}else{
							echo "mb_strpos<br>";
							return  ( mb_strpos( $String_Str , $FindString_Str , $Start_Int , $Character ) !== false ) ? mb_strpos( $String_Str , $FindString_Str , $Start_Int , $Character ) : -1 ;
						}
					} else {
						if ( is_null ( $Character ) ){
							return  ( mb_strripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) ? mb_strripos( $String_Str , $FindString_Str , $Start_Int ) : -1 ;
							return  ( strripos( $String_Str , $FindString_Str , $Start_Int ) !== false ) ? strripos( $String_Str , $FindString_Str , $Start_Int ) : -1 ;
						} else {
							return  ( mb_strrpos( $String_Str , $FindString_Str , $Start_Int , $Character  ) !== false ) ? mb_strrpos( $String_Str , $FindString_Str , $Start_Int , $Character  ) : -1 ;
						} 
					}
				}
			} else {  //完全比對
				if ( $Capital ){  //區分大寫
					return ( strcmp( $String_Str , $FindString_Str ) == 0 ) ? 0 : -1 ;
				} else {  //不區分大寫
					return  ( strcasecmp( $String_Str , $FindString_Str ) == 0 ) ? 0 : -1 ;
				}
			}
		}
		return -1;
	}
?>