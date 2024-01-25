<?php
function light_query_without_data($token_wb, $link_wb){
	$ch = curl_init($link_wb);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization:' . $token_wb,
		'Content-Type:application/json'
	));
	// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE)); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	
	$res = curl_exec($ch);
	
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Получаем HTTP-код
	curl_close($ch);

		if (intdiv($http_code,100) <> 2) {
			echo     '<br> Результат обмена (SELECT without Data): '.$http_code;
		}
		if ( $http_code == 429 ) {
			
			echo     '<br> Превышен лимит по запросам. Повторите запрос через 2 минуты ';
			die('DIE');
		}

	$res = json_decode($res, true);
	return $res;
	}

/****************************************************************************************************************
**************************** Простой запрос на ВБ  с данными **************************************
****************************************************************************************************************/

function light_query_with_data($token_wb, $link_wb, $data){
	$ch = curl_init($link_wb);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization:' . $token_wb,
		'Content-Type:application/json'
	));
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE)); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	
	$res = curl_exec($ch);
	
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Получаем HTTP-код
	curl_close($ch);
	
	if (intdiv($http_code,100) <> 2) {
		   echo     '<br>Результат обмена(SELECT with Data): '.$http_code. "<br>";
	}
	if ( $http_code == 429 ) {
				echo     '<br> Превышен лимит по запросам. Повторите запрос через 2 минуты ';
		die('DIE');
	}

	$res = json_decode($res, true);

return $res;

}

/****************************************************************************************************************
****************************  ОТправка PATCH на ВБ  с данными **************************************
****************************************************************************************************************/

function patch_query_with_data($token_wb, $link_wb, $data) {
$ch = curl_init($link_wb);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Authorization:' . $token_wb,
	'Content-Type:application/json'
));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE)); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);

$res = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Получаем HTTP-код
curl_close($ch);


	if (intdiv($http_code,100) <> 2) {
		echo     '<br>Результат обмена (PATCH): '.$http_code;
	}
	if ( $http_code == 429 ) {
		echo     '<br> Превышен лимит по запросам. Повторите запрос через 2 минуты ';
		die('DIE');
	}

$res = json_decode($res, true);

return $res;
}


