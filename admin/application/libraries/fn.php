<?php

class fn{

    public static function get_date($date){
        if($date <> ""){
          return fn::date_to_db($date);
        } else {
          return "";
        }
    }

    public static function get_decimal($decimal){
        if($decimal <> ""){
          return fn::decimal_to_db($decimal);
        } else {
          return "";
        }
    }

    public static function get_list($list){
        if(is_array($list)){
          return join(",", $list);
        } else {
          return "";
        }
    }

	public static function date_to_print($date, $format = 'd/m/Y' ){
		$newDate = date('d/m/Y', strtotime($date));
		return $newDate;
	}
	public static function datetime_to_print($date, $format = 'd/m/Y H:i' ){
		$newDate = date($format, strtotime($date));
		return $newDate;
	}

	public static function date_to_db($date){
		$arrayDate = explode("/",$date);
		$newDate = date('Y-m-d', mktime(0,0,0,$arrayDate[1],$arrayDate[0],$arrayDate[2]) ) ;
		return $newDate;
	}

	public static function decimal_to_print($value){
		$newValue = number_format($value, 2, ',','.');
		return $newValue;
	}

	public static function decimal_to_db($value){
		$newValue = str_replace('R$ ','',$value);
		$newValue = str_replace('.','',$newValue);
		$newValue = str_replace(',','.',$newValue);
		return $newValue;
	}

	public static function getCollection($colecao, $propriedade, $valorComparar, $valorInteiro = TRUE){
		$novaColecao = array();
		foreach($colecao as $key => $val){
			if($valorInteiro){				
				if(intval($val->$propriedade) == intval($valorComparar)) $novaColecao[] = $val;		
			}else{				
				if($val->$propriedade == $valorComparar) $novaColecao[] = $val;
			}	
		}
		return $novaColecao;				
	}
	
	function limitarTexto($texto, $limite){
	  $contador = strlen($texto);
	  if ( $contador >= $limite ) {      
	      $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
	      return $texto;
	  }
	  else{
	    return $texto;
	  }
	} 
	
	
	function remover_acento($string) {
	    $string = preg_replace("/[áàâãä]/", "a", $string);
	    $string = preg_replace("/[ÁÀÂÃÄ]/", "A", $string);
	    $string = preg_replace("/[éèê]/", "e", $string);
	    $string = preg_replace("/[ÉÈÊ]/", "E", $string);
	    $string = preg_replace("/[íì]/", "i", $string);
	    $string = preg_replace("/[ÍÌ]/", "I", $string);
	    $string = preg_replace("/[óòôõö]/", "o", $string);
	    $string = preg_replace("/[ÓÒÔÕÖ]/", "O", $string);
	    $string = preg_replace("/[úùü]/", "u", $string);
	    $string = preg_replace("/[ÚÙÜ]/", "U", $string);
	    $string = preg_replace("/ç/", "c", $string);
	    $string = preg_replace("/Ç/", "C", $string);
	    $string = preg_replace("/[][><}{)(:;,!?*%~^`&#@]/", "", $string);
	    $string = preg_replace("/ /", "_", $string);
	    return $string;
	}	
	
	
	
	
	
	
	
}
?>