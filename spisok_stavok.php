<?php
require_once "func.php";
require_once "topen.php";
require_once "functions.php";
echo "<link rel=\"stylesheet\" href=\"styles.css\">";


// получаем список компаний
// $res = get_all_campanies($token_reklama ,9); // второй парамет - статус компании Если поставить 0 - то выведет вернет все статусы

echo "<pre>";
// // print_r($res);


// получаем полную информацию о кампании
$link = 'https://advert-api.wb.ru/adv/v0/advert?id=12130740';
$g111 = light_query_without_data ($token_reklama, $link);


print_r($g111);
// die();

$link = 'https://advert-api.wb.ru/adv/v0/allcpm?type=6';

$data = array (
    'param' =>array(3744)
);

$ggg = light_query_post_without_data ($token_reklama, $link, $data);



print_r($ggg);



echo "<br>";
die('KONEC');


function light_query_post_without_data($token_wb, $link_wb, $data){
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
	
		echo     '<br> Результат обмена (SELECT without Data): '.$http_code;
		
	$res = json_decode($res, true);
	
	return $res;
	}