<?php
//////////Html Tag 標籤說明 加s是前後都有 Tag    //後面說明是有搭配 那些變數
//Doctype          Html開頭
//Tags_Html        
//Tags_Head        
//Tag_Meta              
//Tags_Title       頁面名稱  Display
//Tag_Body         瀏覽器顯示內容
//Tags_THAll       表格欄位標題 要搭配 TR //有Fun Display
//Tag_FieldTRStart 表格欄位起頭 //有Fun 包TD(Display 所以不用給值)
//Tag_FieldTREnd   表格欄位結束 //Display
//Tags_FieldTRAll  表格起頭與結束 //有Fun 包TD(Display  所以不用給值)
//Tags_TDAll       表格的欄位分隔 要搭配 TR  //有Fun Display
//Tags_label       標體  //有Fun Display
//Tag_Input	       輸出欄位  //有Fun
//Tags_A           超連結  //有Fun Display
//Tag_Br           文字換行  //Display
//Tags_Caption     表格標題  //有Fun Display
//Tags_Select      下拉式清單  //有Fun Display
//Tags_Optgroup	   下拉式清單群組  //有Fun Display
//Tags_Textarea    多行文字  //有Fun
//Tags_P            文字段落  //
//Tags_Form       表單開始  //有Fun  Display
//Tags_Table       表格開始  //有Fun  Display
//Tag_FormStart    表單開始  //有Fun
//Tag_FormEnd      表單結束 沒有加入其他變數
//Tag_TableStart   表格開始  //有Fun
//Tag_TableEnd     表格結束 沒有加入其他變數
//Tags_Button      一般按鈕  //有Fun  Display
//Tags_Div         很多用途  //有Fun  Display
//Tags_Thead       表格表頭區塊  //沒有Fun  有Display
//Tags_Tbody       表格主要內容區塊  //沒有Fun  有Display
//Tags_Tfoot       表格頁腳區  //沒有Fun  有Display
//Tags_Span        

