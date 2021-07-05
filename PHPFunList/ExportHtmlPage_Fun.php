<?php
	Function ExportHtmlPage_Fun( $BodyHtml_Str , $AgeS = null ){
		if( !empty( $AgeS ) && Count( $AgeS ) != -1 ) {
			foreach ( $AgeS as $AgeSField => $AgeSValue ){
				if ( FindString_Fun( $AgeSField , 'Body'  ) != -1  ) {
					$BodyArray = array( 'Tag_Body' ,$BodyHtml_Str );
					$BodyHtmlFormt_Str = PrintHtmlLanguageArray_Fun( $BodyArray  );
				}else if( FindString_Fun( $AgeSField , 'Meta'  ) != -1 ) {
					$MetaArray = array( 'Tag_Meta' , null , 'charset=utf-8' );
					$MetaHtmlFormt_Str = PrintHtmlLanguageArray_Fun( $MetaArray );				
				}else if( FindString_Fun( $AgeSField , 'Title'  ) != -1 ) {
					$TitleArray = array( 'Tags_Title' , $AgeSValue );
					$TitleHtmlFormt_Str = PrintHtmlLanguageArray_Fun( $TitleArray );
				}else if( FindString_Fun( $AgeSField , 'Head'  ) != -1 ) {
					$HeadContent = $MetaHtmlFormt_Str.$TitleHtmlFormt_Str.$AgeSValue;
					$HeadArray = array( 'Tags_Head' , $HeadContent );  //, 'http-equiv=Content-Type', 'content=text/html' 
					$HeadHtmlFormt_Str = PrintHtmlLanguageArray_Fun( $HeadArray  );
					$HeadHtmlFormt_Str = $HeadHtmlFormt_Str.$BodyHtmlFormt_Str;
				}else if( FindString_Fun( $AgeSField , 'Html'  ) != -1 ) {
					$HtmlArray = array( 'Tags_Html' , $HeadHtmlFormt_Str  );
					$DisplayHtmlFormt_Str = PrintHtmlLanguageArray_Fun( $HtmlArray  );
				}else if( FindString_Fun( $AgeSField , 'Doctype'  ) != -1 ) {
					$DoctypeArray = array( 'Doctype' , $DisplayHtmlFormt_Str );
					$Doctype_Str = PrintHtmlLanguageArray_Fun( $DoctypeArray );
				}else{
					print_r($AgeSField);
				}	
			}
			Return $Doctype_Str;
		}else if ( !empty( $BodyHtml_Str ) ){
			$CSSDir = "\CSS";
			$JavaScriptDir = "\JavaScript";
			//echo __DIR__.$CSSDir;
			if ( file_exists( __DIR__.$CSSDir ))  //本層資料夾路徑
			{
				$CSSDir = "/CSS";
			}elseif ( file_exists( dirname(__DIR__).$CSSDir )){  //上層資料夾路徑
				$CSSDir = "../CSS";
			}
			if ( file_exists( __DIR__.$JavaScriptDir ))  //本層資料夾路徑
			{
				$JavaScriptDir = "/JavaScript";
			}elseif ( file_exists( dirname(__DIR__).$JavaScriptDir )){  //上層資料夾路徑
				$JavaScriptDir = "../JavaScript";
			}
			$BodyArray = array( 'Tag_Body' , Null );
			$HeadArray = array( 'Tags_Head' , Null );  //, 'http-equiv=Content-Type', 'content=text/html' 
			$MetaArray = array( 'Tag_Meta' , Null , 'charset=utf-8' );
			$TitleArray = array( 'Tags_Title' , 'TestPage' );
			$HtmlArray = array( 'Tags_Html' , Null ,  );
			$DoctypeArray = array( 'Doctype' , Null );
			$FavoriteIcon_Str = "<LINK REL='SHORTCUT ICON' href='https://www.google.com/favicon.ico'>";
			$jQueryLibraryUrl_Str = "\r\n<script src='//code.jquery.com/jquery-3.6.0.min.js'></script>\r\n";
			$LoginPictureCSSFile_Str = "\r\n<link rel='stylesheet' type='text/css' href='{$CSSDir}/LoginPicture.css'>\r\n";
			$ContentPictureCSSFile_Str = "\r\n<link rel='stylesheet' type='text/css' href='{$CSSDir}/ContentPicture.css'>\r\n";
			$HeadCSSFileInport_Str = $LoginPictureCSSFile_Str . $ContentPictureCSSFile_Str;
			if ( !isset ( $_SESSION[ 'UserAccount' ] ) ){
				$LoginPictureJsFile_Str = "\r\n<script src=".$JavaScriptDir."/LoginPictureAjax.js></script>\r\n";
				$ContentPictureJsFile_Str = "";
			}else if ( isset ( $_SESSION[ 'UserAccount' ] ) ) {
				$LoginPictureJsFile_Str = "";
				$ContentPictureJsFile_Str = "\r\n<script src=".$JavaScriptDir."/LoadContentPictureAjax.js></script>\r\n";
			}			
			$HeadJSFileInport_Str = $LoginPictureJsFile_Str.$ContentPictureJsFile_Str;
			$BodyHtmlFormt_Str = PrintHtmlLanguageArray_Fun( $BodyArray  , $BodyHtml_Str );
			$TitleHtmlFormt_Str = PrintHtmlLanguageArray_Fun( $TitleArray );
			$MetaHtmlFormt_Str = PrintHtmlLanguageArray_Fun( $MetaArray );
			if ( !isset ( $jQueryLibraryUrl_Str ) ){
				$HeadContent = $MetaHtmlFormt_Str.$TitleHtmlFormt_Str.$FavoriteIcon_Str;
			}else{
				$HeadContent = $MetaHtmlFormt_Str.$TitleHtmlFormt_Str.$FavoriteIcon_Str.$jQueryLibraryUrl_Str.$HeadCSSFileInport_Str.$HeadJSFileInport_Str;
			}
			$HeadHtmlFormt_Str = PrintHtmlLanguageArray_Fun( $HeadArray , $HeadContent , $BodyHtmlFormt_Str  );
			$DisplayHtmlFormt_Str = PrintHtmlLanguageArray_Fun( $HtmlArray , $HeadHtmlFormt_Str );
			$Doctype_Str = PrintHtmlLanguageArray_Fun( $DoctypeArray , $DisplayHtmlFormt_Str );
			$WindowJsFile_Str = "\r\n<script src=".$JavaScriptDir."/WindowContent.js></script>\r\n";
			Return $Doctype_Str.$WindowJsFile_Str;
		}else {
			Return 'BodyHtml_Str 為空';
		}
	}
?>