//引數為 "" 或 Null 都是 Null  使用 is_null 都是 True 
//引數說明 $HtmlLanguage_Arr 陣列 $DisplayValue Httml顯示值 $Recursive_Str 加字串值
//$HtmlLanguage_Arr：一維值說明 = 0 > Html 標籤, 1 > 內容值(有陣列或單一值) 2 > 以上 HtmlFunction
//$HtmlLanguage_Arr：二維陣列說明將一維陣列加進去
	function PrintHtmlLanguageArray_Fun( $HtmlLanguage_Arr , $DisplayValue = Null , $Recursive_Str = Null  ){
		$BlankStr = '';  //空格  &emsp; &nbsp;
		$LinkString = '=';    //切割Function
		$HtmlLangFunValue_Str = '';      //Html Function 集合
		$HtmlLangValue_Str = '';       //Html字串 Function 結果回傳 
		//---------------------------------------------- HtmlLanguage_Arr 陣列處理開始
		if ( is_array ( $HtmlLanguage_Arr ) ) {  //第一次進來 二維  第二次
			Foreach ( $HtmlLanguage_Arr as $ArrayField => $ArrayValue ){
				if ( is_array ( $ArrayValue ) && ( FindString_Fun( $ArrayValue[0] , 'Tag_' ) != -1 || FindString_Fun( $ArrayValue[0] , 'Tags_' ) != -1 ) ) {  //0 1 2 3  // && $ArrayField == 0
					$Recursive_Str = PrintHtmlLanguageArray_Fun( $ArrayValue , $DisplayValue , $Recursive_Str  );  //遞迴 
				}else{  //整個陣列
					if ( $ArrayField != 0 && $ArrayField != 1 ){
						if ( FindString_Fun( $ArrayValue , $LinkString ) != -1  ){
							$HtmlFunction_Arr = SegmentationString_Fun( $ArrayValue , $LinkString , 2 );
							if ( FindString_Fun( $HtmlFunction_Arr[0] , "placeholder"  ) != -1 ){
								$HtmlLangFunValue_Str = $HtmlLangFunValue_Str . " " . $HtmlFunction_Arr[0] . " = '" . DisplayLanguage_Fun( $HtmlFunction_Arr[1] ) . "' ";
							}else{
								$HtmlLangFunValue_Str = $HtmlLangFunValue_Str . " " . $HtmlFunction_Arr[0] . " = '" . $HtmlFunction_Arr[1] . "' ";						
							}
							
						} else if ( FindString_Fun( $ArrayValue , "&emsp;"  ) != -1  ) {
							if ( FindString_Fun( $ArrayValue , "*"  ) != -1  ){
								$BlankStr_Arr = SegmentationString_Fun( $ArrayValue , "*" );
								$BlankStr = $BlankStr . str_repeat( $BlankStr_Arr[0] ,$BlankStr_Arr[1] );
							}else{
								$BlankStr = $BlankStr . $ArrayValue;  //emsp;
							}					
						} else if ( FindString_Fun( $ArrayValue , "&nbsp;"  ) != -1  ) {
							if ( FindString_Fun( $ArrayValue , "*"  ) != -1  ){
								$BlankStr_Arr = SegmentationString_Fun( $ArrayValue , "*" );
								$BlankStr = $BlankStr . str_repeat( $BlankStr_Arr[0] ,$BlankStr_Arr[1] );
							}else{
								$BlankStr = $BlankStr . $ArrayValue;  //nbsp;
							}
						} else if ( FindString_Fun( $ArrayValue , ':'  ) != -1  ) {
							$HtmlFunction_Arr = SegmentationString_Fun( $ArrayValue , ':' , 2 );
							$HtmlLangFunValue_Str = $HtmlLangFunValue_Str . " " . $HtmlFunction_Arr[0] . ":'" . $HtmlFunction_Arr[1] . "' ";
						} else if ( FindString_Fun( $ArrayValue , "Tag_"  ) != -1 || FindString_Fun( $ArrayValue , "Tags_"  ) != -1 ) {  //遞迴
							$HtmlLanguageCopy_Arr = array();  //儲存切割前的功能
							foreach( $HtmlLanguage_Arr as $key => $value){
								if( $key < $ArrayField ){
									$HtmlLanguageCopy_Arr[] = $HtmlLanguage_Arr[$key];
									unset( $HtmlLanguage_Arr[$key] );
								} else {
									//break;
								}
							}
							$HtmlLanguage_Arr = array_values( $HtmlLanguage_Arr );  //最後面
							if ( !is_Null ($DisplayValue) ){  //  處理一維陣列理藏 Html Tag  先做陣列後面(分斷陣列 一維切割很多個陣列)
								$AddStrValue = PrintHtmlLanguageArray_Fun( $HtmlLanguage_Arr , $DisplayValue );
								$DisplayValue = Null;
							} else {
								$AddStrValue = PrintHtmlLanguageArray_Fun( $HtmlLanguage_Arr  );
							}
							if ( isset( $ArrayDisplay ) ){

							}
							$HtmlLanguage_Arr = $HtmlLanguageCopy_Arr;
							break;
						} else {
							$HtmlLangFunValue_Str = $HtmlLangFunValue_Str . " " . $ArrayValue . " " ;
						}
					}else{
						$TagName = $HtmlLanguage_Arr[0];
						if ( !is_Null( $HtmlLanguage_Arr[1] )){
							$ArrayDisplay = $HtmlLanguage_Arr[1];
						}else if ( is_Null( $HtmlLanguage_Arr[1] )){
							$ArrayDisplay = Null;
						}else if ( isset( $HtmlLanguage_Arr[1] )){
							echo 'HtmlLanguage_Arr = '. $HtmlLanguage_Arr[1].'isset<br>';
							$ArrayDisplay = $HtmlLanguage_Arr[1];
						}
					}
				}				
			}
		} else {
			if( !empty ( $HtmlLanguage_Arr ) ){
				echo 'HtmlLanguage_Arr 有值<br>';
			}else{
				echo 'HtmlLanguage_Arr 無值<br>';
				$TagName = 0;
			}
		}
		//---------------------------------------------- HtmlLanguage_Arr 陣列處理結束
		if ( count( $HtmlLanguage_Arr ) != 0 ){  //最外圍二維陣列
			if ( empty( $TagName ) && !empty( $Recursive_Str ) ){
				return $Recursive_Str;
			}
		}
		if ( is_Null( $Recursive_Str ) && empty( $TagName ) && !empty( $Recursive_Str ) ){
			echo '無 NoTag';
			return $Recursive_Str;
		}
		//---------------------------------------------- 針對處理 HtmlLanguage_Arr 陣列結果後要做的事
		if ( is_array ( $ArrayDisplay ) ) {
			$OptionStr = "<option value=''>None</option>";
			Foreach ( $ArrayDisplay as $ArrayField => $ArrayValue ){
				if ( FindString_Fun( $TagName , "Tags_Select"  ) != -1 ){   //DisplayValue = 已被選得值
					if ( FindString_Fun( $ArrayValue , "Tags_Optgroup"  ) == -1 ){
						if ( FindString_Fun( $ArrayValue , "V:" ) != -1 && FindString_Fun( $ArrayValue , "D:" ) != -1 ){
							//echo 'V:'; //比對
							//echo 'D:';
							$ArrayValue_Arr = SegmentationString_Fun( $ArrayValue , 'D:' , 2 );
							if ( !is_numeric ( $ArrayValue_Arr[1] ) ){
								$SelectDisplayValue = DisplayLanguage_Fun( $ArrayValue_Arr[1] ); //翻譯顯示文字 //DisplayLanguage_Fun( $Display ) 
							}else{  //是數字不要翻譯
								$SelectDisplayValue = ReplaceString_Fun ( $ArrayValue_Arr[1] , 'V:' , '' ) ;
							}
							$SelectValue =  ReplaceString_Fun ( $ArrayValue_Arr[0] , 'V:' , '' ) ;
							if ( FindString_Fun( $DisplayValue , $SelectValue , False , True ) != -1 ){
								$OptionStr = $OptionStr . "<option value='". $SelectValue ."' selected >". $SelectDisplayValue . "</option>";
							}else{
								$OptionStr = $OptionStr . "<option value='". $SelectValue ."' >". $SelectDisplayValue . "</option>";
							}
						}else{
							if ( FindString_Fun( $DisplayValue , $ArrayValue ) != -1 ){
								$OptionStr = $OptionStr . "<option value='". $ArrayValue ."' selected >". $ArrayValue . "</option>";
							}else{
								$OptionStr = $OptionStr . "<option value='". $ArrayValue ."' >". $ArrayValue . "</option>";
							}
						}
					}else{
						$OptionStr = $OptionStr.$ArrayValue;
					}
				}else if ( FindString_Fun( $TagName , "Tags_Optgroup"  ) != -1 ){
					if ( FindString_Fun( $ArrayValue , "V:" ) != -1 && FindString_Fun( $ArrayValue , "D:" ) != -1 ){
						//echo 'V:Tags_Optgroup'; //比對
						//echo 'D:';
						$ArrayValue_Arr = SegmentationString_Fun( $ArrayValue , 'D:' , 2 );
						if ( !is_numeric ( $ArrayValue_Arr[1] ) ){
							$SelectDisplayValue = DisplayLanguage_Fun( $ArrayValue_Arr[1] ); //翻譯顯示文字 //DisplayLanguage_Fun( $Display ) 
						}else{  //是數字不要翻譯
							$SelectDisplayValue = $ArrayValue_Arr[1] ;
						}
						$SelectValue = $ArrayValue_Arr[0] ;
						if ( FindString_Fun( $DisplayValue , $SelectValue ) != -1 ){
							$OptionStr = $OptionStr . "<option value='". $SelectValue ."' selected >". $SelectDisplayValue . "</option>";
						}else{
							$OptionStr = $OptionStr . "<option value='". $SelectValue ."' >". $SelectDisplayValue . "</option>";
						}
					}else{
						if ( FindString_Fun( $DisplayValue , $ArrayValue ) != -1 ){
							$OptionStr = $OptionStr . "<option value='". $ArrayValue ."' selected >". $ArrayValue . "</option>";
						}else{
							$OptionStr = $OptionStr . "<option value='". $ArrayValue ."' >". $ArrayValue . "</option>";
						}
					}
				}else if ( FindString_Fun( $TagName , "Tags_THAll"  ) != -1 ){
					$OptionStr = PrintHtmlLanguageArray_Fun ( Array( 'Tags_THAll' , $ArrayValue ) );
					if ( isset( $THStr ) ){
						$THStr = $THStr.$OptionStr;
					}else{
						$THStr = $OptionStr;
					}					
					$OptionStr = '';
				}
				 
			}
			if ( isset($THStr) ){
				Return $THStr;
			}
			
			if ( FindString_Fun( $TagName , "Tags_Div"  ) != -1 ){
			}elseif ( is_Null( $DisplayValue ) && is_Null( $Recursive_Str ) ){  //Tags_Select Tags_Optgroup
				if ( FindString_Fun( $TagName , "Tags_Select"  ) != -1 ){  //For Select
					$DisplayValue = $OptionStr;
				}else{
				
				}
			}else if ( is_Null( $DisplayValue ) && !is_Null( $Recursive_Str ) ){
				echo $TagName . ' -- Select  2 ArrayDisplay _ Array<br>';
				if ( FindString_Fun( $TagName , "Tags_Select"  ) != -1 ){  //For Select
					$DisplayValue = $OptionStr;
				}else{
				
				}
			}else if ( !is_Null( $DisplayValue ) && !is_Null( $Recursive_Str ) ){
				echo $TagName . ' -- Select  3 ArrayDisplay _ Array<br>';
				
			}else {
				
			}
		}elseif ( is_Null ( $DisplayValue ) && !is_Null ( $ArrayDisplay ) && !is_Null ( $Recursive_Str ) && !isset ( $AddStrValue ) ){
			if ( FindString_Fun( $TagName , "Tags_Caption" ) != -1 ){  //翻譯顯示文字
				$DisplayValue = DisplayLanguage_Fun( $ArrayDisplay );
			}else if ( FindString_Fun( $TagName , "Tag_Input" ) != -1 ){  //翻譯顯示文字
				$DisplayValue = DisplayLanguage_Fun( $ArrayDisplay );
				
			}else{
				$DisplayValue = $ArrayDisplay;
			}
		}else if ( is_Null ( $DisplayValue ) && is_Null( $ArrayDisplay )  && !is_Null ( $Recursive_Str ) && !isset ( $AddStrValue ) ){
			$DisplayValue = $Recursive_Str;
		}else if ( is_Null ( $DisplayValue ) && !is_Null ( $Recursive_Str ) && !isset ( $AddStrValue ) ){
			$DisplayValue = $ArrayDisplay;
		}else if ( is_Null ( $DisplayValue ) && is_Null ( $Recursive_Str ) && !isset ( $AddStrValue ) ){
			if ( FindString_Fun( $TagName , "Tags_label" ) != -1 ){  //翻譯顯示文字
				$DisplayValue = DisplayLanguage_Fun( $ArrayDisplay );
			}else if ( FindString_Fun( $TagName , "Tags_THAll" ) != -1 ){  //翻譯顯示文字
				$DisplayValue = DisplayLanguage_Fun( $ArrayDisplay );
			}else if ( FindString_Fun( $TagName , "Tags_TDAll" ) != -1 ){  //翻譯顯示文字
				$DisplayValue = DisplayLanguage_Fun( $ArrayDisplay );
			}else if ( FindString_Fun( $TagName , "Tags_Title" ) != -1 ){  //翻譯顯示文字
				$DisplayValue = DisplayLanguage_Fun( $ArrayDisplay );
			}else if ( FindString_Fun( $TagName , "Tags_Button" ) != -1 ){  //翻譯顯示文字
				$DisplayValue = DisplayLanguage_Fun( $ArrayDisplay );
			}else if ( FindString_Fun( $TagName , "Tag_Br" ) != -1 ){  //翻譯顯示文字
				if ( is_Null( $DisplayValue ) && !is_Null( $ArrayDisplay ) ){
					$DisplayValue = DisplayLanguage_Fun( $ArrayDisplay );
				}else if ( is_Null( $DisplayValue ) && is_Null( $ArrayDisplay ) ){
					$DisplayValue = $ArrayDisplay;
				}else{
					echo $DisplayValue . '有值';
				}
			}else if ( FindString_Fun( $TagName , "Tag_Input" ) != -1 ){  //翻譯顯示文字
				if ( FindString_Fun( $HtmlLangFunValue_Str , "type" ) != -1 && FindString_Fun( $HtmlLangFunValue_Str , "button" ) != -1  ) {
					$DisplayValue = DisplayLanguage_Fun( $ArrayDisplay );
				}else if ( FindString_Fun( $HtmlLangFunValue_Str , "type" ) != -1 && FindString_Fun( $HtmlLangFunValue_Str , "button" ) != -1 ){
				
				}else{
					$DisplayValue = $ArrayDisplay ;
				}
			}else if ( FindString_Fun( $TagName , "Tags_Textarea" ) != -1 ){
				$DisplayValue = $ArrayDisplay;
			}else{
				$DisplayValue = $ArrayDisplay;  //不翻譯 Input 會影響 POST 值  
			}
		}else if ( !is_Null ( $DisplayValue ) && !isset ( $AddStrValue ) ){
			if ( FindString_Fun( $TagName , "Tags_Head" ) != -1 ){
				
			}
		}
		if ( isset( $AddStrValue ) ) {
			if ( FindString_Fun( $TagName , "Tags_label" , False , True ) != -1 ) {  //Label名稱 放置左邊
				if ( FindString_Fun( $TagName , "Tags_label" ) != -1 ){
					$ArrayDisplay = DisplayLanguage_Fun( $ArrayDisplay );   //翻譯文字
				}
				$DisplayValue = $ArrayDisplay.$AddStrValue;  //AddStrValue for inptut
			}else if ( FindString_Fun( $TagName , "Tags_label" ) != -1 ) {  //Label名稱 放置右邊邊
				if ( FindString_Fun( $TagName , "Tags_label" ) != -1 ){
					$ArrayDisplay = DisplayLanguage_Fun( $ArrayDisplay );  //翻譯文字
				}
				$TagName = "Tags_label";   //因將文字 擺在右邊需要 更改標籤 現在更正
				$DisplayValue = $AddStrValue.$ArrayDisplay;  //AddStrValue for inptut
			}else if ( FindString_Fun( $TagName , "Tag_Input" ) != -1 ) {  //input 連結
				if ( isset ( $AddStrValue ) && !is_Null( $Recursive_Str ) ){
					$Recursive_Str = $AddStrValue.$Recursive_Str;
				}elseif ( isset( $AddStrValue ) && is_Null( $Recursive_Str )  ){
					$Recursive_Str = $AddStrValue;
				}
				if ( is_Null( $DisplayValue ) && !is_Null( $ArrayDisplay ) ){
					$DisplayValue = DisplayLanguage_Fun( $ArrayDisplay );
				}else if ( is_Null( $DisplayValue ) && is_Null( $ArrayDisplay ) ){
					$DisplayValue = $ArrayDisplay;
				}else{
					echo $DisplayValue . '有值';
				}
			}else if ( FindString_Fun( $TagName , "Tag_Br" ) != -1 ) {  //Tag_Br 寫在前面 
				if ( isset( $AddStrValue ) && !is_Null( $Recursive_Str ) ) {  
					$Recursive_Str = $AddStrValue.$Recursive_Str;
				}elseif ( isset( $AddStrValue ) && is_Null( $Recursive_Str ) ) {
					$Recursive_Str = $AddStrValue;
				}
				if ( is_Null( $DisplayValue ) && !is_Null( $ArrayDisplay ) ){  //Tag_Br 翻譯文字
					$DisplayValue = DisplayLanguage_Fun( $ArrayDisplay );
				}else if ( is_Null( $DisplayValue ) && is_Null( $ArrayDisplay ) ){
					$DisplayValue = $ArrayDisplay;
				}else{
					echo $DisplayValue . '有值';
				}			
			}else if ( FindString_Fun( $TagName , "Tags_Select" ) != -1 ) { //Tags_Select 
				$Recursive_Str = $AddStrValue;
			}else if ( FindString_Fun( $TagName , "Tags_Div" ) != -1 ) {
				if ( is_Null( $DisplayValue ) && is_Null( $Recursive_Str ) ){  //串在後面或顯示
					$DisplayValue = $AddStrValue;   //顯示
				}else if ( is_Null( $DisplayValue ) && !is_Null( $Recursive_Str ) ){
					$DisplayValue = $AddStrValue;
				}		
			}else{
				$DisplayValue = $ArrayDisplay.$AddStrValue;
			}
			Unset( $AddStrValue );
		}
	//-------------------------------------------------------------TAG Start
		switch ( $TagName ) {
			case "Tags_TDAll":
				$HtmlLangValue_Str = "<td {$HtmlLangFunValue_Str} > {$DisplayValue} </td>";
				break;
			case "Tag_FieldTRStart":
				$HtmlLangValue_Str = "<tr {$HtmlLangFunValue_Str} > {$DisplayValue}";
				break;
			case "Tag_FieldTREnd":
				$HtmlLangValue_Str = "{$DisplayValue} </tr>";
				break;
			case "Tags_FieldTRAll":
				$HtmlLangValue_Str = "<tr {$HtmlLangFunValue_Str} > {$DisplayValue } </tr>";
				break;
			case "Tag_Br":  //寫在陣列前面就是把後面放在
				$HtmlLangValue_Str = $DisplayValue ."<br>".$Recursive_Str;
				break;
			case "Tags_Form":
				$HtmlLangValue_Str = "<form {$HtmlLangFunValue_Str} > {$DisplayValue } </form>";
				break;
			case "Tags_Table":
				$HtmlLangValue_Str =  "<table {$HtmlLangFunValue_Str} > {$DisplayValue } </table>";
				break;
			case "Tag_FormEnd":
				$HtmlLangValue_Str = "</form>";
				break;
			case "Tag_TableEnd":
				$HtmlLangValue_Str = "</table>";
				break;
			case "Tags_A" :
				$HtmlLangValue_Str = "<a style='text-decoration:none;' {$HtmlLangFunValue_Str} >{$DisplayValue}</a>";
				break;
			case "Tags_Button":
				$HtmlLangValue_Str = " <button {$HtmlLangFunValue_Str} >{$DisplayValue}</button>{$Recursive_Str}";
				break;
			case "Tag_Input":
				$HtmlLangValue_Str = "<Input {$HtmlLangFunValue_Str} value='{$DisplayValue}' >{$BlankStr}{$Recursive_Str}";
				break;
			case "Tags_label":
				$HtmlLangValue_Str = "<label {$HtmlLangFunValue_Str} >{$DisplayValue}</label>{$BlankStr}{$Recursive_Str}";
				break;
			case "Tags_THAll":
				$HtmlLangValue_Str = " <th {$HtmlLangFunValue_Str} >{$DisplayValue}</th>";
				break;
			case "Tags_Caption":
				if ( !is_Null( $Recursive_Str ) ){
					$HtmlLangValue_Str = "<caption {$HtmlLangFunValue_Str} > {$DisplayValue } </caption>{$Recursive_Str}";
				}else{
					$HtmlLangValue_Str = "<caption {$HtmlLangFunValue_Str} >{$DisplayValue}</caption>";
				}
				break;
			case "Tags_P":
				$HtmlLangValue_Str = " <p {$HtmlLangFunValue_Str } >{$DisplayValue}</p>";
				break;
			case "Tags_Select":
				if ( !is_Null( $Recursive_Str ) ){
					$HtmlLangValue_Str = "<select {$HtmlLangFunValue_Str } > {$DisplayValue} </select>{$Recursive_Str}";
				}else{
					$HtmlLangValue_Str = "<select {$HtmlLangFunValue_Str } > {$DisplayValue} </select>";
				}
				break;
			case "Tags_Optgroup":
				$HtmlLangValue_Str = "<optgroup {$HtmlLangFunValue_Str } > {$DisplayValue} </optgroup>";
				break;
			case "Tags_Textarea": 
				$HtmlLangValue_Str = "<textarea {$HtmlLangFunValue_Str} >{$DisplayValue}</textarea>{$Recursive_Str}";
				break;
			case "Tags_Div":
				if ( !is_Array( $Recursive_Str ) ){
					if ( is_Array( $DisplayValue ) ){
						echo 'DisplayValue = ';
						print_r ($DisplayValue );
					}else{
						
					}
				}else{
				}				
				$HtmlLangValue_Str = "<div {$HtmlLangFunValue_Str} >{$DisplayValue}</div>{$Recursive_Str}";
				break;
			case "Doctype":
				$HtmlLangValue_Str = "<!DOCTYPE html>\r\n{$DisplayValue}\r\n";
				break;
			case "Tags_Html":
				$HtmlLangValue_Str = "<html>\r\n {$HtmlLangFunValue_Str}{$DisplayValue} </html>\r\n";
				break;
			case "Tags_Head":
				$HtmlLangValue_Str = "<head>\r\n {$HtmlLangFunValue_Str}{$DisplayValue} </head>\r\n{$Recursive_Str}";
				break;
			case "Tag_Meta":
				$HtmlLangValue_Str = "<meta {$HtmlLangFunValue_Str} >{$DisplayValue}\r\n";
				break;
			case "Tags_Title":
				$HtmlLangValue_Str = "<title {$HtmlLangFunValue_Str} >{$DisplayValue}</title>\r\n";
				break;
			case "Tag_Body":
				$HtmlLangValue_Str = "<body {$HtmlLangFunValue_Str} >\r\n{$DisplayValue}</body>\r\n";
				break;
			case "Tags_Thead":
				$HtmlLangValue_Str = "<thead {$HtmlLangFunValue_Str} >\r\n{$DisplayValue}</thead>\r\n";
				break;
			case "Tags_Tbody":
				$HtmlLangValue_Str = "<tbody {$HtmlLangFunValue_Str} >\r\n{$DisplayValue}</tbody>\r\n";
				break;
			case "Tags_Tfoot":
				$HtmlLangValue_Str = "<tfoot {$HtmlLangFunValue_Str} >\r\n{$DisplayValue}</tfoot>\r\n";
				break;
			case "Tags_Span":
				$HtmlLangValue_Str = "<span {$HtmlLangFunValue_Str} >{$DisplayValue}</span>";
				break;
			default:
				echo '找不到 Tag , 請建立 Tag '. $TagName;
				break;
		}
		return $HtmlLangValue_Str;
	}

?>